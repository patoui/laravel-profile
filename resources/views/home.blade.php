@extends('layouts.app')

@section('meta')
    <meta name="description"        content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="Patrique Ouimet" />
    <meta property="og:description" content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
    <meta property="og:image"       content="{{ Request::root() . '/img/black-white-profile.png' }}" />
@endsection

@section('title', 'Patrique Ouimet')

@section('content')
<span class="w-full block mt-2 font-bold text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl">Hello world!</span>
<h1 class="w-full block mb-4 font-bold text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl">My name is Patrique Ouimet :D</h1>
<p class="block mb-5 leading-relaxed">I'm a developer who currently works with: PHP (Laravel), JavaScript (AngularJS, VueJS), and CSS (Sass). I have an obssession with learning, whether it’s to sharpen my existing skills or to explore new ones such as: Ruby (Ruby on Rails), Python (Django), AdonisJS, React, etc. I also enjoy running, hiking, biking, weight lifting, soccer, and basketball.</p>
<p class="block mb-5 leading-relaxed">As of late I’ve decided to try myself at blogging to share some tips and tricks I’ve learned during my time as a developer, whether they be technical, interpersonel, or otherwise; my hope is that fellow developers may learn something from my blog.</p>
<p class="block mb-5 leading-relaxed">If you have any suggestions or materials that would assist me in becoming a better developer or to help me write better content, please don’t hesitate to contact me on Twitter <a href="https://twitter.com/patoui2" class="text-blue-600">@patoui2</a>.</p>
@endsection

@include('vendor.flash.message')
