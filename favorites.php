<?php
	require 'config/config.php';
	
	// ---- STEP 1: Establish DB connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Check for errors
	// connect_errno will return an error code if there is an error when attempting to connect to the db.
	if( $mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}
	$mysqli->set_charset("utf8");

	// ---- STEP 2: Generate & Submit SQL query
	$sql = "SELECT Restaurants.name AS name, Restaurants.image_url AS image, Restaurants.phone AS phone, Restaurants.price AS price, Restaurants.rating AS rating, 
		Restaurants.url AS url, Restaurants.address AS address, Restaurants.cuisine AS cuisine
	FROM FavoriteRestaurants
	JOIN Restaurants 
		ON FavoriteRestaurants.restaurantID = Restaurants.restaurantID
	JOIN UserInfo 
		ON FavoriteRestaurants.userID = UserInfo.userID
	WHERE UserInfo.username = " . "'" . $_SESSION["username"] . "';";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
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
  		
        <style>
        	#map {
				width: 668px;
				height: 400px;
	      	}
	    	html, body {
				background-image: url('images/neon_geometric_background.jpg');
				background-position: 120px 530px;
  				background-size: contain;
		        height: 100%;
		        margin: 0;
		        padding: 0;
	      	}
        	input[type=number]{
  			  width: 47%;
			} 
        	.outerDiv
			{
				color: #fff;
				height: 70px;
				width: 90%;
				margin: 0px auto;
				margin-top:25px;
				padding: 5px;
			}
			.leftDivtop
			{
				color: #000;
				height: 100%;
				width: 55%;
				float: left;
			}
			.leftDiv
			{
				color: #000;
				height: 100%;
				width: 55%;
				float: left;
				margin-right: 5%;
			}
			.rightDivtop
			{
				color: #000;
				height: 100%;
				width: 15%;
				margin-left: 5%;
				float: left;
				text-align: left;
			}
			.rightDivbottom
			{
				color: #000;
				height: 100%;
				width: 32%;
				float: right;
				text-align: center;
			}
			.outerDiv_
			{
				color: #fff;
				height: 350px;
				width: 85%;
				margin: 0px auto;
				margin-top: 55px;
				padding: 5px;
			}
			.leftDiv_
			{
				color: #000;
				height: 100%;
				width: 28%;
				float: left;
			}
			.rightDiv_
			{
				color: #000;
				height: 100%;
				width: 64%;
				margin-left: 5%;
				float: left;
				text-align: left;
				word-break: break-word;
			}
        	#main{
        		width: 100%;
        	}
        	#header, #footer, #submit-search p, h1, h2{
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
				border-color: white;
        	}
			#hr_top {
				margin-bottom: 60px; 
			}
        	.btn-sm {
			    color: white;
				background-color:#FF6EC7;
			    border-radius: 5px;
			    border:none;
				float: right;
			}
			.dropdown-toggle {
			    font-family: Helvetica;
				color: white;
			    background-color: #FF6EC7;
			    border-radius: 5px;
			    border:none;
				margin-top:20px; 
				height:40px; 
				width:100px;
				float: right;
			}
			h1{
			    font-family: Helvetica;
				color: white;
				font-size: 2.5em;
			}
			h2{
			    font-family: Helvetica;
				color: white;
				font-size: 1.075em;
			}
			#left-search-form3 img{
        		width: 100%;
        		height: 100%;
        		border-radius: 15px;
        	}
        	html
			{
			    font-size: 90%;
			}
			.inputs {
				height: 67%; 
				border-radius: 5px;
				width: 80%;
			}
			#modal_btn {
				border-radius: 5px; 
				border:none; 
				background: #FF6EC7; 
				float: right; 
				height: 67%; 
				width: 92%;
			}
			.labels {
				font-family: Helvetica; 
				color: white; 
				font-weight: normal;
				font-size: 16px;
			}
			.glyphicon-search {
				font-size: 225%;
			}
			@media (max-width: 1250px) {
				.outerDiv_ {
					height: 250px;
				}
			}
			@media (max-width: 991px) {
				.labels {
					font-size: 13px;
				}
				#logo {
					margin-top: 12px;
					font-size: 38px;
				}
				#header a {
					font-size: 110%;
				}
				.leftDivtop {
					height: 90%;
				}
				.leftDiv {
					height: 90%;
				}
				#modal_btn {
					height: 60%; 
					font-size: 90%;
				}
				.glyphicon-search {
					font-size: 190%;
				}
				.dropdown-toggle {
					height:35px; 
					width:85px;
					font-size: 90%;
				}
				h1 {
					font-size: 2em;
				}
				h2 {
					font-size: 1em;
				}
				.outerDiv_ {
					height: 200px;
				}
			}
			@media (max-width: 767px) {
				#hr_top {
					margin-bottom: 45px;
				}
				.labels {
					font-size: 11px;
				}
				#logo {
					margin-top: 18px;
					font-size: 32px;
				}
				#header a {
					font-size: 100%;
				}
				.leftDivtop {
					height: 80%;
					width: 90%;					
					margin-left: 5%;
				}
				.leftDiv {
					margin-left: 5%;
					height: 80%;
				}
				#modal_btn {
					height: 55%; 
					font-size: 80%;
				}
				.glyphicon-search {
					font-size: 170%;
				}
				.rightDivtop {
					height: 100%;
					width: 30%;
					margin-left: 35px;
				}
				.dropdown-toggle {
					height:30px; 
					width:70px;
					font-size: 80%;
				}
				h1 {
					font-size: 1.75em;
				}
				h2 {
					font-size: .925em;
				}
				.outerDiv_ {
					height: 150px;
				}
			}
			@media (max-width: 600px) {
				#hr_top {
					margin-bottom: 35px; 
				}
				.outerDiv_ {
					height: 125px;
				}
			}
        </style>
        
	</head>
	<body>
		<div id="main">
			<?php include 'header.php'; ?>			
			<hr id="hr_top">
			<div class="outerDiv">
				<div class="leftDiv" id="left-search-form2">
					<h1 style="float:left; margin-top:22px;"><?php echo $_SESSION["username"]; ?>'s Favorites:</h1><br />
				</div>
				<!-- <div class="rightDivbottom" id="right-search-form2" style="width:27%;"> 				
					<div class="dropdown">
						  <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>Sort by</button>
						  <div class="dropdown-menu"> <% //**************************************************************** work on this %>
							  <a href="favorites.jsp?&sort=atoZ" class="dropdown-item">A to Z</a>
	            			  <a href="favorites.jsp?&sort=ztoA" class="dropdown-item">Z to A</a>
	            			  <a href="favorites.jsp?&sort=highest_rating" class="dropdown-item">Highest Rating</a>
	            			  <a href="favorites.jsp?&sort=lowest_rating" class="dropdown-item">Lowest Rating</a>
	            			  <a href="favorites.jsp?&sort=most_recent" class="dropdown-item">Most Recent</a>
	            			  <a href="favorites.jsp?&sort=least_recent" class="dropdown-item">Least Recent</a>
						  </div>
					</div>
				</div> -->
			</div>
			<?php if(isset($_SESSION["logged_in"])) : ?>
				<!-- ArrayList<Restaurant> favorites = new ArrayList<Restaurant>();
				if(request.getParameter("sort") != null) {
					favorites = user.sortFavorites(session, request.getParameter("sort"));
				}
				else {
					favorites = user.sortFavorites(session, "most_recent");
				} -->
				
				<?php while($row = $results->fetch_assoc() ): ?>
					<hr style="width:90%;">
					<div class="outerDiv_">
						<div class="leftDiv_" id="left-search-form3">
							<a href= "details.php?name=<?php echo $row["name"];?>&phone=<?php echo $row["phone"];?>
							&address=<?php echo $row["address"];?>&cuisine=<?php echo $row["cuisine"];?>&price=<?php echo $row["price"];?>
							&rating=<?php echo $row["rating"];?>&image=<?php echo $row["image"];?>&url=<?php echo $row["url"];?>">
							<img alt="No Picture Available" src="<?php echo $row["image"];?>">	
							</a>
						</div>
						<div class="rightDiv_" id="right-search-form3"> 
							<h1><?php echo $row["name"];?></h1>
							<h2><?php echo $row["address"];?></h2>
							<h2><?php echo $row["url"];?></h2>
						</div>
					</div>
				<?php endwhile;?>
			<?php endif; ?>
    
		</div>
	</body>
</html>