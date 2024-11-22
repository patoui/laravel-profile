<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Patrique Ouimet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Additional meta tags -->
    @yield('meta')

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>

    <title>@yield('title')</title>

    <!-- App CSS -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    @include('feed::links')

    <!-- Additional CSS -->
    @yield('css')
</head>
<body>
    <!-- Header -->
    @if(Auth::user() && Auth::user()->is_admin)
    <div class="flex mb-3 mr-5 ml-5 items-center">
        <ul class="w-full p-3 list-reset flex border-solid border-b border-gray-300">
            <li class="w-1/2 text-center">
                <a class="{{ request()->path() === 'admin/dashboard' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="w-1/2 text-center">
                <a class="{{ request()->path() === 'admin/media' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="{{ route('admin.media.index') }}">Media</a>
            </li>
        </ul>
    </div>
    @endif
    <div class="flex mt-3 mb-3 mr-5 ml-5 items-center">
        <div class="flex w-5/6">
            <div class="mt-1 mr-2">
                <picture>
                    <source srcset="/img/black-white-profile.webp" type="image/webp">
                    <img src="/img/black-white-profile.png" type="image/png" alt="Grayscale profile picture" class="rounded-full w-12 m-auto mb-3" />
                </picture>
            </div>
            <div>
                <p class="block text-2xl">Patrique Ouimet</p>
                <p class="block text-xs italic">Senior Product Engineer</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mb-4">
        <div class="flex justify-center w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 pl-6 sm:pl-8 md:pl-12 lg:pl-20 xl:pl-24 pr-6 sm:pr-8 md:pr-12 lg:pr-20 xl:pr-24 mx-auto">
            <ul class="w-full p-3 list-reset flex border-solid border-b border-t border-gray-300">
                <li class="w-1/4 text-center">
                    <a class="{{ request()->path() === '/' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="{{ route('home') }}">About</a>
                </li>
                <li class="w-1/4 text-center">
                    <a class="{{ request()->path() === 'blog' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="{{ route('post.index') }}">Blog</a>
                </li>
                <li class="w-1/4 text-center">
                    <a class="{{ request()->path() === 'tip' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="{{ route('tip.index') }}">Tips</a>
                </li>
                <li class="w-1/4 text-center">
                    <a class="{{ request()->path() === 'video' ? 'text-black' : 'text-blue-600' }} font-semibold no-underline hover:text-black" href="/video">Videos</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 pl-6 sm:pl-8 md:pl-12 lg:pl-20 xl:pl-24 pr-6 sm:pr-8 md:pr-12 lg:pr-20 xl:pr-24 flex flex-wrap">
        @yield('content')
        </div>
    </div>

    <div class="w-full sm:w-4/5 md:w-4/5 lg:w-4/5 xl:w-3/5 mt-4 ml-auto mr-auto">
        @include('layouts.footer')
    </div>

    <!-- Additional JS -->
    @yield('javascript')
    @stack('scripts')
</body>
</html>
