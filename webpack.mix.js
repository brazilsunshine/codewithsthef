const mix = require('laravel-mix');

require('laravel-mix-tailwind');

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

mix.js('resources/js/app.js', 'public/js').vue();

// new webpack.ProvidePlugin({
//     'window.Quill': 'quill/dist/quill.js',
//     'Quill': 'quill/dist/quill.js'
// })

// mix.extend('foo',new class{
//     webpackPlugins(){
//         return new webpack.ProvidePlugin({
//             "window.Quill": "quill/dist/quill.js",
//             Quill: "quill/dist/quill.js"
//         });
//     }
// });
