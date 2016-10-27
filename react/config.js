const path      = require("path");

module.exports = {
    resolveroot: [ // where to search by require
        path.resolve('src'),
        path.resolve('../public_html/bundles')
    ],
    alias: {
        // 'log': path.join(__dirname, 'webpack', 'log'),
        'log': path.resolve('./webpack/log'),
    },
    provide: {
        log: 'log'
    },

    entryjs: [ // looks for *.entry.{js|jsx} - watch only on files *.entry.{js|jsx}
        path.resolve('./src'),
        // ...
    ],
    outputjs: path.resolve("../public_html/js"),

    // only this scss files will be transformed to css
    entryscss: [
        path.resolve('./src/scss/**/*.scss')
        // ...
    ],
    outputcss: path.resolve("../public_html/css"),
}