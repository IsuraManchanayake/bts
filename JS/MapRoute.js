function initialize() {
    var map = new google.maps.Map(document.getElementById("map_canvas"));
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
    });
    directionsService.route({
        origin: {
            'placeId': 'ChIJc1lGdwfP20YR3lGOMZD-GTM'
        },
        destination: {
            'placeId': 'ChIJdTGhqsbP20YR6DZ2QMPnJk0'
        },
        waypoints: [{
            stopover: true,
            location: {
                'placeId': "ChIJRVj1dgPP20YRBWB4A_sUx_Q"
            }
        }],
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}
google.maps.event.addDomListener(window, "load", initialize);