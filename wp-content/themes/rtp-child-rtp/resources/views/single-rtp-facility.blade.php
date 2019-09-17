@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    @php
      $directory_page = get_page_by_path('directory-map');
      $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($directory_page->ID), 'full' );

      // Location
      $id = get_the_id();
      $location_terms = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));
      $location_photo = get_the_post_thumbnail_url();
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
    @endphp

    <header class="page-header">
      <div class="texture">
        <?php if (!empty($location_photo)) { ?>
          <img src="<?php echo $location_photo; ?>" alt="<?php the_title(); ?> Photograph"/>
        <?php } ?>
      </div>
      <div class="container">
        <div class="entry-title-container">
          <h1 class="entry-title">{!! get_the_title() !!}</h1>
          <p>{{ $street_address }}<br />
            RTP, NC
            @if (!empty($zip_code))
              {{ $zip_code }}
            @else
              27709
            @endif
          </p>

          @if (!empty($website))
            <a class="website button secondary large" href="{{ $website }}" target="_blank" rel="noopener">Visit Website</a>
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

      {{--
        Multi-Tenant Facility Layout
      --}}

      @if ($location_terms[0]->slug == 'multi-tenant')

        <div class="directory-listing row">
          <div class="col xs12 s6">

            @php $tenants = (new RTP_Dir_Listing)->get_facility_tenants($id) @endphp
            @if($tenants->have_posts())

              <h3 class="label">Company Listing</h3>

              <div class="clearfix pagination">
                <div class="float-left">
  								<div class="count">Results: <?php echo do_shortcode('[facetwp counts="true"]'); ?></div>
  							</div>
  							{{-- <div class="float-right text-right">
  								<nav role="navigation" aria-label="Results Pagination">
  									{!! do_shortcode('[facetwp pager="true"]') !!}
  								</nav>
  							</div> --}}
              </div>

              <div class="clearfix vertical-padding facetwp-template">
                @while($tenants->have_posts()) @php $tenants->the_post() @endphp
                  @php
    								$location_type = get_post_type(get_the_id());

    								if ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
    									$location_terms = wp_get_object_terms(get_the_id(), 'rtp-availability', array('fields' => 'all'));
    								} elseif ($location_type == 'rtp-company') {
    									$location_terms = wp_get_object_terms(get_the_id(), 'rtp-company-type', array('fields' => 'all'));
    								}

  								@endphp

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

                @endwhile

              </div>

              <div class="clearfix pagination bottom">
                <div class="float-left">
                  <div class="count">Results: <?php echo do_shortcode('[facetwp counts="true"]'); ?></div>
                </div>
                <div class="float-right text-right">
                  <nav role="navigation" aria-label="Results Pagination">
                    <?php echo do_shortcode('[facetwp pager="true"]'); ?>
                  </nav>
                </div>
              </div>

            @endif @php wp_reset_postdata() @endphp
          </div>
          <div class="col xs12 s6">

            <div class="facet-search-wrapper">
              {!! do_shortcode('[facetwp facet="search_directory"]') !!}
            </div>

            <div id="location-map" class="directory-map" data-post-type="rtp-facility" data-feature-type="<?php echo $geometry; ?>" data-location-id="<?php echo get_the_id(); ?>">
              @include('partials.rtp-loader')
            </div>
          </div>
        </div>

      {{--
        Recreation and Trails Layout
      --}}

      @else

        <div class="company-info row">
          <div class="col xs12 s6">
            <?php the_content(); ?>

            <div class="address">
              @if (!empty($street_address))
                <h3 class="label">Address</h3>
                {{ $street_address }}<br />
                RTP, NC
                @if (!empty($zip_code))
                  {{ $zip_code }}
                @else
                  27709
                @endif
              @endif

              @if (!empty($website))
                <a class="website button secondary large" href="{{ $website }}" target="_blank" rel="noopener">Visit Website</a>
              @endif

              @if (($location_terms[0]->slug == 'multi-tenant') && !empty(get_the_content()) && get_the_content() !== '<p></p>')
                <div class="facility-info">
                  <?php the_content(); ?>
                </div>
              @endif
            </div>

            <?php if (!empty($contact_ppl)) { ?>
              <h3 class="label">Get In Touch</h3>

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
            <?php } ?>

            <?php if (!empty($website)) : ?>
              <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          </div>

          <div class="col xs12 s6">
            <div id="location-map" class="directory-map" data-post-type="rtp-facility" data-feature-type="<?php echo $geometry; ?>" data-location-id="<?php echo get_the_id(); ?>">
                @include('partials.rtp-loader')
            </div>
          </div>
        </div>

      <?php endif; ?>

    </div>

  @endwhile
@endsection
