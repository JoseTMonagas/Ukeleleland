@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="card-title border-bottom text-primary text-center">Detalles de la Tutoria</h5>
    <div class="row">
        <div class="col-md-12 border-bottom  p-4 my-2">
            <strong class="border-bottom text-center text-primary">Datos sobre la Tutoria
                @if(Auth::user()->role->name === 'tutor')
                    <a class="btn btn-warning float-right" href="{{ route('tutorias.edit', $tutoria) }}">Editar</a>
                @endif
            </strong>
            <div class="table-responsive">
                <table class="table table-sm mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Tutoria</th>
                            <th scope="col">Cantidad (Clases o Horas)</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha de Culminacion</th>
                            <th scope="col">¿Tutoria Finalizada?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __("Por ".$tutoria->tipo) }}</td>
                            <td>{{ $tutoria->cantidad }}</td>
                            <td>{{ $tutoria->fecha_inicio }}</td>
                            <td>{{ $tutoria->fecha_termino }}</td>
                            <td>{{ ($tutoria->completado) ? 'Si' : 'No' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <b>Observaciones del Tutor:</b> <br />
            <span>{{ $tutoria->observaciones ?? 'Ninguna' }}</span>
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
    <div class="row">
        <div class="col-md-12 p-4 mt-2">
            <strong class="border-bottom text-center text-primary">Clases</strong>
            <div class="table-responsive mt-2">
                @if($tutoria->clases->count() > 0)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Duracion (Horas)</th>
                            <th scope="col">Tarifa ({{ ucfirst($tutoria->tipo) }})</th>
                            <th scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tutoria->clases as $clase)
                        <tr>
                            <td>{{ $clase->fecha_clase }}</td>
                            <td>{{ $clase->duracion }}</td>
                            <td>$ {{ number_format($clase->tarifa) }}</td>
                            <td>
                                <a href="{{ route('clases.show', ['tutoria' => $tutoria, 'clase' => $clase]) }}">Ver Detalle</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-dark">Esta tutoria aun no tiene clases.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
