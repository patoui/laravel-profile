@extends('layouts.app-footerless')

@section('title', 'Create')

@section('content')
    <section class="section">
        <div class="container">
            <form id="tip-form" method="POST" action="{{ route('admin.tip.store') }}">

                @include('admin.tip.form')

                <p class="control">
                    <button type="submit" class="button is-primary">Submit</button>
                </p>
            </form>
        </div>
    </section>
@endsection
