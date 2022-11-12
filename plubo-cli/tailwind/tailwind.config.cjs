module.exports = {
	content: ['./resources/**/*.{php,vue,js}', './Functionality/**/*.php', './Components/**/*.php'],
	theme: {
		extend: {
			colors: {},
		},
	},
	plugins: [],
	prefix: 'pb-',
	corePlugins: {
		preflight: false,
	}
};