@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-light">Crea tu UkePerfil</div>

          <div class="card-body">
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
              @csrf
              <input name="user_id" type="hidden" value="{{ \Auth::user()->id }}"/>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="text-md-right">Nombre/s:</label>

                    <div class="col-md">
                      <input
                        id="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                            name="name"
                        autocomplete="name" autofocus>

                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="surname" class="text-md-right">Apellido/s:</label>

                    <div class="col-md">
                      <input
                        id="surname"
                        type="text"
                        class="form-control @error('surname') is-invalid @enderror"
                            name="surname"
                        autocomplete="surname" autofocus>

                      @error('surname')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm" class="text-md-right">Telefono:</label>

                    <div class="col-md">
                      <input
                        type="text"
                        class="form-control"
                        name="phone"
                        autocomplete="phone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="image" class="text-md-right">Foto de Pefil:</label>

                    <div class="col-md">
                      <input
                        type="file"
                        class="form-control"
                        name="image">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="rut" class="text-md-right">RUT:</label>

                    <div class="col-md">
                      <input
                        type="text"
                        class="form-control"
                        name="rut"
                        autocomplete="rut">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="comuna" class="text-md-right">Comuna:</label>

                    <div class="col-md">
                      <filter-select :data='@json($communes)' name="commune_id" value="id" label="name"></filter-select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address" class="text-md-right">Direccion:</label>

                    <div class="col-md">
                      <textarea name="address" rows="12" cols="20" class="form-control" autocomplete="address"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Guardar') }}
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
