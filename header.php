<div id="header">
	<div id="logo">
		<a href="index.php">InUrArea</a>
	</div>
	
	<div id="right">
			<?php if(!isset($_SESSION["logged_in"])) : ?>
				<a href="login_sign_up.php">Login / Sign Up</a>
			
			<?php else: ?>
				<a href="index.php">Home</a>
				<a href="favorites.php">Favorites</a>
				<a id="logout" href="logout.php">Logout</a> 				
			<?php endif; ?>
	</div>  
</div>