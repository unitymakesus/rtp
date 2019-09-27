@extends('layouts.app')

@section('content')

  <header class="page-header">
    <div class="container">
      <h1>Didn't mean to box you out.</h1>
    </div>
  </header>

  @if (!have_posts())
    <div class="entry-content container">
      <div class="alert alert-warning">
        <p>You managed to find a page that does not exist.</p>
      </div>
      
      <p>Ready to think inside the box? Get in touch for more details.</p>
      <p><a class="btn" href="/#contact">Reach our inBOX</a></p>
    </div>
  @endif
@endsection
