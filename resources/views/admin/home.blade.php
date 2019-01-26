@extends('layouts.app-footerless')

@section('title', 'Articles')

@section('hero-body')
    <div class="hero-body">
        <div class="container">
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Posts</p>
                        <p class="title">{{ $postsCount }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Published Posts</p>
                        <p class="title">{{ $postsPublishedCount }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Tips</p>
                        <p class="title">{{ $tipsCount }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Published Tips</p>
                        <p class="title">{{ $tipsPublishedCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <section class="section main">
        <div class="container">
            <div class="columns is-mobile">
                <div class="column is-half">
                    <h2 class="is-size-4">Posts</h2>
                </div>
                <div class="column is-half has-text-right">
                    <a href="/admin/post/create" class="button is-primary">New Post</a>
                </div>
            </div>
            <table class="table">
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            <a href="/post/{{ $post->slug }}">
                                <h2>{{ $post->title }}</h2>
                                <span style="color: black;">{{ $post->short_published_at }}</span>
                            </a>
                            <p>{{ $post->short_body }}</p>
                        </td>
                        <td class="has-text-right">
                            <span class="icon">
                                <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </span>
                            <span class="icon">
                                <a href="{{ route('admin.post.publish', ['id' => $post->id]) }}" style="color: black;">
                                    @if($post->published_at)
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    @else
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="section main">
        <div class="container">
            <div class="columns is-mobile">
                <div class="column is-half">
                    <h2 class="is-size-4">Tips</h2>
                </div>
                <div class="column is-half has-text-right">
                    <a href="/admin/tip/create" class="button is-primary">New Tip</a>
                </div>
            </div>
            <table class="table">
                <tbody>
                    @foreach($tips as $tip)
                    <tr>
                        <td>
                            <a href="/tip/{{ $tip->slug }}">
                                <h2>{{ $tip->title }}</h2>
                                <span style="color: black;">{{ $tip->short_published_at }}</span>
                            </a>
                            <p>{{ $tip->short_body }}</p>
                        </td>
                        <td class="has-text-right">
                            <span class="icon">
                                <a href="{{ route('admin.tip.edit', ['id' => $tip->id]) }}" style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </span>
                            <span class="icon">
                                <a href="{{ route('admin.tip.publish', ['id' => $tip->id]) }}" style="color: black;">
                                    @if($tip->published_at)
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    @else
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
