@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="display-4 text-center">¡Clases sin limites!</div>
        <p clas="p-2 mt-4">Por tan solo $ 1.000 puedes disfrutar de tantas clases como quieras, sin limite alguno, domina el arte del Ukelele ahora.</p>
        <strong class="text-primary border-bottom h5 my-4">$ 1.000 y disfruta de clases ilimitadas</strong>
        <div class="row justify-content-around mt-4">
          <a class="btn btn-success" href="{{ route('liberar.webpay') }}">Webpay</a>
          <transferencia-dlg transaction-action="{{ route('liberar.transferencia') }}"></transferencia-dlg>
        </div>
      </div>
    </div>
  </div>
@endsection
