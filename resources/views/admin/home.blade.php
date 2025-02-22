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
@foreach ($posts as $post)
<div class="flex mb-6 w-full">
    <div class="w-4/5">
        <a href="{{ route('post.show', ['post' => $post]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $post->title . ' (' . $post->analytics_count . ')' }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $post->short_body }}</p>
        <p class="text-sm text-gray-600">{{ $post->published_at ? 'Published on ' . $post->short_published_at : 'Not published' }}</p>
        <div>
            @foreach ($post->tags as $tag)
                <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="w-1/5 text-right">
        <a class="inline-block mr-2 w-6" href="{{ route('admin.post.edit', ['post' => $post->id]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </a>
        <a class="inline-block w-6" href="{{ route('admin.post.publish', ['post' => $post->id]) }}">
            @if ($post->published_at)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M10.5 3A1.501 1.501 0 0 0 9 4.5h6A1.5 1.5 0 0 0 13.5 3h-3Zm-2.693.178A3 3 0 0 1 10.5 1.5h3a3 3 0 0 1 2.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15Z" clip-rule="evenodd" />
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
            </svg>
            @endif
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
@foreach ($tips as $tip)
<div class="flex mb-6 w-full">
    <div class="w-4/5">
        <a href="{{ route('tip.show', ['tip' => $tip]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $tip->title . ' (' . $tip->analytics_count . ')' }}</a>
        <p class="mt-2 mb-2 text-sm text-gray-700">{{ $tip->short_body }}</p>
        <p class="text-sm text-gray-600">{{ $tip->published_at ? 'Published on ' . $tip->short_published_at : 'Not published' }}</p>
        <div>
            @foreach ($tip->tags as $tag)
            <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="w-1/5 text-right">
        <a class="inline-block mr-2 w-6" href="{{ route('admin.tip.edit', ['tip' => $tip->id]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </a>
        <a class="inline-block w-6" href="{{ route('admin.tip.publish', ['tip' => $tip->id]) }}">
            @if ($tip->published_at)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M10.5 3A1.501 1.501 0 0 0 9 4.5h6A1.5 1.5 0 0 0 13.5 3h-3Zm-2.693.178A3 3 0 0 1 10.5 1.5h3a3 3 0 0 1 2.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15Z" clip-rule="evenodd" />
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
            </svg>
            @endif
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
@foreach ($videos as $video)
    <div class="flex mb-6 w-full">
        <div class="w-4/5">
            <a href="{{ route('video.show', ['video' => $video->slug]) }}" class="no-underline font-semibold text-black text-xl hover:underline block">{{ $video->title . ' (' . $video->analytics_count . ')' }}</a>
            <p class="text-sm text-gray-600 mb-2">{{ $video->published_at ? 'Published on ' . $video->short_published_at : 'Not published' }}</p>
            <div>
                @foreach ($video->tags as $tag)
                    <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-600 mr-2 hover:text-black hover:underline">{{ '#' . $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="w-1/5 text-right">
            <a class="inline-block mr-2 w-6" href="{{ route('admin.video.edit', ['video' => $video->slug]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
            <a class="inline-block w-6" href="{{ route('admin.video.publish', ['video' => $video->slug]) }}">
                @if ($video->published_at)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M10.5 3A1.501 1.501 0 0 0 9 4.5h6A1.5 1.5 0 0 0 13.5 3h-3Zm-2.693.178A3 3 0 0 1 10.5 1.5h3a3 3 0 0 1 2.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15Z" clip-rule="evenodd" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                </svg>
                @endif
            </a>
        </div>
    </div>
@endforeach
@endsection

