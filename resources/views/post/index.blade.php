@extends('layouts.app')

@section('meta')
    <meta name="description"        content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="Patrique Ouimet" />
    <meta property="og:description" content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
    <meta property="og:image"       content="{{ Request::root() . '/img/black-white-profile.png' }}" />
@endsection

@section('title', 'Articles')

@section('content')
    <h1 class="text-4xl mb-4">Articles</h1>
    @foreach ($posts as $post)
    <div class="mb-6 w-full">
        <a href="{{ route('post.show', ['post' => $post]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $post->title }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $post->short_body }}</p>
        <p class="text-sm text-gray-600">Published on {{ $post->short_published_at }}</p>
        <div>
            @foreach ($post->tags as $tag)
            <a href="{{ route('post.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
            @endforeach
        </div>
    </div>
    @endforeach
@endsection
