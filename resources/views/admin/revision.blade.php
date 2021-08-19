@extends('layouts.admin')

@section('content')
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Nombre Completo:</b>
    </div>
    <div class="col-md">
      {{ $profile->name . " " . $profile->surname }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Tarifa Base:</b>
    </div>
    <div class="col-md">
      {{ $profile->price }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>RUT:</b>
    </div>
    <div class="col-md">
      {{ $profile->rut }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Modalidad Preferida:</b>
    </div>
    <div class="col-md">
      {{ ucfirst($profile->modalidad) }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Cantidad de Estudiantes Preferida:</b>
    </div>
    <div class="col-md">
      {{ ucfirst($profile->cantidad) }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Telefono:</b>
    </div>
    <div class="col-md">
      {{ $profile->phone }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Correo:</b>
    </div>
    <div class="col-md">
      {{ $profile->user->email }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 text-lg-right">
      <b>Direccion:</b>
    </div>
    <div class="col-md">
      {{ $profile->address }}
    </div>
  </div>
  <div class="form-row">
    <div class="col-lg-4 text-lg-right">
      <b>Descripcion:</b>
    </div>
    <div class="col-md">
      {{ $profile->description }}
    </div>
  </div>
  <div class="form-row justify-content-center mt-2">
    <div class="col-md-2">
      <a class="btn btn-success" href="{{ route('tutor.estado', ["profile" => $profile, "estado" => "1"]) }}">Aceptar</a>
      <a class="btn btn-danger" href="{{ route('tutor.estado', ["profile" => $profile, "estado" => "0"]) }}">Rechazar</a>
    </div>
  </div>
@endsection
