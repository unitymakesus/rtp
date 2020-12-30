// import external dependencies
import 'jquery';
import 'modaal';
import 'custom-event-polyfill';

// Import everything from autoload
import './autoload/*';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import templateVendors from './routes/templateVendors';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  home,
  templateVendors,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
