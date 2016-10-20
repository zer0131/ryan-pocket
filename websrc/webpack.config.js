var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    entry: {
        index: './src/index.js'
        //login: './src/login.js'
    },
    output: {
        filename: '[name].min.js',
        //chunkFilename: '[name].chunk.js',
        path: '../app/public/dist',
        publicPath: '/dist/'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader'
                // query: {
                //     presets: ['es2015', 'stage-0', 'react'],
                //     'plugins': [
                //         ['antd', {
                //             style: 'css'
                //         }]
                //     ]
                // }
            },
            {
                test: /\.css$/,
                // loader: "style!css"
                loader: ExtractTextPlugin.extract("style-loader", "css-loader")
            }
        ]
    },
    plugins: [
        // 第三方库打包生成的文件
        //new webpack.optimize.CommonsChunkPlugin('vendors', 'vendor.js'),
        // 压缩
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        // production方式打包
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify('production')
            }
        }),
        // 分离css
        new ExtractTextPlugin("[name].min.css"),
        new webpack.optimize.OccurenceOrderPlugin()
    ]
};