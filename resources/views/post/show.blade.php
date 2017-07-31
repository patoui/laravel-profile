@extends('layouts.app')

@section('meta')
<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="og:type"        content="article" />
<meta property="og:title"       content="{{ $post->title }}" />
<meta property="og:description" content="{{ $post->short_body }}" />
{{-- <meta property="og:image"       content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" /> --}}
@endsection

@section('title', $post->title)

@section('content')
<section class="hero is-dark is-bold">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">{{ $post->title }}</h1>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <p style="white-space: pre-wrap;">{{ $post->body }}</p>
    </div>
</section>
@endsection
