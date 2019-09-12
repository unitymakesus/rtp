// Import parent JS
import '../../../../rtp-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
// import common from './routes/common';
import home from './routes/home';
import companyDirectory from './routes/directory';
// import aboutUs from './routes/about';
// import archive from './routes/archive';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // common,
  home,
  companyDirectory,
  // aboutUs,
  // archive,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
