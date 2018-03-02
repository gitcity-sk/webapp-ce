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
    .js('resources/assets/js/bundle.js', 'public/js')
    .js('resources/assets/js/components/groups/bundle.js', 'public/js/mix/groups')
    .js('resources/assets/js/components/profiles/bundle.js', 'public/js/mix/profiles')
    .js('resources/assets/js/components/projects/bundle.js', 'public/js/mix/projects')
    .js('resources/assets/js/components/users/bundle.js', 'public/js/mix/users')
    .js('resources/assets/js/components/license/bundle.js', 'public/js/mix/license')
    .js('resources/assets/js/components/git/bundle.js', 'public/js/mix/git')
    .js('resources/assets/js/ide/bundle.js', 'public/js/mix/ide')
    .js('resources/assets/js/cms/bundle.js', 'public/js/mix/cms')
    .js('resources/assets/js/milestones/bundle.js', 'public/js/mix/milestones')
    .js('resources/assets/js/issues/bundle.js', 'public/js/mix/issues')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/blog.scss', 'public/css').version().sourceMaps();

mix.copyDirectory('node_modules/monaco-editor/dev/vs', 'public/js/monaco-editor/vs');
