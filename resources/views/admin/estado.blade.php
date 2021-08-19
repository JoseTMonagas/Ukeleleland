@extends('layouts.admin')

@section('content')
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Fecha:</b>
    </div>
    <div class="col-md">
      {{ $sale->created_at }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Sesion Unica:</b>
    </div>
    <div class="col-md">
      {{ $sale->sesion }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Total:</b>
    </div>
    <div class="col-md">
      $ {{ number_format($sale->total) }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Descuento:</b>
    </div>
    <div class="col-md">
      $ {{ number_format($sale->descuento) }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Tipo de Pago</b>
    </div>
    <div class="col-md">
      {{ ucfirst($sale->tipo_pago) }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Nombre del Comprador:</b>
    </div>
    <div class="col-md">
      {{ $sale->profile['name'] . ' ' . $sale->profile['surname'] }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Correo del Comprador:</b>
    </div>
    <div class="col-md">
      {{ $sale->profile['email'] }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-lg-4 text-lg-right">
      <b>Comuna del Comprador:</b>
    </div>
    <div class="col-md">
      {{ $sale->profile['commune'] }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Direccion del Comprador:</b>
    </div>
    <div class="col-md">
      {{ $sale->profile['address'] }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-lg-4 text-lg-right">
      <b>Telefono del Comprador:</b>
    </div>
    <div class="col-md">
      {{ $sale->profile['phone'] }}
    </div>
  </div>

  <form action="{{ route('sale.update', $sale) }}" method="POST">
    @csrf

    <div class="form-group form-row">
      <label for="estado" class="col-lg-4 text-right">Estado de la Transaccion:</label>
      <select class="col-lg form-control form-control-sm" name="estado">
        <option value="EN PROCESO" selected>En Proceso</option>
        <option value="ENVIADO">Enviado</option>
        <option value="RECHAZADO">Rechazado</option>
      </select>
    </div>

    <div class="form-group form-row">
      <label for="empresa" class="col-lg-4 text-right">Empresa de Transporte:</label>
      <input class="col-lg form-control form-control-sm" name="empresa" type="text"/>
    </div>

    <div class="form-group form-row">
      <label for="seguimiento" class="col-lg-4 text-right">N° de Seguimiento:</label>
      <input class="col-lg form-control form-control-sm" name="seguimiento" type="text"/>
    </div>

    <div class="form-group form-row">
      <label for="fecha_entrega" class="col-lg-4 text-right">Fecha aproximada de entrega:</label>
      <input class="col-lg form-control form-control-sm" name="fecha_entrega" type="date"/>
    </div>

    <div class="form-group form-row">
      <label for="mensaje" class="col-lg-4 text-right">Mensaje Adicional:</label>
      <textarea class="col-lg form-control form-control-sm" cols="30" name="mensaje" rows="10"></textarea>
    </div>

    <div class="form-row justify-content-center mt-2">
      <button class="btn btn-primary">Actualizar Estado</button>
    </div>

  </form>
@endsection
