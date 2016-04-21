<?php
	session_start();
	require_once( "config.php" );
	
	$db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
	$db_connection->query( "SET NAMES 'UTF8'" );
	$level = strip_tags($_SESSION['level']);
	
	$statement = $db_connection->prepare( "update users set level=?,start_time=CURRENT_TIMESTAMP where email = ?");
	$statement->bind_param( 'is', $level , $_SESSION['email']);
	$statement->execute();
	
	$statement = $db_connection->prepare( "SELECT question,answer,id from questions where level = ?");
	$statement->bind_param( 'i', $level);
	$statement->execute();
	$statement->bind_result( $ques,$ans,$id );
	$statement->store_result();
	echo "<form role='form'>";
	for($i=1;$i<=$statement->num_rows;$i++)
	{
		$statement->fetch();
		//echo $ques;
		echo "<div class='form-group'>";
		echo "<label for='email'>".$ques."</label>";
		echo "<br><input type='text' name='$id' id='$id'><input type='button' value='check' id='b$id' name='b$id' onclick='getChatText(&quot;$id&quot;)'/><br>";
		echo "</div>";
		echo "<input type='text' class='form-control' id='$id' name='$id' placeholder='Enter Answer'>";
	}	
	$i=$i-1;
	echo "<input type='hidden' id='total' value='$i'>";
	echo "<input type='button' id='submit' value='submit' disabled='false' onclick='location.href=&quot;nextLevel.php&quot'>";
	$statement->close();
	$db_connection->close();

?>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/main.js"></script>