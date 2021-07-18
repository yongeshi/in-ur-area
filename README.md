# Website using Yelp/Google API, PHP, Boostrap, jQuery, MySQL
Search for information on nearby restaurants <br/>
and login to save to favorites.

On my website, you will be able to login and search for nearby restaurants and its rating. It uses Yelp’s database to get information on the restaurants and saves the information in a database when requested. This website is for people who want to be able to search for restaurants and save restaurants for future reference. It is an alternative to Yelp and features a super minimalistic and easy to navigate design.

Some of the features implemented: <br/>
-a navbar/header on the top with logo/home which will redirect you back to the home page and login/logout. <br/>
-After logging in, you will be able to see favorites. This is where your saved restaurants will appear. <br/>
-On the homepage, you can search for restaurants by name and location as well as an option to sort the results. You can either enter your location with latitude/longitude or a button to the right called “Set Location” where a map will pop up (centered on the US), and you can click on any location on the map and it will populate the latitude/longitude for you. <br/>
-After searching, it will bring you to the search results page where you can search again on the top. If you click on the picture of a restaurant on the search results page, it will pull up a more detailed page of the restaurant with more information about the restaurant and an option to add it to your favorites list.

I used a Yelp API for information on the restaurants. It can be found in yelp_backend.php and yelp.js. I also used a Google API so people can use there maps to set a location when searching for a restaurant. This can be found on index.php line 301, via the “Set Location” button.

Yelp API: https://www.yelp.com/developers/documentation/v3/business_search

Google API: https://developers.google.com/maps/documentation/javascript/overview

CSS libraries/frameworks: 
Bootstrap

JavaScript libraries/frameworks: 
jQuery

**Backend**:
Database structure:

![image](https://user-images.githubusercontent.com/54614988/125999433-06ca1796-e548-462b-82e0-3134e971eef3.png)

Where the database is used: <br/>
-In details.php line 632, after pressing the “Add to Favorites” button it makes an ajax call to add_favorite.php which inserts the restaurant in the Restaurants table and inserts into FavoriteRestaurants with the user’s ID. <br/>
-In favorites.php line 5-25, on page load, if there is data in the tables, It will display the restaurants added to your favorites. <br/>
-In details.php, the add to favorites/remove from favorites, will update/remove the existing restaurants and then delete/insert into the FavoriteRestaurants table. <br/>
-In details.php line 613, after pressing the “Remove from Favorites” button it deletes/removes the restaurant in the Restaurants table and removes from FavoriteRestaurants with the user’s ID.


Installing and Running on Your Machine: <br /> 
These are PHP files and will not open like standard HTML files. If you wish to open the files, you can download MAMP which is free and easy to download. MAMP will not compromise any existing Apache installation already running on your system. For the database, I used MySQL which provides a nice looking GUI.

In order to connect to your local database, change the information in config.php (username, pass, etc) with your DB credentials.
