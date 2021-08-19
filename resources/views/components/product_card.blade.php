<div class="text-center mx-lg-3">
        <div class="row">
            <a href="{{ route('producto.show', $product->slug) }}">
                <img src="{{ $product->displayImg }}" class="card-img-top" alt="{{ $product->slug }}" />
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
			@if ($product->hasDescuento())
<p class="card-text text-danger" style="text-decoration: line-through">$ {{ number_format($product->price, 0, ",", ".") }}</p>
<p class="card-text text-primary">$ {{ $product->displayPrice }}</p>
@else
<p class="card-text">{{ $product->displayPrice }}</p>
@endif
                    
                </div>
            </a>
        </div>
        <form class="row justify-content-center" action="{{ route('cart.store', $product) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
        </form>
</div>
