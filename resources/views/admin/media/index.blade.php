@extends('layouts.app-footerless')

@section('title', 'Media Library')

@section('hero-body')
<div class="hero-body">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <h1 class="title">{{ $files->count() }}</h1>
                <h2 class="subtitle">Total</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="section main">
    <div class="container">
        <div class="columns is-desktop">
            @foreach($files as $file)
            <div class="column">
                <div class="card">
                    @if ($file->getTypeFromMime() === 'image')
                    <div class="card-image">
                        <figure class="image">
                            <img src="{!! $file->getUrl() !!}" alt="Placeholder image">
                        </figure>
                    </div>
                    @endif
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4">{{ $file->name }}</p>
                                <p class="subtitle is-6">{{ $file->file_name }}</p>
                                <p class="subtitle is-6">{{ $file->human_readable_size }}</p>
                            </div>
                        </div>

                        <div class="content">
                            <time datetime="{{ $file->created_at->format('Y-n-j') }}">{{ $file->created_at->format('g:i A j M Y') }}<br>11:09 PM - 1 Jan 2016</time>
                        </div>
                    </div>
                    <footer class="card-footer has-text-black">
                        <a href="{{ route('admin.media.edit', ['media' => $file->id]) }}" class="card-footer-item">Edit</a>
                        <a href="{{ route('admin.media.delete', ['media' => $file->id]) }}" class="card-footer-item">Delete</a>
                    </footer>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
