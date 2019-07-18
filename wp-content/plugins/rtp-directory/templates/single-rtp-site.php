<?php
/**
 * Single Site Page
 *
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

  $location_photo = get_the_post_thumbnail_url();

  // Location
  $coords = get_field('coordinates');
  $road_access = get_field('road_access');

  // Details
  $acres = get_field('size_acres');
  $usable = get_field('size_usable_acres');
  $coverage = get_field('size_lot_coverage_sqft');
  // $subdividable = get_field('subdividable');  // Bool
  $zoning = get_field('zoning');
  $water_sewer = get_field('utilities_water_sewer');
  $electricity = get_field('utilities_electricity');
  $gas = get_field('utilities_gas');
  $details_pdf = get_field('details_pdf');

  // Get In Touch
  $contact_ppl = get_field('contact_person'); // Array

  ?>
  <div class="content-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <h1><?php the_title(); ?></h1>
            <?php if (!empty($location_terms)) : ?>
              <div class="location-meta">
                <?php foreach ($location_terms as $lt) : ?>
                <div class="meta-term"><?php echo $lt->name; ?></div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-4">
          <div class="box">
            <?php if (!empty($details_pdf)) : ?>
              <a class="website button secondary large" href="<?php echo $details_pdf['url']; ?>" target="_blank" rel="noopener">Download PDF</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="company-info">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="container-fluid">
            <?php the_content(); ?>

            <h2>Details</h2>

            <div class="indent">
              <dl>
                <?php if (!empty($acres)) { ?>
                  <dt>Total Area:</dt>
                  <dd><?php echo $acres; ?> acres</dd>
                <?php } ?>
                <?php if (!empty($usable)) { ?>
                  <dt>Usable Acres:</dt>
                  <dd><?php echo $usable; ?></dd>
                <?php } ?>
                <?php if (!empty($coverage)) { ?>
                  <dt>Lot Coverage:</dt>
                  <dd><?php echo $coverage; ?> sqft</dd>
                <?php } ?>
                <?php if (!empty($zoning)) { ?>
                  <dt>Zoning:</dt>
                  <dd><?php echo $zoning; ?></dd>
                <?php } ?>
              </dl>
            </div>

            <h2>Utilities</h2>

            <div class="indent">
              <dl>
                <?php if (!empty($water_sewer)) { ?>
                  <dt>Water/Sewer:</dt>
                  <dd><?php echo $water_sewer; ?></dd>
                <?php } ?>
                <?php if (!empty($electricity)) { ?>
                  <dt>Electricity:</dt>
                  <dd><?php echo $electricity; ?></dd>
                <?php } ?>
                <?php if (!empty($gas)) { ?>
                  <dt>Gas:</dt>
                  <dd><?php echo $gas; ?></dd>
                <?php } ?>
              </dl>
            </div>

            <?php if (!empty($contact_ppl)) { ?>
              <h2>Get In Touch</h2>

              <div class="indent">
                <?php foreach($contact_ppl as $contact) { ?>
                  <p>
                    <?php if (!empty($contact['email']) || !empty($contact['phone'])) { ?>
                      <?php echo $contact['name']; ?>
                      <?php if (!empty($contact['title'])) { ?>
                        , <?php echo $contact['title']; ?>
                      <?php } ?>
                      <?php if (!empty($contact['phone'])) { ?>
                        <br /> <?php echo $contact['phone']; ?>
                      <?php } ?>
                      <?php if (!empty($contact['email'])) { ?>
                        <br /> <a href="mailto:<?php echo $contact['email']; ?>" target="_blank" rel="noopener"><?php echo $contact['email']; ?></a>
                      <?php } ?>
                    <?php } ?>
                  </p>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if (!empty($details_pdf)) : ?>
              <a class="pdf button secondary large" href="<?php echo $details_pdf['url']; ?>" target="_blank" rel="noopener">Download PDF</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <div class="location-map-wrapper">
            <div class="location-map" id="location-map" data-post-type="rtp-site" data-feature-type="Polygon" data-location-id="<?php echo get_the_id(); ?>">
              <div class="rtp-loader-wrap">
                <div class="rtp-loader-icon">
                  <div class="row">
                     <div class="arrow up outer outer-18"></div>
                     <div class="arrow down outer outer-17"></div>
                     <div class="arrow up outer outer-16"></div>
                     <div class="arrow down outer outer-15"></div>
                     <div class="arrow up outer outer-14"></div>
                  </div>
                  <div class="row">
                     <div class="arrow up outer outer-1"></div>
                     <div class="arrow down outer outer-2"></div>
                     <div class="arrow up inner inner-6"></div>
                     <div class="arrow down inner inner-5"></div>
                     <div class="arrow up inner inner-4"></div>
                     <div class="arrow down outer outer-13"></div>
                     <div class="arrow up outer outer-12"></div>
                  </div>
                  <div class="row">
                     <div class="arrow down outer outer-3"></div>
                     <div class="arrow up outer outer-4"></div>
                     <div class="arrow down inner inner-1"></div>
                     <div class="arrow up inner inner-2"></div>
                     <div class="arrow down inner inner-3"></div>
                     <div class="arrow up outer outer-11"></div>
                     <div class="arrow down outer outer-10"></div>
                  </div>
                  <div class="row">
                     <div class="arrow down outer outer-5"></div>
                     <div class="arrow up outer outer-6"></div>
                     <div class="arrow down outer outer-7"></div>
                     <div class="arrow up outer outer-8"></div>
                     <div class="arrow down outer outer-9"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="address">
            <?php if (!empty($road_access)) {
              echo $road_access;
            } ?>
          </div>

          <div class="location-photo">
            <?php if (!empty($location_photo)) { ?>
              <img src="<?php echo $location_photo; ?>" alt="<?php the_title(); ?> Photograph"/>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
