@extends('layouts.app')

@section('header')
<title>Clases de ukelele online en Chile - ukelelelandbrand.cl</title>
<meta name="title" content="Clases de ukelele online en Chile - ukelelelandbrand.cl"/>
<meta name="description" content="Recibe clases de ukelele online en cualquier parte de Chile con nuestros ukeprofes. Costo desde $10.000. Descubre más">
<meta name="keywords" content="Clases de ukelele online, Clases de ukelele en Chile, Clases de ukelele, Clases de ukelele para niños, clases ukelele niños y adultos, clases ukulele">
<link rel="canonical" href="https://ukelelelandbrand.cl/ukeprofe">
<meta name="robots" content="follow, all" />

@endsection

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-2">
          <form action="{{ route('ukeprofe.indexComuna') }}" method="POST">
            @csrf
            <div class="form-row justify-content-around">
              <label class="col-md-2 col-form-label">Comuna:</label>
              <search-component class="col-md-6" :communes='@json($communes)'></search-component>
              <button class="btn btn-primary">Filtrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="container">
          <div class="row my-2 align-items-lg-end">
            @foreach ($profiles as $profile)
              <div class="col-md-6">
                <div class="d-flex flex-row flex-wrap m-4 justify-content-center">
                  <a href="{{ route('ukeprofe.show', $profile) }}">
                    <img src="{{ asset('storage/' . $profile->image )}}" alt="..." class="img-fluid mx-auto" style="max-height:12rem;"/>
                  </a>
                  <div class="mt-2 ml-lg-3 pl-lg-3">
                    <a href="{{ route('ukeprofe.show', $profile) }}">
                      <h5 class="card-title text-center text-primary border-bottom">{{$profile->name}}</h5>
                    </a>
                    <p class="text-justify">{!! substr($profile->description, 0, 160) !!} ...</p>
                    <div class="row">
                      <div class="col-lg">
                        <p class="text-left text-muted">Comuna: {{ isset($profile->commune) ? $profile->commune->name : 'Sin Especificar' }}</p>
                        <p class="text-left text-muted">Modalidad: {{ ucfirst($profile->modalidad) }}</p>
                      </div>
                      <div class="col-lg">
                        <span class="text-primary">$ <b>{{ number_format($profile->price, 0, ",", ".") }}/hr</b></span>
                        @if($clasesCount < 1)
                          <span class="badge badge-danger p-2 mt-2">Tu Primera Clase es Gratuita</span>
                        @endif
                      </div>
                    </div>
                    <br>
                    <a class="btn btn-block btn-primary" href="{{ route('ukeprofe.show', $profile) }}">Conoce mas</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
