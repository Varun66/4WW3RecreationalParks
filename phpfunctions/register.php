<?php
    //Start session
    session_start();
    //Import functions file with common functions
    include 'functions.php';

    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    if (isset($_POST['name']) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["psw-confirm"]) && isset($_POST["date"]) && isset($_POST["age"])){
        //Check if the email matches the correct format using the in built php function to validate emails.
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            //Call handleError function to set the session value appropriately and post back to the registration page.
            handleError("validate", "InvalidEmail", "registration.php");

        //Check if the confirm password and password field values match
        } else if ($_POST["psw"] !== $_POST["psw-confirm"]) {
            //Call handleError function to set the session value appropriately and post back to the registration page.
            handleError("validate", "InvalidPassword", "registration.php");

        //Check if the date matches the regex. It should be in yyyy-mm-dd format.
        } else if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST["date"]))) {
            //Call handleError function to set the session value appropriately and post back to the registration page.
            handleError("validate", "InvalidDate", "registration.php");

        //Check if the age is a number
        } else if (!(is_numeric($_POST["age"]))) {
            //Call handleError function to set the session value appropriately and post back to the registration page.
            handleError("validate", "InvalidAge", "registration.php");

        } else {
            //Create PDO and connect to the database
            $pdo = db_connect();
            //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
            $rows = sqlQuery($pdo, "Select * from users where Email=?", [$_POST['email']], true);

            //Check if the user account already exists in the database by checking the Email field
            if (count($rows) > 0) {
                //Call handleError function to set the session value appropriately and post back to the registration page.
                handleError("validate", "Duplicate", "registration.php");

            } else {
                //Use in-built php function to hash and salt the password given by the user
                $hashed_salted_pwd = password_hash($_POST["psw"], PASSWORD_DEFAULT);

                try {
                    //Call sqlQuery function which executes the specified sql query with the appropriate parameters
                    sqlQuery(
                        $pdo,
                        "INSERT INTO users (Name, Email, Password, BirthDate, Age) VALUES (?, ?, ?, ?, ?)",
                        [$_POST['name'], $_POST['email'], $hashed_salted_pwd, $_POST['date'], $_POST['age']],
                        false
                    );

                    //On success, set the session value appropriately and post back to the registration page.
                    handleError("validate", "success", "registration.php");

                } catch (PDOException $e) {
                    //On fail, set the session value appropriately and post back to the registration page.
                    handleError("validate", "failed", "registration.php");
                }
            }
        }

    } else {
        //If any fields are missing, set the session value appropriately and post back to the registration page.
        handleError("validate", "Unset", "registration.php");
    }
?>