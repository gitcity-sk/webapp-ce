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

// Javascripts
mix.js('resources/assets/js/app.js', 'public/js/mix/app.js')
    .js('resources/assets/js/bundle.js', 'public/js/mix/assets.js')
    .js('resources/assets/js/groups/bundle.js', 'public/js/mix/groups.js')
    .js('resources/assets/js/profiles/bundle.js', 'public/js/mix/profiles.js')
    .js('resources/assets/js/projects/bundle.js', 'public/js/mix/projects.js')
    .js('resources/assets/js/users/bundle.js', 'public/js/mix/users.js')
    .js('resources/assets/js/license/bundle.js', 'public/js/mix/license.js')
    .js('resources/assets/js/git/bundle.js', 'public/js/mix/git.js')
    .js('resources/assets/js/ide/bundle.js', 'public/js/mix/ide.js')
    .js('resources/assets/js/cms/bundle.js', 'public/js/mix/cms.js')
    .js('resources/assets/js/milestones/bundle.js', 'public/js/mix/milestones.js')
    .js('resources/assets/js/issues/bundle.js', 'public/js/mix/issues.js').version().sourceMaps().extract(['vue', 'emojione']);

// CSS
mix.sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/blog.scss', 'public/css').version().sourceMaps();

// Copy files/directories
mix.copyDirectory('node_modules/monaco-editor/dev/vs', 'public/js/monaco-editor/vs');
