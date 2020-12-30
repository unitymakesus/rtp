@if ($announcement = App::localSiteAnnouncement())
  <div class="announcement announcement--notice">
    <div class="container">
      {!! $announcement !!}
    </div>
  </div>
@endif
