<?php
    //Start session
    session_start();
    //Import functions file with common functions
    include 'functions.php';

    //Set inital log status to false
    $_SESSION['logged'] = false;

    //Create PDO and connect to the database
    $pdo = db_connect();

    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    if (isset($_POST['email']) && isset($_POST['pwd'])){

        //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
        $rows = sqlQuery($pdo, "Select * from users where Email=?", [$_POST['email']], true);

        //Check if the inputted password matches the password stored in the database (password_verify decrypts the hashed/salted password in the database)
        if (password_verify($_POST['pwd'], $rows[0]['Password'])) {
            //If succesful, store the username in the session
            $_SESSION['username'] = $rows[0]['Name'];
            //Redirect to home page
            handleError("logged", true, "index.php");

        } else {
            //If failed, post back to login page with the error message
            handleError("account", "Incorrect", "loginPage.php");

        }

    } else {
        //If failed, post back to login page with the error message
        handleError("account", "Incorrect", "loginPage.php");
    }
?>