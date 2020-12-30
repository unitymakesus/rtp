<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="screen-reader-text">{{ __('Search for:', 'sage') }}</span>
    <input
      name="s"
      type="search"
      class="search-field browser-default"
      placeholder="{{ __('Search …') }}"
      value="{{ get_search_query() }}"
      autocomplete="off"
      required
    />
  </label>
  <button type="submit" class="search-submit">
    <span class="screen-reader-text">{{ __('Submit', 'sage') }}</span>
  </button>
</form>
