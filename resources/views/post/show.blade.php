@extends('post.layout')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $post->title }}</h1>
            <p style="white-space: pre-wrap;">{{ $post->body }}</p>
        </div>
    </div>
@endsection
