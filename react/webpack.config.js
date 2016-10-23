const path      = require("path");
const webpack   = require('webpack');
const glob      = require("glob");
const libs      = require("./webpack/libs");

var CommonsChunkPlugin = require("./node_modules/webpack/lib/optimize/CommonsChunkPlugin");
// var ExtractTextPlugin = require("extract-text-webpack-plugin");

var env = libs.envlog();
console.log(env);

module.exports = {
    entry: libs.entry(),
    // entry: {
    //     pageA: path.join(__dirname, ".", "src", "pageA.entry.js"),
    //     pageB: path.join(__dirname, ".", "src", "pageB.entry.jsx")
    // },
    output: {
        path: path.join(__dirname, "..", "web", "dist"),
        filename: "[name].bundle.js",
        publicPath: "/publicPath/"
        // chunkFilename: "[id].chunk.js",
        // sourceMapFilename: "[file].map"
    },
    plugins: [
        new CommonsChunkPlugin({
            filename: "commons.bundle.js",
            name: "commons.bundle",
            minChunks: 2
        }),
        // new webpack.SourceMapDevToolPlugin({
        //     filename: '[file].map',
        //     // exclude: ['vendors.js']
        // }),
    ].concat( (env === 'prod') ? [
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false,
            },
            output: {
                comments: false,
            },
        }),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        })
    ] : []),
    resolve: {
        extensions: ['', '.js', '.jsx'],
        root: [
            path.resolve('../web/bundles'),
        ],
        alias: {
            'log': path.join(__dirname, 'webpack', 'log'),
            // 'mixins': __dirname + '/src/mixins',
            // 'components': __dirname + '/src/components/',
            // 'stores': __dirname + '/src/stores/',
            // 'actions': __dirname + '/src/actions/'
        }
    },
    cache: true,
    // debug: true,
    stats: {
        colors: true,
        reasons: true
    },
    module: {
        loaders: [
            {
                test: /\.css$/,
                loader: "style!css"
            },
            {
                test: /\.scss$/,
                loader: "style!css?sourceMap!sass?errLogToConsole=true&outputStyle=compressed&sourceMap"
            },
            {
                test: /\.jsx$/,
                loader: 'babel',
                query: {
                    presets: ['es2015']
                },
                // include: [
                //     path.join(__dirname, '..'),
                //     // __dirname
                // ],
                exclude: [
                    path.join(__dirname, 'node_modules'),
                    // path.join(__dirname, 'js')
                ]
            },
            {
                test: /\.json$/,
                loader: "json"
            }
        ]
    },

        // http://cheng.logdown.com/posts/2016/03/25/679045
        // https://webpack.github.io/docs/configuration.html#devtool

        // off - [aby użyć tego trzeba zakomentować całą sekcję new webpack.SourceMapDevToolPlugin({ ]
    devtool: (env === 'dev') ? false : 'source-map', // full source map (podobno wolne)
    // devtool: "cheap-source-map", // nieczytelne

        // on - [te używamy z włączoną sekcją new webpack.SourceMapDevToolPlugin({ ]
    // devtool: "cheap-module-source-map", // for prod
    // devtool: "cheap-module-eval-source-map", // for dev - nieczytelne
    // devtool: "cheap-module-source-map", // for dev - nie widać kodu w ogóle w zakładce debug w ff
}