{{--
  Template Name: Vendors
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article {!! post_class('full-container') !!}>
      @php
        $vendors = get_posts([
          'post_type'   => 'vendor',
          'numberposts' => -1,
          'order'       => 'ASC',
          'orderby'     => 'title',
        ]);
      @endphp
      @include('partials.content-vendor-map', [
        'vendors' => $vendors,
      ])
      @include('partials.content-vendor-list', [
        'vendors' => $vendors,
      ])
    </article>
  @endwhile
@endsection
