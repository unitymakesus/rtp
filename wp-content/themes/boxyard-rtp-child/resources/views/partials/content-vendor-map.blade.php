<section class="vendor-map">
  <div class="container-wide">
    <div class="row no-margin-bottom">
      <div class="col s12 l4">
        <div class="vendor-map__aside">
          <h1 class="entry-title">{{ __('Discover Our Vendors', 'sage') }}</h1>
          <h2 class="screen-reader-text">{{ __('Boxyard RTP Map', 'sage') }}</h2>
          <div class="btn-map-control-wrap">
            <a role="button" class="btn-map-control btn-map-control--dine" href="#" data-controls="dine">{{ __('Dine') }}</a>
            <a role="button" class="btn-map-control btn-map-control--shop" href="#" data-controls="shop">{{ __('Shop') }}</a>
            <a role="button" class="btn-map-control btn-map-control--play" href="#" data-controls="play">{{ __('Play') }}</a>
          </div>
          <ul class="hide-on-small-only">
            <li class="btn-map-control__legend">
              <img src="@asset('images/icon-restrooms.svg')" alt="" />
              <span>{{ __('Restrooms', 'sage') }}</span>
              <span class="screen-reader-text">{{ __('The bathrooms are located towards Fullsteam Brewery in the corner. When you come into the entrance with the metal arch, go to the right and head to the corner. There are male and female restrooms as well as a family restroom. There are also more restrooms upstairs in the same spot.', 'sage') }}</span>
            </li>
            <li class="btn-map-control__legend">
              <img src="@asset('images/icon-stairs.svg')" alt="" />
              <span>{{ __('Stairs', 'sage') }}</span>
              <span class="screen-reader-text">{{ __('There are three sets of stairs for foot traffic.', 'sage') }}</span>
            </li>
            <li class="btn-map-control__legend">
              <img src="@asset('images/icon-elevator.svg')" alt="" />
              <span>{{ __('Elevator', 'sage') }}</span>
              <span class="screen-reader-text">{{ __('The elevators are located next to the restrooms.', 'sage') }}</span>
            </li>
            <li class="btn-map-control__legend">
              <img src="@asset('images/icon-stage.svg')" alt="" />
              <span>{{ __('Stage', 'sage') }}</span>
              <span class="screen-reader-text">{{ __('The event stage is located on the ground floor.', 'sage') }}</span>
            </li>
            <li class="btn-map-control__legend">
              <img src="@asset('images/icon-dog-park.svg')" alt="" />
              <span>{{ __('Dog Park', 'sage') }}</span>
              <span class="screen-reader-text">{{ __('There is a dog park located next to Boxyard RTP, as well as water bowls and other comfortable locations for animals to rest.', 'sage') }}</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col s12 l8">
        <div class="vendor-map__wrapper">
          @include('partials.boxyard-map')
        </div>
      </div>
    </div>
  </div>
  @foreach ($vendors as $vendor)
    <div class="vendor-tooltip-content" id="{{ $vendor->ID }}" style="display:none;">
      <a class="vendor-tooltip-content__link" href="{{ get_the_permalink($vendor) }}">
        @if ($wayfinding_icon_url = get_field('vendor_wayfinding_icon', $vendor))
          <img class="vendor-tooltip-content__icon no-lazyload" src="{{ $wayfinding_icon_url }}" alt="" />
        @endif
        {{ $vendor->post_title }}
      </a>
    </div>
  @endforeach
</section>
