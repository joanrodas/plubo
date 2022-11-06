module.exports = {
  content: ['./resources/**/*.{php,vue,js}', './General/**/*.php', './Admin/**/*.php'],
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
