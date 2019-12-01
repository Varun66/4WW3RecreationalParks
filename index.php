<?php include "header.php";?>
<!--This <div> block represents the top banner area of the page. The banner-bg class has the css for the background image
    and it is the defined as the parent div (i.e. the top most element) because the background should be full width and
    it should cover all the elements inside the parent div (i.e. all the child elements)-->
<div class="banner-bg">
    <div class="container">
        <div class="top-banner">
            <h1>Find the best parks near you</h1>
        </div>
    </div>
</div>

<!--This div contains the search form to search by either name or rating-->
<div class="container section-padding">
    <h2 class="text-center">Search By</h2>
    <!--Bootstrap tabs are used here. Each tab contain a different search option so users can choose a tab accordingly-->
    <ul class="nav nav-tabs" id="searchTab" role="tablist">
        <!--This is the 'Name' tab. It has a link which references the correct tab content to show. This is done by the href attribute
        which points to the id of a div that holds it's corresponding tab content. The href attribute here points to
        a div with id="name" so when a user clicks on the tab, it wil find the div with this id and display it's contents. -->
        <li class="nav-item">
            <!--There is an active class which specifies which tab is currently active. There is a data-toggle attribute
            which says that this is a tab. Aria-controls and aria-selected are attributes used for accessibility purposes.-->
            <a class="nav-link active" id="name-tab" data-toggle="tab" href="#name" role="tab" aria-controls="name" aria-selected="true">Name</a>
        </li>
        <!--This is the 'Rating' tab. It behaves in the same way as explained above. The href attribute here points to
        a div with id="rating" so when a user clicks on the tab, it wil find the div with this id and display it's contents. -->
        <li class="nav-item">
            <!--There is a data-toggle attribute which says that this is a tab. Aria-controls and aria-selected are attributes used for accessibility purposes.-->
            <a class="nav-link" id="rating-tab" data-toggle="tab" href="#rating" role="tab" aria-controls="rating" aria-selected="false">Rating</a>
        </li>
        <!--This is the 'My Location' tab. It behaves in the same way as explained above. The href attribute here points to
        a div with id="userLocation" so when a user clicks on the tab, it wil find the div with this id and display it's contents. -->
        <li class="nav-item">
            <!--There is a data-toggle attribute which says that this is a tab. Aria-controls and aria-selected are attributes used for accessibility purposes.-->
            <a id="userLocation-tab" class="nav-link" data-toggle="tab" href="#userLocation" role="tab" aria-controls="userLocation" aria-selected="false">My Location</a>
        </li>
    </ul>
    <div class="tab-content">
        <!--This is the tab content for the name tab, as specified with the id.-->
        <div class="tab-pane fade show active" id="name" role="tabpanel" aria-labelledby="name-tab">
            <!--This is a form element with one text input so that a user can search by name. The form action directs the page to the sample results page.-->
            <form class="search-container" action="results.php" method="POST" name="searchByName">
                <input type="hidden" name="searchByName" value=""/>
                <!--We are making this input field required so that users can't submit empty inputs-->
                <input name="parkName" type="text" placeholder="Enter the name of a park" required>
                <button class="btn btn-dark-blue" type="submit">Submit</button>
            </form>
        </div>
        <!--This is the tab content for the rating tab, as specified with the id.-->
        <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">
            <!--This is a form element with one select element (i.e dropdown) so that a user can choose and search by rating. The form action directs the page to the sample results page.-->
            <form class="search-container" action="results.php" method="POST" name="searchByRating">
                <input type="hidden" name="searchByRating" value=""/>
                <!--We are making this select field required so that users can't submit empty inputs-->
                <select name="minRating" required>
                    <!--This is a disabled option that acts as a placeholder for the select element. User's can't choose this value and submit it.-->
                    <option value="" disabled selected>Minimum</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <h2 class="rating-range"> - </h2>
                <!--We are making this select field required so that users can't submit empty inputs-->
                <select name="maxRating" required>
                    <!--This is a disabled option that acts as a placeholder for the select element. User's can't choose this value and submit it.-->
                    <option value="" disabled selected>Maximum</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <button class="btn btn-dark-blue rating-submit" type="submit">Submit</button>
            </form>
        </div>
        <!--This is the tab content for the My Location tab, as specified with the id. When a user clicks on this tab, the browser uses the Geolocation API to retrieve the user's location using Javascript-->
        <div class="tab-pane fade" id="userLocation" role="tabpanel" aria-labelledby="userLocation-tab">
            <!--This div gives the user an instruction to allow or deny on the browser to get their location coordinates.-->
            <div id="response-msg"><h4>Please click allow or decline</h4></div>
            <!--This div displays a spinner to the user while they the browser is making the API call. Using Javascript, the spinner hides after the call has been made.-->
            <div class="spinner-container">
                <div class="spinner"></div>
            </div>
            <!--This is a form element with one select element (i.e dropdown) so that a user can choose and search by radius. The form action directs the page to the sample results page.-->
            <form class="search-container location-search" action="results.php" method="POST" name="searchByUserLocation">
                <input type="hidden" name="searchByUserLocation" value=""/>
                <select name="userLocation" required>
                    <option value="" disabled selected>Select a Radius (in km)</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="More than 200">>200</option>
                </select>
                <button class="btn btn-dark-blue" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <h2 class="text-center or-text">or</h2>
    <form class="text-center" action="results.php" method="POST" name="viewAllParks">
        <input type="hidden" name="viewAllParks" value=""/>
        <button class="btn view-all-parks" type="submit">View All Parks</button>
    </form>
</div>

<?php include "footer.php";?>