@extends('post.layout')

@section('title', 'Articles')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
        </div>
    </div>
@endsection
