<article {!! post_class(implode(' ', $classes)) !!}>
  @if (has_post_thumbnail())
    @php
      $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
      $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    @endphp
    {!! get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => $alt, 'itemprop' => 'image'] ) !!}
  @else
    <div class="placeholder"></div>
  @endif
  <div class="card" itemprop="description">
    <div class="meta">
      <time class="date updated published" datetime="{{ get_post_time('c', true) }}" itemprop="datePublished">{{ get_the_date('F j, Y') }}</time>
    </div>
    <div class="card-inner">
      <div class="card-badge"><span>{{ Content::siteBadge() }}</span></div>
      <h2 class="card-title h4" itemprop="name">
        <a class="a11y-link-wrap" href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
      </h2>
      <div class="card-cta" aria-hidden="true">Read More <span class="arrow">@svg('arrow-right')</span></div>
    </div>
  </div>
  <div class="pattern-background">@svg('pattern-bracket')</div>
</article>
