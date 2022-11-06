import Router from './utils/Router';
import common from './routes/common';
import home from './routes/home';

const routes = {
  common, // All pages
  home, // Home page
};

// Load Events
window.addEventListener('DOMContentLoaded', () => new Router(routes).loadEvents());
