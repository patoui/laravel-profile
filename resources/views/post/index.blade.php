@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <h1 class="text-4xl mb-4">Articles</h1>
    @foreach($posts as $post)
    <div class="mb-6 w-full">
        <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $post->title }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $post->short_body }}</p>
        <p class="text-sm text-gray-600">Published on {{ $post->short_published_at }}</p>
    </div>
    @endforeach
@endsection
