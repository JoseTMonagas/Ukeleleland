@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="card-title border-bottom text-primary text-center">Detalles de la Clase</h5>
    <div class="row">
        <div class="col-md-12 border-bottom  p-4 my-2">
            <strong class="border-bottom text-center text-primary">Datos sobre la Clase
                @if(Auth::user()->role->name === 'tutor')
                    <a class="btn btn-warning float-right" href="{{ route('clases.edit', ['tutoria' => $tutoria, 'clase' => $clase]) }}">Editar</a>
                @endif
            </strong>
            <div class="table-responsive">
                <table class="table table-sm mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Duracion (Horas)</th>
                            <th scope="col">Tarifa ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $clase->fecha_clase }}</td>
                            <td>{{ $clase->duracion }}</td>
                            <td>{{ number_format($clase->tarifa) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <b>Observaciones del Tutor:</b> <br />
            <span>{{ $clase->observaciones ?? 'Ninguna' }}</span>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-md-4 border-bottom p-4 mx-1">
            <strong class="border-bottom text-center text-primary">Datos sobre el Tutor</strong>
            <div class="d-flex flex-column">
                <span><b>Nombre: </b>{{ $tutoria->tutor->name }}</span>
                <b>Sobre mi: </b>
                <span>{{ $tutoria->tutor->profile->description }}</span>
                <img class="img-fluid img-thumbnail" alt="..." src="{{ $tutoria->tutor->profile->image }}" />
            </div>
        </div>
        <div class="col-md-4 border-bottom p-4 mx-1">
            <strong class="border-bottom text-center text-primary">Datos sobre el Estudiante</strong>
            <div class="d-flex flex-column">
                <span><b>Nombre: </b>{{ $tutoria->estudiante->name }}</span>
                <b>Sobre mi: </b>
                <span>{{ $tutoria->estudiante->profile->description }}</span>
                <img class="img-fluid img-thumbnail" alt="..." src="{{ $tutoria->estudiante->profile->image }}" />
            </div>
        </div>
    </div>
</div>
@endsection
