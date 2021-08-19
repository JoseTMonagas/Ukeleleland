@component('mail::message')

@component('mail::panel')
# ¡Tu compra fue despachada!

N° de Seguimiento: {{ $sale->seguimiento }} <br>

Empresa de Transporte: {{ $sale->empresa }} <br>

Fecha Estimada: {{ $sale->fecha_entrega }} <br>


@endcomponent

@component('mail::button', ['url' => $url])
    Ver Detalle
@endcomponent

Muchas Gracias,<br>
Ukelelelandbrand
@endcomponent
