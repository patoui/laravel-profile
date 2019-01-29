@extends('layouts.app')

@section('title', 'Articles')

@section('hero-body')
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">Articles</h1>
            <h2 class="subtitle">Stories of my professional development</h2>
        </div>
    </div>
@endsection

@section('content')

<section class="section main">
    <div class="container">
        <table class="table">
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        <p><a href="/post/{{ $post->slug }}" class="is-size-5 has-text-black">{{ $post->title }}</a></p>
                        <p class="is-size-7 has-text-grey">{{ $post->short_published_at }}</p>
                        <p class="has-text-grey-dark" style="margin: 10px 0;">{{ $post->short_body }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
