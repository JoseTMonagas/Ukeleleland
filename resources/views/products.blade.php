@extends('layouts.app')

    @if(isset($header))
        @yield('header', $header)
    @endif
    
    @section('header')
    <title>Ukelele {{ $current ?? '' }} Chile - Tienda Online | ukelelelandbrand.cl</title>
    <meta name="title" content="Ukeleles {{ $current ?? '' }} Chile - Tienda Online | ukelelelandbrand.cl"/>
    <meta name="description" content="Compra un ukelele {{ $current ?? '' }}  Para profesionales y Principiantes. Envíos a todo Chile.">
    <meta name="keywords" content="Ukeleles {{ $current ?? '' }} con funda, pack ukelele {{ $current ?? '' }}, ukelele {{ $current ?? '' }} precio, ukelele para niños, ukeleles para niños, ukeleles">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="follow, all" />
    @endsection

@section('content')
  <main class="container-fluid">
    <section class="row">
      <div class="col-12">
        <img class="img-fluid" alt="" src="{{ $banner }}"/>
      </div>
    </section>
    <section class="row">

      <!-- Filter for products -->
      <aside class="col-lg-2">
        <ul class="list-group">
          <a class="list-group-item list-group-item-action @if(!isset($current)) active @endif " href="{{ route('producto.index') }}">Todos los Ukes</a>
          @foreach($categories as $category)
            <a class="list-group-item list-group-item-action @if(isset($current) && ($current == $category->slug)) active @endif " href="{{ route('producto.index', $category->slug) }}">{{$category->nombre}}</a>
          @endforeach
        </ul>
        <div >
          <h5 class="text-primary">
            <form action="{{ route('producto.filtro') }}" method="POST">
              @csrf
              <div class="form-group mt-2">
                <input name="current" type="hidden" value="{{ $current ?? '' }}"/>
                <label for="">Filtrar por precio:</label>
                <select class="form-control my-2" name="tipo">
                  <option value="mayor">Mayor que</option>
                  <option value="menor">Menor que</option>
                </select>
                <input class="form-control my-2" name="precio" type="text"/>
                <label for="">Ordenar:</label>
                <select class="form-control my-2" name="orden">
                  <option value="asc">De Mayor a Menor</option>
                  <option value="desc">De Menor a Mayor</option>
                </select>
                <button class="btn btn-primary">Filtrar</button>
              </div>
            </form>
          </h5>
        </div>
      </aside>

      <article class="col-lg-10 d-flex flex-row flex-wrap">
        <!-- Products list -->
        <div class="row my-4 justify-content-center">
          @foreach($products as $product)
            <div class="my-5 my-lg-0" style="width: 18rem">
                @component('components.product_card', ["product" => $product])
                @endcomponent
            </div>
          @endforeach
        </div>
        <div class="mx-auto">
          {{ $products->links() }}
        </div>
      </article>
    </section>
  </main>

@endsection
