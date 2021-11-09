@section('header')
  {!! $product->header !!}
@endsection

@extends('layouts.app')

@section('content')

  <main class="container-fluid">
    <div class="row flex-wrap my-5">
      <div class="col-lg col-offset-lg-2 d-flex flex-column border-right">
        <!-- Carousel & img display -->
        <div class="container">
          <carousel-component :images="[
                                       @foreach($product->img as $image)
                                       '{{ productImage($image) }}',
                                       @endforeach
                                       ]"></carousel-component>
        </div>
      </div>

      <div class="col-lg d-flex flex-column">
        <!-- Product details -->
        <h1 class="display-5 border-bottom text-center">{{$product->name}}</h1>
        <strong class="h1 text-primary text-center">{{ $product->displayPrice }}</strong>
        <p class="text-muted border-bottom text-center">
          {!! $product->description !!}
        </p>
        <form class="d-flex justify-content-center" action="{{ route('cart.store', $product) }}" method="post">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-primary my-4">Agregar al Carrito</button>
        </form>
      </div>

    <div class="col-lg justify-content-center">
        <!-- Product tabs -->
        <ul class="nav nav-pills d-flex flex-column flex-lg-row" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Detalles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Descargas Gratuitas</a>
          </li>
        </ul>
        <div class="tab-content pt-3 px-3 border border-light shadow" id="myTabContent">
          <div class="tab-pane fade show active overflow-auto" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h4 class="text-primary border-bottom">Detalles</h4>
            <p class="text-justify">
              {!! $product->details !!}
            </p>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <h4 class="text-primary border-bottom">Descargas Gratuitas</h4>
            <a class="my-2 btn btn-outline-primary" href="{{ asset('storage/guia.pdf') }}">Guia basica para aprender Uke</a>
          </div>
        </div>

      </div>

    </div>

    @if ($pack->count() > 0)
      <div class="container-fluid">
        <div class="alert alert-info">
          <div class="container">
            <h5 class="border-bottom text-center">Accesorios que incluye</h5>
            <div class="row align-items-baseline">
              @foreach ($pack as $acc)
                <div class="col-lg d-flex flex-column mx-2 p-4 align-items-center">
                  <img style="max-width:12rem" class="img-fluid" src="{{ asset('storage/' . $acc->img)}}" alt="" />
                  <p class="text-dark text-center">{{ $acc->nombre }}</p>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif

    @if (isset($product->video))
      <div class="container my-3">
        <h5 class="text-primary text-center border-bottom">Escucha tu Ukeleleland</h5>
        <div class="d-flex justify-content-center">
            {!! $product->video !!}
        </div>
      </div>
    @endif

    <div class="container border-top pt-3 d-flex flex-column">
      <!-- Similar Products Carousel -->
      <h5 class="text-primary mx-auto">Productos similares</h5>
      <carousel-products-component>
        @foreach($similarProducts as $product)
          @component('components.product_card', ["product" => $product])
          @endcomponent
        @endforeach
      </carousel-products-component>
    </div>
  </main>

@endsection
