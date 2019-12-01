<?php
    session_start();

    if (isset($_POST['name']) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["psw-confirm"]) && isset($_POST["date"]) && isset($_POST["age"])){

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['validate'] = "InvalidEmail";
            header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
        } else if ($_POST["psw"] !== $_POST["psw-confirm"]) {
            $_SESSION['validate'] = "InvalidPassword";
            header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
        } else if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST["date"]))) {
            $_SESSION['validate'] = "InvalidDate";
            header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
        } else if (!(is_numeric($_POST["age"]))) {
            $_SESSION['validate'] = "InvalidAge";
            header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
        } else {
            $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "Select * from users where Email=?";
            $stmnt = $pdo->prepare($sql);

            try {
                $stmnt->execute([$_POST['email']]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            $rows = $stmnt->fetchAll();
            if (count($rows) > 0) {
                $_SESSION['validate'] = "Duplicate";
                header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
            } else {
                $hashed_salted_pwd = password_hash($_POST["psw"], PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (Name, Email, Password, BirthDate, Age) VALUES (?, ?, ?, ?, ?)";
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute([$_POST['name'], $_POST['email'], $hashed_salted_pwd, $_POST['date'], $_POST['age']]);
                    $_SESSION['validate'] = "success";
                    header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
                } catch (PDOException $e) {
                    $_SESSION['validate'] = "failed";
                    header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
                }
            }
        }

    } else {
        $_SESSION['validate'] = "Unset";
        header("Location: https://{$_SERVER['HTTP_HOST']}/registration.php");
    }
?>