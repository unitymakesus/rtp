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
  </div>
</article>
