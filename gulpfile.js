const elixir = require('laravel-elixir');
var gulp = require('gulp');
var shell = require('gulp-shell')
var webpack = require('laravel-elixir-webpack-official');
var del = require('del');

var Task = elixir.Task;

Elixir.extend('remove', function(path) {

    new Task('remove', function() {
        console.log(`Current directory: ${process.cwd()}`); //for debug, remove this if you don't want
        return del(path);
    });
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {

    mix.remove([ 'public/build']);

    mix.sass('app.scss')

        .webpack('home.js')

        .webpack('app.js')

        .version(['css/app.css', 'js/app.js']);

    mix.copy('node_modules/font-awesome/fonts', 'public/fonts/')
});

// Run migrations in sub dirs.
gulp.task('migrate', shell.task([
    'php artisan migrate --path=/database/migrations/users'
]));
