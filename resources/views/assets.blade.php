@extends('layouts.app')

@section('header')
<title>Métodos y libros de ukeleles para adultos y niños</title>
<meta name="title" content="Métodos y libros de ukeleles para adultos y niños"/>
<meta name="description" content="Próximamente, compra e-books para aprender ukelele en ukelelelandbrand.cl. Disfruta de clases online con un ukeprofe mientras esperas. Conocer más">
<meta name="keywords" content="Métodos de ukelele, aprender ukelele chile, aprender ukelele, libros de ukelele">
<link rel="canonical" href="https://ukelelelandbrand.cl/ebooks">
@endsection


@section('content')
  <main class="container-fluid">
    <section class="row">

      <!-- TODO: AGREGAR FILTRADO EDITORIAL -->
      <!-- Filter for products -->
      <aside class="col-lg-2">
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="#">Todos los Libros</a>
        </ul>
        <div >
          <h5 class="text-primary">
            <form action="" method="POST">
              @csrf
              <div class="form-group mt-2">
                <input name="current" type="hidden" value=""/>
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

      <article class="col-lg-10 d-flex flex-row flex-wrap bg-proximamente" style="height: 120rem; background-size: contain; background-repeat: no-repeat">
        <!-- Products list -->
      </article>

    </section>
  </main>

@endsection
