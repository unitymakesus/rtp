{{--
  Template Name: Company Directory
 --}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article {!! post_class("full-container") !!}>
      @include('partials.page-header')

      <div class="container">
				<div class="row">
					<div class="col s6">
            @php the_content() @endphp
					</div>
					<div class="col s6">

            {!! do_shortcode('[facetwp facet="search_directory"]') !!}

            <div class="label">Filter</div>
            <div class="filter-selects">
							{!! do_shortcode('[facetwp facet="company_types"]') !!}
							{!! do_shortcode('[facetwp facet="facility_types"]') !!}
							{!! do_shortcode('[facetwp facet="availability"]') !!}
  					</div>
					</div>
				</div>

  			<div class="directory-listing row">
					<div class="col xs12 s6 facetwp-template">
		        <h3 class="label">Company Listing</h3>
            <div class="clearfix pagination">
              <div class="float-left">
								<div class="count">Showing <?php echo do_shortcode('[facetwp counts="true"]'); ?></div>
							</div>
							<div class="float-right text-right">
								<nav role="navigation" aria-label="Results Pagination">
									<?php echo do_shortcode('[facetwp pager="true"]'); ?>
								</nav>
							</div>
            </div>

						<?php
						$locations = (new \RTP_Dir_Listing)->get_paged_locations();
						if ($locations->have_posts()) :
							while ($locations->have_posts()) : $locations->the_post();
								$id = get_the_id();
								$location_type = get_post_type();

								if ($location_type == 'rtp-facility') {
									$location_terms = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));
								} elseif ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
									$location_terms = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));
								} elseif ($location_type == 'rtp-company') {
									$location_terms = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'all'));
								}
								?>
								<div class="result-item">
									<div class="result-logo">
										<?php
										$within_facility = get_field('within_facility');
										if ($within_facility == true) {
											$related_facility = get_field('related_facility');
											$related_photo = get_the_post_thumbnail_url($related_facility[0], 'medium');
										}

										if ($location_type == 'rtp-facility' || $location_type == 'rtp-space' || $location_type == 'rtp-site') {
											$location_photo = get_the_post_thumbnail_url($id, 'medium');

											if (!empty($location_photo)) {
												?>
												<img src="<?php echo $location_photo; ?>" alt="" />
												<?php
											} elseif (!empty($related_photo)) {
												?>
												<img src="<?php echo $related_photo; ?>" alt="" />
												<?php
											}
										} elseif ($location_type == 'rtp-company') {
											$logo = get_field('company_logo');
											$location_photo = get_field('location_photograph');

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
										}
										?>
									</div>

									<div class="result-details">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<?php if (!empty($location_terms)) : ?>
											<div class="result-meta">
												<div class="meta-icon">
													<?php foreach ($location_terms as $lt) : ?>
														<?php if (function_exists('get_wp_term_image')) :?>
															<?php $meta_image = get_wp_term_image($lt->term_id);?>
															<img src="<?php echo $meta_image;?>" alt="" title="<?php echo $lt->name; ?>" />
															<?php if ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
																echo $lt->name;
															} ?>
														<?php endif; ?>
													<?php endforeach; ?>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endwhile; wp_reset_postdata();
				    else :
				      echo '<p>';
								_e( 'Sorry, no resources matched your criteria.' );
							echo '</p>';
				    endif;
						?>

						<div class="clearfix pagination bottom">
							<div class="float-left">
								<div class="count">Showing <?php echo do_shortcode('[facetwp counts="true"]'); ?></div>
							</div>
							<div class="float-right text-right">
								<nav role="navigation" aria-label="Results Pagination">
									<?php echo do_shortcode('[facetwp pager="true"]'); ?>
								</nav>
							</div>
						</div>
					</div>
					<div class="col xs12 s6">
            <div class="key">
              <div class="label">Map Key</div>
              <ul class="flex flex-grid m3x s1x">
                <li class="flex-item icon-multitenant">Multi-Tenant Facility</li>
                <li class="flex-item icon-recreation">Recreation Facilities</li>
                <li class="flex-item icon-forsale">For Sale</li>
                <li class="flex-item icon-company">Companies</li>
                <li class="flex-item icon-trails">Trails</li>
                <li class="flex-item icon-forlease">For Lease</li>
              </ul>
            </div>

	        	<div id="map" class="directory-map">
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
    </div>
  </article>
@endwhile
@endsection
