var path = require("path"),
    gulp = require('gulp'),
    webpack = require('webpack-stream'), // https://github.com/shama/webpack-stream
    sass = require('gulp-sass'),
    config = require('./webpack.config'),
    utils = require("./webpack/utils"),
    sourcemaps = require('gulp-sourcemaps')
;

var env = utils.setup(path.resolve('./config.js'));

gulp.task("scss", function () {

    var cnf = {
        outputStyle: 'compressed'
    };

    if (utils.env() === 'prod') {
        cnf.errLogToConsole = true;
        // sourceMapEmbed: true,
        // sourceComments: true
        // functions: sassFunctions()
    }

    return gulp.src([
        "src/scss/**/*.scss"
    ])
        .pipe(sourcemaps.init())
        .pipe(sass(cnf).on('error', sass.logError))
        .pipe(sourcemaps.write('.', { // https://github.com/floridoo/gulp-sourcemaps#write-options
            addComment: true,
            debug: true,
            identityMap: true,
        }))
        .pipe(gulp.dest(utils.con('outputcss')))
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
    gulp.watch(['../web/bundles/**/*{js,jsx,css,scss}'], ['default']);

    gulp.watch(['src/**/*{js,jsx,css,scss}'], ['default']);
    gulp.watch(['src/**/*{css,scss}'], ['scss']);
});

