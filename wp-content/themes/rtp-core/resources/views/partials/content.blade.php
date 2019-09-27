@php
$classes = [
  'figure-card',
  'badge-' . strtolower(Content::siteBadge())
];
@endphp
<article {!! post_class(implode(' ', $classes)) !!}>
  <a tabindex="-1" aria-hidden="true" class="mega-link" href="{{ get_permalink() }}"></a>

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
      <h3 class="card-title" itemprop="name"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h3>

      <div class="card-cta"><a tabindex="-1" href="{{ get_permalink() }}">Read More <span class="arrow">@svg('arrow-right')</span></a></div>
    </div>
  </div>
  <div class="pattern-background">@svg('pattern-bracket')</div>
</article>
