<!-- Footer -->
<footer class="container-fluid">
    <div class="row bg-primary text-white d-flex justify-content-center justify-content-md-end align-items-center p-3">
        <div class="col text-right">SUSCRIBETE A NUESTRA NEWSLETTER: </div>
        <a href="{{ route('showSubscribe') }}" class="bg-light text-primary p-2">Suscribirse</a>
    </div>

    <div class="row bg-gray p-3">
      <div class="col-md order-3 order-md-1 d-flex flex-column justify-content-center">
            <span class="bg-dark text-light text-center py-2 px-5">Instagram</span>

<div id="pixlee_container" style="max-height:24rem;overflow-y:auto;"></div><script type="text/javascript">window.PixleeAsyncInit = function() {Pixlee.init({apiKey:'YNDCovbPTcBUOXZpPmnc'});Pixlee.addSimpleWidget({widgetId:'25316'});};</script><script src="//instafeed.assets.pxlecdn.com/assets/pixlee_widget_1_0_0.js"></script>


        </div>
        <div class="col-md order-4 order-md-2 d-flex flex-column my-2 justify-content-center">
            <span class="bg-dark text-light text-center py-2 px-5">Facebook</span>
            <div class="fb-page" data-href="https://www.facebook.com/ukelelelandbrand" data-tabs="timeline" data-width="" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ukelelelandbrand" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ukelelelandbrand">Ukeleleland Brand</a></blockquote></div>
        </div>
        <div class="col-md order-1 order-md-3 my-2 my-md-0">
            <img src="{{ asset('img/logo-ukeleleland-black.png') }}" alt="" class="img-fluid p-4">
            <ul class="nav flex-column mt-1">
                <li class="nav-item">
                    <h5 class="text-dark">DUDAS Y CONTACTO</h5>
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('preguntas_frecuentes') }}">Preguntas Frecuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('contactShow') }}">Contáctenos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="tel:+56977382313"><i class="fab fa-whatsapp" aria-hidden="true"></i> +56 9 7738 2313</a>
                </li>
                <li class="nav-item">
                         <a class="nav-link text-dark" href="mailto: aloha@ukelelelandbrand.cl"><i class="fa fa-envelope" aria-hidden="true"></i> aloha@ukelelelandbrand.cl</a>
                </li>
            </ul>
        </div>
        <div class="col-md order-2 order-md-4 my-2 my-md-0">
            <img src="{{ asset('img/logo_webpay3.png') }}" alt="" class="d-none d-md-block img-fluid" style="max-height: 150px">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <h5 class="text-dark">SERVICIO AL CLIENTE</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('terminosYCondiciones') }}">Terminos y condiciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('formasEnvio') }}">Formas de Envio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('privacidad') }}">Politicas de Privacidad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('metodosPago') }}">Metodos de Pago</a>
                </li>
            </ul>
            <img src="{{ asset('img/logo_webpay3.png') }}" alt="" class="d-block d-md-none img-fluid p-4" style="max-height: 150px">
        </div>
    </div>
</footer>
<!-- !Footer -->
