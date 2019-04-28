@extends('layouts.app')

@section('title', 'Patrique Ouimet')

@section('content')
<span class="w-full block mt-2 font-bold text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl">Hello world!</span>
<h1 class="w-full block mb-4 font-bold text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl">My name is Patrique Ouimet :D</h1>
<p class="block mb-5 leading-relaxed">I'm a developer who currently works with: PHP (Laravel), JavaScript (AngularJS, VueJS), and CSS (Sass). I have an obssession with learning, whether it’s to sharpen my existing skills or to explore new ones such as: Ruby (Ruby on Rails), Python (Django), AdonisJS, React, etc. I also enjoy running, hiking, biking, weight lifting, soccer, and basketball.</p>
<p class="block mb-5 leading-relaxed">As of late I’ve decided to try myself at blogging to share some tips and tricks I’ve learned during my time as a developer, whether they be technical, interpersonel, or otherwise; my hope is that fellow developers may learn something from my blog.</p>
<p class="block mb-5 leading-relaxed">If you have any suggestions or materials that would assist me in becoming a better developer or to help me write better content, please don’t hesitate to contact me on Twitter <a href="https://twitter.com/patoui2" class="text-blue-500">@patoui2</a> or in the form below.</p>
<div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 mt-4 ml-auto mr-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('contact.store') }}" method="post">
        @honeypot
        {{ csrf_field() }}
        <h2>Contact Me</h2>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('name') ? 'border-red-500' : '' }}" for="name"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
            @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('email') ? 'border-red-500' : '' }}" for="email"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email">
            @if ($errors->has('email'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('phone') ? 'border-red-500' : '' }}" for="phone"></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" type="text" placeholder="Phone">
            @if ($errors->has('phone'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 {{ $errors->has('message') ? 'border-red-500' : '' }}" for="message"></label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" type="text" placeholder="Message"></textarea>
            @if ($errors->has('message'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('message') }}</p>
            @endif
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Send!</button>
        </div>
    </form>
</div>
@endsection

@include('vendor.flash.message')
