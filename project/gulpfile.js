var path = require('path');
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cssmin = require('gulp-cssmin');
var jsmin = require('gulp-jsmin');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function () {
    return gulp.src(['public/assets/src/sass/app.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('/'))
        .pipe(gulp.dest('public/assets/dist/css'));
});

gulp.task('css-min', ['sass'], function () {
    return gulp.src(['public/assets/dist/css/**/*.css', '!public/assets/dist/css/**/*.min.css'])
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/dist/css'));
});

gulp.task('js-concat', function () {
    return gulp.src(['public/assets/src/js/**/*.js'])
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(sourcemaps.write('/'))
        .pipe(gulp.dest('public/assets/dist/js'));
});

gulp.task('js-min', ['js-concat'], function () {
    return gulp.src(['public/assets/dist/js/**/*.js', '!public/assets/dist/js/**/*.min.js'])
        .pipe(jsmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/dist/js'));
});

gulp.task('sass-watch', ['sass', 'css-min'], function () {
    gulp.watch(['public/assets/src/sass/**/*.scss'], ['sass', 'css-min']);
});

gulp.task('js-watch', ['js-concat', 'js-min'], function () {
    gulp.watch(['public/assets/src/js/**/*.js'], ['js-concat', 'js-min']);
});

gulp.task('default', ['sass', 'css-min', 'js-concat', 'js-min']);
