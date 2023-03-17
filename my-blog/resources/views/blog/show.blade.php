@extends('layouts.app')
@section('title', 'Blog - Welcome')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <a href="{{route('blog.index')}}" class="btn btn-primary btn-sm" >Return</a>
            <h2 class="display-8 pt-3">
                {{ $blogPost->title}}
            </h2>
            <hr>
                {!! $blogPost->body !!}
                <p>
                    Author : {{ $blogPost->user_id }}
                </p>
            <hr>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-6">
            <a href="{{ route('blog.edit', $blogPost->id)}}" class="btn btn-success btn-sm">Modifier</a>
        </div>
        <div class="col-md-6">
            DELETE
        </div>
    </div>
@endsection