<?php
require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($mysqli->connect_errno){
    echo $mysqli->connect_error;
    exit();
}

//Find restaurantID with correct userID
$r_sql = "SELECT FavoriteRestaurants.restaurantID
FROM FavoriteRestaurants
JOIN Restaurants 
    ON FavoriteRestaurants.restaurantID = Restaurants.restaurantID
JOIN UserInfo 
    ON FavoriteRestaurants.userID = UserInfo.userID
WHERE UserInfo.username = " . "'" . $_SESSION["username"] . "'" 
    . " AND Restaurants.url = " . "'" . $_GET["url"] . "';";

$r_results = $mysqli->query($r_sql);
if(!$r_results) {
    echo $mysqli->error;
    exit();
}
$deleteRestaurantID = $r_results->fetch_assoc()['restaurantID'];

// If we get 1 result back, we found the restaurantID
if($r_results->num_rows > 0) {
    //Find userID
    $r_sql3 = "SELECT UserInfo.userID
    FROM UserInfo
    WHERE UserInfo.username = " . "'" . $_SESSION["username"] . "';";
    
    $r_results3 = $mysqli->query($r_sql3);
    if(!$r_results3) {
        echo $mysqli->error;
        exit();
    }

    // If we get 1 result back, means it found userID
    if($r_results3->num_rows > 0) {
        $deleteUserID = $r_results3->fetch_assoc()['userID'];

        //Delete from FavoriteRestaurants
        $r_sql2 = "DELETE FROM FavoriteRestaurants 
        WHERE restaurantID = " . $deleteRestaurantID . " AND userID = " . $deleteUserID . ";";

        $r_results2 = $mysqli->query($r_sql2);
        if(!$r_results2) {
            echo $mysqli->error;
            exit();
        }

        if($mysqli->affected_rows == 1) {
            //Finally delete this restaurant with restaurantID from Restaurants
            $r_sql4 = "DELETE FROM Restaurants 
            WHERE restaurantID = " . $deleteRestaurantID . ";";

            $r_results4 = $mysqli->query($r_sql4);
            if(!$r_results4) {
                echo $mysqli->error;
                exit();
            }
        }
    }
}

$mysqli->close();
?>