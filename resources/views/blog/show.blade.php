@extends('layouts.app')

@section('header')
<title>{{ ucfirst($post->title) }}</title>
<meta name="title" content="{{ ucfirst($post->slug) }}"/>
<meta name="description" content="{{$post->title}}">
<meta name="keywords" content="La info que necesitas sobre cualquier tipo de ukelele y educación.">
<link rel="canonical" href="{{ url()->current() }}">
<meta name="robots" content="follow, all" />

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-1">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid" alt="{{ $post->slug}}" style="max-height: 20rem;">
                <div class="card-body">
                    <h5 class="card-title text-center border-bottom text-primary">{{$post->title}}</h5>
                    <small class="d-flex flex-row text-muted clearfix justify-content-around">
                        <span><b>Categoria:</b> {{ $post->displayCategoria }}</span>
                        <span><b>Fecha de Publicacion:</b> {{ $post->created_at }}</span>
                    </small>
                    <p class="card-text">{!! $post->body !!}</p>
                </div>
            </div>
        </div>
        <aside class="col-md">
            <ul class="list-group">
                <a class="list-group-item list-group-item-action @if(!isset($current)) active @endif" href="{{route('blog.index')}}">Todos los Articulos</a>
                <a class="list-group-item list-group-item-action @if(isset($current) && ($current == $category->slug)) active @endif" href="{{route('blog.index', 'noticias')}}">Ultimas UkeNoticias</a>
                <a class="list-group-item list-group-item-action @if(isset($current) && ($current == $category->slug)) active @endif" href="{{route('blog.index', 'datos')}}">Datos Curiosos</a>
            </ul>
        </aside>
    </div>
</div>
@endsection
