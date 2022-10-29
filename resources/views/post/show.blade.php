@extends('layouts.app')

@section('meta')
    @include('general-meta', ['model' => $post])
    <meta name="description"        content="{{ $post->short_body }}" />
    <meta property="og:type"        content="article" />
    <meta property="og:title"       content="{{ $post->title }}" />
    <meta property="og:description" content="{{ $post->short_body }}" />
    <meta property="og:image"       content="{{ data_get($post, 'image', Request::root() . '/img/black-white-profile.png') }}" />
@endsection

@section('title', $post->title)

@section('css')
@gitdown
@endsection

@section('content')
<h1 class="w-full text-4xl text-center font-bold">{{ $post->title }}</h1>
<p class="w-full text-sm text-center text-gray-600">{{ $post->short_published_at }}</p>
<form class="w-full text-sm text-center text-gray-500" method="post" action="{{ route('post.favourite.store', ['post' => $post]) }}">
    {{ csrf_field() }}
    <button type="submit">
        <i class="fas fa-thumbs-up mr-2"></i>{{ $post->favourites_count }}
    </button>
</form>

<div class="w-full pt-4 pb-4 markdown-body">{!! GitDown::parseAndCache($post->body) !!}</div>

<div class="w-full p-4">
    <h2 class="text-xl mb-4">Comments</h2>
    @foreach($post->comments as $comment)
    <div class="mb-4 w-full border-b-2">
        <div class="w-full">
            <div class="inline-block w-3/4">
                <a href="{{ '#' . $comment->id }}" id="{{ '#' . $comment->id }}" class="no-underline font-semibold text-gray-700">{{ '# ' . data_get($comment, 'owner.name', 'Anonymous') }}</a>
            </div><div class="inline-block w-1/4 text-right">
                <p class="mb-2 text-sm text-gray-600">{{ $comment->short_created_at }}</p>
            </div>
        </div>
        <p class="mb-4 text-sm text-gray-700">{{ $comment->body }}</p>
    </div>
    @endforeach
</div>

<form class="w-full pl-4 pr-4 pb-4" action="{{ route('post.comment.store', ['post' => $post]) }}" method="post">
    @honeypot
    {{ csrf_field() }}
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('body') ? 'border-red-500' : '' }}" for="body"></label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body" type="text" placeholder="Leave a comment..." required></textarea>
        @if ($errors->has('body'))
        <p class="text-red-500 text-xs italic">{{ $errors->first('body') }}</p>
        @endif
    </div>
    <div class="flex justify-end mb-4">
        <button class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-1 px-2 border border-gray-400 rounded shadow" type="submit">Submit</button>
    </div>
</form>

@if ($previousPost || $nextPost)
<div class="flex w-full mt-4 mb-4">
    <div class="w-1/2">
        @if ($previousPost)
            <a class="underline" href="{{ route('post.show', ['post' => $previousPost]) }}">&#8678; {{ $previousPost->short_title }}</a>
        @endif
    </div>
    <div class="w-1/2 text-right">
        @if ($nextPost)
            <a class="underline" href="{{ route('post.show', ['post' => $nextPost]) }}">{{ $nextPost->short_title }} &#8680;</a>
        @endif
    </div>
</div>
@endif
@endsection
