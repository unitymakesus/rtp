// Import parent JS
import '../../../../rtp-core/dist/scripts/main.js';

/** Import local dependencies */
import Router from './util/Router';
// import common from './routes/common';
import home from './routes/home';
import directoryMap from './routes/directory';
import singleRtpFacility from './routes/directory';
import templateAnnualReport2019 from './routes/templateAnnualReport2019';
// import aboutUs from './routes/about';
// import archive from './routes/archive';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // common,
  home,
  directoryMap,
  singleRtpFacility,
  templateAnnualReport2019,
  // aboutUs,
  // archive,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
