@extends('layouts.app')

@section('title', 'Videos')

@section('content')
    <h1 class="text-4xl mb-4">Videos</h1>
    @foreach($videos as $video)
        <div class="mb-6 w-full">
            <a href="{{ route('video.show', ['slug' => $video->slug]) }}" class="mb-2 no-underline font-semibold text-black text-xl hover:underline block">{{ $video->title }}</a>
            <p class="mb-2 text-sm text-gray-700">{{ $video->description ?? 'No description available.' }}</p>
            <p class="mb-2 text-sm text-gray-600">Published on {{ $video->short_published_at }}</p>
{{--            <div>--}}
{{--                @foreach($video->tags as $tag)--}}
{{--                    <a href="{{ route('video.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
        </div>
    @endforeach
@endsection

