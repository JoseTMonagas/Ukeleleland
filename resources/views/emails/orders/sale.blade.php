@component('mail::message')

@component('mail::panel')
@if(!$admin)
# ¡Muchas Gracias por tu compra!

Gracias por prefererirnos, dentro de poco tendras tu producto en tus manos.

@if (isset($links) && count($links) > 0)
Descarga tus E-books en los siguientes enlaces:
@foreach($links as $link)
@component('mail::button', ['url' => $link['url']])
{{ $link['name']}}
@endcomponent
@endforeach
@endif

@endcomponent

@component('mail::button', ['url' => $url])
Ver Detalle de compras
@endcomponent

Muchas Gracias,<br>
Ukelelelandbrand
@else
# Nueva Compra realizada

Hay una compra a nombre de {{ $sale->profile['name'] }} con el rut: {{ $sale->profile['rut'] }}
a la siguiente direccion: {{ $sale->profile['commune'] }}
{{ $sale->profile['address'] }}
@endcomponent

@endif

@endcomponent
