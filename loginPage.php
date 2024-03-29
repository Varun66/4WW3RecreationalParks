<?php
    include "header.php";
    //Import functions file with common functions
    include 'phpfunctions/functions.php';
?>

<div  class="container register-form">
    <form action="phpfunctions/login.php" method="POST" name="registerForm" method="post">
        <?php
            //Display error message depending on the value stored in the session variable
            if (isset($_SESSION['account']) && $_SESSION['account'] === "Incorrect"){
                displayError('<h4 class="fail-msg">The password or email is incorrect! Please try again.</h4>', 'account');
            }
        ?>
        <h2>Login</h2>
        <div class="row">
            <div class="col-md-6">
                <label for="email"><b>Email</b></label>
                <!--An input form element of type=text for the email. It is a required field.-->
                <input id="email" type="email" name="email" required>
            </div>
            <div class="col-md-6">
                <label for="pwd"><b>Password</b></label>
                <!--An input form element of type=email for the password. It is a required field-->
                <input id="pwd" type="password" name="pwd" required>
            </div>
        </div>
        <div class="register-submit">
            <button type="submit" class="btn btn-dark-blue">Login</button>
        </div>
    </form>
</div>

<?php include "footer.php";?>