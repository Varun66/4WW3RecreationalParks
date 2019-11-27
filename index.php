
<!--DOCTYPE declaration which specifies that the document is in html5 -->
<!DOCTYPE html>
<!--Html tag signifies the start of the html document. Everything should go inside this tag-->
<html>
    <!--This is the head of the document which contains the required meta tags using the <meta> tag and css stylesheet imports using the <link> tag.
    It also contains the title of the website.-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ParkFinder</title>
        <!--This is the meta description that is commonly used by search engines to display information about your site-->
        <meta name="description" content="A page to search for the parks either by name or rating">
        <!--This meta tag enables a responsive viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Link tags with the css stylesheets-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/search.css">
        <link rel="stylesheet" href="./css/typography.css">
        <link rel="stylesheet" href="./css/common.css">
    </head>
    <!--Start of the body of the document. All the content of the website goes inside this tag-->
    <body>
        <!--Start of the header-->
        <header>
            <!--The header contains a navigation menu.
            **Using bootstrap navbar-->
            <nav class="navbar navbar-expand-lg">
                <p class="navbar-brand">ParkFinder</p>
                <!--This button opens and closes the navigation menu on click. It is only visible if the device is less than 992px wide.-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--This div block contains the navigation menu-->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!--There is <ul> element that lists all the menu items and displays them as a list in a single row-->
                    <ul class="navbar-nav">
                        <!--An active class is added to the menu item that is currently active. In other words,
                        the active class represents which page the user is currently on-->
                        <li class="nav-item active">
                            <a class="nav-link" href="search.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="submission.html">Submit a Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <!--The Sign Up menu item is displayed only on touch screen devices. Otherwise, it is hidden-->
                        <li class="nav-item mobile-only">
                            <a class="nav-link" href="registration.html">Sign Up</a>
                        </li>
                    </ul>
                </div>
                <a href="registration.html" class="btn btn-outline-white sign-up-btn">Sign Up</a>
            </nav>
        </header>

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
                    <form class="search-container" action="results_sample.html" method="POST" name="searchByName">
                        <!--We are making this input field required so that users can't submit empty inputs-->
                        <input name="parkName" type="text" placeholder="Enter the name of a park" required>
                        <button class="btn btn-dark-blue" type="submit">Submit</button>
                    </form>
                </div>
                <!--This is the tab content for the rating tab, as specified with the id.-->
                <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">
                    <!--This is a form element with one select element (i.e dropdown) so that a user can choose and search by rating. The form action directs the page to the sample results page.-->
                    <form class="search-container" action="results_sample.html" method="POST" name="searchByRating">
                        <!--We are making this select field required so that users can't submit empty inputs-->
                        <select name="rating" required>
                            <!--This is a disabled option that acts as a placeholder for the select element. User's can't choose this value and submit it.-->
                            <option value="" disabled selected>Select a Rating</option>
                            <option value="4.5-5">4.5 - 5</option>
                            <option value="4.0-4.4">4.0 - 4.4</option>
                            <option value="3.5-3.9">3.5 - 3.9</option>
                            <option value="3.0-3.4">3.0 - 3.4</option>
                            <option value="2.5-2.9">2.5 - 2.9</option>
                            <option value="2.0-2.4">2.0 - 2.4</option>
                            <option value="Less than 2.0">Less than 2.0</option>
                        </select>
                        <button class="btn btn-dark-blue" type="submit">Submit</button>
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
                    <form class="search-container location-search" action="results_sample.html" method="POST" name="searchByUserLocation">
                        <select name="userLocation" required>
                            <option value="" disabled selected>Select a Radius</option>
                            <option value="5">5 km</option>
                            <option value="10">10 km</option>
                            <option value="20">20 km</option>
                            <option value="50">50 km</option>
                            <option value="100">100 km</option>
                            <option value="200">150 km</option>
                            <option value="More than 250">> 200 km</option>
                        </select>
                        <button class="btn btn-dark-blue" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!--This is the footer of the document-->
        <footer>
            <div class="container footer">
                <!--It has a <ul> element with some footer links to navigate around the website.-->
                <ul>
                    <li>
                        <a class="nav-link" href="search.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li>
                        <a class="nav-link" href="submission.html">Submit a Review</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <p>Copyright 2019. ParkFinder. All rights reserved</p>
            </div>
        </footer>

        <!--The following scripts are imported at the end of the <body> tag so that the html elements are rendered quicker by the brower.
            They are all required for bootstrap.-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./js/searchPage.js"></script>
    </body>
</html>