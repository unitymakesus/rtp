@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    @php
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
    @endphp

    <div class="edit-directory">
      <header class="page-header">
        <div class="texture">
          <?php if (!empty($location_photo)) { ?>
            <img src="<?php echo $location_photo['sizes']['large']; ?>" alt="<?php the_title(); ?> Photograph"/>
          <?php } ?>
        </div>
        <div class="container">
          <div class="entry-title-container {{ ($user_can_edit ? 'user-can-edit" data-target="modal-header' : '') }}">
            <h1><?php the_title(); ?>
              {!! ($user_can_edit ? $edit_button : '') !!}
            </h1>
            @if (!empty($location_terms))
              <div class="location-meta">
                @foreach ($location_terms as $lt)
                  <h2 class="h3 meta-term">
                    @if (function_exists('get_wp_term_image'))
                      <div class="meta-icon">
                        @php $meta_image = get_wp_term_image($lt->term_id) @endphp
                        <img src="{{ $meta_image }}" alt="" />
                      </div>
                    @endif
                    {{ $lt->name }}
                  </h2>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </header>

      <div class="container">
        <div class="row">
          <div class="col s12">
            <a class="back-to-directory" href="<?php echo get_permalink(get_page_by_path('/directory-map')); ?>">&laquo; Back to RTP directory</a>
          </div>
        </div>

        <div class="row company-info">
          <div class="col xs12 m6">
            {{-- COMPANY LOGO --}}
            @if (!empty($company_logo))
              <div class="company-logo">
                <img src="{{ $company_logo }}" alt="{{ get_the_title() }}" />
              </div>
            @endif

            {{-- COMPANY DESCRIPTION --}}
            <div class="{{ ($user_can_edit ? 'user-can-edit" data-target="modal-description' : '') }}">
              {!! ($user_can_edit ? '<h3>Company Description ' . $edit_button . '</h3>' : '') !!}
              @if (!empty($description))
                {!! $description !!}
              @elseif ($user_can_edit)
                <p>Add company description.</p>
              @endif
            </div>

            {{-- COMPANY WEBSITE LINK --}}
            <div class="website-link">
              @if (!empty($website))
                <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website <span class="cta-arrow"></span></a>
              @endif
            </div>

            {{-- PHYSICAL ADDRESS/LOCATION --}}
            <div class="address {{ ($user_can_edit ? 'user-can-edit" data-target="modal-location' : '') }}">
              <h3 class="label">Address</h3>

              {!! ($user_can_edit ? $edit_button : '') !!}

              <p>
                @if ($within_facility == 'true')
                  {!! get_the_title($related_facility) !!}
                  <br />
                @endif

                @if (!empty($street_address))
                  {{$street_address}} <br />

                  @if (!empty($suite_or_building))
                    {{ $suite_or_building }}<br />
                  @endif

                  RTP, NC
                  @if (!empty($zip_code))
                    {{$zip_code}}
                  @else
                    27709
                  @endif
                @endif
              </p>
            </div>

            @if (!empty($year_in_rtp) || ($employment_public == true && !empty($company_size)) || !empty($university[0]) || (!empty($locations) && $locations !== 'Located in RTP only'))
              <div class="<?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-details' : ''); ?>">
                <h3 class="label">Additional Details
                  <?php echo ($user_can_edit ? $edit_button : ''); ?>
                </h3>

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
            @elseif ($user_can_edit)
              <div class="user-can-edit" data-target="modal-details">
                <h3 class="label">Additional Details<?php echo $edit_button; ?></h3>
                <p>Add company details.</p>
              </div>
            @endif

            @if (($phone['public'] == true && !empty($phone['number'])) || ($fax['public'] == true && !empty($fax['number'])) || !empty($twitter) || !empty($mailing_address) || !empty($contact_ppl))
              <div class="<?php echo ($user_can_edit ? 'user-can-edit" data-target="modal-contact' : ''); ?>">
                <h3 class="label">Get In Touch
                  <?php echo ($user_can_edit ? $edit_button : ''); ?>
                </h3>

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
                              echo '<a href="mailto:' . eae_encode_str($contact['email']) . '" target="_blank" rel="noopener">' . eae_encode_str($contact['email']) . '</a>';
                            }
                          ?>
                        </span></dd>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </dl>
              @elseif ($user_can_edit)
                <div class="user-can-edit" data-target="modal-contact">
                  <h3 class="label">Get In Touch <?php echo $edit_button; ?></h3>
                  <p>Add contact information</p>
                </div>
              @endif
            </div>
          </div>

          {{-- LOCATION MAP --}}
          <div class="col xs12 s6">
            <div class="directory-map" id="location-map" data-post-type="rtp-company" data-feature-type="<?php echo $feature_type; ?>" data-location-id="<?php echo get_the_id(); ?>">
              @include('partials.rtp-loader')
            </div>
          </div>

        </div>
      </div>
    </div>

    @if ($user_can_edit)
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
    @endif

  @endwhile
@endsection
