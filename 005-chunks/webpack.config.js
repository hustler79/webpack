var path = require("path");
const webpack = require('webpack');

var CommonsChunkPlugin = require("./node_modules/webpack/lib/optimize/CommonsChunkPlugin");

module.exports = {
    entry: {
        pageA: path.join(__dirname, ".", "src", "pageA"),
        pageB: path.join(__dirname, ".", "src", "pageB.jsx")
    },
    output: {
        path: path.join(__dirname, "dist"),
        filename: "[name].bundle.js",
        chunkFilename: "[id].chunk.js",
        // sourceMapFilename: "[file].map"
    },
    plugins: [
        new CommonsChunkPlugin({
            filename: "commons.js",
            name: "commons",
            minChunks: 2
        }),
        // new webpack.SourceMapDevToolPlugin({
        //     filename: '[file].map',
        //     // exclude: ['vendors.js']
        // }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false,
            },
            output: {
                comments: false,
            },
        }),
    ],
    resolve: {
        extensions: ['', '.js', '.jsx'],
        alias: {
            // 'styles': __dirname + '/src/styles',
            // 'mixins': __dirname + '/src/mixins',
            // 'components': __dirname + '/src/components/',
            // 'stores': __dirname + '/src/stores/',
            // 'actions': __dirname + '/src/actions/'
        }
    },
    cache: true,
    debug: true,
    stats: {
        colors: true,
        reasons: true
    },
    module: {
        loaders: [
            // { test: /\.css$/, loader: "style!css" }
            { test: /\.css$/, loader: "style!css" },
            { test: /\.scss$/, loader: "style!css!sass" },
            {
                test: /\.jsx$/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015']
                },
                include: [
                    path.join(__dirname, '..'),
                    __dirname
                ],
                exclude: [
                    path.join(__dirname, 'node_modules'),
                    path.join(__dirname, 'js')
                ]
            },



            { test: /\.json$/, loader: "json-loader" }
        ]
    },

        // http://cheng.logdown.com/posts/2016/03/25/679045
        // https://webpack.github.io/docs/configuration.html#devtool

        // off - [aby użyć tego trzeba zakomentować całą sekcję new webpack.SourceMapDevToolPlugin({ ]
    devtool: 'source-map', // full source map (podobno wolne)
    // devtool: "cheap-source-map", // nieczytelne

        // on - [te używamy z włączoną sekcją new webpack.SourceMapDevToolPlugin({ ]
    // devtool: "cheap-module-source-map", // for prod
    // devtool: "cheap-module-eval-source-map", // for dev - nieczytelne
    // devtool: "cheap-module-source-map", // for dev - nie widać kodu w ogóle w zakładce debug w ff
}