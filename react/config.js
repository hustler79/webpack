const path      = require("path");

module.exports = {
    resolveroot: [ // where to search by require
        path.resolve('../public_html/bundles'),
        path.resolve('../web/bundles'),
        path.resolve('src')
    ],
    entrydir: path.resolve('./src'), // looks for *.entry.js
    outputjs: path.join(__dirname, "..", "web", "js"),
    outputcss: path.join(__dirname, "..", "web", "css"),
    alias: {
        'log': path.join(__dirname, 'webpack', 'log'),
    },
    provide: {
        log: 'log'
    }
}