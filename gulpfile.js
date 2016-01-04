'use strict';

var gulp       = require('gulp');
var fileExists = require('file-exists'); 
var del        = require('del');
var uglify     = require('gulp-uglify');
var sass       = require('gulp-sass');
//var concat = require('gulp-concat');
var notify = require("gulp-notify");
 
//var paths = {
    //scripts: ['client/js/**/*.coffee', '!client/external/**/*.coffee'],
    //images: 'client/img/**/*'
//};

var bower = './bower_components/';
var node  = './node_modules/';

var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed',//nested
    includePaths: [
        node + 'bootstrap-sass/assets/stylesheets',
        bower + 'font-awesome/scss'
    ]
};

gulp.task('copy-fonts', function() {
    gulp.src(bower + 'font-awesome/fonts/**/*')
    .pipe(gulp.dest('./public/fonts'));

    gulp.src(node + 'bootstrap-sass/assets/fonts/bootstrap/**/*')
    .pipe(gulp.dest('./public/fonts'));
});

gulp.task('copy-js', function() {
    gulp.src(node + 'bootstrap-sass/assets/javascripts/bootstrap.min.js')
    .pipe(gulp.dest('./public/js'));    

    gulp.src(bower + 'jquery/dist/jquery.min.js')
    .pipe(gulp.dest('./public/js'));

    gulp.src(bower + 'sweetalert/dist/sweetalert.min.js')
    .pipe(gulp.dest('./public/js'));
});

gulp.task('copy-css', function() {
    gulp.src(bower + 'sweetalert/dist/sweetalert.css')
    .pipe(gulp.dest('./public/css'));
});

gulp.task('sass', ['copy-fonts', 'copy-js', 'copy-css'], function () {
    return gulp.src('./resources/sass/style.scss')
        .pipe(sass(sassOptions))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('clean', function() {
    return del(['build']);
});

//gulp.task('default', ['clean', 'scripts', 'imagemin', 'copy']);

//if(!fileExists(langBR + '/validation.php')) {
    //mix.copy('vendor/caouecs/laravel4-lang/pt-BR', langBR);
//}
