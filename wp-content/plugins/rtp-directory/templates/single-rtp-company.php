<?php
/**
 * Single Company Page
 *
 */

// Get contact people's email addresses and save MD5 hashes into approved people array
$contact_ppl = get_field('contact_person'); // Array
$approved_ppl = array();
if (!empty($contact_ppl)) {
  foreach ($contact_ppl as $contact) {
    if (!empty($contact['email'])) {
      $approved_ppl[] = md5($contact['email']);
    }
  }
}

// Check if fields are editable
if (in_array($_REQUEST['company_edit'], $approved_ppl)) {
  acf_form_head();
  $user_can_edit = true;
  $edit_button = '<span class="modal-btn">&#9998;</span>';
}

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'all'));
  $description = get_field('description');

  $company_logo = get_field('company_logo');
  $location_photo = get_field('location_photograph');

  // Location
  $within_facility = get_field('within_facility');
  if ($within_facility == true) {
    $related_facility = get_field('related_facility');
    $suite_or_building = get_field('suite_or_building');
    $street_address = get_field('street_address', $related_facility);
    $zip_code = get_field('zip_code', $related_facility);
    $feature_type = get_field('geometry_type', $related_facility);
  } else {
    $street_address = get_field('street_address');
    $zip_code = get_field('zip_code');
    $coords = get_field('coordinates');
    $feature_type = 'Point';
  }

  // Get In Touch
  $phone = get_field('phone');  // Array
  $fax = get_field('fax');
  $website = get_field('website');
  $mailing_address = get_field('mailing_address');
  $twitter = get_field('twitter');

  // Operations
  $locations = get_field('operations_locations');
  $us_hq = get_field('operations_us_headquarters');
  $global_hq = get_field('operations_global_headquarters');

  // Details
  $employment_public = get_field('publish_employment');
  $year_in_rtp = get_field('year_arrived_in_rtp');
  $university = get_field('university_affiliation');
  $company_size = get_field('company_size');
  $ft_employment = get_field('reporting_data_full_time_employees');
  $pt_employment = get_field('reporting_data_part_time_employees');

  ?>
  <div class="content-container edit-directory">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-10">
          <div class="row flex <?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-header' : ''); ?>">
            <?php // COMPANY LOGO ?>
            <?php if(!empty($company_logo)) { ?>
              <div class="logo-wrapper">
                <div class="company-logo">
                  <div>
                    <div>
                      <img src="<?php echo $company_logo; ?>" alt="<?php the_title(); ?>" />
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php // COMPANY NAME AND CATEGORY ?>
            <div class="company-title">
              <h1><?php the_title(); ?>
                <?php echo ($user_can_edit ? $edit_button : ''); ?>
              </h1>
              <?php if (!empty($location_terms)) : ?>
                <div class="location-meta">
                  <?php foreach ($location_terms as $lt) : ?>
                  <div class="meta-term">
                    <?php if (function_exists('get_wp_term_image')) :?>
                      <div class="meta-icon">
                        <?php $meta_image = get_wp_term_image($lt->term_id);?>
                        <img src="<?php echo $meta_image;?>" alt="" />
                      </div>
                    <?php endif; ?>
                    <?php echo $lt->name; ?>
                  </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php // COMPANY WEBSITE LINK ?>
        <div class="col-xs-12 col-md-2">
          <?php if ($user_can_edit) { ?>
            <div class="notice user-can-edit" data-target="modal-reporting-data">
              <button class="modal-btn button secondary reporting">2018 RTP Survey &#9998;</button>
            </div>
          <?php } else { ?>
            <?php if (!empty($website)) : ?>
              <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="company-info">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="container-fluid">

            <?php // COMPANY DESCRIPTION ?>
            <div class="<?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-description' : ''); ?>">
              <?php echo ($user_can_edit ? '<h2>Company Description ' . $edit_button . '</h2>' : ''); ?>
              <?php if (!empty($description)) : ?>
                <?php echo $description; ?>
              <?php elseif ($user_can_edit) : ?>
                <p>Add company description.</p>
              <?php endif; ?>
            </div>

            <?php if (!empty($year_in_rtp) || ($employment_public == true && !empty($company_size)) || !empty($university[0]) || (!empty($locations) && $locations !== 'Located in RTP only')) : ?>
              <div class="<?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-details' : ''); ?>">
                <h2>Additional Details
                  <?php echo ($user_can_edit ? $edit_button : ''); ?>
                </h2>

                <div class="indent">
                <dl>
                  <?php if (!empty($year_in_rtp)) { ?>
                    <dt>Arrived in RTP:</dt>
                    <dd><span><?php echo $year_in_rtp; ?></span></dd>
                  <?php } ?>

                  <?php if ($employment_public == true && !empty($company_size)) { ?>
                    <dt>Company Size:</dt>
                    <dd><span><?php echo $company_size ?> Employees</span></dd>
                  <?php } ?>

                  <?php if ($locations == 'Multiple countries') { ?>
                    <dt>Global Headquarters:</dt>
                    <dd><span><?php the_field('operations_global_headquarters'); ?></span></dd>
                    <?php if (get_field('operations_global_headquarters' == get_field('operations_us_headquarters'))) { ?>
                      <dt>US Headquarters:</dt>
                      <dd><span><?php the_field('operations_us_headquarters'); ?></span></dd>
                    <?php } ?>
                  <?php } elseif ($locations == 'Multiple US locations') { ?>
                    <dt>Headquarters:</dt>
                    <dd><span><?php the_field('operations_us_headquarters'); ?></span></dd>
                  <?php } ?>

                  <?php if (!empty($university[0])) { ?>
                  <dt>University Affiliation:</dt>
                    <dd><span><?php echo implode(', ', $university); ?></span></dd>
                  <?php } ?>
                </dl>
                </div>
              </div>
            <?php elseif ($user_can_edit) : ?>
              <div class="user-can-edit" data-target="modal-details">
                <h2>Additional Details<?php echo $edit_button; ?></h2>
                <p>Add company details.</p>
              </div>
            <?php endif; ?>

            <?php if (($phone['public'] == true && !empty($phone['number'])) || ($fax['public'] == true && !empty($fax['number'])) || !empty($twitter) || !empty($mailing_address) || !empty($contact_ppl)) : ?>
              <div class="<?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-contact' : ''); ?>">
                <h2>Get In Touch
                  <?php echo ($user_can_edit ? $edit_button : ''); ?>
                </h2>

                <div class="indent">
                  <dl>
                    <?php if ($phone['public'] == true && !empty($phone['number'])) { ?>
                      <dt>Phone:</dt>
                      <dd><span><?php echo $phone['number']; ?></span></dd>
                    <?php } ?>

                    <?php if ($fax['public'] == true && !empty($fax['number'])) { ?>
                      <dt>Fax:</dt>
                      <dd><span><?php echo $fax['number']; ?></span></dd>
                    <?php } ?>

                    <?php if (!empty($twitter)) { ?>
                      <dt>Twitter:</dt>
                      <dd><span><a href="https://www.twitter.com/<?php echo $twitter; ?>" target="_blank" rel="noopener">@<?php echo $twitter; ?></a></span></dd>
                    <?php } ?>

                    <?php if (!empty($mailing_address)) { ?>
                      <dt>Mailing Address:</dt>
                      <dd><span><?php echo $mailing_address; ?></span></dd>
                    <?php } ?>

                    <?php if (!empty($contact_ppl)) { ?>
                      <?php foreach($contact_ppl as $contact) { ?>
                        <?php if ((!empty($contact['email']) || !empty($contact['phone'])) && $contact['public'] == TRUE) { ?>
                          <?php if ($contact['pr_contact'] == true) { ?>
                            <dt>PR Contact:</dt>
                          <?php } else { ?>
                            <dt>General Contact:</dt>
                          <?php } ?>
                          <dd><span>
                            <?php
                              if (!empty($contact['title'])) {
                                echo $contact['name'];
                                if (!empty($contact['title'])) {
                                  echo ', ' . $contact['title'];
                                }
                                if (!empty($contact['phone']) || !empty($contact['email'])) {
                                  echo '<br />';
                                }
                              }
                              if (!empty($contact['phone'])) {
                                echo $contact['phone'];
                                if (!empty($contact['email'])) {
                                  echo '<br />';
                                }
                              }
                              if (!empty($contact['email'])) {
                                echo '<a href="mailto:' . $contact['email'] . '" target="_blank" rel="noopener">' . $contact['email'] . '</a>';
                              }
                            ?>
                          </span></dd>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                  </dl>
                </div>
              <?php elseif ($user_can_edit) : ?>
                <div class="user-can-edit" data-target="modal-contact">
                  <h2>Get In Touch <?php echo $edit_button; ?></h2>
                  <p>Add contact information</p>
                </div>
              <?php endif; ?>

              <?php // COMPANY WEBSITE LINK ?>
              <?php if (!empty($website)) : ?>
                <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 <?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-location' : ''); ?>">
          <div class="location-map-wrapper">
            <?php echo ($user_can_edit ? $edit_button : ''); ?>

            <div class="location-map" id="location-map" data-post-type="rtp-company" data-feature-type="<?php echo $feature_type; ?>" data-location-id="<?php echo get_the_id(); ?>">
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

          <?php // PHYSICAL ADDRESS/LOCATION ?>
          <div class="address">
            <?php echo ($user_can_edit ? $edit_button : ''); ?>
            <?php if ($within_facility == 'true') { ?>
              <strong><?php echo get_the_title($related_facility); ?></strong>
              <?php if (!empty($suite_or_building)) {
                echo '<br />' . $suite_or_building;
              } ?>
              <br />
            <?php } ?>

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
              <img src="<?php echo $location_photo['sizes']['large']; ?>" alt="<?php the_title(); ?> Photograph"/>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if ($user_can_edit) { ?>
    <div class="modal" id="modal-header">
      <?php acf_form(['fields' => ['company_type', 'website', 'company_logo'], 'uploader' => 'basic', 'post_title' => true]); ?>
    </div>

    <div class="modal" id="modal-description">
      <?php acf_form(['fields' => ['description']]); ?>
    </div>

    <div class="modal" id="modal-details">
      <?php acf_form(['fields' => ['year_arrived_in_rtp', 'company_size', 'publish_employment', 'university_affiliation', 'operations'], 'label_placement' => 'left']); ?>
    </div>

    <div class="modal" id="modal-contact">
      <?php acf_form(['fields' => ['phone', 'fax', 'twitter', 'mailing_address', 'contact_person', 'website'], 'label_placement' => 'left']); ?>
    </div>

    <div class="modal" id="modal-location">
      <?php acf_form(['fields' => ['within_facility', 'related_facility', 'suite_or_building', 'street_address', 'zip_code', 'coordinates', 'location_photograph'], 'uploader' => 'basic']); ?>
    </div>

    <div class="modal" id="modal-reporting-data">
      <?php acf_form(['fields' => ['reporting_data']]); ?>
    </div>
  <?php } ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
