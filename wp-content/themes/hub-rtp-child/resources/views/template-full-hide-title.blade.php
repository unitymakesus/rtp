{{--
  Template Name: Full Width Hide Title
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article {!! post_class('full-container') !!}>
      <h1 class="screen-reader-text">{{ App::title() }}</h1>
      @include('partials.content-page')
    </article>
  @endwhile
@endsection
