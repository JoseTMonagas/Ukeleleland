@extends('layouts.app')

@section('pixel-event')
<script>
   // fbq('track', 'Purchase', {value: {{ $result['amount'] }}, currency: 'CLP'});
   // gtag('event', 'conversion', { 'send_to': 'AW-679334487/LaxMCPfJpMkBENek98MC', 'value': {{ $result['amount'] }}, 'currency': 'CLP', 'transaction_id': '{{ $result['buyOrder'] }}' });
</script> 
@endsection

@section('content')
<div class="container-fluid">
  <div class="jumbotron">
    <div class="display-4 text-primary border-bottom">¡Tu compra fue un exito!</div>
    <div class="table-responsive">
      <table class="table table-hover">
        <tr>
          <th class="text-right">N° Orden de Pedido:</th>
          <td>{{ $sale->id }}</td>
          <th class="text-right">Fecha de la Transaccion:</th>
          <td>{{ $sale->updated_at }}</td>
          <th>Ukeleleland</th>
          <th>77035402-1</th>
        </tr>
        <tr>
        </tr>
        <tr>
          <th class="text-right">Tipo de Pago:</th>
          <td>
              @switch($result['paymentTypeCode'])
                  @case("VN")
                      Venta Normal
                      @break
                  @case("VD")
                      Debito
                      @break
                  @case("VP")
                      Venta Prepago
                      @break
                  @case("VC")
                      Cuotas Normales
                      @break
                  @default
                      Cuotas Sin Interes
              @endswitch
          </td>
          <th class="text-right">N° de Cuotas:</th>
          <td>{{ $result['installmentsNumber'] }}</td>
          <th class="text-right">Tipo de Cuotas:</th>
          <td>
            @if($result['paymentTypeCode'] == "VC")
            Cuotas Normales
            @elseif($result['paymentTypeCode'] == "SI")
            3 Cuotas Sin Interes
            @elseif($result['paymentTypeCode'] == "S2")
            2 Cuotas Sin Interes
            @elseif ($result['paymentTypeCode'] != 'VN')
            {{ (explode('C', $result['paymentTypeCode']))[0] }} Cuotas Sin Interes
            @else
            Sin Cuotas
            @endif
          </td>
        </tr>
        <tr class="border-bottom">
          <th class="text-right">Codigo de Autorizacion:</th>
          <td colspan="2">{{ $result['authorizationCode'] }}</td>
          <th class="text-right">Ultimos 4 Digitos de la Tarjeta:</th>
          <td colspan="2">{{ $result['cardNumber'] }}</td>
        </tr>
        <tr class="table-primary">
          <th colspan="2">Detalle</th>
          <th>Precio Unitario</th>
          <th>Cantidad</th>
          <th>Total</th>
        </tr>
        @if(\Session::has('premium') && \Session::get('premium'))
        <tr>
          <td colspan="2">SIN LIMITES</td>
          <td>$ 1.000</td>
          <td>1</td>
          <td>$ 1.000</td>
        </tr>
        @else
        @foreach (\Cart::content() as $item)
        <tr>
          <td colspan="2">{{ $item->name }}</td>
          <td>$ {{ number_format($item->price) }}</td>
          <td>{{ $item->qty }}</td>
          <td>$ {{ number_format($item->subtotal) }}</td>
          @if ($item->model instanceof \App\Asset)
          <td><a href="{{ $item->model->file_url }}">Descargar</a></td>
          @endif
        </tr>
        @endforeach
        @endif
      </table>
    </div>
  </div>
</div>
@endsection
@php
if(!(\Session::has('premium') && \Session::get('premium'))) {
\Cart::destroy();
session()->forget('compra');
session()->forget('premium');
}
@endphp
