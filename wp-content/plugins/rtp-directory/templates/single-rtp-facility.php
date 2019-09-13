<?php
/**
 * Single Company Page
 *
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));

  $location_photo = get_the_post_thumbnail_url();

  // Location
  $street_address = get_field('street_address');
  $zip_code = get_field('zip_code');
  $geometry = get_field('geometry_type');
  if ($geometry == 'Point') {
    $coords = get_fields('coordinates');
  } else {
    $coords = get_fields('coordinates_long');
  }

  // Get In Touch
  $ownership = get_field('facility_ownership');
  $contact_ppl = get_field('contact_person'); // Array
  ?>
  <div class="content-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <h1><?php the_title(); ?></h1>
            <div class="address">
              <?php if (!empty($street_address)) {
                echo $street_address . '<br />';
                echo 'RTP, NC ';
                if (!empty($zip_code)) {
                  echo $zip_code;
                } else {
                  echo '27709';
                }
              } ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4">
          <div class="box">
            <?php if (!empty($website)) : ?>
              <a class="website button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    /**
     * Multi-Tenant Facility Layout
     */
    if ($location_terms[0]->slug == 'multi-tenant') :
    ?>

      <?php if (!empty(get_the_content()) && get_the_content() !== '<p></p>') : ?>
        <div class="facility-info">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-8">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="directory-listing">
        <div class="row">
          <div class="col-xs-12 col-sm-6 facetwp-template">
            <?php
            $tenants = (new RTP_Dir_Listing)->get_facility_tenants($id);
            ?>
            <div class="clearfix vertical-padding">
              <a class="label" href="<?php echo get_permalink(get_page_by_path('/directory-map')); ?>">&laquo; Back to RTP directory</a>
            </div>

            <div class="clearfix vertical-padding">
			        <span class="count label">Showing <?php echo sizeof($tenants); ?> Companies</span>
						</div>

            <div class="clearfix vertical-padding">
              <?php
  						$original_post = $post;
              if (!empty($tenants)) :
                foreach ($tenants as $tenant) :
                  $post = get_post($tenant->id);
                  setup_postdata($post);
  								$location_type = get_post_type($tenant->id);

  								if ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
  									$location_terms = wp_get_object_terms($tenant->id, 'rtp-availability', array('fields' => 'all'));
  								} elseif ($location_type == 'rtp-company') {
  									$location_terms = wp_get_object_terms($tenant->id, 'rtp-company-type', array('fields' => 'all'));
  								}
  								?>
  								<div class="result-item">
  									<div class="result-logo">
                      <?php
  											$logo = get_field('company_logo');
  											$location_photo = get_field('location_photograph');
  											$within_facility = get_field('within_facility');

  											if ($within_facility == true) {
  												$related_facility = get_field('related_facility');
  												$related_photo = get_the_post_thumbnail_url($related_facility[0], 'medium');
  											}

  											if (!empty($logo)) {
  												?>
  												<img src="<?php echo $logo; ?>" alt="<?php the_title(); ?>" />
  												<?php
  											} elseif (!empty($location_photo)) {
  												?>
  												<img src="<?php echo $location_photo['sizes']['medium']; ?>" alt="" />
  												<?php
  											} elseif (!empty($related_photo)) {
  												?>
  												<img src="<?php echo $related_photo; ?>" alt="" />
  												<?php
  											}
  										?>
  									</div>

  									<div class="result-details">
  										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  										<?php if (!empty($location_terms)) : ?>
  											<div class="result-meta">
  												<?php foreach ($location_terms as $lt) : ?>
  												<div class="meta-icon">
  													<?php if (function_exists('get_wp_term_image')) :?>
  														<?php $meta_image = get_wp_term_image($lt->term_id);?>
  														<img src="<?php echo $meta_image;?>"/>
                              <?php if ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
																echo $lt->name;
															} ?>
  													<?php endif; ?>
  												</div>
  												<?php endforeach; ?>
  											</div>
  										<?php endif; ?>
  									</div>
  								</div>
  								<?php
  							endforeach; wp_reset_postdata();
                $post = $original_post;
  				    else :
  				      echo '<p>';
  								_e( 'Sorry, no resources matched your criteria.' );
  							echo '</p>';
  				    endif;
  						?>
            </div>
          </div>

          <div class="col-xs-12 col-sm-8 col-md-6">
            <div id="location-map" class="directory-map" data-post-type="rtp-facility" data-feature-type="<?php echo $geometry; ?>" data-location-id="<?php echo get_the_id(); ?>">
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
        </div>
      </div>

    <?php
    /**
     * Recreation and Trails Layout
     */
    else : ?>

      <div class="company-info">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="container-fluid">
              <?php the_content(); ?>

              <?php if (!empty($contact_ppl)) { ?>
                <h2>Get In Touch</h2>

                <div class="indent">
                  <?php foreach($contact_ppl as $contact) { ?>
                    <dl>
                      <?php if (!empty($ownership)) { ?>
                        <dt><?php echo $ownership; ?></dt>
                      <?php } ?>
                      <dd class="new-line">
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
                      </dd>
                    </dl>
                  <?php } ?>
                </div>
              <?php } ?>

              <?php if (!empty($website)) : ?>
                <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="location-map-wrapper">
              <div id="location-map" class="location-map" data-post-type="rtp-facility" data-feature-type="<?php echo $geometry; ?>" data-location-id="<?php echo get_the_id(); ?>">
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
              <?php if (!empty($street_address)) {
                echo $street_address . '<br />';
                echo 'RTP, NC ';
                if (!empty($zip_code)) {
                  echo $zip_code;
                } else {
                  echo '27709';
                }
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

    <?php endif; ?>

  </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
