jQuery(document).ready(function($) {

  mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

	// Initiatlize Map
	var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/abtadmin/ck0g04m970j6r1dqniis57oq1',
		center: ['-78.865','35.892'],
		zoom: 12
	});

  // console.log('Map Init');

	// Arrays of map objects used to filter against.
	var pointLayers = ['recreation','companies','forsale','forlease']; // Array cats
  var polyLayers = ['polygon-fills', 'polygon-pattern-fills']; // Array shapes
  var lineLayers = ['lines']; // Array of trails
  var allLayers = pointLayers.concat(polyLayers).concat(lineLayers);

  // Set up initial filters for each layer (to apply correct styles)
  var recreationFilter = ['all',['==', '$type', 'Point'],['any', ['==', 'facility-type', 'recreation'],['==', 'facility-type', 'trail']]];
  var companyFilter = ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-company']];
  var forsaleFilter = ['all',['==', 'availability-for-sale', 'true']];
  var forleaseFilter = ['all',['==', 'availability-for-lease', 'true']];
  var polyFillFilter = ['all',['==', '$type', 'Polygon'],['==', 'content-type', 'rtp-facility']];
  var polyPatternFillFilter = ['all',['==', '$type', 'Polygon'],['==', 'content-type', 'rtp-site']];
  var polyFillHoverFilter = ['all',['==', 'hover_id', '']];
  var polyLinesFilter = ['all',['==', '$type', 'Polygon']];
  var lineFilter = ['all',['==', '$type', 'LineString']];

  // Variable for holding currently active tooltip/popup
  var popup;

  // Get facets on page load
  var facets = FWP.facets;

  // console.log('Facets Init');

	map.on('load', function() {

    // console.log('Map Loaded');

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

    // console.log('Map Source Holder');

		// Add geoJSON source for locations
  	$.ajax({
      url: rtp_dir_vars.ajax_uri,
      cache: false,
      data: {
    		action: 'get_locations',
        _ajax_nonce: rtp_dir_vars._ajax_nonce
    	}
    }).done(function(response, textStatus, jqXHR) {
      // console.log('Locations JSON Loaded');
      // console.log(response);
      var locations = JSON.parse(response);
      // Add locations data source to map
  		map.getSource('locations').setData(locations);
      // Filter layers on map
      set_map_facets();
      // Remove loading state
      $('#map').addClass('loaded');
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
      'filter': lineFilter
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
      'filter': polyFillFilter
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
        'filter': polyPatternFillFilter
      });
    });

    // Add polygon styles (hover states) to map
    map.addLayer({
      'id': 'polygon-fills-hover',
      'type': 'fill',
      'source': 'locations',
      'layout': {},
      'paint': {
        'fill-color': ['get', 'hover-color'],
        'fill-opacity': ['get', 'hover-opacity']
      },
      'filter': polyFillHoverFilter
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
        'filter': companyFilter
      });
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
        'filter': recreationFilter
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
        'filter': forsaleFilter
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
        'filter': forleaseFilter
      });
    });

    // When the user moves their mouse over the states-fill layer, we'll update the filter in
    // the state-fills-hover layer to only show the matching state, thus making a hover effect.
    polyLayers.forEach(function(layer) {
      map.on("mousemove", layer, function(e) {
        map.getCanvas().style.cursor = 'pointer';
        map.setFilter("polygon-fills-hover", ["==", "hover_id", e.features[0].properties.hover_id]);
      });

      // Reset the state-fills-hover layer's filter when the mouse leaves the layer.
      map.on("mouseleave", layer, function() {
        map.getCanvas().style.cursor = '';
        map.setFilter("polygon-fills-hover", ["==", "hover_id", ""]);
      });
    });

		// When a click event occurs open a popup at the location of click
		map.on('click', "polygon-fills-hover", function(e) {
      // Multi-tenant facility buildings and sites
      var prop = e.features[0].properties;
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
                      image +
                      '<p><a class="button secondary" href="' + prop.permalink + '">More Information</a></p>' +
                    '</div>';

      popup = new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(tooltip)
        .addTo(map);
    });

    // Hover and click states for points
    pointLayers.forEach(function(layer) {
      map.on('mousemove', layer, function() {
        map.getCanvas().style.cursor = 'pointer';
      });

      map.on('mouseleave', layer, function() {
        map.getCanvas().style.cursor = '';
      });

      // Companies, Recreation Facilities, and some Real Estate
      map.on('click', layer, function(e) {
        var prop = e.features[0].properties;
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
                        image +
                        '<p><a class="button secondary" href="' + prop.permalink + '">More Information</a></p>' +
                      '</div>';

        popup = new mapboxgl.Popup({ offset: 5 })
          .setLngLat(e.lngLat)
          .setHTML(tooltip)
          .addTo(map);
	    });
    });

    // Hover state for lines
    map.on('mousemove', 'lines', function(e) {
      map.getCanvas().style.cursor = 'pointer';
    });

    map.on('mouseleave', 'lines', function(e) {
      map.getCanvas().style.cursor = '';
    });

    // Click state for lines
		map.on('click', "lines", function(e) {
      // Lines
      var prop = e.features[0].properties;
      var image = (prop.image ? '<div class="tooltip-logo"><img src="' + prop.image + '" alt="' + prop.title + '"/></div>' : '');
      var tooltip = '<div class="tooltip">' +
                      '<p class="title">' + prop.title + '</p>' +
                      image +
                      '<p><a class="button secondary" href="' + prop.permalink + '">More Information</a></p>' +
                    '</div>';

      popup = new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(tooltip)
        .addTo(map);
    });

	});

  // HANDLE FACETS CHANGING
  $(document).on('facetwp-loaded', function() {
    // Re-calc map distance from top
    distance = $('#map').offset().top;

    // Set company icons and checkboxes
    // var checkboxCats = $('.facetwp-checkbox');
    // var companyImages = rtp_dir_vars.company_type_images;
    //
    // // If checkboxes have an icon, set it after content
    // checkboxCats.each(function(i) {
    //   var dataValue = $(this);
    //   for (key in companyImages) {
    //     if(dataValue.attr('data-value') == key && !dataValue.hasClass('has-icon')) {
    //       dataValue.addClass('has-icon');
    //       dataValue.prepend('<img class="checkboxIcons" src="' + companyImages[key] + '" alt="" />');
    //     }
    //   }
    // });

    // Get rid of tooltip/popup
    if (popup) {
      popup.remove();
    }

    console.log(allLayers);

    // Filter layers on map
    set_map_facets();
  });

  // Reset layer filters
  function reset_layer_filter(layer) {
    switch (layer) {
      case 'recreation':
        reset = recreationFilter;
        break;
      case 'companies':
        reset = companyFilter;
        break;
      case 'forsale':
        reset = forsaleFilter;
        break;
      case 'forlease':
        reset = forleaseFilter;
        break;
      case 'polygon-fills':
        reset = polyFillFilter;
        break;
      case 'polygon-pattern-fills':
        reset = polyPatternFillFilter;
        break;
      case 'lines':
        reset = lineFilter;
        break;
    }
    return reset;
  }

  // Check to see if any facets are set
  function areFacetsSet(facets) {
    var set = false;

    $.each(facets, function(fkey, fval) {
      // If any values are set for this facet (besides pagination facets)
      if (fkey !== 'paged' && fval.length > 0) {
        set = true;
      }
    });

    return set;
  }

  // Set facets on the map
  function set_map_facets() {
    if (map.isStyleLoaded()) {

      // Get data from FacetsWP
      var facets = FWP.facets;
      var result_ids = FWP.settings.post_ids;

      console.log(facets);
      console.log(result_ids);

      // console.log('Start Map Facets');

      // Set up filters for each layer individually
      allLayers.forEach(function(layer) {
        // Start building layer's filters from scratch to avoid duplicate filters being set
        var cleaned = reset_layer_filter(layer),
            new_expression = ['any'],
            new_filter = [];

        // Check if any facets are actually set
        if (areFacetsSet(facets) == true) {
          result_ids.forEach(function(id) {
            // Match on ids for any location
            new_expression.push(['==', 'id', Number(id)]);

            // Also match on ids of tenants within facility
            if (($.inArray(layer, polyLayers) != '-1')) {
              new_expression.push(['==', 'tenant-id-' + id, true]);
            }
          });

          // Add new expression to cleaned filter
          if (cleaned[0] == '==') {
            new_filter = ['all', cleaned, new_expression];
          } else {
            new_filter = cleaned.concat([new_expression]);
          }
        } else {
          // If there are no filters set, reset the filter to the cleaned one
          new_filter = cleaned;
        }

        console.log(layer, new_filter);

        // Set this layer's filter
        map.setFilter(layer, new_filter);
      });
    }
  }

});
