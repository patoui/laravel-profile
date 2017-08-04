@extends('layouts.app')

@section('meta')
<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="og:type"        content="article" />
<meta property="og:title"       content="{{ $post->title }}" />
<meta property="og:description" content="{{ $post->short_body }}" />
@endsection

@section('title', $post->title)

@section('content')

@include('navigation.main', ['title' => $post->title])

<section class="section">
    <div class="container">
        <article style="white-space: pre-wrap;">{!! $post->body !!}</article>
    </div>
</section>
<section class="section">
    <div class="container">
        @foreach($comments as $comment)
        <div class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="http://via.placeholder.com/64x64" alt="Avatar placeholder">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>Anonymous</strong>
                        <br>
                        {{ $comment->body }}
                        <br>
                        <small>{{ $comment->short_timestamp }}</small>
                        <!-- TODO: Add like/reply -->
                        <!-- <a>Like</a> · <a>Reply</a> ·  -->
                    </p>
                </div>
            </div>
        </div>
        @endforeach

        <form method="post"
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
@endsection
