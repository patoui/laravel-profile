@extends('layouts.app')

@section('meta')
@if (config('facebook.app_id'))
<meta property="fb:app_id"      content="{{ config('facebook.app_id') }}" />
@endif
<meta property="og:url"         content="{{ Request::url() }}" />
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
<form class="w-full text-sm text-center text-gray-500" method="post" action="{{ route('post.favourite.store', ['slug' => $post->slug]) }}">
    {{ csrf_field() }}
    <button type="submit">
        <i class="fas fa-thumbs-up mr-2"></i>{{ $post->favourites_count }}
    </button>
</form>

<div class="w-full pt-4 pb-4 markdown-body">{!! GitDown::parseAndCache($post->body) !!}</div>

@if ($previousPost || $nextPost)
<div class="flex w-full mt-4 mb-4">
    <div class="w-1/2">
        @if ($previousPost)
            <a class="underline" href="{{ route('post.show', ['slug' => $previousPost->slug]) }}">&#8678; {{ $previousPost->short_title }}</a>
        @endif
    </div>
    <div class="w-1/2 text-right">
        @if ($nextPost)
            <a class="underline" href="{{ route('post.show', ['slug' => $nextPost->slug]) }}">{{ $nextPost->short_title }} &#8680;</a>
        @endif
    </div>
</div>
@endif
@endsection
