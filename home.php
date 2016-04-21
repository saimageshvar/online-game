<?php
	session_start();
	if(IsSet($_SESSION[ "email" ])==false){
	?>
	<html >
		<head>
			<meta charset="UTF-8">
			<title>Material Compact Login Animation</title>
			
			
			
			<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
			<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'>
			
			<link rel="stylesheet" href="css/style.css">
			
			
			
			
		</head>
		
		<body>
			
			<div class="materialContainer">
				
				
				<div class="box">
					<form action="register.php" method="post">
						
						
						<div class="title">REGISTER</div>
						
						<div class="input">
							<label for="regname">Username</label>
							<input type="text" name="regname" id="regname">
							<span class="spin"></span>
						</div>
						
						<div class="input">
							<label for="regpass">Password</label>
							<input type="password" name="regpass" id="regpass">
							<span class="spin"></span>
						</div>
						
						
						<div class="button">
							<button type="submit"><span>Register</span></button>
						</div>
						<a href="./index.php" class="pass-forgot">Login with google?</a>
					</form>
					
				</div>
				
				
			</div>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			<script src="js/index.js"></script>
			
			
			
			
		</body>
	</html>
    <?php
		}else{
		header("Location: home.html");
	}
?>