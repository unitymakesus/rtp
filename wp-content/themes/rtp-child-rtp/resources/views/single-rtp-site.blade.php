@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    @php
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
                  <?php echo $lt->name; ?>
                </h2>
              @endforeach
            </div>
          @endif

          @if (!empty($details_pdf))
            <div class="website-link">
              <a class="button secondary large" href="<?php echo $details_pdf['url']; ?>" target="_blank" rel="noopener">Download PDF <span class="cta-arrow"></span></a>
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
          <?php the_content(); ?>

          @if (!empty($details_pdf))
            <div class="website-link">
              <a class="button secondary large" href="<?php echo $details_pdf['url']; ?>" target="_blank" rel="noopener">Download PDF <span class="cta-arrow"></span></a>
            </div>
          @endif

          <h3 class="label">Details</h3>

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

          <h3 class="label">Utilities</h3>

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

          @if (!empty($contact_ppl))
            <h3 class="label">Get In Touch</h3>

            @foreach($contact_ppl as $contact)
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
            @endforeach
          @endif
        </div>

        {{-- LOCATION MAP --}}
        <div class="col xs12 s6">
          <div class="directory-map" id="location-map" data-post-type="rtp-company" data-feature-type="<?php echo $feature_type; ?>" data-location-id="<?php echo get_the_id(); ?>">
            @include('partials.rtp-loader')
          </div>
        </div>
      </div>
    </div>

  @endwhile
@endsection
