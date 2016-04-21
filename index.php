<?php
require_once 'google-api-php-client/src/Google/autoload.php';

session_start();
$client = new Google_Client();
$client->setAuthConfigFile('client_secret.json');
$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
$objOAuthService = new Google_Service_Oauth2($client);


if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  
  $_SESSION['level']="1";
  header('Location: /online%20game/getQues.php');
  
  
	
} else {
  $redirect_uri = 'http://localhost/online%20game/auth.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

?>