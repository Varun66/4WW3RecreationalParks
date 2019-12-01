<?php
    session_start();

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
	$IAM_KEY = '';
    $IAM_SECRET = '';
    // Connect to AWS

    if (isset($_POST['name']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['description'])){
        if (!(preg_match('/^(-?[1-8]?\d(?:\.\d{1,18})?|90(?:\.0{1,18})?)$/', $_POST['latitude']))){
            $_SESSION['status'] = "InvalidLatitude";
            header("Location: https://{$_SERVER['HTTP_HOST']}/4ww3recreationalparks/submission.php");
        } else if (!(preg_match('/^(-?(?:1[0-7]|[1-9])?\d(?:\.\d{1,18})?|180(?:\.0{1,18})?)$/', $_POST['longitude']))){
            $_SESSION['status'] = "InvalidLongitude";
            header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
        } else {

            $sql = "Select * from objects where Name=?";

            // Prepared statements: For when we don't have all the parameters so we store a template to be executed
            $stmnt = $pdo->prepare($sql);
            try {
                $stmnt->execute([$_POST['name']]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            $rows = $stmnt->fetchAll();

            if (count($rows) > 0) {
                $_SESSION['status'] = "Duplicate";
                header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
            } else {
                $key = '';

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
                $sql = "INSERT INTO objects (Name, Latitude, Longitude, ImageKey, Description) VALUES (?, ?, ?, ?, ?)";

                // Prepared statements: For when we don't have all the parameters so we store a template to be executed
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute([$_POST['name'], $_POST['latitude'], $_POST['longitude'], $key, $_POST['description']]);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                $_SESSION['status'] = "success";
                header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
            }
        }

    } else {
        $_SESSION['status'] = "Unset";
        header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
    }
?>