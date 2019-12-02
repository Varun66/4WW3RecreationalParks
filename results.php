<!--DOCTYPE declaration which specifies that the document is in html5 -->
<?php
    //Import functions file with common functions
    include "phpfunctions/functions.php";

    //Create PDO and connect to the database
    $pdo = db_connect();

    //If the user is searching by name:
    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    if (isset($_POST['searchByName']) && isset($_POST['parkName'])) {
        //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
        $rows = sqlQuery($pdo, "Select * from objects where Name=?", [$_POST['parkName']], true);

    //If the user is searching by rating:
    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    } else if (isset($_POST['searchByRating']) && isset($_POST['minRating']) && isset($_POST['maxRating'])) {
        //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
        $rows = sqlQuery(
            $pdo,
            "Select objects.*, AVG(Rating) from reviews inner join objects on objects.Name=reviews.ParkName group by reviews.ParkName having AVG(Rating) > ? AND AVG(Rating) < ?",
            [$_POST['minRating'], $_POST['maxRating']],
            true
        );

    //If the user is searching by location:
    //Check if all the form fields are set and that they exist (validation for whether or not they are empty is done by the required attribute in the html)
    } else if (isset($_POST['searchByUserLocation']) && isset($_POST['userLocation']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
        //Call sqlQuery function which executes the specified sql query with the appropriate parameters and returns the result
        $allRows = sqlQuery($pdo, "Select * from objects", [], true);
        $rows = array();

        //Check if the user want's to see parks within more than a 200 km radium from them. This would just include all parks
        if ($_POST['userLocation'] === "More than 200"){
            $rows = $allRows;
        } else {
            //Loop through the query result and call distance function to check the condition
            for ($i = 0; $i < count($allRows); $i++){
                if(distance($_POST['latitude'], $_POST['longitude'], $allRows[$i]['Latitude'], $allRows[$i]['Longitude']) <= $_POST['userLocation']){
                    //Push the result to the rows array
                    array_push($rows, $allRows[$i]);
                }
            }
        }

    //If the user is wants to see all parks:
    } else if (isset($_POST['viewAllParks'])) {
        $rows = sqlQuery($pdo, "Select * from objects", [], true);
    }
?>

<?php include "header.php";?>

<!--This container holds the map. It is given the class of container fluid so that is spans across the whole screen and the p-0 class removes any padding.-->
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
                //Import necessary libraries to send objects to AWS S3 bucket
                require './vendor/autoload.php';

                use Aws\S3\S3Client;
                use Aws\Exception\AwsException;

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

                //Check if there is at least 1 park found
                if (count($rows) > 0){
                    //Create a for loop which loops through the array and display's the information on the page.
                    for ($i = 0; $i < count($rows); $i++) {
                        try {
                            //Check if the image key is empty for each row
                            if(strlen($rows[$i]['ImageKey']) >= 1) {
                                //Use getObjectUrl() method to retrieve the image url from s3 (all the objects in the bucket are public)
                                $url = $s3->getObjectUrl('myparkfinders3', $rows[$i]['ImageKey']);
                            } else {
                                $url = '';
                            }
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
                    //If there are no parks found, display a message.
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
<!--Store the sql query result in a javascript variable so that it can be used in another javascript file (this is to display the markers on the map)-->
<script type="text/javascript">var parks =<?php echo json_encode($rows); ?>;</script>
<?php include "footer.php";?>