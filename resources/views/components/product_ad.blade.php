<!-- Products Ad -->

<!-- Products -->
@if (isset($ad))
  @foreach ($ad as $promo)
    <a href="{{ $promo->url }}" class="col-lg-6">
      <h3>
        <span class="p-3 shadow badge badge-primary position-absolute">{{ $promo->description }}</span>
      </h3>
      <img src="{{ asset('storage/'.$promo->img) }}" class="img-fluid" alt="">
      <flip-countdown deadline="{{ $promo->fin }}" :labels="{ days: 'Dias', hours: 'Horas', minutes: 'Minutos', seconds: 'Segundos'}" ></flip-countdown>
    </a>
  @endforeach
@endif
