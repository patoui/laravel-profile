@extends('layouts.app')

@section('title', 'Articles')

@section('css')
<style type="text/css">
td h2 {
    font-weight: bold;
}
tr td:last-child {
    text-align: right;
}
</style>
@endsection

@section('content')
<section class="hero is-dark is-bold">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Articles</h1>
            <h2 class="subtitle">Stories of my professional development</h2>
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
                        <a href="/post/{{ $post->slug }}">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <p>{{ $post->short_body }}</p>
                    </td>
                    <td>{{ $post->short_published_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
