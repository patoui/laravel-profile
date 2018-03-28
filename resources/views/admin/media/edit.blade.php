@extends('layouts.app-footerless')

@section('title', 'Edit Media')

@section('hero-body')
<div class="hero-body">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <h1 class="title">Edit Media</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="section main">
    <div class="container">
        <form method="POST" action="{{ route('admin.media.update', ['media' => $media->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @if ($media->getTypeFromMime() === 'image')
            <div class="field has-text-centered">
                <img src="{!! $media->getUrl() !!}" alt="Image preview">
            </div>
            @endif

            <div class="field">
                <input name="name" class="input{{ $errors->has('slug') ? ' is-danger' : '' }}" type="text" placeholder="Name" value="{{ old('name', $media->name) }}">

                @if ($errors->has('name'))
                <p class="help is-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <p class="control">
                <button type="submit" class="button is-primary">Submit</button>
            </p>
        </form>
    </div>
</section>

@endsection
