@extends('layouts.app')

@section('title', 'Articles')

@section('css')
<style type="text/css">
td h2 {
    display: inline-block;
    font-weight: bold;
}
</style>
@endsection

@section('content')
<section class="hero is-dark is-bold">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column has-text-centered">
                    <h1 class="title">{{ $postsCount }}</h1>
                    <h2 class="subtitle">Total</h2>
                </div>
                <div class="column has-text-centered">
                    <h1 class="title">{{ $postsPublishedCount }}</h1>
                    <h2 class="subtitle">Published</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <table class="table">
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        <a href="/post/{{ $post->id }}">
                            <h2>{{ $post->title }}</h2>&nbsp;<span style="color: black;">{{ $post->short_published_at }}</span>
                        </a>
                        <p>{{ $post->short_body }}</p>
                        <p>
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
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

