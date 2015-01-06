<?php
session_start();

// Example code to read Blinksale data using PHP and basic CURL
// This code should work on most PHP installations
// This code uses Bootstrap - not necessary to use it

//  error_reporting(0);   // Turned off for developemnt

date_default_timezone_set('Africa/Johannesburg');   // Change to your location

$account  = "myaccount";   // Your Blinksale account name IE If your Blinksale account URL is http://myaccount.blinksale.com, your account name is myaccount
$base_url = "https://" . $account . ".blinksale.com";

$username = "username";   // one of your Blinksale users and their password
$password = "password";
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blinksale API - Client List Examples</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

    <h2>Blinksale API Calls - Client List</h2>

    <?php
    // Code from http://stackoverflow.com/questions/10792419/php-curl-accessing-url-with-http-authentication-need-help

    $uri = "/clients";               // Get clients list
    $curl = $base_url . $uri;
     echo "CURL: $curl <br>";

    $ch = curl_init();
    $headers = array(
      'Accept: application/vnd.blinksale+xml',
      'Content-Type: application/vnd.blinksale+xml',
      'Authorization: Basic '. base64_encode($username . ":" . $password) 
    );
    curl_setopt($ch, CURLOPT_URL, $curl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);               // timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
     echo "Code: $status_code <br>";
    $result=curl_exec ($ch);

    if($result === false)  {
      echo "Error Number:" . curl_errno($ch)."<br>";
      echo "Error String:" . curl_error($ch);
    }

    print "output:" . $result . "<br /><br />";

    curl_close($ch);
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
