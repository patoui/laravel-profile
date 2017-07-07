@extends('post.layout')

@section('title', 'Create')

@section('content')
    <div class="row" style="padding-top: 20px;">
        <div class="col-md-12">
            <form method="POST" action="{{ route('post.store') }}">

                @include('post.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
