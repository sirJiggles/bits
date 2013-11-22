$(window).ready(function(){

    if ($('#map-container').length > 0){

        var postcode = 'PE29 2BN';
        var geocoder, map, center;

        function initMap(){
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': postcode}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    center = results[0].geometry.location;

                    var mapOptions = {
                        center: center,
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        streetViewControl: (appVars.desktop) ? true : false,
                        zoomControl: (appVars.desktop) ? true : false,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL,
                            position: google.maps.ControlPosition.RIGHT_TOP
                        },
                        panControl: (appVars.desktop) ? true : false,
                        panControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_TOP
                        }
                    };

                    map = new google.maps.Map(document.getElementById("map-container"), mapOptions);

                    // Custom marker icon
                    
                    var image = new google.maps.MarkerImage(siteAssetsPath + '/assets/modules/google-map/img/icon.png');
                    var shadow = new google.maps.MarkerImage(siteAssetsPath + '/assets/modules/google-map/img/icon-shadow.png');
                    
                    var shape = {
                        coord: [1, 1, 1, 28, 39],
                        type: 'poly'
                    };

                    // create the marker
                    var marker = new google.maps.Marker({
                        position: center,
                        map: map,
                        shadow: shadow,
                        icon: image,
                        shape: shape
                    });
                    

                    if(!appVars.mobile){

                        var contentString = '';
                        contentString += '<div class="info-window"><h4>Tyrrell & Company</h4>Suite D,<br/>South Cambridge Business Park,';
                        contentString += '<br />Babraham Road,<br />Sawston,<br />Cambridge,<br />Cambridgeshire<br />CB22 3JH<br /><br />';
                        contentString += '<strong>Telephone</strong>: 01223 832477<br />';
                        contentString += '<strong>Fax</strong>: 01223 832488<br />';
                        contentString += '<strong>Email</strong>: <a href="mailto:info@tyrrellandcompany.co.uk">info@tyrrellandcompany.co.uk</a><br />';
                        contentString += '<br /><strong>Opening Times:</strong><br />';
                        contentString += 'Monday to Friday 9am to 5pm';

                        // Set up the info window and the click event for the marker
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        
                        google.maps.event.addListener(marker, 'click', function() {
                             infowindow.open(map, this);
                        });
                    }

                    
                }
            });
        }


        $(window).load(function(e){
            initMap();
        })

    } // end if on correct page
});