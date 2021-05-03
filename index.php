<?php
	require 'config/config.php';
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
				background-position: 0px 250px;
  				background-size: contain;
		        height: 100%;
		        margin: 0;
		        padding: 0;
	      	}
        	input[type=number]{
  			  width: 47%;
			} 
        	.outerDiv {
				color: rgb(255, 255, 255);
				height: 70px;
				width: 90%;
				margin: 0px auto;
				margin-top: 5%;
				padding: 5px;
			}
			.leftDiv {
				color: #000;
				height: 100%;
				width: 60%;
				float: left;
				margin-right: 5%;
			}
			.rightDivtop {
				color: #000;
				height: 100%;
				width: 15%;
				margin-left: 20px;
				float: left;
				text-align: center;
			}
			.rightDivbottom {
				color: #000;
				height: 200%;
				width: 32%;
				float: right;
				text-align: center;
			}
        	#main {
        		width: 100%;
        	}
        	#header, #thumbnail, #footer, #submit-search p {
        		width: 90%;
        		margin-left: auto;
        		margin-right: auto;
        	}
			#submit-search {
				position: absolute;
				bottom: 0;
				left: 10%;
				height: 50%;
				width: 80%;
			}
			#thumbnail {
				position: relative;
			}
        	#thumbnail img {
        		width: 100%;
        		margin-top: 100px;
        		margin-bottom: 100px;
        		margin-left: auto;
        		margin-right: auto;
        		border-radius: 15px;
        	}
        	#logo {
				float: left; 
				font-size: 50px;
        		margin-top: 9px;
        	}
        	#right {
				float: right; 
				padding: 10px;
        		margin-top: 25px;
        	}
        	hr {
        		margin-top: 50px;
        		width: 100%;
        	}
        	.btn-sm {
			    color: white;
				background-color:#9370DB;
			    border-radius: 5px;
			    border: none;
			}
			#submit_btn {
				float: right;
			}
			#label_best, #label_review, #label_distance, #label_rating {
				font-family: Helvetica; 
				color: black; 
				font-weight: normal;
				font-weight: bold;
			}
			#restaurant_input {
				height: 85%;
				border-radius: 5px;
				width: 85%;
			}
			#latitude {
				height: 85%;
				border-radius: 5px;
			}
			#longitude {
				float: right; 
				height: 85%;
				border-radius: 5px;
			}
			#modal_btn {
				border-radius: 5px; 
				border:none; 
				background: #9370DB; 
				float: right; 
				height: 41%; 
				width:92%;
				font-size: 120%;
			}
			#modal_dialog {
				width:700px;
			}
			#footer {
				color: white; 
				text-align: center; 
				padding: 5px; 
				margin-top: 80px;
				margin-bottom: 20px;
				font-size: 120%;
			}
			.glyphicon-search {
				font-size: 310%;
			}
			@media (max-width: 1150px) {
				.leftDiv {
					height: 90%;
					width: 60%;
				}
				#restaurant_input {
					width: 80%;
				}
				.rightDivtop {
					margin-left: -9px;
					width: 18.5%;
				}
				#label_best, #label_review, #label_distance, #label_rating {
					font-size: 12px;
				}
				#modal_btn {
					height: 38%; 
					font-size: 100%;
				}
				.glyphicon-search {
					font-size: 265%;
				}
				#logo {
					margin-top: 12px;
					font-size: 38px;
				}
				#header a {
					font-size: 110%;
				}
				#footer {
					margin-top: 50px;
					margin-bottom: 10px;
					font-size: 110%;
				}
				#submit-search {
					height: 55%;
				}
			}
			@media (max-width: 767px) {
				.leftDiv {
					height: 70%;
					width: 90%;					
					margin-left: 5%;
				}
				#submit-search p {
					margin-left: 10%;
				}
				.rightDivtop {
					height: 100%;
					width: 30%;
					margin-left: 30px;
				}
				#modal_btn {
					height: 33%; 
					font-size: 70.5%;
				}
				.glyphicon-search {
					font-size: 190%;
				}
				#logo {
					margin-top: 18px;
					font-size: 32px;
				}
				#header a {
					font-size: 100%;
				}
				#footer {
					margin-top: 80px;
					margin-bottom: 5px;
					font-size: 100%;
				}
				#submit-search {
					height: 60%;
				}
				input[type=number] {
					width: 30%;
				}
				#latitude {
					float: left; 
				}
				#longitude {
					float: left; 
					margin-left: 21px;
				}
				.rightDivbottom {
					position:relative;					
					bottom: 43px;
					left: -5px;
					height: 185%;
					width: 28%;
				}
			}
			@media (max-width: 577px) {
				#submit-search {
					height: 62.5%;
				}
			}
        </style>
	</head>
	<body>
		<div id="main">
            <?php include 'header.php'; ?>
			<hr>
			<div id="thumbnail">
				<img src="images/empty_browser.jpg">
			</div>
			<form id = "submit-search" method="GET" action="search_results.php?"> <p>
				<div class="outerDiv">
					<div class="leftDiv" id="left-search-form">
						<input id="restaurant_input" type="text" name="restaurant" placeholder="Restaurant Name" size=105%>
						<button id="submit_btn" type="submit" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-search"></span>
						</button>						
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="best" value="best_match"> 
						<label id="label_best" for="best">Best Match</label> <br>
						<input type="radio" name="search" id="rating" value="rating"> 
						<label id="label_rating" for="rating">Rating</label>
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="review" value="review_count"> 
						<label id="label_review" for="review">Review Count</label> <br>
						<input type="radio" name="search" id="distance" value="distance"> 
						<label id="label_distance" for="distance">Distance</label>
					</div>
				</div>
				<div class="outerDiv">
					<div class="leftDiv" id="left-search-form2">
						<input id="latitude" type="number" name="latitude" placeholder="Latitude" min="-90" max="90">
						<input id="longitude" type="number" name="longitude" placeholder="Longitude" min="-180" max="180">
					</div>
					<div class="rightDivbottom" id="right-search-form2">
						<button id="modal_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						<span class="glyphicon glyphicon-map-marker"></span> Set Location
						</button>

						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div id="modal_dialog" class="modal-dialog modal-dialog-centered" role="document">
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
			<?php include 'footer.php'; ?>
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