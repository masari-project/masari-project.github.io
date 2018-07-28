/* Created by Sergey on 15.05.2017.*/

/*===========GULP==============*/


var gulp = require('gulp'),
     sass = require('gulp-sass'),
     plumber = require('gulp-plumber'),
     browserSync = require('browser-sync'),
     imagemin = require('gulp-imagemin'),
     autoprefixer = require('gulp-autoprefixer'),
     runSequence = require('run-sequence'),
     cache = require('gulp-cache');


/*===========Compile SCSS==============*/


gulp.task('sass', function() {

    gulp.src('sass/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('css'))
        .pipe(plumber())
        .pipe(sass({errLogToConsole: true}))
        .pipe(browserSync.reload({
            stream: true
        }));
});


/*/!*===========Watch==============*!/*/


gulp.task('watch', ['browserSync', 'sass'], function (){

    gulp.watch('sass/**/*.scss', ['sass']);
    gulp.watch('*.html', browserSync.reload);
    gulp.watch('js/**/*.js', browserSync.reload);
    // others
});


/*/!*===========ON-Line synchronization from browsers==============*!/*/


gulp.task('browserSync', function() {
    browserSync({
        server: {
            baseDir: 'Utouch WP'
        }
    })
});


/*/!*===========Minimization IMAGE==============*!/*/


gulp.task('images', function(){
    return gulp.src('img/**/*.+(png|jpg|jpeg|gif|svg)')
        .pipe(cache(imagemin({
            interlaced: true
        })))
        .pipe(gulp.dest('img'))
});


/*/!*=============Auto-prefixer==============*!/*/


// Autoprefixer Task
gulp.task('autoprefixer', function(){

    gulp.src("css/*.css")
        .pipe(autoprefixer({
            browsers: ['last 12 versions'],
            cascade: false
        }))
        .pipe(gulp.dest("css"))
});

/*/!*=============Join tasks==============*!/*/


gulp.task('default', function(callback) {
    runSequence(['sass', 'browserSync', 'watch', 'autoprefixer'],
        callback
    )
});
