//TODO: Agregar diseño de seleccion de planes premium
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-primary border-bottom text-center">Solicita tu UkePremium</h5>
            <form action="">
                <input name="subscripcion" type="radio" value="1" />
                <input name="subscripcion" type="radio" value="3" />
                <input name="subscripcion" type="radio" value="6" />
                <input name="subscripcion" type="radio" value="12" />

                <button class="btn btn-primary">Webpay</button>
                <button class="btn btn-primary">Transferencia</button>
            </form>
        </div>
        <div class="col-md-6">
            <strong class="text-primary border-bottom text-center">Las ventajas de ser Premium</strong>
            <ul>
                <li>Test</li>
                <li>test</li>
                <li>test</li>
                <li>test</li>
            </ul>
        </div>
    </div>
</div>
@endsection
