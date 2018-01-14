let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

   mix.scripts([
    'resources/assets/js/MapView.js',
    'resources/assets/js/MapViewEN.js',
    'resources/assets/js/MapModel.js',
    'resources/assets/js/MapController.js'
], 'public/js/mo.js');