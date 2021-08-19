@extends('layouts.admin')

@section('content')
    <div class="table-responsive">
      <table class="table table-sm" id="table">
        <thead>
          <tr>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Tarifa</th>
            <th scope="col">Modalidad</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Comuna</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($solicitantes as $profile)
            <tr>
              <td>{{ $profile->name . " " . $profile->surname }}</td>
              <td>$ {{ number_format($profile->price) }}</td>
              <td>{{ $profile->modalidad }}</td>
              <td>{{ $profile->cantidad }}</td>
              <td>{{ $profile->commune->name }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('tutor.revisar', $profile)}}">Revisar Solicitud</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  <script>
   $(document).ready(function() {
     $('#table').DataTable({
       language: {
         url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
       }
     });
   } );
  </script>
@endsection
