<article class="figure-card">
  @if (has_post_thumbnail())
    @php
      $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
      $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    @endphp
    {!! get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => $alt, 'itemprop' => 'image'] ) !!}
  @else
    <div class="placeholder"></div>
  @endif

  <div class="card card-cta card-pattern" itemprop="description">
    <div class="badge"><span>{{ Content::siteBadge() }}</span></div>
    <div class="meta">
      <time class="date updated published" datetime="{{ get_post_time('c', true) }}" itemprop="datePublished">{{ get_the_date('F j, Y') }}</time>
    </div>
    <h3 class="card-title" itemprop="name"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h3>

    <div class="cta"><a href="{{ get_permalink() }}">Read More <span class="arrow">@svg('arrow-right')</span></a></div>

    <div class="pattern-background">
      <svg class="pattern-brackets">
        <defs>
          <pattern id="brackets" x="13" y="13" width="30" height="30" patternUnits="userSpaceOnUse">
            <clipPath id="clip-path">
              <polygon class="cls-1" points="21.25 18.24 21.25 21.25 18.24 21.25 18.24 22.22 22.22 22.22 22.22 18.24 21.25 18.24"></polygon>
            </clipPath>
            <clipPath id="clip-path-2">
              <polygon class="cls-1" points="5.9 8.9 5.9 5.9 8.91 5.9 8.91 4.93 4.93 4.93 4.93 8.9 5.9 8.9"></polygon>
            </clipPath>
            <g class="cls-3" clip-path="url(#clip-path)">
              <rect x="13.75" y="13.75" width="13.32" height="13.32" fill="white"></rect>
            </g>
            <g class="cls-4" clip-path="url(#clip-path-2)">
              <rect x="0.07" y="0.07" width="13.68" height="13.68" fill="white"></rect>
            </g>
          </pattern>
          <linearGradient id="rtp-gradient" x1="0" x2="100%" y1="0" y2="0" gradientUnits="userSpaceOnUse">
            <stop stop-color="#4B9CD3" offset="0%"></stop>
            <stop stop-color="#012169" offset="33%"></stop>
            <stop stop-color="#82052A" offset="66%"></stop>
            <stop stop-color="#CC0000" offset="99%"></stop>
          </linearGradient>
        </defs>

        <mask id="brackets-mask">
          <rect x="0" y="0" width="1000" height="1000" fill="url(#brackets)"></rect>
        </mask>
        <rect x="0" y="0" width="100%" height="100%" fill="url(#rtp-gradient)" mask="url(#brackets-mask)"></rect>
      </svg>
    </div>
  </div>
</article>
