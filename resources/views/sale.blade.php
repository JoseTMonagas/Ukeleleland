@extends('layouts.app')
@section('pixel-event')
  fbq('track', 'InitiateCheckout');
@endsection
@section('content')
  @php
  $discount = 0;
  if(\Session::has('discount')) {
  $discount = \Session::get('discount');
  }
  @endphp
  <div class="container">
    <sale-component
        :cart='@json(Cart::content())'
        :communes='@json($communes)'
        :discount="{{ $discount }}"
        webpay-action="{{ route('sale.init' )}}"
        asset-action="{{ asset("img/1.Webpay_FB_80px.svg")  }}"
        dispatch-action="{{ route('dispatchPrice') }}"
        update-action="{{ route('cart.update') }}"
        coupon-action="{{ route('coupon.store') }}"
        transaction-action="{{ route('sale.store') }}"
        home="{{ route('home') }}" @if(\Auth::user()) :profile='@json(\Auth::user()->profile)' @endif>
    </sale-component>
  </div>
@endsection
