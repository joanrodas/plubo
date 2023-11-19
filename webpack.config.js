const path = require('path');
const defaults = require('@wordpress/scripts/config/webpack.config.js');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const postcssPresetEnv = require('postcss-preset-env');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const Copy = require('copy-webpack-plugin');


module.exports = {
	entry: {
		app: [
			path.resolve(process.cwd(), 'resources/scripts', 'app.ts'),
			path.resolve(process.cwd(), 'resources/styles', 'app.scss')
		]
	},
	output: {
		filename: 'scripts/[name]-[contenthash].js',
		path: path.resolve(process.cwd(), 'dist'),
	},
	module: {
		rules: [
			{
				test: /\.tsx?$/,
				use: [
					{
						loader: 'ts-loader',
						options: {
							configFile: 'tsconfig.json',
							transpileOnly: true,
						}
					}
				]
			},
			{
				test: /\.(sa|sc|c)ss$/,
				use: [
					MiniCSSExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							url: false,
							sourceMap: true,
							importLoaders: 2
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: true,
							postcssOptions: {
								plugins: () => [
									postcssPresetEnv({ browsers: 'last 2 versions' })
								]
							}
						}
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
							sassOptions: {
								outputStyle: 'compressed'
							}
						}
					}
				]
			},
			{
				test: /\.(png|jpg|gif)$/i,
				type: 'asset/resource',
				use: [
					{
						loader: 'url-loader',
						options: {
							limit: 8192,
						}
					},
				]
			},
		]
	},
	resolve: {
		extensions: ['.ts', '.tsx', ...(defaults.resolve ? defaults.resolve.extensions || ['.js', '.jsx'] : [])]
	},
	plugins: [
		new MiniCSSExtractPlugin({
			filename: 'styles/[name]-[contenthash].css'
		}),
		new WebpackManifestPlugin({ publicPath: '' }),
		new CleanWebpackPlugin(),
		new Copy({
			patterns: [
				{
					from: "**/*",
					context: path.resolve(__dirname, "resources", "images"),
					to: '[path][name]-[contenthash][ext]',
					globOptions: {
						dot: true,
						ignore: ['**/.gitkeep'],
					},
					noErrorOnMissing: true,
				},
			]
		}),
	]
};