@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <img class="img-fluid img-thumbnail h-lg-50 float-right my-4 my-lg-0" src="{{ asset('storage/' . $profile->image) }}" alt="Tu Imagen de Perfil" />
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title border-bottom">Tus Datos</h5>
            <p>
              <b>Nombre Completo: </b> {{ $profile->name . " " . $profile->surname }} <br />
              @if(isset($profile->user->email))
                <b>E-mail: </b> {{ $profile->user->email }} <br />
              @endif
              @if(isset($profile->user->phone))
                <b>Telefono: </b> {{ $profile->phone }} <br />
              @endif
              @if(isset($profile->commune) && isset($profile->commune->name))
                <b>Comuna: </b> {{ $profile->commune->name }} <br />
              @endif
              @if(isset($profile->address))
                <b>Direccion: </b> {{ $profile->address }}
              @endif
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 my-4 my-lg-0">
        <div class="list-group">
          <a href="{{ route('profile.edit', $profile) }}" class="list-group-item list-group-item-action">Edita tu Perfil</a>
          <a href="{{ route('chat.index') }}" class="list-group-item list-group-item-action">Tus Chats</a>
          @if (Auth::user()->role->name === 'tutor')
            <a href="{{ route('tutorias.index') }}" class="list-group-item list-group-item-action">Tus Tutorias</a>
          @endif
          @if (Auth::user()->role->name !== 'tutor')
            <a href="{{ route('tutor.solicitar') }}" class="list-group-item list-group-item-action">Vuelvete un UkeProfe</a>
          @endif

        </div>
      </div>
    </div>
    <div class="row">
      <h4 class="mx-auto">Tu Historial de Compras</h4>
      <div class="col-md-12 table-responsive border-top pt-4">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Estado</th>
              <th scope="col">Cantidad de Productos</th>
              <th scope="col">Descuento</th>
              <th scope="col">Total de la compra</th>
              <th scope="col">Detalle</th>
            </tr>
          </thead>
          <tbody>
            @if ($historial->count() > 0)
              @foreach($historial as $venta)
                <tr>
                  <td>{{ $venta->created_at }}</td>
                  <td>{{ ucfirst(strtolower($venta->estado)) }}</td>
                  <td>{{ $venta->products->count() }}</td>
                  <td>$ {{ number_format($venta->discount ?? 0) }}</td>
                  <td>$ {{ number_format($venta->total) }}</td>
                  <td>
                    <a class="btn btn-primary" href="{{ route('sale.show', $venta) }}">Ver Detalle</a>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5">Aun no has realizado ninguna compra :c</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
