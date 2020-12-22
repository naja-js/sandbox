const path = require('path');
const webpack = require('webpack');
const {WebpackManifestPlugin} = require('webpack-manifest-plugin');

const isProduction = process.env.NODE_ENV === 'production';
module.exports = {
	mode: process.env.NODE_ENV || 'development',
	devtool: isProduction ? 'hidden-source-map' : 'inline-source-map',
	entry: {
		main: path.join(__dirname, 'src/ui/index.js'),
	},
	output: {
		filename: `js/${isProduction ? '[name].[chunkhash].js' : '[name].js'}`,
		path: path.resolve(__dirname, 'public/dist'),
		publicPath: isProduction ? 'dist/' : '',
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: 'babel-loader',
			},
		],
	},
	plugins: [
		new WebpackManifestPlugin(),
		new webpack.EnvironmentPlugin('NODE_ENV'),
	],
	devServer: {
		port: 3500,
		contentBase: path.resolve(__dirname, 'public/dist'),
		hot: true,
		headers: {
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Credentials': 'true',
			'Access-Control-Allow-Headers': 'Content-Type, Authorization, x-id, Content-Length, X-Requested-With',
			'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
		},
	},
};
