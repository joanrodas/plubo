// import external dependencies

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common, // All pages
  home, // Home page
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
