<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Transbank\Webpay\WebpayPlus\Transaction;


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
        ];


        if (env('APP_ENV') != "local") {
            \Transbank\Webpay\WebpayPlus::configureForProduction(config("webpay.commerce_code"), 'tu-api-key');
        }


        if (!Arr::has($transactionData, null)) {
            $transaction = (new Transaction)
                         ->create(
                             $transactionData["buyOrder"],
                             $transactionData["sessionId"],
                             $transactionData["monto"],
                             $transactionData["returnUrl"]
                         );

            $context = [
                "status" => "OK",
                "url" => $transaction->getUrl(),
                "token" => $transaction->getToken(),
            ];

            return response()->json($context);
        }

        $context = [
            "status" => 'ERROR'
        ];

        return response()->json($context);

    }

    /**
     * Generación del voucher
     *
     * @return \Illuminate\Http\Response
     */
    public function voucher(Sale $sale, Request $request)
    {

        if (!$request->has('token_ws')) {
            return view('webpay/rechazo');
        }

        if (env('APP_ENV') != "local") {
            \Transbank\Webpay\WebpayPlus::configureForProduction(config("webpay.commerce_code"), 'tu-api-key');
        }

        $transaction = (new Transaction)->commit($request->input("token_ws"));

        if ($transaction->isApproved()) {
            $cardNumber = $transaction->getCardDetail();
            $cardNumber = $cardNumber["card_number"];
            $result = [
                "amount" => $transaction->getAmount(),
                "buyOrder" => $transaction->getBuyOrder(),
                "sessionId" => $transaction->getSessionId(),
                "accountingDate" => $transaction->getAccountingDate(),
                "transactionDate" => $transaction->getTransactionDate(),
                "paymentTypeCode" => $transaction->getPaymentTypeCode(),
                "installmentsAmount" => $transaction->getInstallmentsAmount(),
                "installmentsNumber" => $transaction->getInstallmentsNumber(),
                "authorizationCode" => $transaction->getAuthorizationCode(),
                "cardNumber" => $cardNumber,
                "balance" => $transaction->getBalance(),
            ];

            $orden = Sale::find(intval($transaction->getBuyOrder()));
            $orden->result = json_encode($result);
            $orden->save();

            $orden->actualizarStock();
            $orden->createTransaction();

            if (Session::has('premium') && Session::get('premium')) {
                $user = User::find(Auth::user()->id);
                $user->premium = true;
                $user->save();
            }

            return view('webpay/exito')->with(compact('result', 'sale'));
        }
            return view('webpay/rechazo')->with(compact('transaction'));

    }
}
