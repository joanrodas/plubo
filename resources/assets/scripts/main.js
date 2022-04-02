// import external dependencies

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';

import audio from './shortcodes/audio';

const routes = {
  common, // All pages
  home, // Home page
};

const shortcodes = {
  audio, // Audio shortcode
};

/** Populate Router instance with DOM routes */
const router = new Router(routes, shortcodes);

// Load Events
jQuery(document).ready(() => router.loadEvents());
