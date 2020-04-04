@extends('layouts.app')

@section('title', 'Videos')

@section('content')
    <h1 class="text-4xl mb-4">Videos</h1>
    @forelse($videos as $video)
        <div class="mb-6 w-full">
            <a href="{{ route('video.show', ['video' => $video->slug]) }}" class="mb-2 no-underline font-semibold text-black text-xl hover:underline block">{{ $video->title }}</a>
            <p class="mb-2 text-sm text-gray-700">{{ $video->description ?? 'No description available.' }}</p>
            <p class="mb-2 text-sm text-gray-600">Published on {{ $video->short_published_at }}</p>
        </div>
    @empty
        <div class="mb-6 w-full">
            <p>No videos yet :(</p>
        </div>
    @endforelse
@endsection

