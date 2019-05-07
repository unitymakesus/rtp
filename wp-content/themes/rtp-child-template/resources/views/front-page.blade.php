@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <article {!! post_class() !!}>

      <div id="landing-graphic" class="landing-graphic">
        <svg id="svg-text" viewBox="0 0 324 132">
          <defs>
            <linearGradient id="rtp-gradient" x1="0" x2="100%" y1="0" y2="0" gradientUnits="userSpaceOnUse" >
              <stop stop-color="#4B9CD3" offset="0%"/>
              <stop stop-color="#012169" offset="25%"/>
              <stop stop-color="#82052A" offset="50%"/>
              <stop stop-color="#CC0000" offset="75%"/>
            </linearGradient>
          </defs>
          <text fill="url(#rtp-gradient)">
            <tspan id="svg-where" font-size="40" x="10" y="40">Where</tspan>
            <tspan id="svg-people" font-size="40" x="10" dy="35">People</tspan>
            <tspan id="svg-plus" font-size="40" dx="0" dy="0">+</tspan>
            <tspan id="svg-ideas" font-size="40" dx="0" dy="0">Ideas</tspan>
            <tspan id="svg-convene" font-size="40" x="10" dy="35">Convene</tspan>
          </text>
        </svg>
      </div>

      <section class="placeholder"></section>

    </article>
  @endwhile
@endsection
