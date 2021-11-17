<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-679334487"></script> 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155246038-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155246038-1');
  gtag('config', 'AW-679334487');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '2511947448913671'); 
fbq('track', 'PageView');
@hasSection('pixel-event')
	@yield('pixel-event')
@endif
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=2511947448913671&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

@hasSection('header')
@yield('header')
@else
@include('components.header.settings_header')
@endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>

  <body>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0&appId=212263643505725&autoLogAppEvents=1"></script>
    <div id="app">

      @component('components.header.header')
      @endcomponent

      @component('components.header.navigation')
      @endcomponent
      
      <section class="row">
          <div class="col-md bg-secondary text-light text-center">
              <i class="fas fa-clock"></i>
              <a class="text-light" href="https://ukelelelandbrand.cl/formas-envio">
                  Envío gratis para Santiago y en regiones desde $5.000, info aquí
              </a>
          </div>
      </section>

      <!-- Main Content -->
      <main class="py-4">
        @yield('content')
      </main>
      <!-- !Main Content -->
    </div>
    @component('components.footer.footer')
    @endcomponent

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({
    xfbml            : true,
    version          : 'v6.0'
  });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=install_email
  page_id="100322761491890"
  theme_color="#00446f"
    logged_in_greeting="&#xa1;Aloha! bienvenido (a) a la tierra de ukeleles, &#xbf;te ayudamos?"
    logged_out_greeting="&#xa1;Aloha! bienvenido (a) a la tierra de ukeleles, &#xbf;te ayudamos?">
</div>

    @yield('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
               @if(\Session::has('msg') || isset($msg))
      @php
      $msg = \Session::get('msg') ?? $msg;
      @endphp
      <script charset="utf-8">
      Swal.fire({
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: true,
        icon: "{{ isset($msg['icon']) ? $msg['icon'] : __('info') }}",
        title: "{!! isset($msg['title']) ? $msg['title'] : __('Ukeleleland') !!}",
        html: "{!! isset($msg['msg']) ? $msg['msg'] : __('') !!}",
        confirmButtonText: "{!! isset($msg['confirmButtonText']) ? $msg['confirmButtonText'] : __('Continuar') !!}",
        cancelButtonText: "{!! isset($msg['cancelButtonText']) ? $msg['cancelButtonText'] : __('Cancelar') !!}",
      }) @if(isset($msg['action']))
            .then((result) => {
              if (result.value) {
                window.location.href = "{{ $msg['action'] }}"
              }
            })
      @endif();
      </script>
    @endif
  </body>

</html>
