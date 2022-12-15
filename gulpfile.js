var gulp = require('gulp');
var livereload = require('gulp-livereload');
var zip = require('gulp-zip');
var config = require('./build.config.json');
var del = require('del');
var googleTranslate = require('google-translate')(process.env.GOOGLE_API_KEY);

/**
 * task - 'default'
 * executes 'live-monitor'
 */
gulp.task('default', ['live-monitor']);

/**
 * task - 'laravel-views'
 * monitor laravel views
 */
gulp.task('laravel-views', function () {
    gulp.src('app/views/**/*.blade.php')
        .pipe(livereload());
});

/**
 * task - 'live-monitor'
 * monitors everything
 */
gulp.task('live-monitor', function () {
    livereload.listen();
    gulp.watch('app/views/**/*.blade.php', ['laravel-views']);
});

gulp.task('clean-temp', function () {
    return del(['app/storage/cache/**/*', 'app/storage/logs/laravel.log', 'app/storage/sessions/**/*', 'app/storage/views/**/*', 'app/storage/settings.json'])
})

gulp.task('prepare-envato', ['clean-temp'], function () {

    return gulp.src(config.vendor_files, {base: '.'})
        .pipe(zip('karakata.zip'))
        .pipe(gulp.dest('./'))
})


gulp.task('prepare-upload', ['prepare-envato'], function () {
    return gulp.src(['karakata.zip', 'documentation/**/*', 'important_readme_for_updates!!!.txt'], {base: '.'})
        .pipe(zip('karakata_envato.zip'))
        .pipe(gulp.dest('./'))
});