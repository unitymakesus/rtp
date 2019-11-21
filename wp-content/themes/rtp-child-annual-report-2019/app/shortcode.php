<?php

namespace App;

/**
 * Add Shortcode for Directory Search
 */
add_shortcode('annual-report-boxyard', function($atts) {
  ob_start();
  ?>
  <section id="boxyard">
    <div class="map" style="background-image:url('/wp-content/themes/rtp-child-annual-report-2019/dist/images/boxyard-rtp-map_c8a63222.png');"></div>
    <div class="boxes">
      <div class="box box-1">
        <img src="https://placehold.it/300/" alt="" />
      </div>
      <div class="box box-2">
        <img src="/wp-content/themes/rtp-child-annual-report-2019/dist/images/logos/logo-uncorked@2x_6995ab4b.png" alt="" />
      </div>
      <div class="box box-3"></div>
      <div class="box box-4">
        <img src="/wp-content/themes/rtp-child-annual-report-2019/dist/images/logos/logo-fullsteam@2x_7a1328d0.png" alt="" />
      </div>
      <div class="box box-5"></div>
      <div class="box box-6">
        <img src="/wp-content/themes/rtp-child-annual-report-2019/dist/images/logos/logo-medicinemama@2x_7695bcd6.png" alt="" />
      </div>
      <div class="box box-7"></div>
      <div class="box box-8">
        <img src="/wp-content/themes/rtp-child-annual-report-2019/dist/images/logos/logo-pressedpoured@2x_91b9dfb2.png" alt="" />
      </div>
      <div class="box box-9">
        <img src="https://placehold.it/300/" alt="" />
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
});
