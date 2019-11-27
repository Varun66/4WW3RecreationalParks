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
        <link rel="stylesheet" href="./css/results_sample.css">
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
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

        <!--This container holds the map. For now it is an image, but it will change to an actual map. It is given the class of container fluid so that is spans across
        the whole screen and the p-0 class removes any padding.-->
        <div class="container-fluid p-0">
            <div id="map"></div>
        </div>

        <!--This container holds the search results table-->
       <div class="container section-padding">
           <h2 class="text-center">Results</h2>
           <!--A <table> element is used to create the results table-->
           <table>
               <!-- The <colgroup> tag can be used to apply styles to entire columns. Here, we are setting the width of each column in the table using their corresponding classes. -->
                <colgroup>
                    <col class="col-big">
                    <col class="col-small">
                    <col class="col-small">
                </colgroup>
                <!--The header of the table which consists of <th> elements that represent each heading-->
               <thead>
                   <tr>
                       <th>Park</th>
                       <th>Rating</th>
                       <th>City</th>
                   </tr>
               </thead>
               <!--The body of the table which consists of rows (i.e. <tr> tags) and the tabular data to be displayed in each row (i.e. <td> tags)-->
               <tbody>
                    <tr>
                        <td>
                            <!--Using the bootstrap grid system, we are defining a row that will consist of the park image and park details-->
                            <div class="row">
                                <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-6" to say that for any viewport size above and including 768px,
                                    the <div> width should be 6 columns or 50%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
                                <div class="col-md-6">
                                    <img src="./images/bruce_peninsula.jpg" alt="An image of high park"/>
                                </div>
                                <div class="col-md-6 park-details">
                                    <h4>Bruce Peninsula National Park</h4>
                                    <p>One of Ontario's most popular national parks</p>
                                    <a href="individual_sample.html" target="_blank">View More Details</a>
                                </div>
                            </div>
                        </td>
                        <td>4.8</td>
                        <td>Tobermory, ON</td>
                   </tr>
                   <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="./images/high_park.jpg" alt="An image of high park"/>
                                </div>
                                <div class="col-md-6 park-details">
                                    <h4>High Park</h4>
                                    <p>A beautiful family park located in the heart of toronto</p>
                                    <a href="individual_sample.html" target="_blank">View More Details</a>
                                </div>
                            </div>
                        </td>
                        <td>4.7</td>
                        <td>Toronto, ON</td>
                   </tr>
                   <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="./images/georgian_bay.jpg" alt="An image of high park"/>
                                </div>
                                <div class="col-md-6 park-details">
                                    <h4>Georgian Bay Islands National Park</h4>
                                    <p>Plently of trails, hiking, boating and much more</p>
                                    <a href="individual_sample.html" target="_blank">View More Details</a>
                                </div>
                            </div>
                        </td>
                        <td>4.7</td>
                        <td>Honey Harbour, ON</td>
                   </tr>
               </tbody>
           </table>
       </div>

        <!--This is the footer of the document-->
        <footer>
            <div class="container footer">
                <!--It has a <ul> element with some footer links to navigate around the website.-->
                <ul>
                    <li>
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
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

        <!--The following scripts are imported at the end of the <body> tag so that the html elements are rendered quicker by the brower so the users don't see a blank screen for too long.
            They are all required for bootstrap.-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./js/resultsPage.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=API_key&callback=initLocationProcedure" async defer></script>
    </body>
</html>