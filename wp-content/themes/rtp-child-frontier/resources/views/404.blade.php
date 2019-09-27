@extends('layouts.app')

@section('content')

  <header class="page-header">
    <div class="container">
      <h1>You managed to find a page that does not exist.</h1>
    </div>
  </header>

  @if (!have_posts())
    <div class="entry-content container">
      <div class="alert alert-warning">
        <blockquote class="h3">
          <p>"I'm stranded in space, I'm lost without trace."</p>
          <cite>- Iron Maiden, "The Final Frontier"</cite>
        </blockquote>
      </div>

      <p>Are you looking for a place to plant your flag?</p>
      <p><a class="btn" href="/lease-space/">Check out our spaces for lease</a></p>
    </div>
  @endif
@endsection
