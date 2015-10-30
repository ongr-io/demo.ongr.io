'use strict';

var gulp    = require('gulp');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var uglify  = require('gulp-uglify');

var dir = {
    assets: './src/ONGR/DemoBundle/Resources/public/',
    dist: './src/ONGR/DemoBundle/Resources/public/dist/',
    bower: './bower_components/'
};

gulp.task('sass', function() {
    gulp.src(dir.assets + 'style/**/*.scss')
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(gulp.dest(dir.dist));
});

gulp.task('scripts', function() {
    gulp.src([
        dir.bower + 'jquery/dist/jquery.min.js',
        dir.bower + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
        dir.assets + 'scripts/main.js'
    ])
        .pipe(concat('ongr.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dir.dist));
});

gulp.task('fonts', function() {
    gulp.src(dir.bower + 'bootstrap-sass/assets/fonts/**')
        .pipe(gulp.dest('./web/fonts'));
});

gulp.task('default', ['sass', 'scripts', 'fonts']);
