@extends('layouts.app')

@section('title', 'Articles')

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
                        <p><a href="/tip/{{ $tip->slug }}" class="is-size-5 has-text-black">{{ $tip->title }}</a></p>
                        <p class="is-size-7 has-text-grey">{{ $tip->short_published_at }}</p>
                        <p class="has-text-grey-dark" style="margin: 10px 0;">{{ $tip->short_body }}</p>
                        <p class="is-size-7">
                            @foreach($tip->tags as $tag)
                            <a href="{{ route('tip.index', ['tag' => $tag->name]) }}" class="button is-small is-text">{{ '#' . $tag->name }}</a>
                            @endforeach
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
