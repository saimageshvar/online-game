<?php
  require_once( "config.php" );
  session_start();
  //$jsonData = chatClass::getRestChatLines( $id );
  //print $jsonData;
  //echo $_SESSION['i'.$_GET['id']];
  if(strcasecmp($_GET['ans'],$_SESSION['i'.$_GET['id']])==0)
	$jsonData="true";
  else
	  $jsonData="false";
  print $jsonData;
?>