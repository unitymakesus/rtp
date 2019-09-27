@extends('layouts.app')

@section('content')

  <header class="page-header">
    <div class="container">
      <h1>We’re pushing the boundaries for what it means to be a research park.</h1>
    </div>
  </header>

  @if (!have_posts())
    <div class="entry-content container">
      <div class="alert alert-warning">
        <p>You just happened to reach the boundary of our website.</p>
      </div>
      <p><a class="btn" href="/">Learn more about Hub RTP</a></p>
    </div>
  @endif
@endsection
