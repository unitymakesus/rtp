jQuery(document).ready(function($) {

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

  	// Initiatlize Map
  	var map = new mapboxgl.Map({
      container: 'location-map',
      style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
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
          var related_facility = (prop.related_facility ? '<strong>' + prop.related_facility + '</strong><br />' : '');
          var suite_or_building = (prop.suite_or_building ? prop.suite_or_building + '<br />' : '');
          var street_address = (prop.street_address ? prop.street_address + '<br />RTP, NC ' + prop.zip_code : '');
          var tooltip = '<div class="tooltip">' +
                          '<p class="title">' + prop.title + '</p>' +
                          '<p class="address">' +
                            related_facility +
                            suite_or_building +
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

      // Add polygon styles to map
      map.addLayer({
        'id': 'polygon-fills',
        'type': 'fill',
        'source': 'locations',
        'layout': {},
        'paint': {
          'fill-color': ['get', 'color'],
          'fill-opacity': ['get', 'opacity']
        },
        'filter': ['all',['==', '$type', 'Polygon']]
      });

      // Add polygon outline styles to map
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
          'line-color': '#07444C',
          'line-width': 2,
          'line-dasharray': [0,2]
        },
        'filter': ['all',['==', '$type', 'LineString']]
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

      // Add real estate point styles to map
      map.loadImage(rtp_dir_vars.marker_realestate, function(error, data) {
        if (error) throw error;
        map.addImage('realestate', data);
        map.addLayer({
          'id': 'realestate',
          'type': 'symbol',
          'source': 'locations',
          'layout': {
            'icon-image': 'realestate',
            'icon-size': 0.5,
            'icon-allow-overlap': true
          },
          'filter': ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-space']]
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


    // Stick map to fixed position when it reaches top of screen on scroll
    var $window = $(window);
    if ($('#location-map.directory-map').length) {
      let distance = $('#location-map.directory-map').offset().top;

      $window.scroll(function() {
        if ( $window.scrollTop() >= distance ) {
          $('#location-map.directory-map').addClass('fixed');

        } else {
          $('#location-map.directory-map').removeClass('fixed');
        }
      });
    }
});
