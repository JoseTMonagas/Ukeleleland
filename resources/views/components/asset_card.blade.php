<div class="text-center mx-2">
    <a href="#">
        <img src="{{ $asset->getImg() }}" class="card-img-top" />
        <div class="card-body">
            <h5 class="card-title">{{ $asset->title }}</h5>
            <p class="card-text">{{ $asset->displayPrice }}</p>
        </div>
    </a>
    <form action="#" method="POST">
        {{ csrf_field() }}
        <button type="button" class="btn btn-primary">Agregar al Carrito</button>
    </form>
</div>
