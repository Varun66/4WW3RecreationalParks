<!--DOCTYPE declaration which specifies that the document is in html5 -->
<?php
    require './vendor/autoload.php';

    use Aws\S3\S3Client;
    use Aws\Exception\AwsException;

    parse_str($_SERVER['QUERY_STRING'], $result);

    $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query we are using to check if the user is legit
    $sql = "Select * from objects where ID=?";
    $stmnt = $pdo->prepare($sql);
    try {
        $stmnt->execute([$result['id']]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // For getting data from the query to submitted above.
    $rows = $stmnt->fetchAll();

    // Query we are using to check if the user is legit
    $sqlReview = "Select * from reviews where ParkName=?";
    $stmntReview = $pdo->prepare($sqlReview);
    try {
        $stmntReview->execute([$rows[0]['Name']]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // For getting data from the query to submitted above.
    $rowsReview = $stmntReview->fetchAll();

    $IAM_KEY = '';
    $IAM_SECRET = '';

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
        // Get the object.
        $url = $s3->getObjectUrl('myparkfinders3', $rows[0]['ImageKey']);
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
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    ?>
        <form class="review-form" action="" name="reviewForm">
            <h4>Submit a review:</h4>
            <div class="row">
                <div class="col-md-3">
                    <label for="userRating"><b>Rating</b></label>
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
                    <!--A textarea form element for the description of the object. It is a required field.-->
                    <textarea id="userReview" placeholder="Enter a your review" name="userReview" required></textarea>
                </div>
                <input type="hidden" name="parkName" value="<?php echo $rows[0]["Name"] ?>">
                <input type="hidden" name="userName" value="<?php echo $_SESSION['username'] ?>">
                <div class="signin">
                    <button type="submit" class="btn btn-dark-blue">Submit</button>
                </div>
            </div>
        </form>
        <hr>
    <?php
        } else {
            echo '<h4>Login to submit your own review.</h4>';
        }
    ?>
    <div class="ratings">
        <?php
            if (count($rowsReview) > 0) {
                for ($i = 0; $i < count($rowsReview); $i++) {
                    echo '
                        <!--The follow <div> block contains the markup for the Review microdata schema-->
                        <div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
                            <!--This column contains the user profile picture-->
                            <div class="col-1 rating-img">
                                <img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
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
                echo '<h4 class="no-reviews">There are no reviews for this park yet.</h4>';
            }
        ?>
    </div>
</div>

<script type="text/javascript">var parks =<?php echo json_encode($rows); ?>;</script>
<?php include "footer.php";?>