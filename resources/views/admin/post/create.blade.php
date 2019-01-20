@extends('layouts.app-footerless')

@section('title', 'Create')

@section('content')
    <section class="section">
        <div class="container">
            <form id="post-form" method="POST" action="{{ route('admin.post.store') }}">

                @include('admin.post.form')

                <p class="control">
                    <button type="submit" class="button is-primary">Submit</button>
                </p>
            </form>
        </div>
    </section>
@endsection
