const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: () => {
		const defaultEntries =
			typeof defaultConfig.entry === 'function'
				? defaultConfig.entry()
				: defaultConfig.entry;

		return {
			...defaultEntries,
			app: [
				path.resolve(__dirname, 'src/scripts/app.ts'),
				path.resolve(__dirname, 'src/styles/app.scss'),
			],
		};
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'dist'),
	},
	resolve: {
		...defaultConfig.resolve,
		alias: {
			...(defaultConfig.resolve?.alias || {}),
			'@': path.resolve(__dirname, 'src'),
		},
	},
};
