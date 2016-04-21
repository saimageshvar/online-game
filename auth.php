<?php
	require_once 'google-api-php-client/autoload.php';
	require_once( "config.php" );
	session_start();
	
	
	$client = new Google_Client();
	$client->setAuthConfigFile('client_secret.json');
	$client->setRedirectUri('http://localhost/online%20game/auth.php');
	$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
	$objOAuthService = new Google_Service_Oauth2($client);
	
	if (! isset($_GET['code'])) {
		$auth_url = $client->createAuthUrl();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		if ($client->getAccessToken()) 
		{
			$userinfo = $objOAuthService->userinfo;
			//print_r($userinfo->get());
			$a = new Google_Service_Oauth2_Userinfoplus();
			$a = $userinfo->get();
			//print_r($a);
			$email=$a['email'];
			$givenName=$a['givenName'];
			//print_r($email." ".$givenName);
			
			
			
			//inserting into db
			$db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
			$db_connection->query( "SET NAMES 'UTF8'" );
			
			$statement = $db_connection->prepare( "SELECT email from users where email = ?");
			$statement->bind_param( 's', $email);
			$statement->execute();
			$statement->store_result();
			if ( $statement->num_rows == 0) {
				
				$statement = $db_connection->prepare( "insert into users(name,email,level) values(?,?,1)");
				$statement->bind_param( 'ss', $givenName , $email);
				if(!$statement->execute())
				echo mysqli_error($db_connection);
				
				$statement->close();
				$db_connection->close();
				
				
				
			}
			$_SESSION['email']=$email;
			$_SESSION['givenName']=$givenName;
		}
		$redirect_uri = 'http://localhost/online%20game/index.php';
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	}		