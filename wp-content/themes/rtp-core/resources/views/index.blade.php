@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="container entry-content">
      <p class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </p>
      {!! get_search_form(false) !!}
    </div>
  @endif

  <div class="container flex-grid l3x m2x">
    @while (have_posts()) @php the_post() @endphp
      <div class="flex-item">
        @include('partials.content-'.get_post_type())
      </div>
    @endwhile
  </div>

  @php
    the_posts_pagination([
      'prev_text' => '&laquo; Previous <span class="screen-reader-text">page</span>',
      'next_text' => 'Next <span class="screen-reader-text">page</span> &raquo;',
      'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
    ]);
  @endphp
@endsection
