/*This file uses the GeoLocator to fill in the location as default if required*/
$(document).ready(function(){
  if (navigator.geolocation) {
    /*Get the current position of the user*/
      navigator.geolocation.getCurrentPosition(onSuccess);
  } else {
    /*If not successful, display an error message*/
      $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
    }
    /*Sets the latitude and longitude as default*/
    function onSuccess(position) {
      $('input[name="location"]').val(position.coords.latitude + ", " + position.coords.longitude);
    }
});
