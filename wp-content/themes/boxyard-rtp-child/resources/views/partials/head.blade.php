<head>
  @if (!is_user_logged_in() && wp_get_environment_type() === 'production')
    @include('partials.gtm-head')
  @endif
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="dns-prefetch" href="//fonts.googleapis.com" />
  @php wp_head() @endphp
</head>
