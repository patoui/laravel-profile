@extends('layouts.app')

@section('meta')
@if (config('facebook.app_id'))
<meta property="fb:app_id"      content="{{ config('facebook.app_id') }}" />
@endif
<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="og:type"        content="article" />
<meta property="og:title"       content="{{ $post->title }}" />
<meta property="og:description" content="{{ $post->short_body }}" />
<meta property="og:image"       content="{{ data_get($post, 'image', Request::root() . '/img/black-white-profile.png') }}" />
@endsection

@section('title', $post->title)

@section('hero-body')
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">{{ $post->title }}</h1>
        </div>
    </div>
@endsection

@section('content')

<section class="section">
    <div class="container">
        <article class="markdown-body">{!! $post->parsed_body !!}</article>
    </div>
</section>
<section class="section">
    <div class="container">
        <h4 class="subtitle">Comments</h4>
        <div id="comments">
        @include('post.comments', ['comments' => $comments])
        </div>

        <form id="post-comment"
            method="post"
            action="{{ route('post.comment.store', ['slug' => $post->slug]) }}"
            class="media">
            {{ csrf_field() }}

            <!-- TODO: Add avatar -->
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="http://via.placeholder.com/64x64" alt="Avatar placeholder">
                </p>
            </figure>

            <div class="media-content">
                <div class="field">
                    <p class="control">
                        <textarea name="body"
                            class="textarea{{ $errors->has('body') ? ' is-danger' : '' }}"
                            placeholder="Write a comment, would love to hear your feedback!"></textarea>
                    </p>

                    @if ($errors->has('body'))
                    <p class="help is-danger">{{ $errors->first('body') }}</p>
                    @endif
                </div>
                <nav class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <button type="submit" class="button is-primary">Submit</button>
                        </div>
                    </div>
                    <!-- TODO: Add 'Press enter to submit' functionality -->
                    <!-- <div class="level-right">
                        <div class="level-item">
                            <label class="checkbox">
                                <input type="checkbox"> Press enter to submit
                            </label>
                        </div>
                    </div> -->
                </nav>
            </div>
        </form>
    </div>
</section>
@if ($previousPost)
<section class="section">
    <div class="container">
        <a href="{{ route('post.show', ['slug' => $previousPost->slug]) }}" class="button is-secondary" style="white-space: normal; padding: 25px;">Previous: {{ $previousPost->title }}</a>
    </div>
</section>
@endif
@endsection

@section('javascript')
<script src="{{ mix('/js/post.js') }}"></script>
@endsection
