@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title border-bottom text-primary text-center">{{ isset($tutoria) ? 'Editar' : 'Crear' }} Clase</h5>
            <form
                action="{{ isset($clase) ? route('clases.update', ['tutoria' => $tutoria, 'clase' => $clase]) : route('clases.store', ['tutoria' => $tutoria, 'clase' => $clase])}}"
                method="POST"
                accept-charset="utf-8">
                @csrf

                <div class="form-row justify-content-around">
                    <div class="form-group col-md-3">
                        <label>Fecha:</label>
                        <input @if(isset($clase)) {{ __("value=".$clase->fecha_clase) }} @endif class="form-control" type="date" name="fecha_clase" required />
                        <small class="text-muted">Fecha en que se realiza la clase</small>
                        @if ($errors->has('fecha_clase'))
                        @foreach ($errors->get('fecha_clase') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Duracion (Horas):</label>
                        <input @if(isset($clase)) {{ __("value=".$clase->duracion) }} @endif class="form-control" type="text" name="duracion" required>
                        <small class="text-muted">Duracion en horas de la clase.</small>
                        @if ($errors->has('duracion'))
                        @foreach ($errors->get('duracion') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-row justify-content-around">
                    <div class="form-group col-md-3">
                        <label>Tarifa ($):</label>
                        <input class="form-control" name="tarifa" type="text" @if(isset($clase)) value="{{ $clase->tarifa }}" @endif />
                        <small class="text-muted">Tarifa de la clase realizada. {{ 'Por '.$tutoria->tipo }}</small>
                        @if ($errors->has('tarifa'))
                        @foreach ($errors->get('tarifa') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Observaciones:</label>
                        <textarea @if(isset($clase)) {{ __("value=".$clase->observaciones) }} @endif class="form-control" name="observaciones" cols="30" rows="10"></textarea>
                        @if ($errors->has('observaciones'))
                        @foreach ($errors->get('observaciones') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
