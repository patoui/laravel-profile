@extends('layouts.app')

@section('meta')
    @include('general-meta', ['model' => $tip])
    <meta name="description"        content="{{ $tip->short_body }}" />
    <meta property="og:type"        content="article" />
    <meta property="og:title"       content="{{ $tip->title }}" />
    <meta property="og:description" content="{{ $tip->short_body }}" />
    <meta property="og:image"       content="{{ data_get($tip, 'image', Request::root() . '/img/black-white-profile.png') }}" />
@endsection

@section('title', $tip->title)

@section('css')
@gitdown
@endsection

@section('content')
<h1 class="w-full text-4xl text-center font-bold">{{ $tip->title }}</h1>
<p class="w-full text-sm text-center text-gray-600">{{ $tip->short_published_at }}</p>

<div class="w-full pt-4 pb-4 markdown-body">{!! GitDown::parseAndCache($tip->body) !!}</div>

@if ($previousTip || $nextTip)
<div class="flex w-full mt-4 mb-4">
    <div class="w-1/2">
        @if ($previousTip)
            <a class="underline" href="{{ route('tip.show', ['tip' => $previousTip]) }}">&#8678; {{ $previousTip->short_title }}</a>
        @endif
    </div>
    <div class="w-1/2 text-right">
        @if ($nextTip)
            <a class="underline" href="{{ route('tip.show', ['tip' => $nextTip]) }}">{{ $nextTip->short_title }} &#8680;</a>
        @endif
    </div>
</div>
@endif
@endsection
