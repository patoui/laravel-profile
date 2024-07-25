@extends('layouts.app')

@section('meta')
    @include('general-meta', ['model' => $video])
    <meta name="description"        content="{{ $video->short_body }}" />
    <meta property="og:type"        content="video.other" />
    <meta property="og:title"       content="{{ $video->title }}" />
    <meta property="og:description" content="{{ $video->short_body }}" />
    <meta property="og:image"       content="{{ data_get($video, 'image', Request::root() . '/img/black-white-profile.png') }}" />
    <meta property="og:video"       content="{{ $video->embed_url }}" />
@endsection

@section('title', $video->title)

@section('content')
    <h1 class="w-full text-4xl text-center font-bold">{{ $video->title }}</h1>
    <p class="w-full text-sm text-center text-gray-600">{{ $video->short_published_at }}</p>
    {{-- <form class="w-full text-sm text-center text-gray-500" method="post" action="{{ route('video.favourite.store', [$video->slug]) }}">
        {{ csrf_field() }}
        <button type="submit">
            <i class="fas fa-thumbs-up mr-2"></i>{{ $video->favourites_count }}
        </button>
    </form> --}}

    <div class="block relative" style="max-width:600px; max-height:338px; width:90vw; height:50.85vw; margin: 1rem auto;">
        <iframe style="position:absolute; top:0; left:0; width:100%; height:100%; border: none;" src="{{ $video->embed_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    @if ($previousVideo || $nextVideo)
        <div class="flex w-full mt-4 mb-4">
            <div class="w-1/2">
                @if ($previousVideo)
                    <a class="underline" href="{{ route('video.show', ['video' => $previousVideo->slug]) }}">&#8678; {{ $previousVideo->title }}</a>
                @endif
            </div>
            <div class="w-1/2 text-right">
                @if ($nextVideo)
                    <a class="underline" href="{{ route('video.show', ['video' => $nextVideo->slug]) }}">{{ $nextVideo->title }} &#8680;</a>
                @endif
            </div>
        </div>
    @endif
@endsection
