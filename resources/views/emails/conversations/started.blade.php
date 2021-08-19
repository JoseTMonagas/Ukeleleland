@component('mail::message')
# Conversacion Iniciada

    Tienes una nueva conversacion con: {{ isset($user->profile->name) ? $user->profile->name : $user->email }}.

@component('mail::button', ['url' => $url])
    Mira tus conversaciones aqui
@endcomponent

Que tengas un buen dia,<br>
{{ config('app.name') }}
@endcomponent
