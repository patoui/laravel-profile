@extends('layouts.app')

@section('title', 'Add Media')

@section('hero-body')
<div class="hero-body">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <h1 class="title">Add Media</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="section main">
    <div class="container">
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="field">
                <div class="file has-name is-boxed">
                    <label class="file-label">
                        <input class="file-input" type="file" name="media">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name">
                            File name...
                        </span>
                    </label>
                </div>
            </div>

            <p class="control">
                <button type="submit" class="button is-primary">Submit</button>
            </p>
        </form>
    </div>
</section>

@endsection
