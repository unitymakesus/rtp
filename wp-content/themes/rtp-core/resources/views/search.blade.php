@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @php
    $network_index_results = network_query_posts([
      's'              => $_GET['s'],
      'posts_per_page' => get_option('paged'),
      'paged'          => get_query_var('paged') ?? 1,
    ]);
  @endphp
  @if(!$network_index_results)
    <div class="container entry-content">
      <p class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </p>
      {!! get_search_form(false) !!}
    </div>
  @endif

  <div class="container flex-grid l3x m2x">
    @php global $post @endphp
    @foreach($network_index_results as $result)
      @php
        $post = $result;
        setup_postdata($post);
        switch_to_blog($post->BLOG_ID);
      @endphp
      <div class="flex-item">
        @include('partials.content-search')
      </div>
      @php restore_current_blog(); @endphp
    @endforeach
    @php wp_reset_postdata(); @endphp
  </div>

  @php
    the_posts_pagination([
      'prev_text' => '&laquo; Previous <span class="screen-reader-text">page</span>',
      'next_text' => 'Next <span class="screen-reader-text">page</span> &raquo;',
      'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
    ]);
  @endphp
@endsection
