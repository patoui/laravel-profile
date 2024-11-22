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

<div class="w-full pt-4 pb-4 markdown-body">{!! GitDown::parseAndCache($post->body) !!}</div>

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
