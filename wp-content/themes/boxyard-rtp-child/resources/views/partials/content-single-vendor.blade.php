<article>
  <div class="hero-img">
    @if ($hero = get_field('header_hero_image'))
      {!! wp_get_attachment_image($hero, 'full') !!}
    @endif
  </div>
  <div class="container-wide">
    <div class="row">
      <div class="col s12 l6">
        @if ($logo = get_field('vendor_logo'))
          <div class="vendor-logo">
            {!! wp_get_attachment_image($logo, 'large') !!}
          </div>
        @endif
        <h1>{!! App::title() !!}</h1>
        @if ($desc = get_field('vendor_short_description'))
          <div class="h3">{!! $desc !!}</div>
        @endif
        @if ($curbside_delivery_label = get_field('vendor_curbside_delivery_label'))
          <div class="vendor-curbside-info">
            <img class="vendor-curbside-info__icon" src="@asset('images/vendor-order.svg')" alt="" />
            <div class="vendor-curbside-info__content">
              <strong>{{ $curbside_delivery_label }}</strong>
              @if ($curbside_delivery_link = get_field('vendor_curbside_delivery_link'))
                <a href="{{ $curbside_delivery_link['url'] }}" target="_blank" rel="noopener noreferrer">{{ $curbside_delivery_link['title'] }}</a>
              @endif
            </div>
          </div>
        @endif
        @if ($website = get_field('vendor_website_url'))
          <dl>
            <dt>{{ __('Website', 'sage') }}</dt>
            <dd><a href="{{ $website }}" target="_blank" rel="noopener noreferrer">{{ $website }}</a></dd>
          </dl>
        @endif
        @if ($hours = get_field('vendor_hours_of_operation'))
          <dl>
            <dt>{{ __('Hours', 'sage') }}</dt>
            <dd>{!! $hours !!}</dd>
          </dl>
        @endif
        <div class="entry-content">
          <div class="row">
            <div class="col m2">
              <img src="{{ get_field('vendor_wayfinding_icon_dark') }}" alt=""/>
            </div>
            <div class="col m10 xl8">
              @php the_content() @endphp
            </div>
          </div>
        </div>
      </div>
      <div class="col s12 l6">
        @if ($profile = get_field('vendor_profile_image'))
          <figure>
            {!! wp_get_attachment_image($profile, 'large') !!}
            @if ($quote = get_field('vendor_profile_quote'))
              <figcaption>{!! $quote !!}</figcaption>
            @endif
          </figure>
        @endif
        @if ($social_media = get_field('vendor_social_media'))
          <strong>{{ __('Follow Us', 'sage') }}</strong>
          <ul class="social-icons social-icons--light">
            @foreach ($social_media as $platform => $url)
              <li class="icon-{{ $platform }}">
                <a href="{{ $url }}">{{ $platform }}</a>
              </li>
            @endforeach
          </ul>
        @endif
        @if ($gallery_images = get_field('vendor_gallery'))
          <div class="gallery">
            @foreach ($gallery_images as $image)
              <div>
                <a class="modaal-gallery" href="{{ $image['sizes']['large'] }}" data-group="vendor-gallery">
                  <img src="{{ $image['sizes']['medium-square-thumbnail'] }}" alt="" />
                </a>
              </div>
            @endforeach
          </div>
        @endif
      </div>
      <footer class="col s12 text-center">
        @if ($vendors_page = get_field('vendors_page', 'option'))
          <a class="btn-primary" href="{{ get_permalink($vendors_page) }}">{{ __('View More Vendors', 'sage') }}</a>
        @endif
      </footer>
    </div>
  </div>
</article>
