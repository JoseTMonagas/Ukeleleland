<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <meta name="description" content="{{($post->meta_description != null) ? $post->meta_description : 'Blogland es tu fuente de informacion para todo lo relacionado con Ukeleles'}}">
    <meta name="keywords" content="{{($post->meta_keywords != null) ? $post->meta_keywords : 'ukeleles, blog, chile'}}">

    <title>{{($post->seo_title != null) ? $post->seo_title : 'Blogland | Tu fuente de informacion'}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/8ca19da716.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>

  <body>
    <div id="app">

      <!-- Header -->
      <header class="container-fluid bg-gray">
        <div class="row p-3">
          <div class="col-md-3 d-flex flex-column">
            <img src="{{ asset('img/logo-ukeleleland-black.png') }}" alt="Logo Ukeleleland" class="img-fluid">
          </div>
          <div class="col-md-4 offset-md-5 container d-flex">
            @guest
              <div class="col-md-auto"><a href="/login">Ingresar</a></div>
              <div class="col-md-auto"><a href="/register">Registrarse</a></div>
            @else
              <div class="col-md-auto"><button class="btn btn-primary rounded dropdown-toggle"><i class="fas fa-user"></i></button></div>
            @endguest
            <div class="d-flex flex-column">
              <span class="d-flex">
                <a href="" class="h5 mx-1"><i class="fab fa-instagram"></i></a>
                <a href=""class="h5 mx-1"><i class="fab fa-facebook-square"></i></a>
                <a href=""class="h5 mx-1"><i class="fab fa-youtube"></i></a>
              </span>
              <div class="dropleft open">
                <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-shopping-cart"></i>
                  @if(Cart::count() > 0)
                    <span class="badge badge-light">{{Cart::count()}}</span>
                    <span class="badge badge-success">{{presentPrice(Cart::total())}}</span>
                  @endif
                </button>
                <div class="dropdown-menu p-2 overflow-auto" aria-labelledby="triggerId" style="width:20rem;max-height:18rem;">
                  <h5 class="text-primary text-center border-bottom">Mi Carrito de Compras</h5>
                  @if( Cart::count() > 0)
                    @foreach(Cart::content() as $item)
                      <div class="container">
                        <div class="row @if(!($loop->last)) border-bottom @endif p-2">
                          <div class="col">
                            <img src="{{ asset('storage/products/'.$item->model->slug.'.png') }}" class="img-fluid" alt=""/>
                          </div>
                          <div class="col">
                            <h5 class="text-primary text-center border-bottom">{{$item->model->name}}</h5>
                            <p class="text-muted text-center">{{$item->model->presentPrice()}}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    <div class="bg-gradient-light p-2 text-right">
                      <p>Subtotal: {{ presentPrice(Cart::subtotal()) }}</p>
                      <p>IVA: {{ presentPrice(Cart::tax()) }}</p>
                      <b>Total(Sin Envio): {{ presentPrice(Cart::total()) }}</b>
                    </div>
                    <a href="/mi-carrito" class="my-2 btn btn-block btn-success">Revisa tu carrito</a>
                  @else
                    <h4 class="text-center p-4">No hay objetos en el carro</h4>
                  @endif
                </div>
              </div>
            </div>
            <div class="row justify-content-around">
            </div>
          </div>
      </header>
      <!-- !Header -->

      <!-- Navigation -->
      <nav class="nav justify-content-around border-bottom shadow">
        <a class="nav-link" href="/home"><span class="btn btn-danger"><i class="fas fa-home"></i></span></a>
        <div class="input-group my-2 w-25">
          <input type="text" class="mt-2 form-control  border-top-0 border-left-0 border-right-0 rounded-0 border-primary" placeholder="¿Buscas algo?" aria-label="buscas algo" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-primary border-top-0 border-left-0 border-right-0 rounded-right" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
          </div>
        </div>

        <div class="dropdown open nav-style">
          <a class="nav-link d-flex flex-column align-items-center" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-guitar"></i><span class="dropdown-toggle">Ukeleles</span>
            <div class="dropdown-menu" aria-labelledby="triggerId">
              <a class="dropdown-item" href="/productos/ukeleles">Todos los Ukeleles</a>
              <ul>
                <li>
                  <a class="dropdown-item" href="/productos/soprano">Soprano</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/productos/concierto">Concierto</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/productos/tenor">Tenor</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/productos/baritono">Baritono</a>
                </li>
                <li>
                  <a class="dropdown-item" href="/productos/guitarlele">Guitarlele</a>
                </li>
              </ul>
            </div>
        </div>

        <div class="dropdown open nav-style">
          <a class="nav-link d-flex flex-column align-items-center" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book"></i><span class="dropdown-toggle">Aprende Leyendo</span>
            <div class="dropdown-menu" aria-labelledby="triggerId">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Action</a>
            </div>
        </div>

        <a class="nav-link d-flex flex-column align-items-center" href="#"><i class="fas fa-chalkboard-teacher"></i><span>Tu Ukeprofe</span></a>
        <a class="nav-link d-flex flex-column align-items-center" href="#"><i class="fas fa-blog"></i><span>Blogland</span></a>
      </nav>
      <!-- !Navigation -->

      <!-- Main Content -->
      <main class="py-4">
        @yield('content')
      </main>
      <!-- !Main Content -->


      <!-- Footer -->
      <footer class="container-fluid">
        <div class="row bg-primary text-white d-flex justify-content-end p-3">
          <div>SUSCRIBETE A NUESTRA NEWSLETTER: <span class="bg-light text-primary">Suscribirse</span></div>
        </div>

        <div class="row bg-gray p-3">
          <div class="col">
            <span class="bg-dark text-light text-center py-2 px-5">Instagram</span>
          </div>
          <div class="col">
            <span class="bg-dark text-light text-center py-2 px-5">Facebook</span>

          </div>
          <div class="col">
            <img src="{{ asset('img/logo-ukeleleland-black.png') }}" alt="" class="img-fluid">
            <ul class="nav flex-column mt-1">
              <li class="nav-item">
                <h5 class="text-dark">SOBRE NOSOTROS</h5>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Somos tierra de ukeleles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Contáctenos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Sigue tu pedido</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i> +56 9 7307 8934</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="mailto: aloha@ukeleleland.cl"><i class="fa fa-envelope" aria-hidden="true"></i> aloha@ukeleleland.cl</a>
              </li>
            </ul>
          </div>
          <div class="col">
            <img src="{{ asset('img/logo_webpay3.png') }}" alt="" class="img-fluid" style="max-height: 150px">

            <ul class="nav flex-column">
              <li class="nav-item">
                <h5 class="text-dark">SERVICIO AL CLIENTE</h5>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Terminos y condiciones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Formas de Envio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Politicas de Privacidad</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Metodos de Pago</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- !Footer -->

        </div>
        @yield('js')
  </body>

</html>
