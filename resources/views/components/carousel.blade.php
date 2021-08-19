<!-- Carousel Banner -->
<div class="row d-flex flex-row d-md-none">
  <div id="{{ $posicion }}" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @foreach ($xs as $item)
        <div class="carousel-item @if ($loop->first) active @endif">
                    <a href="{{ isset($item->url) ? $item->url : "#" }}">
            <img src="{{ asset('storage/' . $item->img) }}" class="d-block w-100" alt="...">
          </a>
        </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#{{ $posicion }}" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $posicion }}" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class="row d-none flex-row d-md-flex">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @foreach ($lg as $item)
        <div class="carousel-item @if ($loop->first) active @endif">
                    <a href="{{ isset($item->url) ? $item->url : "#" }}">
            <img src="{{ asset('storage/' . $item->img) }}" class="d-block w-100" alt="...">
          </a>
        </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#{{ $posicion }}" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $posicion }}" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
