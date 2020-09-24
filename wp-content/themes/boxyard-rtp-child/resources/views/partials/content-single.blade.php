<article {!! post_class() !!}>
  @include('partials.page-header')
  <div class="entry-content container-wide">
    <div class="row">
      <div class="col m4 s12">
        @if (has_post_thumbnail())
          @php
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            $thumb_caption = get_the_post_thumbnail_caption(get_the_ID());
          @endphp
          <figure class="post-thumbnail">
            {!! get_the_post_thumbnail( get_the_ID(), 'large', ['alt' => $alt] ) !!}
            @if (!empty($thumb_caption))
              <figcaption class="thumb-caption">{!! $thumb_caption !!}</figcaption>
            @endif
          </figure>
        @endif
        @include('partials/entry-meta')
      </div>
      <div class="col m8 s12">
        @php the_content() @endphp
      </div>
    </div>
  </div>
</article>
