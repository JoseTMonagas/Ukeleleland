@extends('layouts.app')

@section('pixel-event')
  fbq('track', 'Contact');
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body p-5">
            <h3 class="card-title text-primary border-bottom text-center">Contactanos</h3>
            <form action="{{ route('contact') }}" method="POST">
              @csrf

              <div class="form-group">
                <label for="name">Nombre/s</label>
                <input class="form-control" name="name" type="text"/>
              </div>
              <div class="form-group">
                <label for="surname">Apellido/s</label>
                <input class="form-control" name="surname" type="text"/>
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" name="email" type="email"/>
              </div>
              <div class="form-group">
                <label for="">Mensaje</label>
                <textarea cols="30" class="form-control" name="message" rows="10"></textarea>
              </div>

              <button type="submit" class="btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
