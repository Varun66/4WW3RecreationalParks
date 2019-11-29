<?php
    session_start();
    $_SESSION['logged'] = false;

    $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email']) && isset($_POST['pwd'])){

        // Query we are using to check if the user is legit
        $sql = "Select * from users where Email=?";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['email']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // For getting data from the query to submitted above.
        $rows = $stmnt->fetchAll();

        // If there is only one user
        if (count($rows) != 1){
            // Setting the session to the returned user ID.
            echo 'account already exists';
        } else if (password_verify($_POST['pwd'], $rows[0]['Password'])) {
            $_SESSION['username'] = $rows[0]['Name'];
            $_SESSION['logged'] = true;
            header("Location: http://{$_SERVER['HTTP_HOST']}/4ww3recreationalparks/index.php");
        } else {
            echo 'incorrect password';
        }

    } else {
        // This path is dependent on where the root of your documents is located.
        // For this it is made to point back to the index file if login has failed.
        echo 'failed';
    }
?>