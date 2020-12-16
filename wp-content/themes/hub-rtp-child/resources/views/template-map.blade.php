{{--
  Template Name: Map Playground
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.office-map')
  @endwhile
@endsection
