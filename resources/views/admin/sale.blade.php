@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
	@if(isset($msg))
<div class="alert alert-info">{{ $msg }}</div>
@endif
    <div class="table-responsive">
      <table class="table table-sm" id="table">
        <thead>
          <tr>
            <th scope="col">Folio</th>
            <th scope="col">Sesion</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
            <th scope="col">Descuento</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipo de Pago</th>
            <th scope="col">Comprador</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $sale)
            <tr>
              <td>{{ $sale->id }}</td>
              <td>{{ $sale->sesion }}</td>
              <td>{{ $sale->created_at }}</td>
              <td>$ {{ number_format($sale->total) }}</td>
              <td>$ {{ number_format($sale->descuento) }}</td>
              <td>{{ $sale->estado }}</td>
              <td>{{ $sale->tipo_pago }}</td>
              <td>{{ ucfirst($sale->profile['name']) . ' ' . ucfirst($sale->profile['surname']) }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('sale.show', $sale)}}">Ver</a>
                <a class="btn btn-primary" href="{{ route('sale.edit', $sale)}}">Actualizar Estado</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
   $(document).ready(function() {
     $('#table').DataTable({
       language: {
         url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
       }
     });
   } );
  </script>
@endsection
