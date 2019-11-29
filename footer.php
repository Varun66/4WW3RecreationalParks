        <!--This is the footer of the document-->
        <footer>
            <div class="container footer">
                <!--It has a <ul> element with some footer links to navigate around the website.-->
                <ul>
                    <li>
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li>
                        <a class="nav-link" href="submission.php">Submit a Review</a>
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
        <?php if(basename($_SERVER['PHP_SELF']) == 'registration.php'){ ?>
            <script src="./js/registration.js"></script>
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'index.php'){ ?>
            <script src="./js/searchPage.js"></script>
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'results.php'){ ?>
            <script src="./js/resultsPage.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=API_key&callback=initLocationProcedure" async defer></script>
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'submission.php'){ ?>
            <script src="./js/SubmissionGeoLocation.js"></script>
        <?php } elseif(basename($_SERVER['PHP_SELF']) == 'individual.php'){ ?>
            <script src="js/objectPage.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=API_key&callback=initLocationProcedure" async defer></script>
        <?php } ?>
    </body>
</html>
