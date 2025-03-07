const path = require('path');
const defaults = require('@wordpress/scripts/config/webpack.config.js');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const postcssPresetEnv = require('postcss-preset-env');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const Copy = require('copy-webpack-plugin');
const fs = require('fs');
const glob = require('glob');

function convertFilePathToRoute(filePath) {
	return filePath.replace('Routes/', '').replace('.blade.php', '').replace('.php', '');
}

function generateRoutesConfig() {
	console.log("Generating routes...");

	const routeBladeFiles = glob.sync('Routes/**/*.php');
	const routeConfigs = [];

	const distDir = path.resolve(process.cwd(), 'dist');
	if (!fs.existsSync(distDir)) {
		fs.mkdirSync(distDir, { recursive: true });
		console.log(`Created dist directory: ${distDir}`);
	}

	// Process each Blade template and extract JSON inside Blade comments
	routeBladeFiles.forEach((file) => {
		const routeContent = fs.readFileSync(file, 'utf8');
		console.log(`Processing file: ${file}`);

		// Use a regex to extract the JSON-like content inside the Blade comment
		//const routeConfigMatch = routeContent.match(/{{--\s*(\{.*?\})\s*--}}/s);
		const routeConfigMatch = routeContent.match(/@configRoute\s*\(\s*(\{[\s\S]*?\})\s*\)/s);

		if (routeConfigMatch) {
			// Parse the JSON-like structure from the Blade comment
			try {
				const configJson = JSON.parse(routeConfigMatch[1]);
				configJson.path = file;
				configJson.route = convertFilePathToRoute(file);
				routeConfigs.push(configJson);
				console.log(`Added route from ${file}: ${JSON.stringify(configJson)}`);
			} catch (error) {
				console.error(`Failed to parse route config in ${file}: ${error}`);
			}
		}
		else {
			const configJson = {
				route: convertFilePathToRoute(file),
				path: file
			};
			routeConfigs.push(configJson)
			console.log(`Added route from ${file}: ${JSON.stringify(configJson)}`);
		}
	});

	// Save the route configurations to a JSON file for use in PHP
	const outputFile = path.resolve(distDir, 'routes.json');
	fs.writeFileSync(outputFile, JSON.stringify(routeConfigs, null, 4));
	console.log(`Saved routes to ${outputFile}`);

	if (fs.existsSync(outputFile)) {
		console.log(`routes.json exists at: ${outputFile}`);
	} else {
		console.error('Failed to create routes.json!');
	}
}

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
		new CleanWebpackPlugin({ cleanOnceBeforeBuildPatterns: ['**/*', '!routes.json'] }),
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
		{
			apply: (compiler) => {
				compiler.hooks.beforeCompile.tapAsync('GenerateRoutesConfigPlugin', (params, callback) => {
					generateRoutesConfig();
					callback();
				});
			}
		}
	]
};