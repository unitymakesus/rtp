@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    @php
      $id = get_the_id();
      $location_terms = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

      $location_photo = get_the_post_thumbnail_url();

      // Location
      $within_facility = get_field('within_facility');
      if ($within_facility == true) {
        $related_facility = get_field('related_facility');
        $street_address = get_field('street_address', $related_facility[0]);
        $zip_code = get_field('zip_code', $related_facility[0]);
        $feature_type = get_field('geometry_type', $related_facility[0]);
      } else {
        $street_address = get_field('street_address');
        $zip_code = get_field('details_zip_code');
        $coords = get_field('coords');
        $feature_type = 'Point';
      }

      // Details
      $link = get_field('link');

      // Get In Touch
      $contact_co = get_field('contact_company');
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

          @if (!empty($link))
            <div class="website-link">
              <a class="button secondary large" href="{{ $link }}" target="_blank" rel="noopener">More Information <span class="cta-arrow"></span></a>
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

          @if (!empty($link))
            <div class="website-link">
              <a class="button secondary large" href="{{ $link }}" target="_blank" rel="noopener">More Information <span class="cta-arrow"></span></a>
            </div>
          @endif

          <h3 class="label">Address</h3>

          <p>{{ $street_address }}<br />
            RTP, NC
            @if (!empty($zip_code))
              {{ $zip_code }}
            @else
              27709
            @endif
          </p>

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
