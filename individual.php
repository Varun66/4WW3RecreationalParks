<!--DOCTYPE declaration which specifies that the document is in html5 -->
<?php include "header.php";?>

<!--This <div> block represents the top banner area of the page. The banner-bg class has the css for the background image
    and it is the defined as the parent div (i.e. the top most element) because the background should be full width and
    it should cover all the elements inside the parent div (i.e. all the child elements)-->
<div class="banner-bg">
    <div class="container">
        <div class="top-banner">
            <h1>Bruce Peninsula National Park</h1>
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
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
</div>

<!--This is the ratings and reviews section. It uses the bootstrap grid system to display each user review-->
<div class="container section-padding ratings-section">
    <h2>Ratings and Reviews</h2>
    <div class="ratings">
        <!--The follow <div> block contains the markup for the Review microdata schema-->
        <div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
            <!--This column contains the user profile picture-->
            <div class="col-1 rating-img">
                <img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
            </div>
            <!--This column contains the user name, rating, date of post and review-->
            <div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                <div class="rating-author">
                    <p><b><span itemprop="name">User1</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
                    <p>Oct 7, 2019</p>
                </div>
                <p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
            </div>
        </div>
        <!--The follow <div> block contains the markup for the Review microdata schema-->
        <div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
            <!--This column contains the user profile picture-->
            <div class="col-1 rating-img">
                <img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
            </div>
            <!--This column contains the user name, rating, date of post and review-->
            <div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                <div class="rating-author">
                    <p><b><span itemprop="name">User2</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
                    <p>Oct 7, 2019</p>
                </div>
                <p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
            </div>
        </div>
        <!--The follow <div> block contains the markup for the Review microdata schema-->
        <div class="row ratings-row" itemscope itemtype="http://schema.org/Review">
            <!--This column contains the user profile picture-->
            <div class="col-1 rating-img">
                <img src="./images/anonymous-user.png" alt="A profile picture of the user"/>
            </div>
            <!--This column contains the user name, rating, date of post and review-->
            <div class="col-11 rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                <div class="rating-author">
                    <p><b><span itemprop="name">User3</span></b><br/>Rating: <span itemprop="ratingValue">4</span>/5</p>
                    <p>Oct 7, 2019</p>
                </div>
                <p itemprop="reviewBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";?>