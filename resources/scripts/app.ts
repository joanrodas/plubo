import Router from './utils/Router';
import common from './routes/common';

const routes = {
  common, // All pages
};

// Load Events
window.addEventListener('DOMContentLoaded', () => new Router(routes).loadEvents());