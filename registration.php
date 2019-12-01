<!-- Web Page for user to Register the form -->
<?php include "header.php";?>

<?php
    // define variables and set to empty values
    $nameErr = $emailErr = $pswErr = $confirmPswErr = $birthDateErr = $ageErr= "";
    $isFormValid = true;
    $hashed_salted_pwd = null;
    $submit_status = "default";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $isFormValid = false;
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isFormValid = false;
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isFormValid = false;
        }

        if (empty($_POST["psw"])) {
            $pswErr = "Password is required";
            $isFormValid = false;
        }

        if (empty($_POST["psw-confirm"])) {
            $confirmPswErr = "Confirm password is required";
            $isFormValid = false;
        }else if ($_POST["psw"] !== $_POST["psw-confirm"]) {
            $confirmPswErr = "Password does not match";
            $isFormValid = false;
        } else {
            $hashed_salted_pwd = password_hash($_POST["psw"], PASSWORD_DEFAULT);
        }

        if (empty($_POST["date"])) {
            $birthDateErr = "Birth Date is required";
            $isFormValid = false;
        }else if (!(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST["date"]))) {
            $birthDateErr = "Date is in wrong format";
            $isFormValid = false;
        }

        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
            $isFormValid = false;
        }else if (!(is_numeric($_POST["age"]))) {
            $ageErr = "Please enter a number";
            $isFormValid = false;
        }

        if ($isFormValid) {
            $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query we are using to check if the user is legit
            $sql = "INSERT INTO users (Name, Email, Password, BirthDate, Age) VALUES (?, ?, ?, ?, ?)";
            $stmnt = $pdo->prepare($sql);
            try {
                $stmnt->execute([$_POST['name'], $_POST['email'], $hashed_salted_pwd, $_POST['date'], $_POST['age']]);
                $submit_status = "success";
            } catch (PDOException $e) {
                $submit_status = "failed";
                echo $e->getMessage();
            }
        }
    }
?>
<div class="container register-form">
    <!--A form element for the user registration. Right now, it performs no action. The POST method means that the it will be sending data to the server.-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="registerForm" method="post">
        <?php
            if ($submit_status === "success"){
                echo '<h4 class="success-msg">Thank you! Your registration was successful. You can login in now.</h4>';
                $_SESSION['status'] = "default";
            } else if ($submit_status === "failed") {
                echo '<h4 class="fail-msg">Your registration was not successful!</h4>';
                $_SESSION['status'] = "default";
            } else {
                echo '';
            }
        ?>
        <h2>Register</h2>
        <p>Please fill in this form to create an account.</p>
        <!--The <hr> element creates a horizontal line which acts as a divider-->
        <hr>

            <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-4" to say that for any viewport size above and including 768px,
            the <div> width should be 4 columns or 33.3333%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
        <div class="row">
            <div class="col-md-4">
                <label for="name"><b>Name</b></label>
                <!--An input form element of type=text for the name of the user. It is a required field.-->
                <input id="name" type="text" placeholder="Enter name" name="name">
                <div class="error"><?php echo $nameErr;?></div>
            </div>
            <div class="col-md-4">
                <label for="email"><b>Email</b></label>
                <!--An input form element of type=email for the email of the user. It is a required field-->
                <input id="email" type="text" placeholder="Enter email" name="email">
                <div class="error"><?php echo $emailErr;?></div>
            </div>
            <div class="col-md-4">
                <label for="psw"><b>Password</b></label>
                <!--An input form element of type=password for the password of the user account. It is a required field-->
                <input id="psw" type="password" placeholder="Enter password" name="psw">
                <div class="error"><?php echo $pswErr;?></div>
            </div>
            <div class="col-md-4">
                <label for="psw-confirm"><b>Confirm Password</b></label>
                <!--An input form element of type=password for the user to confirm their password. It is a required field-->
                <input id="psw-confirm" type="password" placeholder="Confirm password" name="psw-confirm">
                <div class="error"><?php echo $confirmPswErr;?></div>
            </div>
            <div class="col-md-4">
                <label for="date"><b>Birth Date</b></label>
                <!--An input form element of type=date for the user's date of birth. It is an optional field-->
                <input id="date" type="text"  placeholder="yyyy-mm-dd" name="date">
                <div class="error"><?php echo $birthDateErr;?></div>
            </div>
            <div class="col-md-4">
                <label for="age"><b>Age</b></label>
                <!--An input form element of type=date for the user's date of birth. It is an optional field-->
                <input id="age" type="text" placeholder="Enter a number"  name="age">
                <div class="error"><?php echo $ageErr;?></div>
            </div>
        </div>

        <div class="register-submit">
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" class="btn btn-dark-blue">Register</button>
        </div>

    </form>

</div>

<?php include "footer.php";?>