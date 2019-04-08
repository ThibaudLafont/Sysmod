// Requis
const gulp = require('gulp');
const concatCss = require('gulp-concat-css');
const autoprefixer = require('gulp-autoprefixer');
const minify = require('gulp-minify');
const cleancss = require('gulp-clean-css');
const rename = require('gulp-rename');

// CSS concat and prefix
gulp.task('concat-prefix-css', function () {
  return gulp.src(['css/main.css', 'css/900px.css', 'css/500px.css'])
    .pipe(autoprefixer({browsers: ['last 99 versions']}))
    .pipe(minify())
    .pipe(concatCss("style.css"))
    .pipe(gulp.dest('../dist/'));
});

// CSS minify
gulp.task('minify-css', function () {
  return gulp.src(['../dist/style.css'])
    .pipe(cleancss())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('../dist/'));
});

// JS minify
gulp.task('minify-js', function () {
  return gulp.src('js/script.js')
    .pipe(minify())
    .pipe(gulp.dest('../dist/'));
});
