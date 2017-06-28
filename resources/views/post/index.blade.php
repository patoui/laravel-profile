@extends('post.layout')

@section('title', 'Articles')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            @foreach($posts as $post)
            <a href="/post/{{ $post->id }}">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="display: inline-block;">{{ $post->title }}</h3>
                        <span class="pull-right hidden-xs">{{ $post->published_at }}</span>
                    </div>
                    <div class="panel-body" style="color: black;">
                        {{ $post->short_body }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
