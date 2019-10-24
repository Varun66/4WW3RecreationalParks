$(document).ready(function(){
    $("#userLocation-tab").click(function(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(onSuccess, onError);
        } else {
            $("#response-msg").html("<h4>Unfortunately, this feature is not available. Please choose another criteria to search by</h4>");
        }
    });

    function onSuccess(position) {
        console.log(position);
        if (position) {
            $(".spinner-container").hide();
            $(".location-search").css("display", "flex");
            $("#response-msg").html("<h4>You can select an option below to see all the best parks within a certain radius from you.</h4>");
        }
    }

    function onError(error) {
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
