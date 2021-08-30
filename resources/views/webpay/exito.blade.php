@extends('layouts.app')

@section('pixel-event')
    <script>
     fbq('track', 'Purchase', {value: {{ $result['amount'] }}, currency: 'CLP'});
     gtag('event', 'conversion', { 'send_to': 'AW-679334487/LaxMCPfJpMkBENek98MC', 'value': {{ $result['amount'] }}, 'currency': 'CLP', 'transaction_id': '{{ $result['buyOrder'] }}' });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="display-4 text-primary border-bottom">¡Tu compra fue un exito!</div>
            <div class="row">
                <div class="col-md-2 d-flex flex-column">
                    <b>N° Orden de Pedido:</b>
                    <span>N° {{ str_pad($sale->id, 5, "0", STR_PAD_LEFT) }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <b>Fecha:</b>
                    <span>{{ $result["transactionDate"]  }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <b>Ukeleleland</b>
                    <span>77035402-1</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 d-flex flex-column">
                    <b>Tipo de Pago:</b>
                    <span>
                        @switch($result['paymentTypeCode'])
                            @case("VD")
                                Venta debito
                                                        @break
                            @case("VN")
                                Venta normal
                                                        @break
                            @case("VC")
                                Cuotas normales
                                                        @break
                            @case("S1")
                                3 cuotas sin interes
                                                        @break
                            @case("S2")
                                2 cuotas sin interes
                                                        @break
                            @case("VP")
                                Venta prepago
                                                        @break
                            @default
                            {{ (explode('C', $result['paymentTypeCode']))[0] }} Cuotas Sin Interes
                        @endswitch
                    </span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <b>N° de Cuotas:</b>
                    <span>{{ $result['installmentsNumber'] ?? 0 }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <b>Monto de cuotas:</b>
                    <span>{{ $result['installmentsAmount'] ?? 0 }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <b>Codigo de Autorizacion:</b>
                    <span>{{ $result["authorizationCode"]  }}</span>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <b>Tarjeta utilizada (Ultimos 4 digitos):</b>
                    <span>{{ $result["cardNumber"]  }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="">
                            <tr class="table-primary">
                                <th scope="row">SKU</th>
                                <th scope="row">Producto</th>
                                <th scope="row">Cantidad</th>
                                <th scope="row">Precio Unitario</th>
                                <th scope="row">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(\Session::has('premium') && \Session::get('premium'))
                                <tr>
                                    <td>ESPECIAL</td>
                                    <td>SIN LIMITES</td>
                                    <td>1</td>
                                    <td>1.000 CLP</td>
                                    <td>1.000 CLP</td>
                                </tr>
                            @else
                                @foreach (\Cart::content() as $item)
                                    <tr>
                                        <td>{{ str_pad($item->id, 5, "0", STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->price) }} CLP</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->subtotal) }} CLP</td>
                                    </tr>
                                @endforeach
                            @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-8 d-flex flex-column">
                    <span>
                        <b>Total:</b>
                        {{ number_format(\Cart::total()) }} CLP
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
