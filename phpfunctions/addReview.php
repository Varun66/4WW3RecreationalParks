<?php
    //Import functions file with common functions
    include 'functions.php';

    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    if (isset($_POST['userName']) && isset($_POST['parkName']) && isset($_POST['userRating']) && isset($_POST['userReview']) ) {
        //Create PDO object and connect to the database
        $pdo = db_connect();

        //Call sqlQuery function which executes the specified sql query with the appropriate parameters
        sqlQuery(
            $pdo,
            "INSERT INTO reviews (Username, ParkName, Rating, Review) VALUES (?, ?, ?, ?)",
            [$_POST['userName'], $_POST['parkName'], $_POST['userRating'], $_POST['userReview']],
            false
        );
    }
?>