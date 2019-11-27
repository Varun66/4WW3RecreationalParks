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
        <!--Meta data for the Open Graph protocol. The URLs used for content values are hypothetical-->
        <meta property="og:title" content="ParkFinder" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://mywebsite.com/individual_sample.html/" />
        <meta property="og:image" content="http://mywebsite.com/images/social_media_image.png/" />
        <!--Meta data for the Twitter Cards-->
        <meta name="twitter:card" content="website">
        <meta name="twitter:site" content="@ParkFinder">
        <meta name="twitter:creator" content="@4WW3" />
        <!--Link tags with the css stylesheets-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/individual_sample.css">
        <link rel="stylesheet" href="./css/typography.css">
        <link rel="stylesheet" href="./css/common.css">
        <!--Manifest file for adding the website to android and ios homescreen-->
        <link rel="manifest" href="/manifest.json">
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

        <!--This <div> block represents the top banner area of the page. The banner-bg class has the css for the background image
            and it is the defined as the parent div (i.e. the top most element) because the background should be full width and
            it should cover all the elements inside the parent div (i.e. all the child elements)-->
        <div class="banner-bg">
            <div class="container">
                <div class="top-banner">
                    <h1>Bruce Peninsula National Park</h1>
                </div>
            </div>
        </div>

        <!--This container holds the map. It also contains the Place microdata schema-->
        <div class="container section-padding map-location" itemscope itemtype="http://schema.org/Place">
            <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                <meta itemprop="latitude" content="45.195829" />
                <meta itemprop="longitude" content="-81.5239711" />
                <div id="map"></div>
            </div>
        </div>

        <!--This container has details about the park.-->
        <div class="container details-section">
            <h2>Park Details</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
        </div>

        <!--This is the ratings and reviews section. It uses the bootstrap grid system to display each user review-->
        <div class="container section-padding ratings-section">
            <h2>Ratings and Reviews</h2>
            <div class="ratings">
                <!--The follow <div> block contains the markup for the Review microdata schema-->
				<div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
                    <!--This column contains the user profile picture-->
					<div class="col-1 rating-img">
						<img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
                    </div>
                    <!--This column contains the user name, rating, date of post and review-->
					<div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<div class="rating-author">
							<p><b><span itemprop="name">User1</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
							<p>Oct 7, 2019</p>
						</div>
						<p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
					</div>
                </div>
                <!--The follow <div> block contains the markup for the Review microdata schema-->
				<div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
                    <!--This column contains the user profile picture-->
					<div class="col-1 rating-img">
						<img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
                    </div>
                    <!--This column contains the user name, rating, date of post and review-->
					<div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<div class="rating-author">
							<p><b><span itemprop="name">User2</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
							<p>Oct 7, 2019</p>
						</div>
						<p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
					</div>
                </div>
                <!--The follow <div> block contains the markup for the Review microdata schema-->
				<div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
                    <!--This column contains the user profile picture-->
					<div class="col-1 rating-img">
						<img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
                    </div>
                    <!--This column contains the user name, rating, date of post and review-->
					<div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<div class="rating-author">
							<p><b><span itemprop="name">User3</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
							<p>Oct 7, 2019</p>
						</div>
						<p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
					</div>
				</div>
			</div>
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

        <!--The following scripts are imported at the end of the <body> tag so that the html elements are rendered quicker by the brower.
            They are all required for bootstrap.-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/objectPage.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=API_key&callback=initLocationProcedure" async defer></script>
    </body>
</html>