@extends('layouts.app')

@section('content')

  <main class="container">
    <div class="row flex-wrap my-5">
      <div class="col d-flex flex-column border-right">
        <!-- Carousel & img display -->
        <img src="{{ $asset->getImg() }}" alt="{{ $asset->title_sort }}"/>
      </div>

      <div class="col d-flex flex-column">
        <!-- Product details -->
        <h1 class="display-5 border-bottom">{{$asset->title}}</h1>
        <strong class="h1 text-primary">$ {{ number_format($asset->price, 0) }}</strong>
        <p class="text-muted border-bottom">
            {{ $asset->description ?? $asset->title_sort }}
        </p>
        <form action="" method="post">
          {{ csrf_field() }}
          <button type="button" class="btn btn-primary">Agregar al Carrito</button>
        </form>
      </div>

      <div class="col d-flex flex-column">
        <!-- Product tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripcion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Detalles</a>
          </li>
        </ul>
        <div class="tab-content pt-3 px-3 border border-light shadow" id="myTabContent">
          <div style="height:250px;" class="tab-pane fade show active overflow-auto" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="text-primary border-bottom">Descripcion</h4>
            <p class="text-justify">
              {{ $asset->description }}
            </p>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h4 class="text-primary border-bottom">Detalles</h4>
            <p class="text-justify">
            </p>
          </div>
        </div>

      </div>

    </div>

    <div class="border-top pt-3 d-flex flex-column">
      <!-- Similar Products Carousel -->
      <h5 class="text-primary mx-auto">Productos similares</h5>
      <carousel-products-component>
        @foreach($similarAssets as $asset)
          <div class="text-center mx-2">
            <a href="{{ route('asset.show', $asset) }}">
                <img src="{{ $asset->getImg() }}" class="card-img-top"  alt="{{ $asset->title_sort }}" />
              <div class="card-body">
                <h5 class="card-title">{{ $asset->title }}</h5>
                <p class="card-text">$ {{ number_format($asset->price) }}</p>
              </div>
            </a>
            <a href="#" class="btn btn-primary">Agregar al carrito</a>
          </div>
        @endforeach
      </carousel-products-component>
    </div>
  </main>

@endsection
