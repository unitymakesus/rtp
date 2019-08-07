// import external dependencies
import 'jquery';

// Core Materialize JS
// import 'materialize-css/js/cash.js';
// import './materializejs/component.js';
// import 'materialize-css/js/global.js';
// import 'materialize-css/js/anime.min.js';

// import 'materialize-css/js/cash.js';
// import 'materialize-css/js/component.js';
// import 'materialize-css/js/global.js';
// import 'materialize-css/js/anime.min.js';
// import 'materialize-css/js/collapsible.js';
// import 'materialize-css/js/dropdown.js';
// import 'materialize-css/js/modal.js';
// import 'materialize-css/js/materialbox.js';
// import 'materialize-css/js/parallax.js';
// import 'materialize-css/js/tabs.js';
// import 'materialize-css/js/tooltip.js';
// import 'materialize-css/js/waves.js';
// import 'materialize-css/js/toasts.js';
// import 'materialize-css/js/sidenav.js';
// import 'materialize-css/js/scrollspy.js';
// import 'materialize-css/js/autocomplete.js';
// import 'materialize-css/js/forms.js';
// import 'materialize-css/js/slider.js';
// import 'materialize-css/js/cards.js';
// import 'materialize-css/js/chips.js';
// import 'materialize-css/js/pushpin.js';
// import 'materialize-css/js/buttons.js';
// import 'materialize-css/js/datepicker.js';
// import 'materialize-css/js/timepicker.js';
// import 'materialize-css/js/characterCounter.js';
// import 'materialize-css/js/carousel.js';
// import 'materialize-css/js/tapTarget.js';
// import 'materialize-css/js/select.js';
// import 'materialize-css/js/range.js';

// Materialize form interactions
// import 'materialize-css/js/forms.js';
import './materializejs/core.js';
// import 'materialize-css/js/dropdown.js';
// import './materializejs/select.js';

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
