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

    <div id="app">

        <section class="hero is-primary is-bold">

            <!-- Navigation -->
            <admin-navigation-vue></admin-navigation-vue>

            <!-- Headline -->
            @yield('hero-body')

        </section>


        <!-- Main Content -->
        @yield('content')

        <footer class="footer hero is-primary">
            <div class="container">
                <div class="columns" style="max-width: 767px; margin: 0 auto;">
                    <div class="column">
                        <h3 class="is-size-4">Want to get notifications about my latest posts!</h3>
                    </div>
                    <div class="column">
                        <div class="field has-addons" style="margin: 0 auto;">
                            <div class="control">
                                <input class="input" type="text" placeholder="Email">
                            </div>
                            <div class="control">
                                <a class="button"
                                    style="background-color: #007F6E; color: white; border: 1px solid rgba(0,0,0,0);">
                                Subscribe!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="content has-text-centered">
                    <p>Website by Patrique Ouimet.</p>
                    <p>
                        <a class="icon" href="https://twitter.com/OuimetPatrique">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class="icon" href="https://github.com/patoui">
                            <i class="fa fa-github"></i>
                        </a>
                    </p>
                </div>
            </div>
        </footer>

    </div>

    <!-- App JS -->
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Additional JS -->
    @yield('javascript')

</body>

</html>
