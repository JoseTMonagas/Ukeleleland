<!-- Header -->
<header class="container-fluid bg-gray">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <div class="row p-3 align-items-start">
    <div class="col-lg-3">
      <img src="{{ asset('img/logo-ukeleleland-black.png') }}" alt="Logo Ukeleleland" class="img-fluid">
    </div>
    <div class="col-lg d-none d-lg-flex flex-row align-self-end justify-content-end">
      @guest
      <div class="d-flex flex-row flex-md-column justify-content-center">
        <a href="{{ route('login') }}" class="nav-link">Ingresar</a>
        <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
      </div>
      @endguest

      <div class="col-lg-2 d-flex flex-column justify-content-center">
        <span class="row d-none d-lg-flex justify-content-center">
          <a href="{{ setting('site.instagram') }}" class="h5 mx-2"><i class="fab fa-instagram"></i></a>
          <a href="{{ setting('site.facebook') }}" class="h5 mx-2"><i class="fab fa-facebook-square"></i></a>
          <a href="{{ setting('site.youtube') }}" class="h5 mx-2"><i class="fab fa-youtube"></i></a>
        </span>

        <div class="row justify-content-center">
          @auth
          <vs-dropdown class="d-none d-lg-block mr-3" vs-custom-content vs-trigger-click >
            <a class="a-icon btn btn-primary text-light" href.prevent>
              <i class="fas fa-user"></i>
            </a>
            <vs-dropdown-menu>
              <vs-dropdown-item>
                <a class="dropdown-item" href="{{ route('miPerfil') }}">Mi Perfil</a>
              </vs-dropdown-item>
              <vs-dropdown-item>            <form action="{{ route('logout') }}" method="POST" accept-charset="utf-8">
                @csrf

                <button class="dropdown-item" type="submit">Salir</button>
              </form>
              </vs-dropdown-item>          </vs-dropdown-menu>
          </vs-dropdown>
          @endauth

          <vs-dropdown class="d-none d-lg-block" vs-custom-content vs-trigger-click >
            <a class="a-icon btn btn-primary text-light" href.prevent>
              <i class="fas fa-shopping-cart"></i>
              @if(Cart::count() > 0)
                <span class="badge badge-light">{{ Cart::count()}}</span>
                <span class="badge badge-success">$ {{ (Cart::subtotal()) }}</span>
              @endif
            </a>
            <vs-dropdown-menu class="w-50 w-lg-auto">

              <h5 class="text-primary text-center border-bottom">Mi Carrito de Compras</h5>
              @if( Cart::count() > 0)
                @foreach(Cart::content() as $item)
                  <div class="container" style="max-height:12rem;">
                    @component('components.cart_item', ["item" => $item, "loop" => $loop])
                    @endcomponent
                  </div>
                @endforeach
                <div class="bg-gradient-light p-2 text-right">
                  <b>Total: $ {{ (Cart::subtotal()) }}</b>
                </div>
                <a href="{{ route('sale.index') }}" class="my-2 btn btn-block btn-success">Comprar</a>
              @else
                <h4 class="text-center p-4">No hay objetos en el carro</h4>
              @endif
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>
      </div>
    </div>
</header>
<!-- !Header -->
