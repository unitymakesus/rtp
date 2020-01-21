<article {!! post_class() !!} itemtype="http://schema.org/Person">
  <header class="page-header">
    <div class="texture"></div>
    <div class="container">
      <div class="entry-title-container">
        <h1 class="entry-title" itemprop="name">{!! get_the_title() !!}</h1>
        <h2 class="job-title" itemprop="jobTitle">{{ get_field('job_title') }}</h2>
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

          @if (!empty($phone = get_field('phone_number')) || !empty($email = get_field('email')))
            <div class="meta">
              <h3>Contact Info</h3>
              @if (!empty($phone))
                @php
                  $phone_raw = preg_replace('/[\.-]/m', '', $phone);
                @endphp
                <div class="contact">
                  <span class="icon">
                    <span class="screen-reader-text">Phone Number:</span>
                    @svg('icon-phone')
                  </span>
                  <a itemprop="telephone" target="_blank" rel="noopener" href="tel:+1{{ $phone_raw }}">{{ $phone }}</a>
                </div>
              @endif

              @if (!empty($email))
                <div class="contact">
                  <span class="icon">@svg('icon-mail')</span>
                  <a itemprop="email" target="_blank" rel="noopener" href="mailto:{!! eae_encode_emails($email) !!}">Email Me</a>
                </div>
              @endif
            </div>
          @endif
        @endif
      </div>

      <div class="col m8 s12">
        @php the_content() @endphp
      </div>
    </div>
  </div>
</article>
