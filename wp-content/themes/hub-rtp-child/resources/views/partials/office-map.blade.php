<div class="hub-office-map">
  <a href="#map-information" class="screen-reader-text btn" id="map-jump">{{ __('View Plan Details', 'sage') }}</a>
  <div class="hub-office-map__legend">
    <h2 class="hub-office-map__legend-heading">{{ __('Check Out Our Plans', 'sage') }}</h2>
    <ul class="hub-office-map__legend-items">
      <li class="legend-item legend-item--blue" data-type-target="workspace">{{ __('Workspace', 'sage') }}</li>
      <li class="legend-item legend-item--green" data-type-target="greenspace">{{ __('Greenspace', 'sage') }}</li>
      <li class="legend-item legend-item--purple" data-type-target="hotel">{{ __('Hotel', 'sage') }}</li>
      <li class="legend-item legend-item--light-blue" data-type-target="apartments">{{ __('Apartments', 'sage') }}</li>
      <li class="legend-item legend-item--red" data-type-target="retail">{{ __('Restaurant & Retail', 'sage') }}</li>
    </ul>
    <div class="hub-office-map__legend-filters">
      <h2 class="screen-reader-text">{{ __('Highlight Properties By Development Phase', 'sage') }}</h2>
      <span>
        <button type="button" class="hub-office-map__legend-filter" data-phase-target="1" aria-pressed="true">{{ __('Phase 1', 'sage') }}</button>
      </span>
      <span>
        <button type="button" class="hub-office-map__legend-filter" data-phase-target="2" aria-pressed="true">{{ __('Phase 2', 'sage') }}</button>
      </span>
    </div>
  </div>
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1400 905" role="img" aria-labelledby="mapdesc">
    <desc id="mapdesc">{{ __('Map of Phase 1 & Phase 2 of Hub RTP. A high fidelity rendering of new buildings and greenspace coming to Research Triangle Park.', 'sage') }}</desc>
    <g transform="translate(-1.778 -271)">
      <image width="1400" height="905" transform="translate(1.778 271)" xlink:href="{{ App\asset_path('images/hubmap@2x.png') }}"/>
      <g transform="translate(34.778 305.788)">
        <g class="property" data-hub-property="greenspace" data-type="greenspace" data-phase="1">
          <path d="M621.937,249h0l-9.186-4.594L584.273,233.38l-16.854-2.757H539.258l-39.5-18.376-18.373-11.026L465.764,190.2l-9.186-11.026-14.7-10.107-22.048-9.188-27.56-6.431-21.129-9.188-2.757,1.838-11.023-6.432-15.618-10.107L338.07,126.8l2.756-1.838,22.967-15.62,8.267-7.35.919,2.757,12.862,6.431,3.675-1.838,4.593,2.757,5.512,5.513,6.431,5.513h3.675l6.43,4.595,11.024,4.594,22.048,5.513,41.34,19.3,7.349,6.431,30.316,14.7,6.431,6.431,54.2-3.676,4.593-8.269,30.317-19.295,4.593-7.351,11.024,1.838,20.211,9.188,21.129,11.026,25.722,21.425V200.3l-31.234,20.214-13.78-6.431-14.7,9.6v8.772L621.938,249Zm512.617-.919-88.192-15.62v-3.675l18.374-28.484,7.349-26.645-82.68-26.645-11.024,13.782-1.837,8.269L837.825,129.553l-2.757,2.757c.195.275,19.577,27.586,20.2,27.586.01,0,.015-.007.015-.022,0-.03.018-.045.054-.045,1,0,15.782,11.939,16.411,12.447l54.273,16.083-27.56,23.889-1.838,8.269H875.49l-26.641,1.838-23.886-1.838-15.617-2.756-79.006-35.834-6.43,1.838-31.235-24.809-13.78-7.35-26.641-12.864-1.838-3.675-1.837-1.838,1.837-2.757L661.44,122.2l23.885,11.945,12.862,9.188,7.349,7.35,3.675,5.513,62.469-19.3,6.431-6.432.919-9.188,4.594-2.757.919-6.431,4.593-3.676,2.757-53.291L906.725,91.882l73.494,24.809,77.168,24.808L1186,176.414l-45.015,69.83-6.43,1.838h0ZM186.49,187.439H171.821l-15.647-2.757L117.59,166.307,2.756,85.641,0,82.694l2.756-6.431,45.933-19.3,56.957-39.509L166.279,0l70.737,6.431,105.647,23.89.918,4.594L329.8,43.185l8.268,35.833,26.642,5.513L346.338,101.07l-45.015,28.483-76.249,38.591-32.154,14.7-6.43,4.594Z" transform="translate(0 113.712)"/>
        </g>
        <g class="property" data-hub-property="high_rise_office_phase_2" data-type="workspace" data-phase="2">
          <path d="M3.67,100.723l9.175-3.663L0,21.976,62.388,0,88.078,4.578,101.84,9.157,110.1,72.337,165.146,93.4l1.835,11.9,19.267,8.241L189,152l-59.636-23.807L115.6,134.6v7.325l-7.34,3.663Z" transform="translate(397 0.712)"/>
        </g>
        <g class="property" data-hub-property="high_rise_office_2" data-type="workspace" data-phase="1">
          <path d="M25.684,17.315l-9.173,4.556V24.7l-4.586.89.917,2.661L0,32.806,5.5,41.4v3.714L1.835,47.387,5.5,52.855l2.752,1.823-.917,2.734L3.669,59.234l5.5,5.468.136,3.705L5.5,70.56l7.338,11.8,14.394,3.3L64.211,104.8,97.233,113l16.511-8.2V97.944L122,93.863l-1.835-33.718-2.752-30.984-11.008-5.468L46.782,0,33.023,6.379v7.29Z" transform="translate(479 129.712)"/>
        </g>
        <g class="property" data-hub-property="high_rise_office_1" data-type="workspace" data-phase="1">
          <path d="M0,38.595.916,54.216,3.665,92.811l11,5.514,2.749,31.243,8.247.919,11,5.514,16.495-8.27,6.415,2.757L103,108.432V45.558l-2.2-1.45V11.946l-9.164-1.838L77.891,0Z" transform="translate(583 59.712)"/>
        </g>
        <g class="property" data-hub-property="office_over_retail" data-type="workspace" data-phase="1">
          <path d="M0,79.095l7.32,4.6L0,89.361V99.546L50.327,126,140,54.263V41.128L49.412,0,43.007,1.839,25.621,7.65V18.394L61.307,35.869Z" transform="translate(681 294.712)"/>
        </g>
        <g class="property" data-hub-property="hotel_boutique" data-type="hotel" data-phase="1">
          <path d="M0,28.155,6.471,49.709,28.6,61.675v7.634l93.116,50.359,10.141-.921,22.127,11.046-3.688,3.682L160.435,139l23.97-23.934v-4.153l4.61,1.392L201,99.417V89.549l-9.917-5.971.7-6.253L39.661,1.841l-8.3,7.364L15.691,0,1.861,12.887Z" transform="translate(777 411.712)"/>
        </g>
        <g class="property" data-hub-property="hotel_275" data-type="hotel" data-phase="1">
          <path d="M0,85.172v8.5l10.114,4.324,14.711,8.242,11.953,8.242L50.57,127.3,66.2,121.805l5.517,3.663V132l45.054-13.858,6.436-6.411.919-9.158,4.6-2.747.919-6.411,4.6-3.663L137,36.633V34.156l-4.6-2.1-4.6,1.832L70.8,0,46.893,12.822,45.973,50.37,26.664,61.36l2.7,2.747.06,4.579Z" transform="translate(654 132.712)"/>
        </g>
        <g class="property" data-hub-property="mid_rise_office" data-type="workspace" data-phase="1">
          <path d="M7.337,23.85,5.5,32.105,0,65.128,123.817,122l17.426-16.511,11.006-42.2L155,40.361,71.538,6.421,34.852,0Z" transform="translate(890 301.712)"/>
        </g>
        <g class="property" data-hub-property="residential_phase_2" data-type="apartments" data-phase="2">
          <path d="M2.751,8.284,12.84,54.307l.917,4.6L0,67.193l8.254,35.9,19.667,4.084L43.107,96.648l4.115,21.17-5.032,2.761V126.1l.917,2.761,12.84,6.443,3.669-1.841,4.586,2.761,5.5,5.523,6.42,5.523h3.669l6.42,4.6,11.006,4.6L119.231,162V151.55l4.586-2.436L121.162,126.1l9.074-3.682L73.373,94.807l43.107-19.33L155,92.966l-3.669-5.523,3.669-2.3V81.391L121.982,65.352,118.314,39.58,97.219,31.3,71.538,43.261,66.953,18.653,24.763,0Z" transform="translate(329 89.712)"/>
        </g>
        <g class="property" data-hub-property="residential_phase_1" data-type="apartments" data-phase="1">
          <path d="M201.48,221h0l-18.4-9.207-7.36,6.446-10.12-2.762L1.84,111.421,0,86.558,8.28,80.08v-10.1L76.36,13.812H78.2v-4.6L90.16,0,96.6,3.684l2.76-1.842,26.692,14.125-.932,25.472,10.12-.921V36.833l11.039-8.287,33.12,17.5-1.84,23.942-1.84,2.763,14.72-.921v-4.6l11.04-9.209,29.44,16.575.92,2.762,4.6,2.763-.92,23.021,34.04,20.258-.92,1.841,7.36,4.6-2.76,14.733ZM79.12,40.517,29.407,82.875,189.52,183.245l47.839-51.566L79.12,40.517Z" transform="translate(643 463.712)"/>
          <path d="M155.464,184h0L23.185,97.951l-1.837-3.662-4.594,2.746L4.812,88.8,0,65.452,3.894,63.14V60.418l7.348-4.434v-3.8L85.65,6.408l3.675.915L103.232,0,107.7,2.746,109.964.915l9.426,5.493.249,1.831,127.687,71.4v1.831L251,84.219l-.919,24.716L155.464,184ZM106.779,50.349,93,52.179v2.462L71.871,69.572l72.57,44.856v3.056h14.895l1.641-4.887,16.535-12.816,4.593,1.831V99.37L107.7,54.925Z" transform="translate(435 361.712)"/>
          <path d="M136.474,143l-28.5-19.036-.73-2.965L104.3,118.25l-3.677-11.917L88.158,99l-2.245-3.667H78.559L68.17,99H62.931L52.819,93.5,49.142,77l-7.355-6.417H34.433L24.321,75.167l-17.466-11L0,41.782,79.478,1.833l4.6,3.667L96.026,0l34.014,20.166,4.6,2.75,4.6-.917,7.355-3.667,2.758-1.833,15.628,10.084,2.758,12.833L193.47,55l.92,2.75h9.193l9.193-5.5,17.467,10.083L233,79.75l-7.355,4.129V97.167l-19.3,10.084-15.628-9.167-.92-3.667-11.95,2.227V99l-13.79,8.25,3.677,18.333L136.474,143ZM92.348,21.083,48.222,41.25l77.221,48.584,45.965-24.75-79.06-44Z" transform="translate(221 241.712)"/>
        </g>
        <g class="property" data-hub-property="restaurant_retail" data-type="retail" data-phase="1">
          <path d="M417.166,356h0l-23.889-11-4.612-19.76,1.677-4.738,4.773,15.93,22.053,11.95V356Zm-75.348-51.744h0L292.2,277.628v-8.085l-7.384,4.042h0l-51.423-26.321V237.154L258.2,220.608v-8.777l14.7-9.607,13.783,6.435,35.562,19.358L292.2,249.1l7.35,4.6-7.35,5.665v10.18l50.538,26.439,90.049-71.7v8.732l-90.967,71.239Zm78.1-8.273h0l-5.131-3.02,53.832-45.7L487,257.377l-45.9,37.67-12.91-6.418-8.269,7.353Zm-402-9.193v0h0l-17-10.109L0,269.326l35.836-21.142,17.458,9.907v7.558Zm327.275-74.876h0L317.929,199.93V188.436L353.764,205.9l-8.57,6.013ZM146.1,172.81h0l-6.431-6.435-30.323-14.707-7.351-6.434-41.349-19.3V115.5l12.864,7.678,27.681,11.03,6.735,5.515,28.986,14.707-11.946-12.869.918-2.636,26.189,12.954,41.808-2.245,15.285-9.91v4.745l-3.339,6.286,29.4-17.465v8.273l-30.323,19.3-4.594,8.273L146.1,172.81h0Zm178.225-33.091h0L317.01,134.2l15.62-5.515,5.513,3.676v6.556l-5.737-1.959-8.081,2.757Zm-74.393-28.5h0l-15.534-7.63-1-2.48h-1.838l-18.7-8.74-.424-7.862,17.287,7.41,4.367-1.838v3.182l15.848,6.929,6.432-3.676v10.445l-6.432,4.261ZM92.5,39.182h0L63.14,27.576l-.947-6.63L95.315,35.215l-4.347,1.553L92.5,39.179ZM16.629,5.605h0L15.62,0l7.139,2.758L16.631,5.6Z" transform="translate(388 124.712)"/>
        </g>
      </g>
    </g>
  </svg>
  <figure class="hub-office-map__mobile">
    <img src="{{ App\asset_path('images/hubmap.png') }}" alt="{{ __('Map of Phase 1 & Phase 2 of Hub RTP. A high fidelity rendering of new buildings and greenspace of future Hub RTP development coming to Research Triangle Park.') }}" />
  </figure>
</div>

@if ($hub_properties = get_field('office_map_properties', 'option'))
  @foreach ($hub_properties as $property)
    <div id="tippy_{{ $property['id'] }}" style="display:none;">
      <div class="map-tooltip">
        <h2 class="map-tooltip__heading">{{ $property['title'] }}</h2>
        @if ($property['sqft'])
          <span class="map-tooltip__sqft">
            <span class="screen-reader-text">{{ __('Rentable Square Feet: ', 'sage') }}</span>{!! $property['sqft'] !!}</span>
        @endif
        @if ($property['tooltip'])
          <div class="map-tooltip__text">
            <div>{!! $property['tooltip'] !!}</div>
          </div>
        @endif
      </div>
    </div>
  @endforeach
@endif
