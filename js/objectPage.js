/*This file contains javascript for the individual object page*/

/* this function initializes Google Maps*/
function initLocationProcedure() {
    /*Creating an infowindow to open when a user clicks on the marker*/
    var infowindow = new google.maps.InfoWindow();

    /*Initializing the Google Map*/
    var map = new google.maps.Map(
        document.getElementById('map'),
        {
            center: { lat: 45.2260142, lng: -81.5270672 },  //centering the map at this coordinates
            zoom: 7, //setting the initial zoom level
            disableDefaultUI: true, //turns off the API's default UI settings
        }
    );

    /*Creating a marker*/
    var marker = new google.maps.Marker({
        map: map, //specifying the map to put the marker on
        position: new google.maps.LatLng(  //setting the position of the marker at a certain latitude and longitude
            "45.2260142",
            "-81.5270672"
        ),
    });

    /*This adds an event listener to the marker so that when a user clicks on a marker, it sets the content inside the infowindow and opens the infowindow*/
    google.maps.event.addListener(marker, 'click', (function (marker) {

        return function () {
            /*Calling the setContent method to set the inner html of the infowindow*/
            infowindow.setContent(
                '<div id="content" class="container park-marker">' +
                '<h4>Bruce Peninsula National Park</h4>' +
                '</div>'
            );
            infowindow.open(map, marker);  //opens the infowindow on the map above the clicked marker
        }
    })(marker));

    /*This adds an event listener to the map so that if the user clicks on the map, it closes any infowindows that are open*/
    google.maps.event.addListener(map, "click", function () {
        infowindow.close();
    });
}