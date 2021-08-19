@extends('layouts.app')

@section('content')
    @php
        $response = \Session::get('result');
    @endphp
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="display-5 text-primary border-bottom">Tu compra fue rechazada</div>
            <div class="jumbotron">
                Orden de Compra: {{ $response->buyOrder ?? 'Compra Anulada' }} <br>
                Las posibles causas de este rechazo son: <br>
                Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad). <br>
                Su tarjeta de Crédito o Débito no cuenta con saldo suficiente. <br>
                Tarjeta aún no habilitada en el sistema financiero.
            </div>
        </div>
    </div>
@endsection
