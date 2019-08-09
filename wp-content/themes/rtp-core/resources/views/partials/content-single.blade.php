<article {!! post_class() !!}>
  <header class="page-header" style="background-image: url('http://files.rtp.org/wp-content/uploads/sites/2/2019/07/31151808/IMG_9572.jpg')">
    <div class="container">
      <div class="entry-title-container">
        <h1 class="entry-title">{!! get_the_title() !!}</h1>
      </div>
    </div>
  </header>
  <div class="entry-content container">
    <div class="row">
      <div class="col m4 s12">
        @if (has_post_thumbnail())
          @php
            $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            $thumb_caption = get_the_post_thumbnail_caption(get_the_ID());
          @endphp
          <figure class="post-thumbnail">
            {!! get_the_post_thumbnail( get_the_ID(), 'large', ['alt' => $alt] ) !!}
            @if (!empty($thumb_caption))
              <figcaption class="thumb-caption">{!! $thumb_caption !!}</figcaption>
            @endif
          </figure>
          @include('partials/entry-meta')
        @endif
      </div>

      <div class="col m8 s12">
        @php the_content() @endphp
        <footer>
          {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
        </footer>
      </div>
    </div>
  </div>
</article>
