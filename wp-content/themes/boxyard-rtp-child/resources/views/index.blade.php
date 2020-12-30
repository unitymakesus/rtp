@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="container-wide entry-content">
      <p class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </p>
    </div>
  @endif

  <div class="container-wide">
    <div class="figure-card-grid">
      @while (have_posts()) @php the_post() @endphp
        @include('partials.content-'.get_post_type(), [
          'classes' => [
            'figure-card',
            'badge-' . strtolower(Content::siteBadge())
          ],
        ])
      @endwhile
    </div>
  </div>

  @php
    the_posts_pagination([
      'prev_text'          => '&laquo; Previous <span class="screen-reader-text">page</span>',
      'next_text'          => 'Next <span class="screen-reader-text">page</span> &raquo;',
      'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
    ]);
  @endphp
@endsection
