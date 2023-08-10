const mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js').vue();


// remove comments when in production
if (mix.inProduction())
{
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true
                }
            }
        }
    });

    mix.version();
}
