<?php
  
  session_start();
  $_SESSION['level']=$_SESSION['level']+1;
  header('Location: /online%20game/getQues.php');
  
  ?>