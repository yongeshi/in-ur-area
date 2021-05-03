<?php

require 'config/config.php';
$inFavorites = 0;

if (isset($_GET["address"])) {
	$complete_address = $_GET["address"];
}
else {
	$complete_address = $_GET["address1"] . ", " . $_GET["address2"] . ", " . $_GET["address3"] . " " . $_GET["address4"];
}

// If user is logged in, check whether restaurant is in favorites so user sees button to remove from favorites or add to favorites.
if( isset($_SESSION["logged_in"])) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}
	$mysqli->set_charset('utf8');
	
	$sql = "SELECT favoriteID
	FROM FavoriteRestaurants
	JOIN Restaurants
		ON FavoriteRestaurants.restaurantID = Restaurants.restaurantID
	JOIN UserInfo
		ON FavoriteRestaurants.userID = UserInfo.userID
	WHERE Restaurants.url = " . "'" . $_GET["url"] . "'" .
	"AND UserInfo.username = " . "'"  . $_SESSION["username"] . "'" . ";";
		
	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// If we get 1 result back, means restaurant is in favorites.
	if($results->num_rows > 0) {
		$inFavorites = 1;
	}

	$mysqli->close();
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
        <style>
        	#map {
				width: 668px; 
				height: 400px;
	      	}
	    	html, body {
				background-image: url('images/neon_geometric_background.jpg');
				background-position: 100px 0px;
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
				padding: 5px;
			}
			.outerDivReservation
			{
				height: 300px;
				width: 90%;
				margin: 0px auto;
				margin-top:30px;
				padding: 5px;
			}
			.outerDivbuttons
			{
				color: #fff;
				height: 70px;
				width: 90%;
				margin: 0px auto;
				margin-top: 40px;
				margin-bottom: -15px;
				padding: 5px;
			}
			.outerDivbuttons2
			{
				color: #fff;
				height: 70px;
				width: 90%;
				margin: 0px auto;
				margin-top: 0px;
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
				margin-left: 7%;
				float: left;
				text-align: left;
			}
			.rightDivbottom
			{
				color: #000;
				height: 100%;
				width: 32%;
				float: left;
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
        	}
			#hr_top {
				margin-bottom: 66px;
			}
        	.btn-sm {
			    color: white;
				background-color:#FF6EC7;
			    border-radius: 5px;
			    border:none;
				float: right;
			}
			h1{
			    font-family: Helvetica;
				color: white;
				font-size: 2.5em;
				margin-bottom: -20px;
			}
			h2{
			    font-family: Helvetica;
				color: white;
				font-size: 1.4em;
			}
			#left-search-form3 img{
        		width: 100%;
        		height: 100%;
        		border-radius: 15px;
        	}
            .btn-lg {
			    width:100%;  
			    color: black;
			    background-color: #00f9ff;
			    border:none;
			    border-radius: 5px;
			}
			span.stars, span.stars>* {
			    display: inline-block;
			    background: url(http://i.imgur.com/YsyS5y8.png) 0 -16px repeat-x;
			    width: 80px;
			    height: 16px;
			}
			span.stars>*{
			    max-width:80px;
			    background-position: 0 0;
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
			#hr {
				margin-top: 27px;
				width: 90%;
			}
			#reservation, #NotLogged {
				color: white; 
				background-color:#9370DB;
			}
			@media (max-width: 1250px) {
				.outerDiv_ {
					height: 250px;
				}
			}
			@media (max-width: 991px) {
				#hr_top {
					margin-bottom: 50px;
				}
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
					font-size: 175%;
				}
				h1 {
					font-size: 2em;
					margin-bottom: -30px;
				}
				h2 {
					font-size: 1em;
					margin-top: 13px;
				}
				.outerDiv_ {
					height: 200px;
				}
				.btn-lg {
					height: 63%;
					font-size: 90%;
				}
			}
			@media (max-width: 767px) {
				#hr_top {
					margin-bottom: 35px;
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
					font-size: 160%;
				}
				.rightDivtop {
					height: 100%;
					width: 30%;
					margin-left: 35px;
				}
				h1 {
					font-size: 1.75em;
					margin-bottom: -40px;
				}
				#main > h1 {
					margin-left: 10%;
				}
				h2 {
					font-size: .925em;
					margin-top: 10px;
				}
				.outerDiv_ {
					height: 150px;
				}
				#hr {
					width: 80%;
				}
				.btn-lg {
					height: 55%;
					font-size: 80%;
				}
			}
			@media (max-width: 600px) {
				#hr_top {
					margin-bottom: 30px;
				}
				.outerDiv_ {
					height: 125px;
				}
				h2 {
					margin-top: 5px;
					font-size: .8em;
				}
			}
        </style>
    </head>
	<body>
		<div id="main">
			<?php include 'header.php'; ?>
			<hr id="hr_top">
			<form id = "submit-search" method="GET" action="search_results.php?">
				<div class="outerDiv">
					<div class="leftDivtop" id="left-search-form">
						<input id="restaurant_input" class="inputs" type="text" name="restaurant" placeholder="Restaurant Name" size=90%>
						<button type="submit" class="btn btn-default btn-sm">
						<span class="glyphicon glyphicon-search"></span>
						</button>						
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="best" value="best_match"> 
						<label class="labels" for="best">Best Match</label> <br>
						<input type="radio" name="search" id="rating" value="rating"> 
						<label class="labels" for="rating">Rating</label>
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="review" value="review_count"> 
						<label class="labels" for="review">Review Count</label> <br>
						<input type="radio" name="search" id="distance" value="distance"> 
						<label class="labels" for="distance">Distance</label>
					</div>
				</div>
				<div class="outerDiv">
					<div class="leftDiv" id="left-search-form2">
						<input class="inputs" type="number" name="latitude" placeholder="Latitude" min="-90" max="90">
						<input class="inputs" type="number" name="longitude" placeholder="Longitude" min="-180" max="180" style="float: right;">
					</div>
					<div class="rightDivbottom" id="right-search-form2">
						<button id="modal_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						<span class="glyphicon glyphicon-map-marker"></span> Set Location
						</button>

						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document" style="width:700px;">
						    <div class="modal-content">
						      <div class="modal-body">
								  <div id="map"></div>			      
						      </div>
						    </div>
						  </div>
						</div>
						<script>
					    var map;
					    function initMap() {
					        map = new google.maps.Map(document.getElementById('map'), {
					          	center: {lat: 39.786742, lng: -95.685585},
					         	zoom: 4
					        });
					        map.addListener('click', function(location) {
								document.getElementById("latitude").value = Math.round(location.latLng.lat());
					        	document.getElementById('longitude').value = Math.round(location.latLng.lng());
					        	document.getElementsByName('latitude')[0].placeholder = Math.round(location.latLng.lat());
					        	document.getElementsByName('longitude')[0].placeholder = Math.round(location.latLng.lng());
					        	$('#exampleModalCenter').modal('hide');
					        });
					    }
					    </script>
					    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2Ht5y7iGyg41WY95itIIR4m2SeMjfjO4&callback=initMap"
					    async defer></script> 
					</div>
				</div>
			</form>
			
			<h1><?php $_GET['name'] ?></h1><br />
			<hr id="hr">
	        <div class="outerDiv_">
				<div class="leftDiv_" id="left-search-form3">
					<a href= <?php echo $_GET['url'] ?> target="_blank">
					<img alt="No Picture Available" src="<?php echo $_GET['image'] ?>">	
					</a>
				</div>
				<div class="rightDiv_" id="right-search-form3"> 
					<h2>Address: <?php echo $complete_address; ?></h2>
					<h2>Phone No: <?php echo $_GET['phone'] ?></h2>
					<h2>Cuisine: <?php echo $_GET['cuisine'] ?></h2>
					<h2>Price: <?php echo $_GET['price'] ?></h2>
					<h2>Rating: <span class="stars"><?php echo floatval($_GET['rating']); ?></span></h2>
				</div>
			</div>
			<?php if(isset($_SESSION["logged_in"])) : ?> 
				<div class="outerDivbuttons">
					<button type="button" class="btn btn-default btn-lg add-remove" data-infav="<?php echo $inFavorites; ?>">
					<span class="glyphicon glyphicon-star"></span> 
					<?php echo ($inFavorites ? "Remove from Favorites" : "Add to Favorites") ?>
					</button> 
				</div>
				
				<!-- if(logged in via google**********) {            if(user.getPassword().contains("Google:")) { 
					<div class="outerDivbuttons2">
						<button id='reservation' onclick="show_more('hide_me');" type="button" class="btn btn-default btn-lg">
						<span class="glyphicon glyphicon-calendar"></span> Add Reservation
						</button>
					</div>
					<div id = "hide_me" class="outerDivReservation" style="display:none;">
						<input type="date" id="date" name="date" placeholder="Date" style="width:49%; height:14%; border-radius: 5px;">
						<input type="time" id="time" name="time" placeholder="Time" style="float:right; width:49%; height:14%; border-radius: 5px;">
						<textarea id="paragraph_text" name="paragraph_text" placeholder="Reservation Notes" cols="50" rows="10" style="margin-top: 15px; width:100%; height:60%; border-radius: 5px;"></textarea>
						<button id='make-reservation' onclick="makeApiCall()" type="button" class="btn btn-default btn-lg" style="margin-top:15px; margin-bottom: 10px; color: white; background-color: #990000;">
						<span class="glyphicon glyphicon-calendar"></span> Submit Reservation
						</button>
						<div id="event-response"></div>
					</div>
					<button id='authorize-button' type="button" style="color: white; width:0px; height:0px; display: none;>"></button>
				} -->
			
			<?php else: ?>
				<div class="outerDivbuttons">
					<button id="NotLogged2" type="button" onclick="NotLogged2()" class="btn btn-default btn-lg">
					<span class="glyphicon glyphicon-star"></span> Add to Favorites
					</button> 
				</div>
				<div class="outerDivbuttons2">
					<button id="NotLogged" type="button" onclick="NotLogged()" class="btn btn-default btn-lg">
					<span class="glyphicon glyphicon-calendar"></span> Add Reservation
					</button>
				</div>

			<?php endif; ?>   

		</div> 


		<script>
		// Client-side input validation
		document.querySelector('#submit-search').onsubmit = function(){
			var missing_inputs = 0;

			if ( document.querySelector('#restaurant_input').value.trim().length == 0 ) {
				missing_inputs = 1;
			} 
			if ( document.querySelector('#latitude').value.trim().length == 0 ) {
				missing_inputs = 1;
			} 
			if ( document.querySelector('#longitude').value.trim().length == 0 ) {
				missing_inputs = 1;	
			} 
			if (missing_inputs) {
				window.alert("Please fill in missing information. (Name and location is required)");
				return (false);
			} 

			return (true);
		}

		$.fn.stars = function() {
		    return this.each(function(i,e){$(e).html($('<span/>').width($(e).text()*16));});
		};
		$('.stars').stars();
		
		function show_more (element_to_show) {
			var element_to_show = document.getElementById(element_to_show);
			element_to_show.style.display = "block";
		}
		
		function NotLogged() {	
			var btn = document.getElementById("NotLogged");
			btn.innerHTML = "Please login with your Google account";
		}
		
		function NotLogged2() {	
			var btn = document.getElementById("NotLogged2");
			btn.innerHTML = "Not logged in";
		}
		
		var clientId = '892719816770-bhrd7f79i3bvjup9ojfs7ejai89cj0dk.apps.googleusercontent.com';
		var apiKey = 'AIzaSyC2Ht5y7iGyg41WY95itIIR4m2SeMjfjO4';
		var scopes = 'https://www.googleapis.com/auth/calendar';


		// Oauth2 functions
		function handleClientLoad() {
			gapi.client.setApiKey(apiKey);
			window.setTimeout(checkAuth,1);
		}
		function checkAuth() {
			gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
		}
		function handleAuthResult(authResult) {
		}
		function handleAuthClick(event) {
			gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
			return false;
		}
			
		// function load the calendar api and make the api call
		function makeApiCall() {
			var time = new Date(document.getElementById("date").value + "T" + document.getElementById("time").value);
			date = time.toISOString();
			var twoHoursLater = new Date(time.getTime() + (2*1000*60*60));
			twoHoursLater = twoHoursLater.toISOString();
			
			var resource = {
				'summary': "Reservation at "+"<?php $_GET['name'] ?>",
				'location': "<?php echo $complete_address ?>",
				'description': document.getElementById("paragraph_text").value,
				'start': {
					"dateTime": date
				},
				'end': {
					"dateTime": twoHoursLater
				}
			};
			gapi.client.load('calendar', 'v3', function() {	
				var request = gapi.client.calendar.events.insert({
					'calendarId': 'primary',
					"resource": resource
				});
				
				request.execute(function(resp) {
					if(resp.status=='confirmed') {
						document.getElementById('event-response').innerHTML = "Event created successfully. View it <a href='" + resp.htmlLink + "' target='_blank'>online here</a>.";
					} else {
						document.getElementById('event-response').innerHTML = "There was a problem. Reload page and try again.";
					}
					console.log(resp);
				});
			});
		}
		</script>

		<script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
		
		<script>
		$(".add-remove").on("click", function() {
			const $clickedButton = $(this);
			const inFav = $clickedButton.data("infav")

			if(inFav == "1") {
				$.ajax({
					method: "GET",
					url: "remove_favorite.php",
					data: {
						name: "<?php echo $_GET['name'] ?>",
						address: "<?php echo $complete_address; ?>",
						phone: "<?php echo $_GET['phone'] ?>",
						cuisine: "<?php echo $_GET['cuisine'] ?>",
						price: "<?php echo $_GET['price'] ?>",
						rating: "<?php echo $_GET['rating'] ?>",
						image: "<?php echo $_GET['image'] ?>",
						url: "<?php echo $_GET['url'] ?>"
					},
				}).done(function (response) {
					$clickedButton.data("infav", 0);
					$clickedButton.text("Add to Favorites");
				});

			} else {
				$.ajax({
					method: "GET",
					url: "add_favorite.php",
					data: {
						name: "<?php echo $_GET['name'] ?>",
						address: "<?php echo $complete_address; ?>",
						phone: "<?php echo $_GET['phone'] ?>",
						cuisine: "<?php echo $_GET['cuisine'] ?>",
						price: "<?php echo $_GET['price'] ?>",
						rating: "<?php echo $_GET['rating'] ?>",
						image: "<?php echo $_GET['image'] ?>",
						url: "<?php echo $_GET['url'] ?>"
					},
				}).done(function (response) {
					$clickedButton.text("Remove from Favorites");
					$clickedButton.data("infav", 1);
				});

			}
		});
		</script>
	</body>
</html>