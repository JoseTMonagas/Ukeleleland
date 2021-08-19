@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title border-bottom text-primary text-center">Lista de Tutorias</h5>
            <a href="{{ route('tutorias.create') }}" class="btn btn-success">Nueva Tutoria</a>
            <div class="table-responsive p-4">
                @if($tutorias->count() > 0)
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Tutoria</th>
                            <th scope="col">Cantidad (Horas o Clases)</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha de Culminacion</th>
                            <th scope="col">Tutor</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Clases</th>
                            <th scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tutorias as $tutoria)
                            <tr>
                                <td>{{ ucfirst($tutoria->tipo) }}</td>
                                <td class="text-center">{{ $tutoria->cantidad }}</td>
                                <td class="text-center">{{ $tutoria->fecha_inicio }}</td>
                                <td class="text-center">{{ $tutoria->fecha_termino }}</td>
                                <td class="text-center">{{ $tutoria->tutor->name }}</td>
                                <td class="text-center">{{ $tutoria->estudiante->name }}</td>
                                <td>
                                    <a href="{{ route('clases.index', $tutoria) }}">Ver Clases</a>
                                </td>
                                <td>
                                    <a href="{{ route('tutorias.show', $tutoria) }}">Mas Informacion</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-dark">Sin tutorias por ahora</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
