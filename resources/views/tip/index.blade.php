@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <h1 class="text-4xl mb-4">Tips &amp; Tricks</h1>
    @foreach($tips as $tip)
    <div class="mb-6 w-full">
        <a href="{{ route('tip.show', ['slug' => $tip->slug]) }}" class="mb-2 no-underline font-semibold text-black text-xl hover:underline block">{{ $tip->title }}</a>
        <p class="mb-2 text-sm text-gray-700">{{ $tip->short_body }}</p>
        <p class="mb-2 text-sm text-gray-600">Published on {{ $tip->short_published_at }}</p>
        <div>
            @foreach($tip->tags as $tag)
            <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
            @endforeach
        </div>
    </div>
    @endforeach
@endsection

