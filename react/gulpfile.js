var path = require("path"),
    gulp = require('gulp'),
    webpack = require('webpack-stream'),
    sass = require('gulp-sass'),
    config = require('./webpack.config'),
    libs = require("./webpack/libs"),
    sourcemaps = require('gulp-sourcemaps')
;


gulp.task("scss", function () {

    var cnf = {
        outputStyle: 'compressed'
    };

    if (libs.envlog() === 'prod') {
        cnf.errLogToConsole = true;
        // sourceMapEmbed: true,
        // sourceComments: true
        // functions: sassFunctions()
    }

    var target = path.join(config.output.path, "scss");

    return gulp.src(["src/scss/pageA.scss"])
    // return gulp.src("src/scss/pageA.scss")
        .pipe(sourcemaps.init())
        .pipe(sass(cnf).on('error', sass.logError))
        .pipe(sourcemaps.write('.', { // https://github.com/floridoo/gulp-sourcemaps#write-options
            addComment: true,
            debug: true,
            identityMap: true,
        }))
        .pipe(gulp.dest(target))
    ;
});

gulp.task('default', function() {
    return gulp.src('')
        .pipe(webpack(config))
        .pipe(gulp.dest(config.output.path))
    ;
});

gulp.task('prod', ['scss', 'default']);

gulp.task('watch', ['default', 'scss'], function () {
    gulp.watch(['src/**/*{js,jsx,css,scss}'], ['default']);
    gulp.watch(['src/**/*{css,scss}'], ['scss']);
});

