@extends('layouts.app')

@section('content')

  <header class="page-header">
    <div class="container">
      <h1>You've discovered a page that does not exist.</h1>
    </div>
  </header>

  @if (!have_posts())
    <div class="entry-content container">
      <div class="alert alert-warning">
        <blockquote class="h3">
          <p>"The very nature of science is discoveries, and the best of those discoveries are the ones you don't expect."</p>
          <cite>- Neil deGrasse Tyson</cite>
        </blockquote>
      </div>
      <p>You can make a difference in a child's life today by helping them discover careers in STEM.</p>
      <p><a class="btn" href="/volunteer/">Volunteer Opportunities</a></p>
    </div>
  @endif
@endsection
