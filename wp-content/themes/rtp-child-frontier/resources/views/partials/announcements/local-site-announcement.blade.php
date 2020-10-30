@if ($announcement = App::localSiteAnnouncement())
  <div class="announcement announcement--notice">
    <div class="container">
      {!! $announcement !!}

      @if ($headcount = get_field('local_coworking_floor_headcount', 'option'))
        <div class="announcement__headcount">
          <strong>{{ __('Remaining Coworking Seats Available: ', 'sage') }}</strong>
          <span class="announcement__headcount-num">{{ $headcount }}</span>
        </div>
      @endif
    </div>
  </div>
@endif
