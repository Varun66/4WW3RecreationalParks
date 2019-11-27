<!-- Web Page for user to Register the form -->

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

        <div class="container register-form">
            <!--A form element for the user registration. Right now, it performs no action. The POST method means that the it will be sending data to the server.-->
            <form action="#" method="POST" name="registerForm" action="/action_page.php" onsubmit="return validateForm()" method="post">

                <h2>Register</h2>
                <p>Please fill in this form to create an account.</p>
                <!--The <hr> element creates a horizontal line which acts as a divider-->
                <hr>

                 <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-4" to say that for any viewport size above and including 768px,
                    the <div> width should be 4 columns or 33.3333%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
                <div class="row">
                    <div class="col-md-4">
                        <label for="name"><b>Name</b></label>
                        <!--An input form element of type=text for the name of the user. It is a required field.-->
                        <input id="name" type="text" placeholder="Enter name" name="name">
                    </div>
                    <div class="col-md-4">
                        <label for="email"><b>Email</b></label>
                        <!--An input form element of type=email for the email of the user. It is a required field-->
                        <input id="email" type="text" placeholder="Enter email" name="email">
                    </div>
                    <div class="col-md-4">
                        <label for="psw"><b>Password</b></label>
                        <!--An input form element of type=password for the password of the user account. It is a required field-->
                        <input id="psw" type="password" placeholder="Enter password" name="psw">
                    </div>
                    <div class="col-md-4">
                        <label for="psw-confirm"><b>Confirm Password</b></label>
                        <!--An input form element of type=password for the user to confirm their password. It is a required field-->
                        <input id="psw-confirm" type="password" placeholder="Confirm password" name="psw-confirm">
                    </div>
                    <div class="col-md-4">
                        <label for="date"><b>Birth Date</b></label>
                        <!--An input form element of type=date for the user's date of birth. It is an optional field-->
                        <input id="date" type="date" name="date">
                    </div>
                    <div class="col-md-4">
                        <label for="gender"><b>Gender</b></label>
                        <!--An select form element for the gender of the user. It is an optional field-->
                        <select id="gender" name="gender">
                            <option value="" disabled selected>Select a Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="register-submit">
                    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                    <button type="submit" class="btn btn-dark-blue">Register</button>
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
        <script src="./js/registration.js"></script>

    </body>
</html>