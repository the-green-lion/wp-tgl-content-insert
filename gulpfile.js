const gulp = require('gulp');
const zip = require('gulp-zip');
var phplint = require('gulp-phplint');
const runSequence = require('run-sequence');

gulp.task('copyClient', () => {
    return gulp.src('../../TGL API/Tgl.Api.Client.Php/src/*.php')
    .pipe(gulp.dest('./tgl-content-insert/tglApiClient'));
});

gulp.task('phplint', function() {
  return gulp.src(['./tgl-content-insert/**/*.php'])
    .pipe(phplint(''))
    .pipe(phplint.reporter('fail'))
});

gulp.task('zip', () => {
    return gulp.src(['tgl-content-insert/**', '!**/*.ini'],
            {base: '.'})
        .pipe(zip('tgl-content-insert.zip'))
        .pipe(gulp.dest('dist'));
});

gulp.task('copyForSVN', () => {
    return gulp.src(['./tgl-content-insert/**', '!**/*.ini'])
    .pipe(gulp.dest('./wp-org-repository/trunk'));
});

gulp.task('copyForSVN2', () => {
    return gulp.src('./readme.txt')
    .pipe(gulp.dest('./wp-org-repository/trunk'));
});

gulp.task("default", function (callback) {
    runSequence("copyClient", "phplint", "zip", "copyForSVN", "copyForSVN2", callback);
});