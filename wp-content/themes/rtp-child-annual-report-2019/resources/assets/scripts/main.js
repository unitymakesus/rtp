// Import parent JS
import '../../../../rtp-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import templateAnnualReport from './routes/templateAnnualReport';

/** Populate Router instance with DOM routes */
const routes = new Router({
  common,
  templateAnnualReport,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
