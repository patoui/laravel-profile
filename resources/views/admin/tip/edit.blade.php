@extends('layouts.app-footerless')

@section('title', 'Update: ' . $tip->title)

@section('content')

    <section class="section">
        <div class="container">
            <form method="POST" action="{{ route('admin.tip.update', ['id' => $tip->id]) }}">
                {{ method_field('PUT') }}

                @include('admin.tip.form')

                <p class="control">
                    <button type="submit" class="button is-primary">Submit</button>
                </p>
            </form>
        </div>
    </section>

@endsection
