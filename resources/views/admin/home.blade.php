@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<h1 class="w-full text-center text-4xl">Stats</h1>
<div class="flex mb-4 w-full">
    <div class="w-1/2 text-center text-xl">
        <p>Articles: {{ $postsPublishedCount . ' / ' . $postsCount }}</p>
    </div>
    <div class="w-1/2 text-center text-xl">
        <p>Tips: {{ $tipsPublishedCount . ' / ' . $tipsCount }}</p>
    </div>
</div>

<div class="flex pt-4 pb-2 w-full items-center border-solid border-t-2">
    <div class="w-3/5">
        <h1 class="text-4xl">Articles</h1>
    </div>
    <div class="w-2/5 text-right">
        <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="/admin/post/create">New +</a>
    </div>
</div>
@foreach($posts as $post)
<div class="flex mb-6 w-full">
    <div class="w-4/5">
        <a href="{{ route('post.show', ['slug' => $post->slug]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $post->title . ' (' . $post->analytics_count . ')' }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $post->short_body }}</p>
        <p class="text-sm text-gray-600">{{ $post->published_at ? 'Published on ' . $post->short_published_at : 'Not published' }}</p>
    </div>
    <div class="w-1/5 text-right">
        <a class="mr-2" href="{{ route('admin.post.edit', ['id' => $post->id]) }}"><i class="fas fa-edit" aria-hidden="true"></i></a>
        <a href="{{ route('admin.post.publish', ['id' => $post->id]) }}">
            <i class="{{ $post->published_at ? 'fas' : 'far' }} fa-file"></i>
        </a>
    </div>
</div>
@endforeach

<div class="flex pt-4 pb-2 w-full items-center border-solid border-t-2">
    <div class="w-3/5">
        <h1 class="text-4xl">Tips</h1>
    </div>
    <div class="w-2/5 text-right">
        <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="/admin/tip/create">New +</a>
    </div>
</div>
@foreach($tips as $tip)
<div class="flex mb-6 w-full">
    <div class="w-4/5">
        <a href="{{ route('tip.show', ['slug' => $tip->slug]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $tip->title . ' (' . $tip->analytics_count . ')' }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $tip->short_body }}</p>
        <p class="text-sm text-gray-600">{{ $tip->published_at ? 'Published on ' . $tip->short_published_at : 'Not published' }}</p>
        <div>
            @foreach($tip->tags as $tag)
            <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="w-1/5 text-right">
        <a class="mr-2" href="{{ route('admin.tip.edit', ['id' => $tip->id]) }}"><i class="fas fa-edit" aria-hidden="true"></i></a>
        <a href="{{ route('admin.tip.publish', ['id' => $tip->id]) }}">
            <i class="{{ $tip->published_at ? 'fas' : 'far' }} fa-file"></i>
        </a>
    </div>
</div>
@endforeach

<div class="flex pt-4 pb-2 w-full items-center border-solid border-t-2">
    <div class="w-3/5">
        <h1 class="text-4xl">Videos</h1>
    </div>
    <div class="w-2/5 text-right">
        <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="{{ route('admin.video.create') }}">New +</a>
    </div>
</div>
@foreach($videos as $video)
    <div class="flex mb-6 w-full">
        <div class="w-4/5">
            <a href="{{ route('video.show', ['slug' => $video->slug]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $video->title . ' (' . $video->analytics_count . ')' }}</a>
            <p class="text-sm text-gray-600 mb-2">{{ $video->published_at ? 'Published on ' . $video->short_published_at : 'Not published' }}</p>
            <div>
                @foreach($video->tags as $tag)
                    <a href="{{ route('video.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="w-1/5 text-right">
            <a class="mr-2" href="{{ route('admin.video.edit', ['id' => $video->slug]) }}"><i class="fas fa-edit" aria-hidden="true"></i></a>
            <a href="{{ route('admin.video.publish', ['id' => $video->slug]) }}">
                <i class="{{ $video->published_at ? 'fas' : 'far' }} fa-file"></i>
            </a>
        </div>
    </div>
@endforeach
@endsection

