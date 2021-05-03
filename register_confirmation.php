<?php

require 'config/config.php';

// Server-side input validation

if ( !isset($_POST['email2']) || empty($_POST['email2'])
	|| !isset($_POST['username2']) || empty($_POST['username2'])
    || !isset($_POST['password2']) || empty($_POST['password2'])
    || !isset($_POST['c_password2']) || empty($_POST['c_password2']) ) {
	$error = "Please fill out all required fields.";
}
else if ($_POST['password2'] != $_POST['c_password2']) {
    $error = "Passwords do not match.";
}
else {
	// Store this user into the database!
	// connect to db
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Check if username or email address is already taken (aka exists in the users table)
	$sql_registered = "SELECT * FROM UserInfo 
	WHERE username = '" . $_POST["username2"] . 
	"' OR email = '" . $_POST["email2"] . "';";

	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	};

	// num_rows is the # of matches
	if($results_registered->num_rows > 0) {
		$error = "Username or email has been already taken. Please choose another one.";
	}
	else {

		// Hash the password
		$password = hash("sha256", $_POST["password2"]);

		// To add a new user, INSERT INTO UserInfo
		$sql = "INSERT INTO UserInfo(username, email, password) VALUES('" . $_POST["username2"] . "','" . $_POST["email2"] . "','" . $password . "');";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}
	}

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username2']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login_sign_up.php" role="button" class="btn btn-primary">Login</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>