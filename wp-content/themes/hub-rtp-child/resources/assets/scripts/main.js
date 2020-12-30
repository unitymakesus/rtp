// import external dependencies
import 'jquery';
import 'modaal';

// Import everything from autoload
import './autoload/*';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import templateMap from './routes/templateMap';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  home,
  templateMap,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
