<?php
    session_start();
?>
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
        <?php if(basename($_SERVER['PHP_SELF']) == 'registration.php' || basename($_SERVER['PHP_SELF']) == 'loginPage.php'){ ?>
            <link rel="stylesheet" href="./css/RegistrationForm.css?v=1">
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'index.php'){ ?>
            <link rel="stylesheet" href="./css/search.css?v=1">
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'results.php'){ ?>
            <link rel="stylesheet" href="./css/results_sample.css?v=1">
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'submission.php'){ ?>
            <link rel="stylesheet" href="./css/RegistrationForm.css?v=1">
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'individual.php'){ ?>
            <link rel="stylesheet" href="./css/individual_sample.css?v=1">
        <?php } ?>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="submission.php">Submit a Park</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <!--The Sign Up menu item is displayed only on touch screen devices. Otherwise, it is hidden-->
                        <li class="nav-item mobile-only">
                            <a class="nav-link" href="registration.php">Sign Up</a>
                        </li>
                    </ul>
                </div>
                <?php
                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                        $user = $_SESSION['username'];
                        echo '<p class="welcome-msg">Welcome '. $user . '</p>';
                        echo '<a href="phpfunctions/logout.php" class="btn btn-outline-white sign-up-btn">Logout</a>';
                    } else {
                        echo '<a href="loginPage.php" class="btn btn-outline-white login-btn">Login</a>';
                        echo '<a href="registration.php" class="btn btn-outline-white sign-up-btn">Sign Up</a>';
                    }
                ?>
            </nav>
        </header>