'use strict';

var gulp    = require('gulp');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var uglify  = require('gulp-uglify');

var dir = {
    assets: './src/ONGR/DemoBundle/Resources/public/',
    dist: './web/',
    bower: './bower_components/',
    bootstrapJS: './bower_components/bootstrap-sass/assets/javascripts/bootstrap/'
};

gulp.task('sass', function() {
    gulp.src(dir.assets + 'style/**/*.scss')
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(gulp.dest(dir.dist + 'css'));
});

gulp.task('scripts', function() {
    gulp.src([
            dir.bower + 'jquery/dist/jquery.min.js',
            // Bootstrap JS modules
            dir.bootstrapJS + 'transition.js',
            dir.bootstrapJS + 'carousel.js',
            dir.bootstrapJS + 'dropdown.js',
            dir.bootstrapJS + 'tab.js',
            // Main JS file
            dir.assets + 'scripts/main.js'
        ])
        .pipe(concat('ongr.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('images', function() {
    gulp.src([
            dir.assets + 'images/**'
        ])
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function() {
    gulp.src(dir.bower + 'bootstrap-sass/assets/fonts/**')
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('default', ['sass', 'scripts', 'fonts', 'images']);
