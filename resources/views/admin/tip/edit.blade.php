@extends('layouts.app')

@section('title', 'Update: ' . $tip->title)

@section('content')
<form id="app" class="w-full" method="post" action="{{ route('admin.tip.update', [$tip->id]) }}">
    {{ method_field('PUT') }}
    <h2>Edit Tip</h2>
    @include('admin.tip.form')
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Submit</button>
</form>
@endsection

