@extends('layouts.app')

@section('title', 'Dashboard')

@section('css')
<style type="text/css">
    .stats {
        margin-right: 5px;
    }
    .panel-footer {
        background-color: initial;
        border-top: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            @foreach($posts as $post)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" style="display: inline-block;">{{ $post->title }}</h3>
                    <span class="pull-right hidden-xs">{{ $post->published_at }}</span>
                </div>
                <div class="panel-body" style="color: black;">
                    {{ $post->short_body }}
                </div>
                <div class="panel-footer">
                    <span class="stats"><i class="fa fa-user-o" aria-hidden="true"></i> 0</span>
                    <span class="stats"><i class="fa fa-list" aria-hidden="true"></i> 0</span>
                    <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 0</span>
                    <span class="pull-right"><a href="{{ route('post.edit', ['id' =>$post->id]) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
