{{--
  Template Name: 2019 Community Impact Report
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article class="full-container" {!! post_class() !!}>
      @include('partials.content-page')
    </article>
  @endwhile
@endsection
