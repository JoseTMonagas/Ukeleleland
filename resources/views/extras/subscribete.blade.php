@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-body p-5">
        <h3 class="card-title text-primary border-bottom text-center">Suscribete</h3>
        <form
          action="https://ukelelelandbrand.us4.list-manage.com/subscribe/post?u=aaa83aa310806c11ffb26a4b0&amp;id=700ff974e0"
          method="POST"
          name="mc-embedded-subscribe-form"
          target="_blank"
          novalidate>
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
          </div>
	        <input type="email" class="form-control" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Correo Electronico" required>
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Suscribete</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
