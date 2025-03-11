const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .scripts([
      'resources/js/libs.min.js',
      'resources/js/slider.js',
      'resources/js/setting/utility.js',
      'resources/js/setting/setting.js',
      'resources/js/setting/setting-init.js',
      'resources/js/masonry.pkgd.min.js',
      'resources/js/enchanter.js',
      'resources/js/sweet-alert.js',
      'resources/js/charts/weather-chart.js',
      'resources/js/app.js',
      'resources/js/fslightbox.js',
      'resources/js/lottie.js',
      'resources/js/select2.js',
      'resources/js/ecommerce.js'
   ], 'public/js/all.js')
   .sass('resources/sass/app.scss', 'public/css');
