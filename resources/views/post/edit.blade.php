@extends('post.layout')

@section('title', 'Update: ' . $post->title)

@section('content')
    <div class="row" style="padding-top: 20px;">
        <div class="col-md-12">
            <form method="POST" action="{{ route('post.update', ['id' => $post->id]) }}">
                {{ method_field('PUT') }}

                @include('post.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
