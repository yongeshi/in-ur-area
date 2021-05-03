<?php
require 'config/config.php';

if ( !isset($_GET['latitude']) || empty($_GET['latitude']) || !isset($_GET['longitude']) || empty($_GET['longitude'])) {
	$error = "Please fill out all required fields. (latitude/longitude)";
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
		<script type="text/javascript" src="yelp.js"></script>
        <style>
        	#map {
				width: 668px; 
				height: 400px;
	      	}
	    	html, body {
				background-image: url('images/neon_geometric_background.jpg');
				background-position: 0px 106px;
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
				margin-bottom: 60px;
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
				margin-bottom: 60px;
			}
        	.btn-sm {
			    color: white;
				background-color:#FF6EC7;
			    border-radius: 5px;
			    border:none;
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
			.labels {
				font-family: Helvetica; 
				color: white; 
				font-weight: normal;
				font-size: 16px;
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
			#modal_dialog {
				width:700px;
			}
			#error {
				color: white;
			}
			#submit_btn {
				float: right;
			}
			.glyphicon-search {
				font-size: 225%;
			}
			.hr_ {
				width: 90%;
				margin-top: 10px;
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
					font-size: 175%;
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
				}
				#main > h1 {
					margin-left: 10%;
				}
				h2 {
					font-size: .925em;
				}
				.outerDiv_ {
					height: 150px;
				}
				.hr_ {
					width: 80%;
				}
			}
			@media (max-width: 600px) {
				.outerDiv_ {
					height: 135px;
					margin-bottom: 100px;
				}
				h1 {
					font-size: 1.5em;
					margin-top: 8px;
				}
			}
        </style>
	</head>
	<body>
		<div id="main">
			<?php include 'header.php'; ?>
			<hr id="hr_top">
			<form id="submit-search" method="GET" action="search_results.php?"> <p> <!-- Get rid of this p???*************** -->
				<div class="outerDiv">
					<div class="leftDivtop" id="left-search-form">
						<input id="restaurant_input" class="inputs" type="text" name="restaurant" placeholder="Restaurant Name" size="90%" value="<?php echo $_GET["restaurant"] ?>">
						<button id="submit_btn" type="submit" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-search"></span>
						</button>						
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="best" value="best_match" <?php if(isset($_GET["search"])) if($_GET["search"] == "best_match") echo "checked" ?>> 
						<label class="labels" for="best">Best Match</label> <br>
						<input type="radio" name="search" id="rating" value="rating" <?php if(isset($_GET["search"])) if($_GET["search"] == "rating") echo "checked" ?>> 
						<label class="labels" for="rating">Rating</label>
					</div>
					<div class="rightDivtop" id="right-search-form"> 
						<input type="radio" name="search" id="review" value="review_count" <?php if(isset($_GET["search"])) if($_GET["search"] == "review_count") echo "checked" ?>> 
						<label class="labels" for="review">Review Count</label> <br>
						<input type="radio" name="search" id="distance" value="distance" <?php if(isset($_GET["search"])) if($_GET["search"] == "distance") echo "checked" ?>> 
						<label class="labels" for="distance">Distance</label>
					</div>
				</div>
				<div class="outerDiv">
					<div class="leftDiv" id="left-search-form2">
						<input class="inputs" id="latitude" type="number" name="latitude" placeholder="Latitude" min="-90" max="90" value="<?php echo $_GET["latitude"] ?>">
						<input class="inputs" id="longitude"type="number" name="longitude" placeholder="Longitude" min="-180" max="180" style="float: right;" value="<?php echo $_GET["longitude"] ?>"> 
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
				<?php if( isset($error) && !empty($error) ) :?>
					<div class="text-danger font-italic"><?php echo $error;?></div>
				<?php endif;?>
			</form>
			
			<h1>
				<?php 
					if ( isset($_GET['restaurant']) && !empty($_GET['restaurant']) ) {
						echo "Results for " . $_GET['restaurant'];
					}
					else {
						echo "Results";
					}
				?>
			</h1><br />
			<div id="yelp-grid">
				<!-- ***yelp.js uses this template below to create restaurant "cards" and appends to this div***
				<hr class="hr_">
				<div class="outerDiv_">
					<div class="leftDiv_" id="left-search-form3">
						<a href=<details.php?name=" + searchResults.get(i).getName() + "&address=" + searchResults.get(i).getAddress() 
   						+ "&phone=" + searchResults.get(i).getPhone() + "&cuisine=" + searchResults.get(i).getCuisine() + "&price=" + searchResults.get(i).getPrice() 
   						+ "&rating=" + searchResults.get(i).getRating() + "&image=" + searchResults.get(i).getImage_url() + "&url=" + searchResults.get(i).getUrl() + "\"" %> >
							<img border="0" alt="No Picture Available" src="https://www.linguahouse.com/linguafiles/md5/d01dfa8621f83289155a3be0970fb0cb">
						</a>
					</div>
					<div class="rightDiv_" id="right-search-form3"> 
						<h1>Restaurant Name</h1>
						<h2>1011 Wind</h2>
						<h2>URL of Restaurant</h2>
					</div> 
				</div>
				-->
			</div>
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
		</script>
	</body>
</html>