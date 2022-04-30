const mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.postCss("resources/css/tailwind.css", "public/css", [
    tailwindcss('./tailwind.config.js'),
  ]);

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/libs.js', 'public/js');
    
mix.sass('resources/scss/app.scss', 'public/css')
.sass('resources/scss/libs.scss', 'public/css');