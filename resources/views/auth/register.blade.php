@extends('layouts.app')

@section('content')
<div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 mt-4 ml-auto mr-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-4" action="{{ route('register') }}" method="post">
        @honeypot
        {{ csrf_field() }}
        <h2>Register</h2>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('name') ? 'border-red-500' : '' }}" for="name"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name">
            @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('email') ? 'border-red-500' : '' }}" for="email"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email">
            @if ($errors->has('email'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('password') ? 'border-red-500' : '' }}" for="name"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="password" type="password" placeholder="Password">
            @if ($errors->has('password'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}" for="name"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="password_confirmation" type="password" placeholder="Confirm Password">
            @if ($errors->has('password_confirmation'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>
        <div class="flex items-center justify-center mb-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Register</button>
        </div>
        <div class="flex items-center justify-center">
            <a class="text-dark py-2 px-4 focus:outline-none" href="{{ url('/auth/github') }}"><i class="fab fa-github mr-2"></i>Github</a>
        </div>
    </form>
</div>
@endsection
@section('content')

