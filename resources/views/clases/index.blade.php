@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title border-bottom text-primary text-center">Lista de Clases</h5>
            <a href="{{ route('clases.create', $tutoria) }}" class="btn btn-success">Nueva Clase</a>
            <div class="table-responsive mt-2">
                @if($clases->count() > 0)

                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Duracion (Horas)</th>
                            <th class="text-center" scope="col">Tarifa</th>
                            <th class="text-center" scope="col">Observaciones</th>
                            <th class="text-center" scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clases as $clase)
                        <tr>
                            <td class="text-center">{{ $clase->fecha_clase }}</td>
                            <td class="text-center">{{ $clase->duracion }}</td>
                            <td class="text-center">{{ $clase->tarifa }}</td>
                            <td class="text-center">{{ $clase->observaciones }}</td>
                            <td class="text-center">
                                <a href="{{ route('clases.show', ['tutoria' => $tutoria, 'clase' => $clase]) }}">Mas Informacion</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-dark">Aun no hay clases para esta tutoria</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
