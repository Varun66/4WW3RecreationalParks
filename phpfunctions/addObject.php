<?php
    //Start session
    session_start();
    //Import functions file with common functions
    include 'functions.php';

    //Display errors on the page for debugging
    ini_set('display_errors', 1);

    //Import necessary libraries to send objects to AWS S3 bucket
    require '../vendor/autoload.php';

    use Aws\S3\S3Client;
    use Aws\Exception\AwsException;

    //Create PDO and connect to the database
    $pdo = db_connect();

    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    if (isset($_POST['name']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['description'])){
        //Check if the latitude matches the given regex. It should be a number between -90 and 90.
        if (!(preg_match('/^(-?[1-8]?\d(?:\.\d{1,18})?|90(?:\.0{1,18})?)$/', $_POST['latitude']))){
            //Call handleError function to set the session value appropriately and post back to the submission page.
            handleError("status", "InvalidLatitude", "submission.php");

        //Check if the longitude matches the given regex. It should be a number between -180 and 180.
        } else if (!(preg_match('/^(-?(?:1[0-7]|[1-9])?\d(?:\.\d{1,18})?|180(?:\.0{1,18})?)$/', $_POST['longitude']))){
            //Call handleError function to set the session value appropriately and post back to the submission page.
            handleError("status", "InvalidLongitude", "submission.php");

        } else {
            //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
            $rows = sqlQuery($pdo, "Select * from objects where Name=?", [$_POST['name']], true);

            //Check if the object already exists in the database
            if (count($rows) > 0) {
                handleError("status", "Duplicate", "submission.php");

            } else {
                //Variable to store the image key created for each image being sent to the s3 bucket. This key will get stored in the database
                $key = '';

                //Check if there is a file uploaded
                if(is_uploaded_file($_FILES["imageFile"]['tmp_name'])){
                    //Try to execute the following block. If it fails, then stop and display the error
                    try {
                        //Connect to aws by passing the credentials
                        $s3 = S3Client::factory(
                            array(
                                'credentials' => array(
                                    'key' => $IAM_KEY,
                                    'secret' => $IAM_SECRET,
                                ),
                                'version' => 'latest',
                                'region'  => 'us-east-1',
                            )
                        );
                    } catch (Exception $e) {
                        die("Error: " . $e->getMessage());
                    }

                    //Generate random key for each file
                    $key = basename($_FILES["imageFile"]['tmp_name']);
                    $file = $_FILES["imageFile"]['tmp_name'];
                    //Try executing the following block. If it fails, then stop and display the error.
                    try {
                        //Upload the object to s3:
                        $s3->putObject(
                            array(
                                'Bucket'=>$bucketName,
                                'Key' =>  $key,
                                'SourceFile' => $file,
                                'StorageClass' => 'REDUCED_REDUNDANCY',
                            )
                        );
                    } catch (S3Exception $e) {
                        die('Error:' . $e->getMessage());
                    } catch (Exception $e) {
                        die('Error:' . $e->getMessage());
                    }
                }

                try{
                    //Execute an sql query to post the form data to the database
                    sqlQuery(
                        $pdo,
                        "INSERT INTO objects (Name, Latitude, Longitude, ImageKey, Description) VALUES (?, ?, ?, ?, ?)",
                        [$_POST['name'], $_POST['latitude'], $_POST['longitude'], $key, $_POST['description']],
                        false
                    );

                    //If it submitted successfully, redirect to the submission page with a success status
                    handleError("status", "success", "submission.php");
                } catch (Execption $e){
                    //If it submission failed, redirect to the submission page with a failed status
                    handleError("status", "failed", "submission.php");
                }
            }
        }

    } else {
        //If there are any missing fields, then redirect to the submission page with an unset stateus
        handleError("status", "Unset", "submission.php");
    }
?>