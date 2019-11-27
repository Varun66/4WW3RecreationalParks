<?php
    ini_set('display_errors', 1);
    require '../vendor/autoload.php';

    use Aws\S3\S3Client;
    use Aws\Exception\AwsException;
    // using php data objects we set the login parameters for the database.
    $pdo = new PDO('mysql:host=localhost;dbname=myparkfinder_db', '4ww3', 'myparkfinder');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Connect to AWS
    $bucketName = 'myparkfinders3';
	$IAM_KEY = 'AKIAJ6NIYWCB7IYQNG6A';
    $IAM_SECRET = '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';
    // Connect to AWS

    if (isset($_POST['name']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['userRating']) && isset($_POST['userReview'])){

        $pathInS3 = '';

        if(is_uploaded_file($_FILES["imageFile"]['tmp_name'])){
            try {
                // You may need to change the region. It will say in the URL when the bucket is open
                // and on creation.
                $s3 = S3Client::factory(
                    array(
                        'credentials' => array(
                            'key' => $IAM_KEY,
                            'secret' => $IAM_SECRET,
                        ),
                        'version' => 'latest',
                        'region'  => 'us-east-1',
                        'client_defaults' => ['verify' => false]
                    )
                );
            } catch (Exception $e) {
                // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
                // return a json object.
                die("Error: " . $e->getMessage());
            }

            // For this, I would generate a unqiue random string for the key name. But you can do whatever.
            $key = basename($_FILES["imageFile"]['tmp_name']);
            $file = $_FILES["imageFile"]['tmp_name'];
            $pathInS3 = 'https://' . $bucketName. '.s3.amazonaws.com/' . $key;
            // Add it to S3
            try {
                // Uploaded:
                $s3->putObject(
                    array(
                        'Bucket'=>$bucketName,
                        'Key' =>  $key,
                        'SourceFile' => $file,
                        'StorageClass' => 'REDUCED_REDUNDANCY',
                    )
                );
            } catch (S3Exception $e) {
                die('Error:' . $e->getMessage());
            } catch (Exception $e) {
                die('Error:' . $e->getMessage());
            }
        }

        // Query we are using to check if the user is legit
        $sql = "INSERT INTO objects (Name, Latitude, Longitude, Rating, ImageURL, Review) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepared statements: For when we don't have all the parameters so we store a template to be executed
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['name'], $_POST['latitude'], $_POST['longitude'], $_POST['userRating'], $pathInS3, $_POST['userReview']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Redirect to login page
        echo 'Success';

    } else {
        // This path is dependent on where the root of your documents is located.
        // For this it is made to point back to the register file if registering has failed.
        echo 'Failed';
    }
?>