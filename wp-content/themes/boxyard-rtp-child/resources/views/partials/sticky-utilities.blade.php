<div class="sticky-utilities">
  <button class="sticky-utilities__toggle" data-template="sticky-general-info">
    <span class="screen-reader-text">{{ __('View Boxyard RTP General Info', 'sage') }}</span>
    <svg class="sticky-utilities__toggle-icon" viewBox="0 0 25.709 25.709"><path d="M12.855,0A12.855,12.855,0,1,0,25.709,12.855,12.869,12.869,0,0,0,12.855,0Zm.836,20.481c-.611.1-1.826.356-2.443.407A1.5,1.5,0,0,1,9.932,20.2a1.606,1.606,0,0,1-.195-1.471l2.43-6.681H9.641a3.02,3.02,0,0,1,2.378-2.809,9.3,9.3,0,0,1,2.443-.4,1.938,1.938,0,0,1,1.316.685,1.606,1.606,0,0,1,.195,1.471l-2.43,6.681h2.526a2.844,2.844,0,0,1-2.377,2.806Zm.771-12.447a1.607,1.607,0,1,1,1.607-1.607,1.607,1.607,0,0,1-1.607,1.607Z"/></svg>
  </button>
  <button class="sticky-utilities__toggle" data-template="sticky-spotify">
    <span class="screen-reader-text">{{ __('Listen To Boxyard RTP Spotify Playlist', 'sage') }}</span>
    <svg class="sticky-utilities__toggle-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
  </button>
</div>

<div style="display: none;">
  @if ($general_info = get_field('sticky_general_info', 'option'))
    <div id="sticky-general-info">
      {!! $general_info !!}
    </div>
  @endif
  @if ($spotify = get_field('sticky_spotify', 'option'))
    <div id="sticky-spotify">
      {!! $spotify !!}
    </div>
  @endif
</div>
