const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');

mix.styles('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/theme.css');