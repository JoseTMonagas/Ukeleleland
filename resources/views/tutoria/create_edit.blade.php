@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title border-bottom text-primary text-center">{{ isset($tutoria) ? 'Editar' : 'Crear'}} Tutoria</h5>
            <form action="{{ isset($tutoria) ? route('tutorias.update', $tutoria) : route('tutorias.store')}}"
                  method="POST"
                  accept-charset="utf-8">
                @csrf

                <div class="form-row justify-content-around">
                    <div class="form-group col-md-3">
                        <label>Tipo de Tutoria:</label>
                        <select class="form-control" name="tipo" required>
                            <option @if(isset($tutoria) && ($tutoria->tipo === 'hora'))
                                {{ __("selected") }}
                                @endif
                                value="hora">
                                Por Hora
                            </option>
                            <option @if(isset($tutoria) && ($tutoria->tipo === 'clase'))
                                {{ __("selected") }}
                                @endif
                                value="clase">
                                Por Clase
                            </option>
                        </select>
                        <small class="text-muted">Controla si la tutoria se contara por Horas o por Clases realizadas</small>
                        @if ($errors->has('tipo'))
                        @foreach ($errors->get('tipo') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Cantidad de Horas o Clases</label>
                        <input @if(isset($tutoria)) {{ __("value=".$tutoria->cantidad) }} @endif class="form-control" type="number" name="cantidad" required>
                        <small class="text-muted">La cantidad de horas o la cantidad de clases para la Tutoria dependiendo de su tipo</small>
                        @if ($errors->has('cantidad'))
                        @foreach ($errors->get('cantidad') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-row justify-content-around">
                    <div class="form-group col-md-3">
                        <label>Fecha de Inicio:</label>
                        <input @if(isset($tutoria)) {{ __("value=".$tutoria->fecha_inicio) }} @endif class="form-control" type="date" name="fecha_inicio" required />
                        <small class="text-muted">Fecha de inicio para la Tutoria</small>
                        @if ($errors->has('fecha_inicio'))
                        @foreach ($errors->get('fecha_inicio') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fecha de Termino:</label>
                        <input @if(isset($tutoria)) {{ __("value=".$tutoria->fecha_termino) }} @endif class="form-control" type="date" name="fecha_termino" required>
                        <small class="text-muted">Fecha de termino estimado para la Tutoria</small>
                        @if ($errors->has('fecha_termino'))
                        @foreach ($errors->get('fecha_termino') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-row justify-content-around">
                    <div class="form-group col-md-3">
                        <label>Estudiante:</label>
                        @if(isset($tutoria))
                        <input class="form-control-plaintext" disabled type="text" value="{{ $tutoria->estudiante->name }}" />
                        @else
                        <select class="form-control" name="user_id">
                            @foreach ($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}">{{ $estudiante->name }}</option>
                            @endforeach
                        </select>
                        @endif
                        <small class="text-muted">Estudiante que participara en la tutoria</small>
                        @if ($errors->has('user_id'))
                        @foreach ($errors->get('user_id') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Observaciones:</label>
                        <textarea @if(isset($tutoria)) {{ __("value=".$tutoria->observaciones) }} @endif class="form-control" name="observaciones" cols="30" rows="10"></textarea>
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
