import Router from './utils/Router';
import common from './routes/common';
import home from './routes/home';
import audio from './shortcodes/audio';

const routes = {
  common, // All pages
  home, // Home page
  audio, // Audio shortcode
};

// Load Events
window.addEventListener('DOMContentLoaded', () => new Router(routes).loadEvents());
