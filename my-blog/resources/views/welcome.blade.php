@extends('layouts.app')
@section('title', 'Blog - Welcome')
@section('content')
    <div class="row">
        <div class="col-12 text-center pt-3">
            <h1 class="display-3 mt-3">
                {{ config('app.name')}}
            </h1>
            <p>
            Ce blog génial contient de nombreux articles, cliquez sur le bouton ci-dessous pour les voir
            </p>
            <a href="{{route('blog.index')}}" class="btn btn-primary btn-sm">Afficher le blog</a>
        </div>
    </div>
@endsection


