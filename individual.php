<?php
    //Import functions file with common functions
    include 'phpfunctions/functions.php';

    //Import necessary libraries to send objects to AWS S3 bucket
    require './vendor/autoload.php';

    use Aws\S3\S3Client;
    use Aws\Exception\AwsException;

    //Use in-built php function to parse the URL query string to get the id
    parse_str($_SERVER['QUERY_STRING'], $result);

    //Create PDO and connect to the database
    $pdo = db_connect();

    //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
    $rows = sqlQuery($pdo, "Select * from objects where ID=?", [$result['id']], true);
    $rowsReview = sqlQuery($pdo, "Select * from reviews where ParkName=?", [$rows[0]['Name']], true);

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

    try {
        //Check if the image key is empty
        if(strlen($rows[0]['ImageKey']) >= 1) {
            //Use getObjectUrl() method to retrieve the image url from s3 (all the objects in the bucket are public)
            $url = $s3->getObjectUrl('myparkfinders3', $rows[0]['ImageKey']);
        } else {
            $url = '';
        }
    } catch (S3Exception $e) {
        $url = '';
    }
?>

<?php include "header.php";?>

<!--This <div> block represents the top banner area of the page. The banner-bg class has the css for the background image
    and it is the defined as the parent div (i.e. the top most element) because the background should be full width and
    it should cover all the elements inside the parent div (i.e. all the child elements)-->
<div class="banner-bg" data-bg="<?php echo $url;?>">
    <div class="container">
        <div class="top-banner">
            <h1><?php echo $rows[0]['Name']; ?></h1>
        </div>
    </div>
</div>

<!--This container holds the map. It also contains the Place microdata schema-->
<div class="container section-padding map-location" itemscope itemtype="http://schema.org/Place">
    <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
        <meta itemprop="latitude" content="45.195829" />
        <meta itemprop="longitude" content="-81.5239711" />
        <div id="map"></div>
    </div>
</div>

<!--This container has details about the park.-->
<div class="container details-section">
    <h2>Park Details</h2>
    <p><?php echo $rows[0]['Description']; ?></p>
</div>

<!--This is the ratings and reviews section. It uses the bootstrap grid system to display each user review-->
<div class="container section-padding ratings-section">
    <h2>Ratings and Reviews</h2>
    <?php
        //If the user is logged in, then display the form for them to submit a review.
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    ?>
        <form class="review-form" action="" name="reviewForm">
            <h4>Submit a review:</h4>
            <div class="row">
                <div class="col-md-3">
                    <label for="userRating"><b>Rating</b></label>
                    <!--A select form element for the rating of the object. It is a required field.-->
                    <select name="userRating" required>
                        <option value="" disabled selected>Select a Rating (High - Low)</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="userReview"><b>Review</b></label>
                    <!--A textarea form element for the review of the object. It is a review field.-->
                    <textarea id="userReview" placeholder="Enter a your review" name="userReview" required></textarea>
                </div>
                <!--Input hidden form element to store the park name and username. This will not be visible to the users.-->
                <input type="hidden" name="parkName" value="<?php echo $rows[0]["Name"] ?>">
                <input type="hidden" name="userName" value="<?php echo $_SESSION['username'] ?>">
                <div class="signin">
                    <button type="submit" class="btn btn-dark-blue">Submit</button>
                </div>
            </div>
        </form>
        <hr>
    <?php
        //If the user is not logged in, then display a message.
        } else {
            echo '<h4>Login to submit your own review.</h4>';
        }
    ?>
    <div class="ratings">
        <?php
            //Check if there is at least 1 review for the object
            if (count($rowsReview) > 0) {
                //Create a for loop which loops through the array and display's the information on the page.
                for ($i = 0; $i < count($rowsReview); $i++) {
                    echo '
                        <!--The follow <div> block contains the markup for the Review microdata schema-->
                        <div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
                            <!--This column contains the user profile picture-->
                            <div class="col-1 rating-img">
                                <img src="https://myparkfinders3.s3.amazonaws.com/anonymous-user.png" alt="A profile picture of the user"/>
                            </div>
                            <!--This column contains the user name, rating, date of post and review-->
                            <div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <div class="rating-author">
                                    <p><b><span itemprop="name">'.$rowsReview[$i]['Username'].'</span></b><br/>Rating: <span itemprop="ratingValue">'.$rowsReview[$i]['Rating'].'</span>/5</p>
                                </div>
                                <p itemprop="reviewBody">'.$rowsReview[$i]['Review'].'</p>
                            </div>
                        </div>
                    ';
                }
            } else {
                //Display message if there are no reviews yet.
                echo '<h4 class="no-reviews">There are no reviews for this park yet.</h4>';
            }
        ?>
    </div>
</div>
<!--Store the sql query result in a javascript variable so that it can be used in another javascript file (this is to display the markers on the map)-->
<script type="text/javascript">var parks =<?php echo json_encode($rows); ?>;</script>
<?php include "footer.php";?>