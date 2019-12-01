/*This file contains javascript for the individual object page*/

$(document).ready(function(){
    $(".banner-bg").css({
        "background": "linear-gradient(90deg, rgba(0, 0, 0, 0.6), transparent), url("+$(".banner-bg").attr('data-bg')+")", /*Specifies the background image to use and adds a gradient to it*/
        "background-size": "cover",     /*Specifies the size of background image. By setting it to cover, it will automatically resize to cover the entire area of the div.*/
        "background-attachment": "fixed",    /*A fixed background attachment gives a parallax effect. It means that the background will stay fixed as the user scrolls the page.*/
        "background-repeat": "no-repeat",    /*By setting background repeat to no repeat, it will not repeat the background image multiple items if the size of the whole image cannot cover the entire div.*/
        "background-position": "center 100%",    /*The position of the background image can be controlled. Here, it is being centered horizontally and the image is pushed all the way to the top vertically.*/

    });

    $('form').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
          type: 'post',
          url: 'phpfunctions/addReview.php',
          data: $('form').serialize(),
          success: function () {
            $("form").append("<h4 class='success-msg'>Thank you! Your review was submitted successfully</h4>");
            $(".ratings").append(
            '<div class="row ratings-row" itemscope itemtype="http://schema.org/Review">' +
                '<!--This column contains the user profile picture-->' +
                '<div class="col-1 rating-img">'+
                    '<img src="./images/anonymous-user.png" alt="A profile picture of the user"/>' +
                '</div>' +
                '<!--This column contains the user name, rating, date of post and review-->' +
                '<div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">' +
                    '<div class="rating-author">' +
                        '<p><b><span itemprop="name">'+ $('input[name="userName"]').val() + '</span></b><br/>Rating: <span itemprop="ratingValue">' + $('select[name="userRating"]').val() + '</span>/5</p>' +
                    '</div>' +
                    '<p itemprop="reviewBody">' + $('textarea[name="userReview"]').val() + '</p>' +
                '</div>' +
            '</div>');
          },
          error: function() {
            $("form").append("<h4 class='fail-msg'>Your review was not submitted. Please try again</h4>");
          }
        });

    });
});


/* this function initializes Google Maps*/
function initLocationProcedure() {
    /*Creating an infowindow to open when a user clicks on the marker*/
    var infowindow = new google.maps.InfoWindow();

    /*Initializing the Google Map*/
    var map = new google.maps.Map(
        document.getElementById('map'),
        {
            center: { lat: parks[0].Latitude, lng: parks[0].Longitude },  //centering the map at this coordinates
            zoom: 7, //setting the initial zoom level
            disableDefaultUI: true, //turns off the API's default UI settings
        }
    );

    /*Creating a marker*/
    var marker = new google.maps.Marker({
        map: map, //specifying the map to put the marker on
        position: new google.maps.LatLng(  //setting the position of the marker at a certain latitude and longitude
            parks[0].Latitude,
			parks[0].Longitude
        ),
    });

    /*This adds an event listener to the marker so that when a user clicks on a marker, it sets the content inside the infowindow and opens the infowindow*/
    google.maps.event.addListener(marker, 'click', (function (marker) {

        return function () {
            /*Calling the setContent method to set the inner html of the infowindow*/
            infowindow.setContent(
                '<div id="content" class="container park-marker">' +
                '<h4>'+parks[0]["Name"]+'</h4>' +
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