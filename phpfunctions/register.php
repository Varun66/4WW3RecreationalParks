<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['date']) && isset($_POST['age'])){
                $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Query we are using to check if the user is legit
                $sql = "INSERT INTO users (Name, Email, Password, BirthDate, Age) VALUES (?, ?, ?, ?, ?)";
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute([$_POST['name'], $_POST['email'], password_hash($_POST["psw"], PASSWORD_DEFAULT), $_POST['date'], $_POST['age']]);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                // Redirect to login page
                header("Location: http://{$_SERVER['HTTP_HOST']}/4ww3recreationalparks/loginPage.php");
            } else {
                echo "failed";
            }
?>