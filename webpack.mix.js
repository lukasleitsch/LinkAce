const mix = require('laravel-mix');

mix.options({
  processCssUrls: false
});

mix.disableNotifications();

mix.js('assets/_js/fontawesome.js', 'assets/dist');

mix.combine([
  'node_modules/jquery/dist/jquery.min.js',
  'node_modules/bootstrap/dist/js/bootstrap.min.js',
  'node_modules/selectize/dist/js/standalone/selectize.min.js'
], 'assets/dist/dependencies.js');

mix.sass('assets/_scss/app.scss', 'assets/dist');
