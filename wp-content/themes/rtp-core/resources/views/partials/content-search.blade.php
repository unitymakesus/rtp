@php
$classes = [
  'excerpt',
  'no-image',
  'figure-card',
  'badge-' . strtolower(Content::siteBadge())
];
@endphp
<article {!! post_class(implode(' ', $classes)) !!}>
  <a tabindex="-1" aria-hidden="true" class="mega-link" href="{{ get_permalink() }}"></a>

  <div class="card" itemprop="description">
    <div class="card-inner">
      <div class="card-badge"><span>{{ Content::siteBadge() }}</span></div>
      <h3 class="card-title" itemprop="name"><a href="{{ get_permalink() }}">@php relevanssi_the_title() @endphp</a></h3>
      <div class="entry-summary">
        @php the_excerpt() @endphp
      </div>
      <div class="card-cta"><a tabindex="-1" href="{{ get_permalink() }}">Read More <span class="arrow">@svg('arrow-right')</span></a></div>
    </div>
  </div>
</article>
