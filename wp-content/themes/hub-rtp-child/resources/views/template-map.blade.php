{{--
  Template Name: Map Playground
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <h1 class="screen-reader-text">{{ App::title() }}</h1>
    @include('partials.content-page')
  @endwhile
@endsection
