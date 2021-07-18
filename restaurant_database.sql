CREATE TABLE UserInfo (
	userID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    password VARCHAR(45) NOT NULL
);

CREATE TABLE Restaurants (
	restaurantID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    image_url VARCHAR(500),
    phone VARCHAR(45),
    price VARCHAR(45),
    rating DOUBLE,
    url VARCHAR(500),
	address VARCHAR(500),
    cuisine VARCHAR(45)
);

CREATE TABLE FavoriteRestaurants (
	favoriteID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	restaurantID INT(11) NOT NULL,
    userID INT(11) NOT NULL,
    FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID),
    FOREIGN KEY (userID) REFERENCES UserInfo(userID)
);



INSERT INTO UserInfo (username, email, password)
	VALUES	('John', 'John@gmail.com', 'password');