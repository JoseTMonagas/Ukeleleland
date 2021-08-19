@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Cart::count() > 0)
            <div class="row mb-4">
                <div class="col">
                    <h4>{{ Cart::count() }} objeto(s) en tu carrito</h4>
                </div>
                <div class="col">
                    <a class="btn btn-danger" href="empty">Vaciar carrito</a>
                </div>
            </div>
            @foreach(Cart::content() as $item)
                <div class="container border-top p-4">
                    <article class="row">
                        <a class="col" href="/producto/{{$item->model->slug}}"><img src="{{ asset('storage/products/'.$item->model->slug.'.png') }}" class="img-fluid" style="width: 10rem" alt=""></a>
                        <div class="col">
                            <a class="h5" href="/producto/{{$item->model->slug}}">{{ $item->model->name }}</a>
                            <p class="text-muted">{{ $item->model->details }}</p>
                        </div>
                        <form class="col" action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <div class="col form-group">
                            <label for="quantity">Cantidad:</label>
                            <select name="quantity" class="form-control" id="quantity">
                                @for($i = 1; $i < 99; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <h5 class="col">$ {{ $item->model->presentPrice() }}</h5>
                    </article>
                </div>
            @endforeach
            <section class="row">
                <div class="col-md-4">
                    <p>¿Tienes un cupon?</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="Ingresa tu cupon" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Canjear</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex flex-row jumbotron">
                    <div class="col">
                        El envio se calcula al momento de iniciar el proceso de pago, hay regiones en las que no se realizan envios, para mas informacion contactanos
                    </div>
                    <div class="col">
                        <p><b>Subtotal</b>: $ {{Cart::subtotal()}}</p>
                        <p><b>Total(Sin Envio)</b>: $ {{Cart::total()}}</p>
                    </div>
                </div>
            </section>
            <section class="row align-items-center justify-content-center">
                <div class="col-3">
                    <a href="/" class="btn btn-block btn-outline-success">Seguir en la tienda</a>
                </div>
                <div class="col-3">
                    <a href="/pagar" class="btn btn-block btn-success">Comprar</a>
                </div>
            </section>
        @else
            <h5>No hay nada en tu carrito ;c</h5>
        @endif
    </div>
@endsection
