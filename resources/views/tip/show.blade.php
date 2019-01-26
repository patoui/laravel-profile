@extends('layouts.app')

@section('meta')
@if (config('facebook.app_id'))
<meta property="fb:app_id"      content="{{ config('facebook.app_id') }}" />
@endif
<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="og:type"        content="article" />
<meta property="og:title"       content="{{ $tip->title }}" />
<meta property="og:description" content="{{ $tip->short_body }}" />
<meta property="og:image"       content="{{ data_get($tip, 'image', Request::root() . '/img/black-white-profile.png') }}" />
@endsection

@section('title', $tip->title)

@section('hero-body')
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">{{ $tip->title }}</h1>
            <p style="margin-bottom: 5px;">{{ $tip->short_published_at }}</p>
            <form method="post" action="{{ route('tip.favourite.store', ['slug' => $tip->slug]) }}">
                {{ csrf_field() }}
                <button type="submit" class="button" style="color: white; border: 1px solid #00e0bf; background: rgba(0,0,0,0);">
                    <span class="icon"><i class="fa fa-thumbs-o-up"></i></span><span>{{ $tip->favourites_count }}</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('content')

<section class="section">
    <div class="container">
        <article class="markdown-body">{!! $tip->parsed_body !!}</article>
    </div>
</section>
@if ($previousTip || $nextTip)
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                @if ($previousTip)
                    <a href="{{ route('tip.show', ['slug' => $previousTip->slug]) }}" class="button is-secondary" style="white-space: normal; padding: 25px;">Previous: {{ $previousTip->title }}</a>
                @endif
            </div>
            <div class="column has-text-right">
                @if ($nextTip)
                    <a href="{{ route('tip.show', ['slug' => $nextTip->slug]) }}" class="button is-secondary" style="white-space: normal; padding: 25px;">Next: {{ $nextTip->title }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('javascript')
{{-- <script src="{{ mix('/js/tip.js') }}"></script> --}}
@endsection
