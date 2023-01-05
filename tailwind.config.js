module.exports = {
    content: ['./resources/**/*.{php,js}', './Functionality/**/*.php', './Components/**/*.php'],
    theme: {
      extend: {
        colors: {},
      },
    },
    plugins: [], //require("daisyui")
    important: true,
    prefix: 'pb-',
    corePlugins: {
      preflight: false,
    }
  };