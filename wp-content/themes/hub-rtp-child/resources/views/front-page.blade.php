@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <article {!! post_class() !!}>
    <h1 class="screen-reader-text">{{ get_bloginfo('name', 'display') }}</h1>
    @php the_content() @endphp
  </article>
  @endwhile
@endsection
