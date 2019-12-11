<?php

namespace App;

/**
 * Add Shortcode for Directory Search
 */
add_shortcode('annual-report-boxyard', function($atts) {
  ob_start();
  ?>
  <section id="boxyard">
    <div class="map" style="background-image:url('<?= asset_path('images/boxyard-rtp-map.png'); ?>');"></div>
    <div class="boxes">
      <div class="box box-1" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-gameon.png'); ?>" alt="Game On Escapes & More" />
      </div>
      <div class="box box-2" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-uncorked.png'); ?>" alt="RTP Uncorked" />
      </div>
      <div class="box box-3"></div>
      <div class="box box-4" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-fullsteam.png'); ?>" alt="Fullsteam Brewery" />
      </div>
      <div class="box box-5"></div>
      <div class="box box-6" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-medicinemamas.png'); ?>" alt="Medicine Mamas" />
      </div>
      <div class="box box-7"></div>
      <div class="box box-8" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-pouredpressed.png'); ?>" alt="Poured & Pressed" />
      </div>
      <div class="box box-9" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-comingsoon.png'); ?>" alt="Coming Soon" />
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
});
