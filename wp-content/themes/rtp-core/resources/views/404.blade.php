@extends('layouts.app')

@section('content')

  <header class="page-header">
    <div class="container">
      <h1>RTP is known for discoveries</h1>
    </div>
  </header>

  @if (!have_posts())
    <div class="entry-content container">
      <div class="alert alert-warning">
        <p>Looks like you've discovered a page that does not exist. Try searching for it below.</p>
      </div>
      {!! get_search_form(false) !!}
    </div>
  @endif
@endsection
