<!-- Web Page for user to submit the form -->

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
        <link rel="stylesheet" href="./css/RegistrationForm.css">
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
                        <li class="nav-item active">
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

        <div class="container register-form">
            <!--A form element for the user registration. Right now, it performs no action. The POST method means that the it will be sending data to the server.-->
            <form action="phpfunctions/addObject.php" name="submissionForm" method="post" enctype="multipart/form-data">

                <h2>Submission</h2>
                <p>Please fill in this form to submit a review.</p>
                <!--The <hr> element creates a horizontal line which acts as a divider-->
                <hr>

                <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-4" to say that for any viewport size above and including 768px,
                    the <div> width should be 4 columns or 33.3333%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
                <div class="row">
                    <div class="col-md-3">
                        <label for="name"><b>Park Name</b></label>
                         <!--An input form element of type=text for the name of the object. It is a required field.-->
                        <input id="name" type="text" placeholder="Enter name of object" name="name" required pattern="[a-zA-Z]*||^(?=.*\d)(?=.*[A-Z])(?!.*\s).*$||^(?=.*\d)(?=.*[a-z])(?!.*\s).*$">
                        <p>Only numbers not allowed and no special characters allowed</p>
                    </div>
                    <div class="col-md-3">
                        <label for="latitude"><b>Latitude</b></label>
                        <!--An input form element of type=text for the latitude of the object. It is a required field.-->
                        <input id="latitude" type="text" placeholder="Enter the lat coordinates" name="latitude" required>
                    </div>
                    <div class="col-md-3">
                        <label for="longitude"><b>Longitude</b></label>
                        <!--An input form element of type=text for the longitude of the object. It is a required field.-->
                        <input id="longitude" type="text" placeholder="Enter the long coordinates" name="longitude" required>
                    </div>
                    <div class="col-md-3">
                        <label for="userRating"><b>Rating</b></label>
                        <!--A select form element of for the rating tje user wants to give. It is a required field.-->
                        <select id="userRating" name="userRating" required>
                            <option value="" disabled selected>Select a Rating</option>
                            <option value="4.5-5">4.5 - 5</option>
                            <option value="4.0-4.4">4.0 - 4.4</option>
                            <option value="3.5-3.9">3.5 - 3.9</option>
                            <option value="3.0-3.4">3.0 - 3.4</option>
                            <option value="2.5-2.9">2.5 - 2.9</option>
                            <option value="2.0-2.4">2.0 - 2.4</option>
                            <option value="Less than 2.0">Less than 2.0</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="imageFile"><b>Upload Image</b></label>
                        <!--An input form element of type=file for the user to upload an image. It is an optional field.-->
                        <input id="imageFile"  type="file" name="imageFile">
                    </div>
                    <div class="col-md-12">
                        <label for="userReview"><b>Review</b></label>
                        <!--A textarea form element for the description of the object. It is a required field.-->
                        <textarea id="userReview" placeholder="Enter a descriotion of the object" name="userReview" required></textarea>
                    </div>
                </div>

                <div class="signin">
                    <button type="submit" class="btn btn-dark-blue">Submit</button>
                </div>
            </form>
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
        <script src="./js/SubmissionGeoLocation.js"></script>
    </body>
</html>
