{{--
  Template Name: Map Playground
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @php echo do_shortcode('[hub-office-map]') @endphp
  @endwhile
@endsection
