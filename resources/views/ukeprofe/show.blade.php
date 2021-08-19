@extends('layouts.app')

@section('header')
<title>Clases de ukelele online junto a {{$profile->name}}</title>
<meta name="title" content="Clases de ukelele online junto a {{$profile->name}}"/>
<meta name="description" content="Recibe clases de ukelele ucfirst($profile->modalidad) en cualquier parte de Chile con {{$profile->name}}. Costo desde $10.000. Descubre más">
<meta name="keywords" content="Clases de ukelele online, Clases de ukelele en Chile, Clases de ukelele, Clases de ukelele para niños, clases ukelele niños y adultos, clases ukulele">
<link rel="canonical" href="https://ukelelelandbrand.cl/ukeprofe/mostrar/{{$profile}}">
<meta name="robots" content="follow, all" />

@endsection

@section('content')

  <main class="container">
    <div class="row flex-wrap my-5 justify-content-center">
      <div class="d-flex flex-column mr-lg-5">
        <img class="img-fluid" src="{{ asset('storage/' .$profile->image) }}" alt="Imagen de Perfil de {{ $profile->name }}">
        <a class="btn btn-primary btn-block my-3" href="{{ route('ukeprofe.chat', $profile) }}">Contactar</a>
      </div>

      <div class="col-lg">
        <!-- Product details -->
        <h1 class="display-5 border-bottom text-center my-2">{{$profile->name}}</h1>
        <p class="text-primary my-2 my-lg-0 d-flex flex-column justify-content-center">
          <span>Modalidad: <b>{{ ucfirst($profile->modalidad) }}</b></span>
          <span>Comuna: <b>{{ isset($profile->commune) ? $profile->commune->name : 'Sin Especificar' }}</b></span>
        </p>
        <strong class="h1 text-primary text-center my-2">$ {{ number_format($profile->price, 0, ",", ".") }}/hr</strong>
        <p class="text-muted border-bottom my-3">
          {!!   $profile->description !!}
        </p>
      </div>

    </div>

  </main>

@endsection

@section('js')
@endsection
