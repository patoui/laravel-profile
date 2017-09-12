<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Patrique Ouimet">
    <!-- Additional meta tags -->
    @yield('meta')

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>

    <title>@yield('title')</title>

    <!-- App CSS -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <!-- Additional CSS -->
    @yield('css')
</head>
<body>

    <div>

        <section class="hero is-primary is-bold">

            <!-- Navigation -->
            @include('navigation.main')

            <!-- Headline -->
            @yield('hero-body')

        </section>

        <!-- Main Content -->
        @yield('content')

        @include('layouts.footer')

    </div>

    <!-- App JS -->
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Additional JS -->
    @yield('javascript')

    @if (! app()->environment('development', 'testing', 'dusk'))
        @include('google.analytics')
    @endif

</body>

</html>
