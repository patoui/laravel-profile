@extends('layouts.app')

@section('title', 'Update: ' . $post->title)

@section('content')
    <section class="section">
        <div class="container">
            <form method="POST" action="{{ route('admin.post.update', ['id' => $post->id]) }}">
                {{ method_field('PUT') }}

                @include('admin.post.form')

                <p class="control">
                    <button type="submit" class="button is-primary">Submit</button>
                </p>
            </form>
        </div>
    </section>
@endsection
