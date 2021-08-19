@extends('layouts.app')

@section('content')
    <main class="container-fluid">
        <section class="row justify-content-around">

            <article class="col-md-5 d-flex flex-row flex-wrap">
                <!-- Products list -->
                @if ($ukeleles->count() > 0)
                    <div class="h5 border-bottom mx-auto mb-3">{{ $ukeleles->count() }} Resultados en Ukeleles</div>
                    <div class="row my-2">
                        @foreach($ukeleles as $ukelele)
                            <div class="col-md-6">
                                @component('components.product_card', ["product" => $ukelele])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h5 border-bottom mx-auto mb-3">0 Resultados en Ukeleles</div>
                @endif
            </article>

            <article class="col-md-5 d-flex flex-row flex-wrap">
                <!-- Products list -->
                @if ($ebooks->count() > 0)
                    <div class="h5 border-bottom mx-auto mb-3">{{ $ebooks->count() }} Resultados en E-Books</div>
                    <div class="row my-2">
                        @foreach($ebooks as $book)
                            <div class="col-md-6">
                                @component('components.asset_card', ["asset" => $book])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h5 border-bottom mx-auto mb-3">0 Resultados en E-Books</div>
                @endif
            </article>
        </section>
    </main>

@endsection
