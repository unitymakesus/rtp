@if ($announcement = App::globalSiteAnnouncement())
  <div class="announcement announcement--alert" role="alert" aria-live="polite">
    <div class="container-wide text-center">
      {!! $announcement !!}
    </div>
  </div>
@endif
