const mix = require('laravel-mix');

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
mix.babelConfig({
    "presets": [
        [
            "@babel/preset-env",
            {
                'corejs': 3,
                'useBuiltIns': 'usage'
            }
        ],
    ],
});

mix

    .setPublicPath("public_html/")
    .sourceMaps(false, "source-map")
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .disableSuccessNotifications();

