<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Http\Requests\SaleForm;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Region;
use App\Sale;
use Barryvdh\DomPDF\Facade as PDF;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::all();
        return view('admin.sale')->with(compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = \App\Commune::all();
        return view('sale')->with(compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = collect([
            "name" => $request->input('name'),
            "surname" => $request->input('surname'),
            "phone" => $request->input('phone'),
            "email" => $request->input('email'),
            "rut" => $request->input('rut'),
            "commune" => $request->input('commune'),
            "address" => $request->input('address'),
        ]);
        $discount = session()->get('coupon')['discount'] ?? 0;
        $subtotal = intval(str_replace(",", "", \Cart::subtotal()));

        $commune = \App\Commune::where('name', $request->input('commune'))->get()->first();
        $dispatchPrice = \DB::table('dispatch_prices')->where('commune_id', $commune->id)->first()->price;
        $dispatch = ($dispatchPrice > 1) ? $dispatchPrice : 0;
        $amount = $subtotal - $discount + $dispatch;

        $sale = \App\Sale::create([
            'sesion' => (\Carbon\Carbon::now()->timestamp),
            'total' => $amount,
            'descuento' => $discount,
            'profile' => json_encode($user->toArray()),
            'tipo_pago' => 'Transferencia'
        ]);

        if (\Auth::user()) {
            $sale->users()->attach(\Auth::user()->id);
        }

        foreach (\Cart::content() as $item) {
            if ($item->model instanceof \App\Product) {
                $sale->products()->attach($item->model->id, ['cantidad' => $item->qty, 'precio' => $item->subtotal]);
            } else {
                $sale->assets()->attach($item->model->id, ['cantidad' => 1, 'precio' => $item->subtotal]);
            }
        }

        \Cart::destroy();

        $sale->sendCreated();

        $msg = [
            "status" => "OK",
            "msg" => "Venta Creada"
        ];

        return response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $commune = \App\Commune::where('name', $sale->profile['commune'])->get();
        if ($commune->count() > 0) {
            $dispatch = \DB::table('dispatch_prices')->where('commune_id', $commune->first()->id)->first()->price;
        } else {
            $dispatch = 0;
        }


        $data = collect([
            "fullName" => $sale->profile['name'] . " " . $sale->profile['surname'],
            "rut" => $sale->profile['rut'],
            "address" => $sale->profile['address'],
            "contact" => $sale->profile['phone'],
            "email" => $sale->profile['email'],
            "commune" => $sale->profile['commune'],
            "dispatchPrice" => $dispatch,
            "buyOrder" => $sale->id,
            "date" => $sale->created_at,
            "tipo" => $sale->tipo_pago,
            "products" => $sale->products()->get(),
            "subtotal" => $sale->total - $sale->discount,
            "discount" => $sale->discount ?? 0,
            "total" => $sale->total
        ]);

        $pdf = PDF::loadView('pdf.detalle', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    public function edit(Sale $sale)
    {
        return view('admin.estado')->with(compact('sale'));
    }


    public function update(Request $request, Sale $sale)
    {
        $sale->estado = $request->input('estado');
        $sale->empresa = $request->input('empresa');
        $sale->seguimiento = $request->input('seguimiento');
        $sale->fecha_entrega = $request->input('fecha_entrega');
        $sale->mensaje = $request->input('mensaje');
        if ($sale->saveOrFail()) {
            if ($sale->estado === 'ENVIADO') {
                $sale->actualizarStock();
                $sale->sendCreated();
                $sale->createTransaction();
            }
            return redirect()->route('sale.index');
        } else {
            return redirect()->route('sale.index');
        }
    }

    public function webpaySale(SaleForm $request)
    {
        $form = $request->validated();
        $discount = $request->session()->get('coupon')['discount'] ?? 0;
        $subtotal = intval(str_replace(",", "", Cart::subtotal()));
        $commune = \App\Commune::where('name', $form["commune"])->get()->first();
        $dispatchPrice = DB::table('dispatch_prices')->where('commune_id', $commune->id)->first()->price;
        $dispatch = ($dispatchPrice > 1) ? $dispatchPrice : 0;
        $amount = $subtotal - $discount + $dispatch;

        $sale = Sale::create([
            'sesion' => (\Carbon\Carbon::now()->timestamp),
            'total' => $amount,
            'descuento' => $discount,
            'profile' => json_encode($form),
            'tipo_pago' => 'webpay'
        ]);

        if (Auth::user()) {
            $sale->users()->attach(Auth::user()->id);
        }

        foreach (Cart::content() as $item) {
            if ($item->model instanceof \App\Product) {
                $sale->products()->attach($item->model->id, ['cantidad' => $item->qty, 'precio' => $item->subtotal]);
            } else {
                $sale->assets()->attach($item->model->id, ['cantidad' => 1, 'precio' => $item->subtotal]);
            }
        }

        if ($sale->id > 0) {
            $status = [
                "status" => "OK",
                "url" => route("webpay.init", $sale),
            ];
        } else {
            $status = [
                "status" => "error"
            ];

            Log::error([
                $form, $amount
            ]);
        }


        return response()->json($status);

    }
}
