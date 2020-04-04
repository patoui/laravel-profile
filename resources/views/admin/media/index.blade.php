@extends('layouts.app')

@section('title', 'Media')

@section('content')
    <h1 class="w-full text-center text-4xl">Stats</h1>
    <div class="flex mb-4 w-full">
        <div class="w-100 text-center text-xl">
            <p>Files: {{ $files->count() }}</p>
        </div>
    </div>

    <div class="flex pt-4 pb-2 w-full items-center border-solid border-t-2">
        <div class="w-3/5">
            <h1 class="text-4xl">Media</h1>
        </div>
        <div class="w-2/5 text-right">
            <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="{{ route('admin.media.create') }}">New +</a>
        </div>
    </div>
    @foreach($files as $file)
        <div class="flex mb-6 w-full">
            <div class="w-4/5">
                <a href="{{ $file->getFullUrl() }}" class="no-underline font-semibold text-black text-xl hover:underline block" target="_blank">{{ $file->name }}</a>
                <p class="mt-2 mb-2 text-sm text-gray-700">{{ $file->created_at }}</p>
            </div>
            <div class="w-1/5 text-right">
                <a class="mr-2" href="{{ route('admin.media.edit', ['media' => $file->id]) }}"><i class="fas fa-edit" aria-hidden="true"></i></a>
                <a class="mr-2" href="{{ route('admin.media.delete', ['media' => $file->id]) }}"><i class="fas fa-trash" aria-hidden="true"></i></a>
            </div>
        </div>
    @endforeach
@endsection

