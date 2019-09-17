jQuery(document).ready(function($) {

  mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

	// Initiatlize Map
	var map = new mapboxgl.Map({
    container: 'location-map',
    style: 'mapbox://styles/abtadmin/ck0g04m970j6r1dqniis57oq1',
		center: ['-78.865','35.892'],
		zoom: 12,
	});

  var post_type = $('#location-map').attr('data-post-type');
  var feature_type = $('#location-map').attr('data-feature-type');

  map.on('load', function() {
    // Placeholder for data that's coming from AJAX response
    map.addSource('locations', {
      type: 'geojson',
      data: {
        "type": "FeatureCollection",
          "features": [{
            "type": "Feature",
            "properties": {},
            "geometry": {
            "type": "Point",
            "coordinates": []
          }
        }]
      }
    });

    // Add geoJSON source for location
    $.ajax({
      url: rtp_dir_vars.ajax_uri,
      type: 'POST',
      data: {
        action: 'get_this_location',
        location_id: $('#location-map').attr('data-location-id'),
        post_type: post_type,
        _ajax_nonce: rtp_dir_vars._ajax_nonce
      }
    })
    .done(function(response, textStatus, jqXHR) {
      // console.log(response);
      let location = JSON.parse(response),
          prop = location.features[0].properties,
          coords = location.features[0].geometry.coordinates,
          mapCenter = ['-78.865','35.892'],
          popCenter = [],
          zoom = 12;

      // Add data to locations data source on map
      map.getSource('locations').setData(location);

      if (feature_type == 'Polygon') {

        // Get bounding box of polygons
        let bounds = coords[0].reduce(function(bounds, coord) {
          return bounds.extend(coord);
        }, new mapboxgl.LngLatBounds(coords[0][0], coords[0][0]));
        map.fitBounds(bounds, {padding: 50, maxZoom: 13});

        // Set popup center
        popCenter = bounds.getCenter();

      } else if (feature_type == 'LineString') {

        // Get bounding box of linestrings
        let bounds = coords.reduce(function(bounds, coord) {
          return bounds.extend(coord);
        }, new mapboxgl.LngLatBounds(coords[0], coords[0]));
        map.fitBounds(bounds, {padding: 50});

      } else if (feature_type == 'Point') {

        // Set popup center
        popCenter = coords;
        // Zoom to point
        map.flyTo({
          center: coords,
          zoom: 13
        });

      }

      if (feature_type !== 'LineString' && post_type !== 'rtp-site') {
        // Build tooltip HTML
        var logo_photo = (prop.logo ? prop.logo : prop.photo);
        var image = (logo_photo ? '<div class="tooltip-logo"><img src="' + logo_photo + '" alt="' + prop.title + '"/></div>' : '');
        var related_facility = (prop.related_facility ? prop.related_facility + '<br />' : '');
        var street_address = (prop.street_address ? prop.street_address + '<br />' + (prop.suite_or_building ? prop.suite_or_building + '<br />' : '') + 'RTP, NC ' + (prop.zip_code ? prop.zip_code : '27709') : '');
        var tooltip = '<div class="tooltip">' +
                        '<p class="title">' + prop.title + '</p>' +
                        '<p class="address">' +
                          related_facility +
                          street_address +
                        '</p>' +
                      '</div>';
        new mapboxgl.Popup({closeOnClick: false})
          .setLngLat(popCenter)
          .setHTML(tooltip)
          .addTo(map)
          .on('open', function(e) {
            // Is this even firing???
            // console.log('e', e);
            // var px = map.project(e.popup._latlng); // find the pixel location on the map where the popup anchor is
            // px.y -= e.popup._container.clientHeight/2 // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
            // map.panTo(map.unproject(px),{animate: true}); // pan to new center
          });
      }

      // Remove loading animation
      $('#location-map').addClass('loaded');
    });

    // Add line styles to map
    map.addLayer({
      'id': 'lines',
      'type': 'line',
      'source': 'locations',
      'layout': {
        'line-join': 'round',
        'line-cap': 'round'
      },
      'paint': {
        'line-color': '#000000',
        'line-width': 2,
        'line-dasharray': [1,3]
      },
      'filter': ['all',['==', '$type', 'LineString']]
    });

    // Add polygon styles (inactive states) to map
    map.addLayer({
      'id': 'polygon-fills',
      'type': 'fill',
      'source': 'locations',
      'layout': {},
      'paint': {
        'fill-color': ['get', 'color'],
        'fill-opacity': ['get', 'opacity']
      },
      'filter': ['all',['==', '$type', 'Polygon'],['==', 'content-type', 'rtp-facility']]
    });

    // Add patterned polygon styles (inactive states) to map
    map.loadImage(rtp_dir_vars.pattern_forsale, function(error, data) {
      if (error) throw error;
      map.addImage('pattern_forsale', data);
      map.addLayer({
        'id': 'polygon-pattern-fills',
        'type': 'fill',
        'source': 'locations',
        'layout': {},
        'paint': {
          'fill-pattern': 'pattern_forsale',
          'fill-opacity': 0.6,
          'fill-outline-color': '#333F48'
        },
        'filter': ['all',['==', '$type', 'Polygon'],['==', 'content-type', 'rtp-site']]
      });
    });

    // Add polygon outline styles (hover states) to map
    map.addLayer({
      'id': 'polygon-outlines',
      'type': 'line',
      'source': 'locations',
      'layout': {},
      'paint': {
        'line-color': ['get', 'hover-color'],
        'line-width': 1
      },
      'filter': ['all',['==', '$type', 'Polygon']]
    });

    // Add recreation styles to map
    map.loadImage(rtp_dir_vars.marker_recreation, function(error, data) {
      if (error) throw error;
      map.addImage('recreation', data);
      map.addLayer({
        'id': 'recreation',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'recreation',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['any', ['==', 'facility-type', 'recreation'],['==', 'facility-type', 'trail']]]
      });
    });

    // Add for sale point styles to map
    map.loadImage(rtp_dir_vars.marker_forsale, function(error, data) {
      if (error) throw error;
      map.addImage('forsale', data);
      map.addLayer({
        'id': 'forsale',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'forsale',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'availability-for-sale', 'true']]
      });
    });

    // Add for lease point styles to map
    map.loadImage(rtp_dir_vars.marker_forlease, function(error, data) {
      if (error) throw error;
      map.addImage('forlease', data);
      map.addLayer({
        'id': 'forlease',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'forlease',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'availability-for-lease', 'true']]
      });
    });

    // Add company styles to map
    map.loadImage(rtp_dir_vars.marker_company, function(error, data) {
      if (error) throw error;
      map.addImage('company', data);
      map.addLayer({
        'id': 'companies',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'company',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-company']]
      });
    });
  });
});
