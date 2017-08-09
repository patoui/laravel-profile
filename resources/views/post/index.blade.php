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

@include(
    'navigation.main',
    [
        'title' => 'Articles',
        'subtitle' => 'Stories of my professional development'
    ]
)

<section class="section main">
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
