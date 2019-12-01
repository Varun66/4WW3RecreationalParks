<!--DOCTYPE declaration which specifies that the document is in html5 -->
<?php
    //copied distance function from https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
    function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
          pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    if (isset($_POST['searchByName']) && isset($_POST['parkName'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query we are using to check if the user is legit
        $sql = "Select * from objects where Name=?";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['parkName']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // For getting data from the query to submitted above.
        $rows = $stmnt->fetchAll();

    } else if (isset($_POST['searchByRating']) && isset($_POST['minRating']) && isset($_POST['maxRating'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query we are using to check if the user is legit
        $sql = "Select objects.*, AVG(Rating) from reviews inner join objects on objects.Name=reviews.ParkName group by reviews.ParkName having AVG(Rating) > ? AND AVG(Rating) < ?";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['minRating'], $_POST['maxRating']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // For getting data from the query to submitted above.
        $rows = $stmnt->fetchAll();

    } else if (isset($_POST['searchByUserLocation']) && isset($_POST['userLocation']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query we are using to check if the user is legit
        $sql = "Select * from `objects`";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // For getting data from the query to submitted above.
        $allRows = $stmnt->fetchAll();
        $rows = array();

        if ($_POST['userLocation'] === "More than 200"){
            $rows = $allRows;
        } else {
            for ($i = 0; $i < count($allRows); $i++){
                if(distance($_POST['latitude'], $_POST['longitude'], $allRows[$i]['Latitude'], $allRows[$i]['Longitude']) <= $_POST['userLocation']){
                    array_push($rows, $allRows[$i]);
                }
            }
        }

    } else if (isset($_POST['viewAllParks'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query we are using to check if the user is legit
        $sql = "Select * from objects";
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // For getting data from the query to submitted above.
        $rows = $stmnt->fetchAll();
    }
?>

<?php include "header.php";?>

<!--This container holds the map. For now it is an image, but it will change to an actual map. It is given the class of container fluid so that is spans across
the whole screen and the p-0 class removes any padding.-->
<div class="container-fluid p-0">
    <div id="map"></div>
</div>

<!--This container holds the search results table-->
<div class="container section-padding">
    <h2 class="text-center">Results</h2>
    <!--A <table> element is used to create the results table-->
    <table>
        <!-- The <colgroup> tag can be used to apply styles to entire columns. Here, we are setting the width of each column in the table using their corresponding classes. -->
        <colgroup>
            <col class="col-big">
            <col class="col-small">
            <col class="col-small">
        </colgroup>
        <!--The header of the table which consists of <th> elements that represent each heading-->
        <thead>
            <tr>
                <th>Parks</th>
            </tr>
        </thead>
        <!--The body of the table which consists of rows (i.e. <tr> tags) and the tabular data to be displayed in each row (i.e. <td> tags)-->
        <tbody>
            <?php
                require './vendor/autoload.php';

                use Aws\S3\S3Client;
                use Aws\Exception\AwsException;

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

                if (count($rows) > 0){
                    for ($i = 0; $i < count($rows); $i++) {
                        try {
                            // Get the object.
                            $url = $s3->getObjectUrl('myparkfinders3', $rows[$i]['ImageKey']);
                        } catch (S3Exception $e) {
                            $url = '';
                        }

                        echo '
                            <tr>
                                <td>
                                    <!--Using the bootstrap grid system, we are defining a row that will consist of the park image and park details-->
                                    <div class="row">
                                        <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-6" to say that for any viewport size above and including 768px,
                                            the <div> width should be 6 columns or 50%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
                                        <div class="col-md-5">
                                            <img src="'.$url.'" alt="An image of a park"/>
                                        </div>
                                        <div class="col-md-7 park-details">
                                            <h4>'.$rows[$i]['Name'].'</h4>
                                            <p>'.$rows[$i]['Description'].'</p>
                                            <a href="individual.php?id='.$rows[$i]['ID'].'" target="_blank">View More Details</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                } else {
                    echo '
                        <tr>
                            <td>No Parks found</td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">var parks =<?php echo json_encode($rows); ?>;</script>
<?php include "footer.php";?>