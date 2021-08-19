<!-- Navigation Ad -->
<div class="container-fluid">
  <div class="row">
    <a href="{{ route('producto.index') }}" class="col-md p-0 mx-1 my-2" style="background-image: url({{ asset('img/ukeleles.jpg') }}); background-size: cover; min-height: 16rem;">
      <div class="ad-nav">
        <p class="ml-1 text-light">
          <span class="p-2 bg-primary text-light">COMPRAR</span>
          UKELELES
          <i class="text-shadow text-primary fa fa-chevron-right" aria-hidden="true"></i>
        </p>
      </div>
    </a>
    <a href="{{ route('ukeprofe.index') }}" class="col-md p-0 mx-1 my-2" style="background-image: url({{ asset('img/tocando.jpg') }}); background-size: cover; min-height:300px">
      <div class="ad-nav">
        <p class="ml-1 text-light">
          <span class="p-2 bg-primary text-light">CLASES</span>
          PERSONALIZADAS
          <i class="text-shadow text-primary fa fa-chevron-right" aria-hidden="true"></i>
        </p>
      </div>
    </a>
    <a href="{{ route('asset.index') }}" class="col-md p-0 mx-1 my-2" style="background-image: url({{ asset('img/partitura.jpg') }}); background-size: cover; min-height:300px">
      <div class="ad-nav">
        <p class="ml-1 text-light">
          <span class="p-2 bg-primary text-light">APRENDE Y TOCA</span>
          TUS CANCIONES FAVORITAS
          <i class="text-shadow text-primary fa fa-chevron-right" aria-hidden="true"></i>
        </p>
      </div>
    </a>
  </div>
</div>
