<!DOCTYPE html>
<html>
<head>
    <!-- mobile friendly viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- page title -->
    <title>Patrique Ouimet - @yield('title')</title>

    <!-- style sheets -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @yield('css')

    <!-- font awesome icons -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <style type="text/css">
        html, body {
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        }
        body {
            padding-top: 50px;
        }
    </style>
</head>
<body>
    @include('navigation.main')
    <div class="container">
        @yield('content')
    </div>

    <!-- scripts -->
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('scripts')
</body>
</html>
