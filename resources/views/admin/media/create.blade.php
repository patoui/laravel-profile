@extends('layouts.app')

@section('content')
    <div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 mt-4 ml-auto mr-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-4" action="{{ route('admin.media.store') }}" method="post" enctype="multipart/form-data">
            @honeypot
            {{ csrf_field() }}
            <h2>Media</h2>
            <div class="mt-4 mb-4">
                <input class="shadow appearance-none border {{ $errors->has('media') ? 'border-red-500' : '' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="media" name="media" type="file" placeholder="Media">
                @if ($errors->has('media'))
                    <p class="text-red-500 text-xs italic mt-2">{{ $errors->first('media') }}</p>
                @endif
            </div>
            <div class="flex items-center justify-center mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Upload</button>
            </div>
        </form>
    </div>
@endsection
