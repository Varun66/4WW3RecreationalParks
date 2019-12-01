<?php
    if (isset($_POST['userName']) && isset($_POST['parkName']) && isset($_POST['userRating']) && isset($_POST['userReview']) ) {
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query we are using to check if the user is legit
        $sql = "INSERT INTO reviews (Username, ParkName, Rating, Review) VALUES (?, ?, ?, ?)";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['userName'], $_POST['parkName'], $_POST['userRating'], $_POST['userReview']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>