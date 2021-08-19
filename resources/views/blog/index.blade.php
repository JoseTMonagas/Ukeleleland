@extends('layouts.app')

@section('header')
<title>Blog sobre ukeleles por ukelelandbrand.cl</title>
<meta name="title" content="Blog sobre ukeleles por ukelelandbrand.cl"/>
<meta name="description" content="Todo lo que necesitas saber sobre tu ukelele, lo consigues aquí. Conoce más.">
<meta name="keywords" content="La info que necesitas sobre cualquier tipo de ukelele y educación.">
<link rel="canonical" href="{{ url()->current() }}">
<meta name="robots" content="follow, all" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="card mb-3" style="max-width: 60rem;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <a href="{{route('blog.show', $post->slug)}}">
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img" alt="..." />
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{route('blog.show', $post->slug)}}">
                                    {{ $post->displayCategoria . ': ' . $post->title}}
                                </a>
                            </h5>
                            <p class="card-text">{!! $post->excerpt !!}</p>
                            <p class="card-text"><small class="text-muted">{{$post->created_at}}</small></p>
                            <a class="card-link" href="{{route('blog.show', $post->slug)}}">Seguir Leyendo >></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
