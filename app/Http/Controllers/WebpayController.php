<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;

class WebpayController extends Controller
{
    /**
     * Start WebPay
     *
     * @return \Illuminate\Http\Response
     */
    public function init(Sale $sale)
    {

        $transaction  = null;

        $transactionData = [
            "monto" => $sale->total,
            "sessionId" => $sale->sesion,
            "buyOrder" => $sale->id,
            "returnUrl" => route('webpay.voucher', $sale),
            "finalUrl" => route('webpay.finish', $sale),
        ];

        if (env('APP_ENV') == "local") {
            $transaction = (new Webpay(
                Configuration::forTestingWebpayPlusNormal())
            )->getNormalTransaction();
        } else {
            $configuration = new Configuration;
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(config("webpay.commerce_code"));
            $configuration->setPublicCert(config("webpay.public_cert"));
            $configuration->setPrivateKey(config("webpay.private_key"));

            $webpay = new Webpay($configuration);
            

            $transaction = $webpay->getNormalTransaction();
            
            
        }

        if ($transaction != null && !Arr::has($transactionData, null)) {
            $initResult = $transaction->initTransaction(
                $transactionData["monto"],
                $transactionData["buyOrder"],
                $transactionData["sessionId"],
                $transactionData["returnUrl"],
                $transactionData["finalUrl"],
            );
            

            $formAction = $initResult->url;
            $tokenWs = $initResult->token;

            return view('webpay/token')->with(compact('formAction', 'tokenWs'));
        }

        return redirect()->route('home');

    }

    /**
     * Generación del voucher
     *
     * @return \Illuminate\Http\Response
     */
    public function voucher(Sale $sale, Request $request)
    {

        if (!$request->has('token_ws')) {
            return 'Error. No token recibido';
        }

        $transaction = null;

        if (env('APP_ENV') == "local") {
            $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))->getNormalTransaction();
        } else {
            $configuration = new Configuration;
            $configuration->setEnvironment("PRODUCCION");
            $configuration->setCommerceCode(config('webpay.commerce_code'));
            $configuration->setPublicCert(config('webpay.public_cert'));
            $configuration->setPrivateKey(config('webpay.private_key'));

            $webpay = new Webpay($configuration);
            

            $transaction = $webpay->getNormalTransaction();
        }

        if (isset($transaction)) {
            $tokenWs = $request->input('token_ws');
            $result = $transaction->getTransactionResult($tokenWs);
            $output = $result->detailOutput;

            $orden = Sale::find(intval($output->buyOrder));
            $orden->result = json_encode($result);
            $orden->save();

            $formAction = $result->urlRedirection;

            if ($output->responseCode == 0) {
                $orden->actualizarStock();
                $orden->sendCreated();
                $orden->createTransaction();
                if (Session::has('premium') && Session::get('premium')) {
                    $user = User::find(Auth::user()->id);
                    $user->premium = true;
                    $user->save();
                }
                return view('webpay/token')->with(compact('tokenWs', 'formAction'));
            } else {
                return view('webpay/rechazo')->with(compact('output'));
            }

            return view('webpay/rechazo')->with(compact('output'));
        }

    }
    /**
     * Finaliza la compra en Webpay
     *
     * @return \Illuminate\Http\Response
     */
    public function finish(Sale $sale)
    {
        $result = json_decode($sale->result, true);

        if (isset($result) && $result["detailOutput"]["responseCode"] == 0) {
            return view('webpay/exito')->with(compact('result', 'sale'));
        } else {
            return view('webpay/rechazo')->with(compact('result', 'sale'));
        }
    }
}
