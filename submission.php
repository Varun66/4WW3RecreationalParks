<!-- Web Page for user to submit the form -->
<?php include "header.php";?>

<?php
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
?>
<div class="container register-form">
    <!--A form element for the user registration. Right now, it performs no action. The POST method means that the it will be sending data to the server.-->
    <form action="phpfunctions/addObject.php" name="submissionForm" method="post" enctype="multipart/form-data">
        <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] === "success"){
                echo '<h4 class="success-msg">Thank you! Your submission was successful.</h4>';
                $_SESSION['status'] = "default";
            } else if (isset($_SESSION['status']) && $_SESSION['status'] === "InvalidLatitude") {
                echo '<h4 class="fail-msg">Please check the format of the latitude field!</h4>';
                $_SESSION['status'] = "default";
            } else if (isset($_SESSION['status']) && $_SESSION['status'] === "InvalidLongitude") {
                echo '<h4 class="fail-msg">Please check the format of the longitude field!</h4>';
                $_SESSION['status'] = "default";
            } else if (isset($_SESSION['status']) && $_SESSION['status'] === "Duplicate") {
                echo '<h4 class="fail-msg">This park already exists in our database!</h4>';
                $_SESSION['status'] = "default";
            } else if (isset($_SESSION['status']) && $_SESSION['status'] === "Unset") {
                echo '<h4 class="fail-msg">The submission failed! Please try again later.</h4>';
                $_SESSION['status'] = "default";
            }
        ?>
        <h2>Submission</h2>
        <p>Please fill in this form to submit a review.</p>
        <!--The <hr> element creates a horizontal line which acts as a divider-->
        <hr>

        <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-4" to say that for any viewport size above and including 768px,
            the <div> width should be 4 columns or 33.3333%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
        <div class="row">
            <div class="col-md-3">
                <label for="name"><b>Park Name</b></label>
                    <!--An input form element of type=text for the name of the object. It is a required field.-->
                <input id="name" type="text" placeholder="Enter name of object" name="name" required pattern="[a-zA-Z ]*||^(?=.*\d)(?=.*[A-Z ])(?!.*\s).*$||^(?=.*\d)(?=.*[a-z])(?!.*\s).*$">
                <p>Only numbers not allowed and no special characters allowed</p>
            </div>
            <div class="col-md-3">
                <label for="latitude"><b>Latitude</b></label>
                <!--An input form element of type=text for the latitude of the object. It is a required field.-->
                <input id="latitude" type="text" placeholder="Enter the lat coordinates" name="latitude" required>
            </div>
            <div class="col-md-3">
                <label for="longitude"><b>Longitude</b></label>
                <!--An input form element of type=text for the longitude of the object. It is a required field.-->
                <input id="longitude" type="text" placeholder="Enter the long coordinates" name="longitude" required>
            </div>
            <div class="col-md-3">
                <label for="imageFile"><b>Upload Image</b></label>
                <!--An input form element of type=file for the user to upload an image. It is an optional field.-->
                <input id="imageFile"  type="file" name="imageFile">
            </div>
            <div class="col-md-12">
                <label for="description"><b>Description</b></label>
                <!--A textarea form element for the description of the object. It is a required field.-->
                <textarea id="description" placeholder="Enter a descriotion of the object" name="description" required></textarea>
            </div>
        </div>

        <div class="signin">
            <button type="submit" class="btn btn-dark-blue">Submit</button>
        </div>
    </form>
</div>

<?php
    } else {
        echo '<div class="login-message"><h2>Please login first to submit a new park!</h2></div>';
    }
?>

<?php include "footer.php";?>