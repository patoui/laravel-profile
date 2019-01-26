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

@section('hero-body')
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">Tips and Tricks</h1>
        </div>
    </div>
@endsection

@section('content')

<section class="section main">
    <div class="container">
        <table class="table">
            <tbody>
                @foreach($tips as $tip)
                <tr>
                    <td>
                        <a href="/tip/{{ $tip->slug }}">
                            <h2>{{ $tip->title }}</h2>
                        </a>
                        <p>{{ $tip->short_body }}</p>
                    </td>
                    <td>{{ $tip->short_published_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
