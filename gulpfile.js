var gulp = require('gulp');
var livereload = require('gulp-livereload');
var zip = require('gulp-zip');
var config = require('./build.config.json');

/**
 * task - 'default'
 * executes 'live-monitor'
 */
gulp.task('default', ['live-monitor']);

/**
 * task - 'laravel-views'
 * monitor laravel views
 */
gulp.task('laravel-views', function() {
    gulp.src('app/views/**/*.blade.php')
        .pipe(livereload());
});

/**
 * task - 'live-monitor'
 * monitors everything
 */
gulp.task('live-monitor', function() {
    livereload.listen();
    gulp.watch('app/views/**/*.blade.php', ['laravel-views']);
});

gulp.task('prepare-envato', function(){

    return gulp.src(config.vendor_files)
        .pipe(zip('karakata.zip'))
        .pipe(gulp.dest('./'))
})