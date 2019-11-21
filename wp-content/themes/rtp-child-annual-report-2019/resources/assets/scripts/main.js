// Import parent JS
import '../../../../rtp-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
import common from './routes/common';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
