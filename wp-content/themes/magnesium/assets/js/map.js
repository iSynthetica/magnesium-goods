(function($) {
    $(document).ready(function() {
        $('.acf-map').each(function(){
            map = new_map( $(this) );
        });



        /**
         * Create Google Map
         * @param $el
         * @returns {google.maps.Map}
         */
        function new_map($el) {
            var $markers = jointsMapObj.accomodations;

            var styles = [
                {
                    "featureType": "all", "stylers": [{ "saturation": 0 },]
                }, {
                    "featureType": "poi", "elementType": "labels.text", "stylers": [{ "visibility": "off" }]
                }, {
                    "featureType": "poi.business", "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "road", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "transit", "stylers": [{"visibility": "off"}]
                }
            ];

            var args = {
                zoom		: 13,
                center		: new google.maps.LatLng(0, 0),
                disableDefaultUI: true,
                styles: styles,
                mapTypeId	: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map( $el[0], args);

            map.markers = [];

            var myOptions = {
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(0, -100),
                boxStyle: {
                    padding: "0px 0px 0px 0px",
                    width: "320px",
                    height: "auto"
                },
                infoBoxClearance: new google.maps.Size(1, 1),
                pane: "floatPane",
                alignBottom: true,
                closeBoxMargin: "6px 6px 2px 2px",
                enableEventPropagation: true
            };

            var ib = new InfoBox(myOptions);

            $.each( $markers, function( index, value ){
                add_marker( value, map, ib );
            });

            center_map( map );

            return map;
        }

        /**
         * Adding Markers
         *
         * @param $marker
         * @param map
         */
        function add_marker($marker, map, ib ) {
            var latlng = new google.maps.LatLng( $marker.location.lat, $marker.location.lng );
            var $icon = jointsMapObj.marker;

            var marker = new google.maps.Marker({
                position	: latlng,
                map			: map,
                icon: {
                    url: $icon,
                    scaledSize: new google.maps.Size(30, 39),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(15,39),
                    labelOrigin:  new google.maps.Point(20,10),
                }
            });

            map.markers.push( marker );

            if($marker.info) {
                google.maps.event.addListener(marker, 'click', function(e) {
                    //map.clear();
                    ib.setContent($marker.info);
                    ib.open(map, this);
                    map.panTo(ib.getPosition());
                });

                google.maps.event.addListener(ib, 'closeclick', function(e) {
                    center_map( map );
                });

                google.maps.event.addListener(ib, 'domready', function(e) {
                    var closeBtn = $('.infobox-close-btn').get();

                    google.maps.event.addDomListener(closeBtn[0], 'click', function() {
                        ib.close();
                        center_map( map );
                    });
                });
            }
        }

        function center_map( map ) {
            var bounds = new google.maps.LatLngBounds();

            $.each( map.markers, function( i, marker ){
                var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
                bounds.extend( latlng );
            });

            if( map.markers.length == 1 )
            {
                map.setCenter( bounds.getCenter() );
                map.setZoom( 17 );
            } else {
                map.fitBounds( bounds );
                var listener = google.maps.event.addListener(map, "idle", function() {
                    if (map.getZoom() > 17) map.setZoom(17);
                    google.maps.event.removeListener(listener);
                });
            }
        }
    });
})(jQuery);