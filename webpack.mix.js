const path = require('path');
const glob = require('glob-all');
//const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const mix = require('laravel-mix');

let LiveReloadPlugin = require('webpack-livereload-plugin');
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

// Admin
/*mix.sass('resources/assets/sass/rbt-ems-admin.scss', 'public/assets/RBT_EMS/css')
    .js('resources/assets/js/rbt-ems-admin.js', 'public/assets/RBT_EMS/js')
    .js('resources/assets/js/footer-scripts/AFScript.js', 'public/assets/RBT_EMS/js')
    .extract(['vue', 'jquery', 'bootstrap']);*/


// Client
mix.sass('theme/assets/sass/app.scss', 'public/static/theme/css')
    .sass('theme/assets/sass/dark.scss', 'public/static/theme/css')
    .sass('theme/assets/sass/light.scss', 'public/static/theme/css')

    .js('theme/assets/js/app.js', 'public/static/theme/js')

    .extract(['vue', 'jquery', 'bootstrap'])

    .setPublicPath('public/static')

    .options({
        cssNano: {
            discardComments: {
                removeAll: true
            }
        }
        /*purifyCss: {
            paths: glob.sync([
                path.join(__dirname, '.php'),
                path.join(__dirname, 'theme/views/!*.php'),
                path.join(__dirname, 'theme/assets/js/components/!*.vue')
            ]),
        },*!/

        /!*fileLoaderDirs: {
            fonts: 'static/fonts',
            images: 'static/images'
        }*/
    })
    .webpackConfig({
        plugins: [
            new LiveReloadPlugin(),

            //new CleanWebpackPlugin()
        ]
    })
    //.version()
    .browserSync({
        proxy: 'localhost:8000',

        files: ["public/static/theme/css/!*.css", "public/static/theme/js/!*.js", "theme/views/!*.php"]
    });
