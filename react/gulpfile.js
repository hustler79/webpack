var path = require("path"),
    gulp = require('gulp'),
    webpack = require('webpack-stream'),
    sass = require('gulp-sass'),
    config = require('./webpack.config'),
    libs = require("./webpack/libs")
;


gulp.task("scss", function () {

    var cnf = {};

    if (libs.envlog() === 'prod') {
      cnf = {
            errLogToConsole: true,
            outputStyle: 'compressed',
            // sourceMapEmbed: true,
            // sourceComments: true
            // functions: sassFunctions()
        }
    }

    return gulp.src("src/scss/pageA.scss")
        .pipe(sass(cnf))
        .pipe(gulp.dest(path.join(config.output.path, "scss")))
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

