@extends('post.layout')

@section('title', 'Articles')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <ul>
                @foreach($posts as $post)
                <li>{{ $post->title }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
