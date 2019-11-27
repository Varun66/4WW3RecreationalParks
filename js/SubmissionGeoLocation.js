/*This file uses the GeoLocator to fill in the location as default if required*/
$(document).ready(function(){
  if (navigator.geolocation) {
    /*Get the current position of the user*/
      navigator.geolocation.getCurrentPosition(onSuccess);
  } else {
    /*If not successful, display an error message*/
    alert("Unfortunately, we could not find your location");
  }

  /*Sets the latitude and longitude as default*/
  function onSuccess(position) {
    $('input[name="latitude"]').val(position.coords.latitude);
    $('input[name="longitude"]').val(position.coords.longitude);
  }
});
