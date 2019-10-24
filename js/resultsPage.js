/*This file contains javascript for the results page*/

/* this function initializes Google Maps*/
function initLocationProcedure() {
    /*This an array of park objects with the necessary information to create a marker. This acts as model of our database */
    var parks = [
        {
            Latitude: "45.2260142",
            Longitude: "-81.5270672",
            NameOfPark: "Bruce Peninsula National Park",
            Description: "One of Ontario's most popular national parks",
        },
        {
            Latitude: "43.6465518",
            Longitude: "-79.465879",
            NameOfPark: "High Park",
            Description: "A beautiful family park located in the heart of toronto",
        },
        {
            Latitude: "44.8743203",
            Longitude: "-79.8721441",
            NameOfPark: "Georgian Bay Islands National Park",
            Description: "Plently of trails, hiking, boating and much more",
        },
    ];

    /*Creating an infowindow to open when a user clicks on the marker*/
    var infowindow = new google.maps.InfoWindow();

    /*Initializing the Google Map*/
    var map = new google.maps.Map(
        document.getElementById('map'),
        {
            center: { lat: 44.7184038, lng: -79.5181442 },  //centering the map at this coordinates
            zoom: 7, //setting the initial zoom level
            disableDefaultUI: true, //turns off the API's default UI settings
        }
    );

    /*This loop iterates through the parks array defined above, creates a new marker for each park and sets an infowindow associated with each marker*/
    for (var i = 0; i < parks.length; i++) {

        /*Creating a marker*/
		var marker = new google.maps.Marker({
			map: map, //specifying the map to put the marker on
			position: new google.maps.LatLng(  //setting the position of the marker at a certain latitude and longitude
				parks[i].Latitude,
				parks[i].Longitude
			),
        });

        /*This adds an event listener to the marker so that when a user clicks on a marker, it sets the content inside the infowindow and opens the infowindow*/
        google.maps.event.addListener(marker, 'click', (function (marker, i) {

            return function () {
                /*Calling the setContent method to set the inner html of the infowindow*/
				infowindow.setContent(
					'<div id="content" class="container park-marker">' +
					'<h4>' + parks[i]["NameOfPark"] + '</h4>' +
                    '<p>' + parks[i]["Description"] + '</p>' +
                    '<a href="individual_sample.html" target="_blank">View More Details</a>' +
					'</div>'
				);
                infowindow.open(map, marker);  //opens the infowindow on the map above the clicked marker
			}
        })(marker, i));

        /*This adds an event listener to the map so that if the user clicks on the map, it closes any infowindows that are open*/
        google.maps.event.addListener(map, "click", function () {
            infowindow.close();
        });
	}
}