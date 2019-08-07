// import external dependencies
import 'jquery';
import 'materialize-css';

// Core Materialize JS
// import 'materialize-css/js/cash.js';
// import 'materialize-css/js/component.js';
// import 'materialize-css/js/global.js';
// import 'materialize-css/js/anime.min.js';
//
// // Materialize form interactions
// import 'materialize-css/js/forms.js';
// import 'materialize-css/js/select.js';

// Import everything from autoload
import './autoload/*';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import archive from './routes/archive';
import calendar from './routes/calendar';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  archive,
  calendar,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
