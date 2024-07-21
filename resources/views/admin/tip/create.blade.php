@extends('layouts.app')

@section('title', 'Create')

@section('content')
<form id="app" class="w-full" method="post" action="{{ route('admin.tip.store') }}">
    <h2>New Tip</h2>
    @include('admin.tip.form')
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Submit</button>
</form>
@endsection

