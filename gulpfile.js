const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.scripts(
        [
            './node_modules/jquery/dist/jquery.min.js',
            './node_modules/bootstrap/dist/js/bootstrap.min.js',
        ],
        'public/js'
    ).styles(
        [
            'app.css',
            './node_modules/bootstrap/dist/css/bootstrap.min.css',
            './node_modules/font-awesome/css/font-awesome.min.css',
        ],
        'public/css'
    )
    .copy(
        [
            './node_modules/font-awesome/fonts/fontawesome-webfont.eot',
            './node_modules/font-awesome/fonts/fontawesome-webfont.svg',
            './node_modules/font-awesome/fonts/fontawesome-webfont.ttf',
            './node_modules/font-awesome/fonts/fontawesome-webfont.woff',
            './node_modules/font-awesome/fonts/fontawesome-webfont.woff2',
            './node_modules/font-awesome/fonts/FontAwesome.otf',
        ],
        'public/fonts'
    );
});
