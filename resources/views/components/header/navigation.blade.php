<!-- Navigation -->
<nav class="nav navbar justify-content-around border-bottom shadow">
    <sidebar class="d-lg-none" v-cloak>
        <vs-sidebar-item index="0">
            <a class="nav-link" href="{{ route('home') }}">Homepage</span></a>
        </vs-sidebar-item>
        <vs-sidebar-group title="Ukeleles">
            <vs-sidebar-item index="1">
                <a href="{{ route('producto.index') }}">Todos los productos</a>
            </vs-sidebar-item>
            @foreach (\App\Categoria::all() as $categoria)
            <vs-sidebar-item index="{{ $loop->index + 2 }}">
                <a href="{{ route('producto.index', $categoria->slug) }}">{{ $categoria->nombre }}</a>
            </vs-sidebar-item>
            @endforeach
        </vs-sidebar-group>
        <vs-sidebar-group title="Ebooks">
            <vs-sidebar-item index="8">
                <a href="{{ route('asset.index') }}">Todos los productos</a>
            </vs-sidebar-item>
        </vs-sidebar-group>
        <vs-sidebar-group title="Tu Ukeprofe">
            <vs-sidebar-item index="9">
              <a href="{{route('ukeprofe.index')}}">Conocelos</a>
            </vs-sidebar-item>
            <vs-sidebar-item index="10">
              <a href="{{ route('chat.index') }}">Tus Chats</a>
            </vs-sidebar-item>
        </vs-sidebar-group>
        <vs-sidebar-group title="Blogland">
          <vs-sidebar-item index="11">
            <a href="{{route('blog.index')}}">Ultimos Articulos</a>
          </vs-sidebar-item>
          <vs-sidebar-item index="12">
            <a href="{{route('blog.index', 'noticias')}}">UkeNoticias</a>
          </vs-sidebar-item>
          <vs-sidebar-item index="13">
            <a href="{{route('blog.index', 'datos')}}">Datos Curiosos</a>
          </vs-sidebar-item>
        </vs-sidebar-group>
        <vs-sidebar-group title="Tu Cuenta">
          @guest
          <vs-sidebar-item index="14">
            <a href="{{ route('login') }}">Ingresar</a>
          </vs-sidebar-item>
          <vs-sidebar-item index="15">
            <a href="{{ route('register') }}">Registrarse</a>
          </vs-sidebar-item>
            @else
          <vs-sidebar-item index="16">
            <a href="{{ route('miPerfil') }}">Tu Perfil</a>
          </vs-sidebar-item>
          <vs-sidebar-item index="17">
            <form action="{{ route('logout') }}" method="POST" accept-charset="utf-8">
              @csrf

              <button class="btn btn-warning" type="submit">Salir</button>
            </form>
          </vs-sidebar-item>
          @endguest
        </vs-sidebar-group>

        <vs-sidebar-item index="17">
            <form action="{{ route('search') }}" method="POST">
                @csrf

                <div class="input-group my-2">
                    <input type="text" class="form-control" placeholder="¿Buscas algo?" name="query">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary p-1" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </vs-sidebar-item>
        <vs-sidebar-item index="18">
            <div class="d-flex d-md-none justify-content-center">
                <a href="{{ setting('site.instagram') }}" class="h5 mx-2"><i class="fab fa-instagram"></i></a>
                <a href="{{ setting('site.facebook') }}" class="h5 mx-2"><i class="fab fa-facebook-square"></i></a>
                <a href="{{ setting('site.youtube') }}" class="h5 mx-2"><i class="fab fa-youtube"></i></a>
            </div>
        </vs-sidebar-item>

    </sidebar>

    <vs-dropdown class="d-lg-none" vs-custom-content vs-trigger-click v-cloak>
        <a class="a-icon btn btn-primary text-light" href.prevent>
            <i class="fas fa-shopping-cart"></i>
            @if(Cart::count() > 0)
            <span class="badge badge-light">{{ Cart::count()}}</span>
            <span class="badge badge-success">$ {{ (Cart::subtotal()) }}</span>
            @endif
        </a>
        <vs-dropdown-menu class="w-50">

            <h5 class="text-primary text-center border-bottom">Mi Carrito de Compras</h5>
            @if( Cart::count() > 0)
            @foreach(Cart::content() as $item)
            @component('components.cart_item', ["item" => $item, "loop" => $loop])
            @endcomponent
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

    <div class="d-none d-lg-flex flex-row justify-content-around" id="navbarTogglerDemo01">
        <a class="nav-link mx-2" href="{{ route('home') }}"><span class="btn btn-danger"><i class="fas fa-home"></i></span></a>

        <form action="{{ route('search') }}" method="POST">
            @csrf

            <div class="input-group my-2">
                <input type="text" class="form-control" placeholder="¿Buscas algo?" name="query">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary p-1" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="dropdown open nav-style">
            <a class="nav-link mx-2 d-flex flex-column align-items-center" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-guitar"></i><span class="dropdown-toggle">Ukeleles</span>
                <div class="dropdown-menu" style="width: 24rem;background-image: url('{{asset('storage/'.setting('site.menuUkes'))}}');background-size:cover;" aria-labelledby="triggerId">
                    <ul class="nav flex-column" style="margin-top:-1rem">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('producto.index') }}">Todos los productos</a>
                            @foreach (\App\Categoria::all() as $categoria)
                            <a class="nav-link text-dark" href="{{ route('producto.index', $categoria->slug) }}">{{ $categoria->nombre }}</a>
                            @endforeach
                        </li>
                    </ul>
                </div>
        </div>

        <div class="dropdown open nav-style">
            <a class="nav-link mx-2 d-flex flex-column align-items-center" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-book"></i><span class="dropdown-toggle">Aprende Leyendo</span>
                <div class="dropdown-menu" style="width: 24rem;background-image: url('{{ asset('storage/'.setting('site.menuLibros')) }}');background-size:cover;" aria-labelledby="triggerId">
                    <ul class="nav flex-column" style="margin-top:-1rem">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('asset.index') }}">Todos los productos</a>
                        </li>
                    </ul>
                </div>
        </div>

        <a class="nav-link mx-2 d-flex flex-column align-items-center" href="{{route('ukeprofe.index')}}"><i class="fas fa-chalkboard-teacher"></i><span>Tu Ukeprofe</span></a>
        <a class="nav-link mx-2 d-flex flex-column align-items-center" href="{{route('blog.index')}}"><i class="fas fa-blog"></i><span>Blogland</span></a>

        @guest
        <div class="d-flex d-lg-none flex-row flex-md-column justify-content-center">
            <a href="{{ route('login') }}" class="nav-link">Ingresar</a>
            <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
        </div>
        @else
        <div class="dropdown d-lg-none">
            <button class="btn btn-primary rounded dropdown-toggle" id="userDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('miPerfil') }}">Mi Perfil</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" accept-charset="utf-8">
                    @csrf

                    <button class="dropdown-item" type="submit">Salir</button>
                </form>
            </div>
        </div>
        @endguest

        <div class="d-flex d-md-none justify-content-center">
            <a href="" class="h5 mx-2"><i class="fab fa-instagram"></i></a>
            <a href="" class="h5 mx-2"><i class="fab fa-facebook-square"></i></a>
            <a href="" class="h5 mx-2"><i class="fab fa-youtube"></i></a>

        </div>
    </div>
</nav>
<!-- !Navigation -->
