const webpack = require('webpack');
const path = require("path");

module.exports = {
    entry: path.join(__dirname, 'src', 'app.jsx'),
    output: {
        path: path.join(__dirname, 'bin'),
        filename: 'app.bundle.js',
    },
    module: {
        loaders: [
            { test: /\.css$/, exclude: /node_modules/, loader: "style!css" },
            { test: /\.jsx$/, exclude: /node_modules/, loader: 'babel-loader' }
        ]
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: 'eval-source-map',
            compress: {
                warnings: false,
            },
            output: {
                comments: false,
            },
        }),
    ]
}