<?php

require 'config/config.php';

// If no user is logged in, do the usual things. Otherwise, redirect user out of this page.
if( !isset($_SESSION["logged_in"])) {

	// Check if user has entered in username/password
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// User did not enter username/password, it's blank
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			// User did enter username/password but need to check if the username/pw combination is correct
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			// Hash whatever user typed in for password, then compare this to the hashed password in the DB
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM UserInfo WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			// If we get 1 result back, means username/pw combination is correct.
			if($results->num_rows > 0) {
				// Set sesssion variables to remember this user
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = "true";

				// Success! Redirect user to the home page
				header("Location: index.php");
			}
			else {
				$error = "Invalid username and password.";
			}
		} 
	}
}
// Redirect logged in user to home
else {
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="header.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<meta name="google-signin-client_id" content="892719816770-bhrd7f79i3bvjup9ojfs7ejai89cj0dk.apps.googleusercontent.com"> 

        <style>
			html, body {
				background-image: url('images/neon_geometric_background.jpg');
				background-position: 0px 530px;
  				background-size: contain;
			}
        	.outerDiv
			{
				height: 500px;
				width: 90%;
				margin: 0px auto;
				padding: 5px;
				margin-top: 70px;
			}
			.leftDiv
			{
				color: #000;
				height: 500px;
				width: 49%;
				float: left;
			}
			.rightDiv
			{
				color: #000;
				height: 500px;
				width: 49%;
				float: right;
			}
        	#main {
        		width: 100%;
        	}
        	#header {
        		width: 90%;
        		margin-left: auto;
        		margin-right: auto;
        	}
        	#logo{
        		margin-top: 6px;
				float:left; 
				font-size:50px;
        	}
        	#right{
        		margin-top: 25px;
				float: right; 
				padding: 10px;
        	}
        	hr{
        		margin-top: 50px;
        		width: 100%;
        	}
        	.btn {
			    width:90%;  
			    color: black;
			    background-color: #00f9ff;
			    border-radius: 5px;
			    border:none;
			}
			#outerDiv h, p{
        		color: black;
        	}
        	h3{
        		color: white;
        		font-size: 33px;
        	}
			.labels {
				font-family: Helvetica;
				font-size:17px; 
				color: white; 
				font-weight: normal;
			}
			.inputs {
				height: 45px; 
				border-radius: 5px;
				width: 90%;
			}
			.submit_btn {
				height:40px;
			}
			#hr {
				width:90%; 
				margin-left: 0px;
				margin-top:20px;
			}
			.error {
				color: white;
				margin-bottom: 85px;
			}
			#conditions {
				display: inline-block;
				color: white;
			}
			@media (max-width: 991px) {
				#logo {
					margin-top: 12px;
					font-size: 38px;
				}
				#header a {
					font-size: 110%;
				}
				h3 {
					font-size: 30px;
				}
				.inputs {
					height: 35px;
				}
				.submit_btn {
					height: 33px;
				}
			}
			@media (max-width: 767px) {
				#logo {
					margin-top: 18px;
					font-size: 32px;
				}
				#header a {
					font-size: 100%;
				}
				h3 {
					font-size: 25px;
				}
				.inputs {
					height: 31px;
				}
				.submit_btn {
					height: 29px;
				}
			}
        </style>
	</head>
	<body>
		<div id="main">
			<?php include 'header.php'; ?>
			<hr>
			<div class="outerDiv">
				<div class="leftDiv" id="left-search-form">
					<h3>Login</h3>
					<form method="POST" action="login_sign_up.php">
						<p><br> 
						<label class="labels" for="username">Username</label> <br>
						<input class="inputs" type="text" id="username" name="username" size=87%> <br> 
						<label class="labels" for="password">Password</label> <br>
						<input class="inputs" type="text" id="password" name="password" size=87%> <br><br>
						<button type="submit" class="btn btn-default submit_btn">
							<span class="glyphicon glyphicon-log-in"></span> Sign In
						</button> </p>
					</form>

					<!-- <div class="g-signin2" data-onsuccess="onSignIn" data-width="657" data-height="40px" data-longtitle="true"></div> -->
					<p class="error">
						<?php
							if ( isset($error) && !empty($error) ) {
								echo $error;
							}
						?>
					</p>
				</div>
				<div class="rightDiv" id="right-search-form">
					<h3>Sign Up</h3>
					<form id="register-form" method="POST" action="register_confirmation.php">
						<p><br>
						<label class="labels" for="email2">Email</label> <br>
						<input class="inputs" type="text" id="email2" name="email2" size=87%> <br><br> 

				 		<label class="labels" for="username2" >Username</label> <br>
						<input class="inputs" type="text" id="username2" name="username2" size=87%> <br><br> 

						<label class="labels" for="password2">Password</label> <br>
						<input class="inputs" type="text" id="password2" name="password2" size=87%> <br><br> 

						<label class="labels" for="c_password2">Confirm Password</label> <br>
						<input class="inputs" type="text" id="c_password2" name="c_password2" size=87%> <br><br> 

						<input type="checkbox" id="agreedtoTerms2" name="agreedtoTerms2" value= "Y" /> 
						<span id="conditions">I have read and agree to all terms and conditions of InUrArea.</span> <br
						>
						<button type="submit" class="btn btn-default submit_btn">
							<span class="glyphicon glyphicon-user"></span> Create Account
						</button></p>
					</form>
				</div>
			</div>
		</div>
		<script>
			// Client-side input validation
			document.querySelector('#register-form').onsubmit = function(){
				var missing_inputs = 0;
				var mismatch_pass = 0;

				if ( document.querySelector('#username2').value.trim().length == 0 ) {
					missing_inputs = 1;
				} 
				if ( document.querySelector('#email2').value.trim().length == 0 ) {
					missing_inputs = 1;	
				} 
				if ( document.querySelector('#password2').value.trim().length == 0 ) {
					missing_inputs = 1;
				} 
				if ( document.querySelector('#c_password2').value.trim().length == 0 ) {
					missing_inputs = 1;
				} 
				if ( missing_inputs == 0 && !(document.querySelector('#password2').value.trim() == document.querySelector('#c_password2').value.trim()) ) {
					mismatch_pass = 1;
				} 
				if (missing_inputs) {
					window.alert("Please fill in missing information.");
					return (false);
				} 
				else if(!document.getElementById("agreedtoTerms2").checked) {
					window.alert("Please check terms and conditions.");
					return (false);
				}
				else if(mismatch_pass) {
					window.alert("Passwords do not match.");
					return (false);
				}

				return (true);
			}

		// function onSignIn(googleUser) {
		// 	var profile = googleUser.getBasicProfile();
			
		// 	var profile = googleUser.getBasicProfile();
		// 	var xhttp = new XMLHttpRequest();
		// 	xhttp.open("GET", "\GoogleLoginServlet?name=" + profile.getName() + "&ID=" + profile.getId() + "&email=" + profile.getEmail() + "\"", true);
		// 	xhttp.onreadystatechange = function() {
		// 		window.location = "index.php";
		// 	}
		// 	xhttp.send();	
		// }
		// 
		</script>
	</body>
</html>