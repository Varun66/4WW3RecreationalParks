<!-- Web Page for user to Register the form -->
<?php include "header.php";?>

<div class="container register-form">
    <!--A form element for the user registration. Right now, it performs no action. The POST method means that the it will be sending data to the server.-->
    <form action="phpfunctions/register.php" method="POST" name="registerForm" method="post">
        <?php
            if (isset($_SESSION['validate']) && $_SESSION['validate'] === "success"){
                echo '<h4 class="success-msg">Thank you! Your registration was successful. You can login in now.</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "failed") {
                echo '<h4 class="fail-msg">Your registration was not successful!</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "InvalidEmail") {
                echo '<h4 class="fail-msg">Please check the format of the email field!</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "InvalidPassword") {
                echo '<h4 class="fail-msg">The password does not match!</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "InvalidDate") {
                echo '<h4 class="fail-msg">Please check the format of the date field!</h4>';
                $_SESSION['validate'] = "default";
            }  else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "InvalidAge") {
                echo '<h4 class="fail-msg">Please check the format of the age field! It should be a number</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "Unset") {
                echo '<h4 class="fail-msg">The submission failed! Please try again later.</h4>';
                $_SESSION['validate'] = "default";
            } else if (isset($_SESSION['validate']) && $_SESSION['validate'] === "Duplicate") {
                echo '<h4 class="fail-msg">An account with this email already exists!</h4>';
                $_SESSION['validate'] = "default";
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
                <input id="name" type="text" placeholder="Enter name" name="name" required>
            </div>
            <div class="col-md-4">
                <label for="email"><b>Email</b></label>
                <!--An input form element of type=email for the email of the user. It is a required field-->
                <input id="email" type="text" placeholder="Enter email" name="email" required>
            </div>
            <div class="col-md-4">
                <label for="psw"><b>Password</b></label>
                <!--An input form element of type=password for the password of the user account. It is a required field-->
                <input id="psw" type="password" placeholder="Enter password" name="psw" required>
            </div>
            <div class="col-md-4">
                <label for="psw-confirm"><b>Confirm Password</b></label>
                <!--An input form element of type=password for the user to confirm their password. It is a required field-->
                <input id="psw-confirm" type="password" placeholder="Confirm password" name="psw-confirm" required>
            </div>
            <div class="col-md-4">
                <label for="date"><b>Birth Date</b></label>
                <!--An input form element of type=date for the user's date of birth. It is an optional field-->
                <input id="date" type="text"  placeholder="yyyy-mm-dd" name="date" required>
            </div>
            <div class="col-md-4">
                <label for="age"><b>Age</b></label>
                <!--An input form element of type=date for the user's date of birth. It is an optional field-->
                <input id="age" type="text" placeholder="Enter a number"  name="age" required>
            </div>
        </div>

        <div class="register-submit">
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" class="btn btn-dark-blue">Register</button>
        </div>

    </form>

</div>

<?php include "footer.php";?>