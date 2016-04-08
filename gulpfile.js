var elixir = require('laravel-elixir');
$bowerPath = "bower_components/";
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

elixir(function (mix) {
    mix.sass('app.sass', 'resources/assets/css/app.css')
        .sass('admin.sass', 'resources/assets/css/admin.css')
        .copy($bowerPath + "normalize-css/normalize.css", "resources/assets/css/vendor/normalize.css")
        .copy($bowerPath + "jquery/dist/jquery.min.js", "resources/assets/js/vendor/jquery.js")

        .copy($bowerPath + "bootstrap-css/css/bootstrap.min.css", "resources/assets/css/vendor/bootstrap.css")
        .copy($bowerPath + "bootstrap-css/js/bootstrap.min.js", "resources/assets/js/vendor/bootstrap.js")
        .copy($bowerPath + "bootstrap-css/fonts", "public/fonts")

        .copy($bowerPath + "font-awesome/css/font-awesome.min.css", "resources/assets/css/vendor/font-awesome.css")
        .copy($bowerPath + "font-awesome/fonts", "public/fonts")

        .copy($bowerPath + "jquery-colorbox/example4/colorbox.css", "resources/assets/css/vendor/colorbox.css")
        .copy($bowerPath + "jquery-colorbox/jquery.colorbox-min.js", "resources/assets/js/vendor/colorbox.js")

        .copy($bowerPath + "jquery-validation/dist/jquery.validate.min.js", "resources/assets/js/vendor/jquery-validation.js")

        .copy($bowerPath + "metisMenu/dist/metisMenu.min.css", "resources/assets/css/vendor/metisMenu.css")
        .copy($bowerPath + "metisMenu/dist/metisMenu.min.js", "resources/assets/js/vendor/metisMenu.js")

        .copy($bowerPath + "morris.js/morris.css", "resources/assets/css/vendor/morrisjs.css")
        .copy($bowerPath + "morris.js/morris.min.js", "resources/assets/js/vendor/morrisjs.js")

        .copy($bowerPath + "eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css", "resources/assets/css/vendor/datetimepicker.css")
        .copy($bowerPath + "moment/min/moment.min.js", "resources/assets/js/vendor/moment.js")
        .copy($bowerPath + "eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js", "resources/assets/js/vendor/datetimepicker.js")

        .copy($bowerPath + "footable/css/footable.core.min.css", "resources/assets/css/vendor/footable.css")
        .copy($bowerPath + "footable/dist/footable.min.js", "resources/assets/js/vendor/footable.js")
        .copy($bowerPath + "footable/css/fonts", "public/css/fonts")

        .copy($bowerPath + "raphael/raphael-min.js", "resources/assets/js/vendor/raphael.js")
        .copy($bowerPath + "notie/notie.js", "resources/assets/js/vendor/notie.js")

        .copy($bowerPath + "select2/dist/js/select2.min.js", "resources/assets/js/vendor/select2.js")
        .copy($bowerPath + "select2/dist/css/select2.min.css", "resources/assets/css/vendor/select2.css")

        //.copy($bowerPath + "ckeditor/adapters", "public/ckeditor/adapters")
        //.copy($bowerPath + "ckeditor/lang", "public/ckeditor/lang")
        //.copy($bowerPath + "ckeditor/plugins", "public/ckeditor/plugins")
        //.copy($bowerPath + "ckeditor/skins", "public/ckeditor/skins")
        //.copy($bowerPath + "ckeditor/ckeditor.js", "public/ckeditor/ckeditor.js")
        //.copy($bowerPath + "ckeditor/config.js", "public/ckeditor/config.js")
        //.copy($bowerPath + "ckeditor/contents.css", "public/ckeditor/contents.css")
        //.copy($bowerPath + "ckeditor/styles.js", "public/ckeditor/styles.js")
        //.copy("resources/assets/js/ckeditorCustom.js","public/ckeditor/ckeditorCustom.js")

        .styles([
            'vendor/normalize.css',
            'vendor/bootstrap.css',
            'vendor/font-awesome.css',
            'vendor/datetimepicker.css',
            'vendor/footable.css',
            'vendor/colorbox.css',
            'app.css'
        ], 'public/css/app.css')

        .styles([
            'vendor/normalize.css',
            'vendor/bootstrap.css',
            'vendor/font-awesome.css',
            'vendor/datetimepicker.css',
            'vendor/footable.css',
            'vendor/colorbox.css',
            'vendor/metisMenu.css',
            'vendor/morrisjs.css',
            'vendor/select2.css',
            'admin.css'
        ], 'public/css/admin.css')

        .scripts([
            'vendor/jquery.js',
            'vendor/bootstrap.js',
            'vendor/moment.js',
            'vendor/datetimepicker.js',
            'vendor/colorbox.js',
            'vendor/footable.js',
            'vendor/jquery-validation.js',
            'appNav.js'
        ], 'public/js/app.js')

        .scripts([
            'vendor/jquery.js',
            'vendor/bootstrap.js',
            'vendor/moment.js',
            'vendor/datetimepicker.js',
            'vendor/metisMenu.js',
            'vendor/colorbox.js',
            'vendor/morrisjs.js',
            'vendor/raphael.js',
            'vendor/footable.js',
            'vendor/jquery-validation.js',
            'vendor/notie.js',
            'vendor/select2.js',
            'adminScript.js'
        ], 'public/js/admin.js')
    ;
});
