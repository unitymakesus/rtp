@php

$announcement = App::localSiteAnnouncement();
$headcount = get_field('local_coworking_floor_headcount', 'option');

@endphp

@if ($announcement || $headcount)
  <div class="announcement announcement--notice">
    <div class="container">
      @if (!empty($announcement))
        {!! $announcement !!}
      @endif
      @if ($headcount)
        <div class="announcement__headcount">
          <strong>{{ __('Remaining Coworking Seats Available: ', 'sage') }}</strong>
          <span class="announcement__headcount-num">{{ $headcount }}</span>
        </div>
      @endif
    </div>
  </div>
@endif
