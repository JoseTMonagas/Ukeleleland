@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if(count($superiorLg) > 0 && count($superiorXs) > 0)
    @component('components.carousel', ["posicion" => "superior", "xs" => $superiorXs, "lg" => $superiorLg])
    @endcomponent
    @endif
</div>


<div class="container-fluid my-4">
    @component('components.nav_ad')
    @endcomponent

    <div class="row my-4">

<!--- Promociones --->
        @component('components.product_ad', ["ad" => $promos])
        @endcomponent
        
        <div class="container-fluid my-5">
            <div class="pt-3 d-flex flex-column">
                <!-- Highlighted Products Carousel -->
                <h5 class="text-primary mx-auto">Productos destacados</h5>
                <div class="container">
                    <carousel-products-component>
                        @foreach($popular as $product)
                        @component('components.product_card', ["product" => $product])
                        @endcomponent
                        @endforeach
                    </carousel-products-component>
                </div>
            </div>
        </div>

        <div class="container-fluid my-5">
            <div class="pt-3 d-flex flex-column">
                <!-- New Products Carousel -->
                <h5 class="text-primary mx-auto">Productos nuevos</h5>
                <div class="container">
                    <carousel-products-component>
                        @foreach($latest as $product)
                        @component('components.product_card', ["product" => $product])
                        @endcomponent
                        @endforeach
                    </carousel-products-component>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    @if(count($inferiorLg) > 0 && count($inferiorXs) > 0)
    @component('components.carousel', ["posicion" => "inferior", "xs" => $inferiorXs, "lg" => $inferiorLg])
    @endcomponent
    @endif
</div>

@endsection
