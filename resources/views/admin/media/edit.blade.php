@extends('layouts.app')

@section('content')
    <div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 mt-4 ml-auto mr-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-4" action="{{ route('admin.media.update', [$media->id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @honeypot
            {{ csrf_field() }}
            <a href="{{ $media->getFullUrl() }}" class="underline font-semibold text-blue-600 text-xl hover:underline block" target="_blank">{{ $media->name }}</a>
            <div class="mt-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('name') ? 'border-red-500' : '' }}" for="name">Name</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name" value="{{ old('name', $media->name) }}">
                @if ($errors->has('name'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="flex items-center justify-center mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Upload</button>
            </div>
        </form>
    </div>
@endsection
