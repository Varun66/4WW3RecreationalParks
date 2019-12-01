/*This file contains the javascript for the search page*/
$(document).ready(function(){
  /*A click listener on the user location tab that fetches user location using Geolocation APi*/
    $("#userLocation-tab").click(function(){
        if (navigator.geolocation) {
          /*Get the current position of the user*/
            navigator.geolocation.getCurrentPosition(onSuccess, onError);
        } else {
          /*If not successful, display an error message*/
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
        }
    });

    /*Function that runs when geolocation is successfull*/
    function onSuccess(position) {
        /*Hide the div with the spinner*/
        $(".spinner-container").hide();
        /*Set css display properties for the div with class location search*/
        $(".location-search").css("display", "flex");
        /*Replace html in div with a success message and instructions*/
        $("#response-msg").html("<h4>You can select an option below to see all the best parks within a certain radius from you.</h4>");
        $('.location-search').append("<input name='latitude' type='hidden' value="+position.coords.latitude+">");
        $('.location-search').append("<input name='longitude' type='hidden' value="+position.coords.longitude+">");

    }

    /*Function that runs when there is an error*/
    function onError(error) {
      /*Switch case statement for handling different error cases. Each case displays an error message*/
        switch(error.code) {
          case error.PERMISSION_DENIED:
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
            $(".spinner-container").hide();
            break;
          case error.POSITION_UNAVAILABLE:
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
            $(".spinner-container").hide();
            break;
          case error.TIMEOUT:
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
            $(".spinner-container").hide();
            break;
          case error.UNKNOWN_ERROR:
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
            $(".spinner-container").hide();
            break;
        }
      }
})
