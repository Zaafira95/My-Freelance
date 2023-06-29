// webpack.mix.js

let mix = require('laravel-mix');

mix.js('src/app.js', 'assets/js').postCss('src/app.css', 'assets/css', [
    require('tailwindcss'),]);
