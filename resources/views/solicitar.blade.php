@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-light">Vuelvete un Ukeprofe</div>

          <div class="card-body">
            <form method="POST" action="{{ route('tutor.realizarSolicitud', \Auth::user()->profile) }}">
              @csrf

              <div class="row">
                <div class="col-md">
                  <div class="form-row align-items-baseline">
                    <i class="col-1 fas fa-user"></i>
                    <input type="text" class="col form-control-plaintext" disabled value="{{ $profile->name . ' ' . $profile->surname }}">
                  </div>
                  <div class="form-row align-items-baseline">
                    <i class="col-1 fas fa-at"></i>
                    <input type="text" class="col form-control-plaintext" disabled value="{{ $profile->user->email }}">
                  </div>

                  <div class="form-row align-items-baseline">
                    <i class="col-1 fas fa-phone"></i>
                    <input type="text" class="col form-control-plaintext" disabled value="{{ $profile->phone }}">
                  </div>

                  <div class="form-row align-items-baseline">
                    <i class="col-1 fas fa-map-marker-alt"></i>
                    <p class="col">{{ $profile->address }}</p>
                  </div>
                  <div class="form-group form-row">
                    <label for="precio">Tarifa Basica:</label>
                    <input class="form-control" name="precio" type="text"/>
                    <small class="text-muted">Precio base que se muestra a los usuarios que ven tu perfil.</small>
                  </div>

                  <div class="form-group form-row">
                    <label for="modalidad">Modalidad Preferida de Tutoria:</label>
                    <select class="form-control" name="modalidad">
                      <option value="presencial">Presencial</option>
                      <option value="virtual">Virtual</option>
                      <option value="cualquiera">Cualquiera</option>
                    </select>
                    <small class="text-muted">¿Prefieres dar clases en persona o por internet?</small>
                  </div>

                  <div class="form-group form-row">
                    <label for="cantidad">Cantidad de estudiantes:</label>
                    <select class="form-control" name="cantidad">
                      <option value="individual">Individual</option>
                      <option value="grupal">Grupal</option>
                      <option value="cualquiera">Cualquiera</option>
                    </select>
                    <small class="text-muted">¿Prefieres trabajar con grupos o con un solo estudiante?</small>
                  </div>

                  <div class="form-group form-row">
                    <label for="descripcion">Describete:</label>
                    <textarea class="form-control" cols="30" id="" name="descripcion" rows="10"></textarea>
                    <small class="text-muted">
                      Escribe un descripcion breve de ti mismo. Tus experiencias enseñando, tus años de practica; esta descripcion la veran los usuarios que entren a tu perfil.
                    </small>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Enviar') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
