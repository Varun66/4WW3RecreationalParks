<?php
    //Globally declare AWS credentials so that all files using AWS API can access this
    $bucketName = 'myparkfinders3';
    $IAM_KEY = '';
    $IAM_SECRET = '';

    //A function to connect to the database using PDOs and returns the PDO.
    function db_connect(){
        //Creating a new PDO with the specified db name, username and password.
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    //A function that handles validation cases
    function handleError($session, $param, $location){
        //Setting the desired session attribute to the desired value
        $_SESSION[$session] = $param;
        //Redirecting to the desired location
        header("Location: https://{$_SERVER['HTTP_HOST']}/$location");
    }

    //A function that excutes SQL queries and returns the result depending of the fetchResults parameter.
    function sqlQuery($pdo, $sql, $executeArr, $fetchResults){
        // Prepared statements with the desired SQL as the template
        $stmnt = $pdo->prepare($sql);
        //Try executing the prepared statement
        try {
            $stmnt->execute($executeArr);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //If the results are needed, then return the results
        if($fetchResults) {
            $rows = $stmnt->fetchAll();
            return $rows;
        }
    }

    //A function to display error messages on the page
    function displayError($msg, $session){
        echo $msg;
        //Resetting the session value to default
        $_SESSION[$session] = 'default';
    }

    //copied distance function from https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
    function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
          pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

?>