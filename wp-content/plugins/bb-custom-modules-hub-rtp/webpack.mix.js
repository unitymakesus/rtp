const mix = require('laravel-mix');

/**
 * Asset directory paths.
 */
const src = 'assets/src';
const dist = 'assets/dist';

/**
 * Options and other Laravel Mix configs.
 */
mix.options({
  autoprefixer: {
    options: {
      browsers: ['last 2 versions'],
    },
  },
  terser: {
    extractComments: false,
  },
  processCssUrls: false,
}).setPublicPath(`${dist}`);

/**
 * CSS.
 */
mix.sass(`${src}/styles/hub-rtp-blog-feed.scss`, `${dist}/styles`, {
  implementation: require('node-sass'),
});
mix.sass(`${src}/styles/hub-rtp-carousel.scss`, `${dist}/styles`, {
  implementation: require('node-sass'),
});
mix.sass(`${src}/styles/hub-rtp-contact-card.scss`, `${dist}/styles`, {
  implementation: require('node-sass'),
});
mix.sass(`${src}/styles/hub-rtp-figure-card.scss`, `${dist}/styles`, {
  implementation: require('node-sass'),
});
mix.sass(`${src}/styles/hub-rtp-lifestyle-cards.scss`, `${dist}/styles`, {
  implementation: require('node-sass'),
});

/**
 * JS.
 */
mix.js(`${src}/scripts/hub-rtp-carousel.js`, `${dist}/scripts`);
mix.js(`${src}/scripts/hub-rtp-lifestyle-cards.js`, `${dist}/scripts`);

/**
 * Images.
 */
mix.copy(`${src}/images`, `${dist}/images`);

/**
 * Externally-loaded libraries.
 */
mix.webpackConfig({
  externals: {
    'jquery': 'jQuery',
  }
});

/**
 * Production build.
 */
if (mix.inProduction()) {
  mix.version();
}
