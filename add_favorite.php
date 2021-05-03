<?php
require 'config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($mysqli->connect_errno){
    echo $mysqli->connect_error;
    exit();
}

// If optional fields are not filled out, make it add as "null"
if( isset($_GET["name"]) && !empty($_GET["name"])) {
    $name = $mysqli->real_escape_string($_GET["name"]); //real_escape_string() escapes certain characters such as single quotes, double quotes, end of line characters, etc that causes problems when inserted into a SQL statement.
} else {
    $name = null;
}
if( isset($_GET["image"]) && !empty($_GET["image"])) {
    $image = $_GET["image"];
} else {
    $image = null;
}
if( isset($_GET["phone"]) && !empty($_GET["phone"])) {
    $phone = $_GET["phone"];
} else {
    $phone = null;
}
if( isset($_GET["price"]) && !empty($_GET["price"])) {
    $price = $_GET["price"];
} else {
    $price = null;
}
if( isset($_GET["rating"]) && !empty($_GET["rating"])) {
    $rating = $_GET["rating"];
} else {
    $rating = null;
}
if( isset($_GET["url"]) && !empty($_GET["url"])) {
    $url = $_GET["url"];
} else {
    $url = null;
}
if( isset($_GET["address"]) && !empty($_GET["address"])) {
    $address = $_GET["address"];
} else {
    $address = null;
}
if( isset($_GET["cuisine"]) && !empty($_GET["cuisine"])) {
    $cuisine = $_GET["cuisine"];
} else {
    $cuisine = null;
}

$statement = $mysqli->prepare("INSERT INTO Restaurants(name, image_url, phone, price, rating, url, address, cuisine)
VALUES (?,?,?,?,?,?,?,?);");
$statement->bind_param("ssssssss", $name, $image, $phone, $price, $rating, $url, $address, $cuisine);

$executed = $statement->execute();

if(!$executed) {
    echo $mysqli->error;
}

if( $statement->affected_rows == 1 ) {
    //Now find the restuarantID of the restaurant you just inserted
    $sql2 = "SELECT Restaurants.restaurantID
    FROM Restaurants
    WHERE Restaurants.url = " . "'" . $url . "'" . ";";

    $results2 = $mysqli->query($sql2);
    if(!$results2) {
        echo $mysqli->error;
        exit();
    }

    // If we get 1 result back, means it found restaurantID
    if($results2->num_rows > 0) {
        $foundRestaurantID = $results2->fetch_assoc()['restaurantID']; //add this restaurantID with userID into FavoriteRestaurants
        
        //Find userID
        $sql3 = "SELECT UserInfo.userID
        FROM UserInfo
        WHERE UserInfo.username = " . "'" . $_SESSION["username"] . "'" . ";";

        $results3 = $mysqli->query($sql3);
        if(!$results3) {
            echo $mysqli->error;
            exit();
        }
    
        // If we get 1 result back, means it found userID
        if($results3->num_rows > 0) {
            $foundUserID = $results3->fetch_assoc()['userID'];

            //Now add into FavoriteRestaurants with restaurantID and userID
            $statement2 = $mysqli->prepare("INSERT INTO FavoriteRestaurants(restaurantID, userID)
            VALUES (?,?);");
            $statement2->bind_param("ii", $foundRestaurantID, $foundUserID);

            $executed2 = $statement2->execute();
            if(!$executed2) {
                echo $mysqli->error;
            }

            $statement2->close();
        }
    }
}

$statement->close();
$mysqli->close();
?>