<!--DOCTYPE declaration which specifies that the document is in html5 -->
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
                <th>Park</th>
                <th>Rating</th>
                <th>City</th>
            </tr>
        </thead>
        <!--The body of the table which consists of rows (i.e. <tr> tags) and the tabular data to be displayed in each row (i.e. <td> tags)-->
        <tbody>
            <tr>
                <td>
                    <!--Using the bootstrap grid system, we are defining a row that will consist of the park image and park details-->
                    <div class="row">
                        <!--The bootstrap grid system is split into 12 columns. We are using the class "col-md-6" to say that for any viewport size above and including 768px,
                            the <div> width should be 6 columns or 50%. For anything below 768px, the <div> should be 12 columns or 100%. This leads to a good responsive design-->
                        <div class="col-md-6">
                            <img src="./images/bruce_peninsula.jpg" alt="An image of high park"/>
                        </div>
                        <div class="col-md-6 park-details">
                            <h4>Bruce Peninsula National Park</h4>
                            <p>One of Ontario's most popular national parks</p>
                            <a href="individual_sample.html" target="_blank">View More Details</a>
                        </div>
                    </div>
                </td>
                <td>4.8</td>
                <td>Tobermory, ON</td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="./images/high_park.jpg" alt="An image of high park"/>
                        </div>
                        <div class="col-md-6 park-details">
                            <h4>High Park</h4>
                            <p>A beautiful family park located in the heart of toronto</p>
                            <a href="individual_sample.html" target="_blank">View More Details</a>
                        </div>
                    </div>
                </td>
                <td>4.7</td>
                <td>Toronto, ON</td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="./images/georgian_bay.jpg" alt="An image of high park"/>
                        </div>
                        <div class="col-md-6 park-details">
                            <h4>Georgian Bay Islands National Park</h4>
                            <p>Plently of trails, hiking, boating and much more</p>
                            <a href="individual_sample.html" target="_blank">View More Details</a>
                        </div>
                    </div>
                </td>
                <td>4.7</td>
                <td>Honey Harbour, ON</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include "footer.php";?>