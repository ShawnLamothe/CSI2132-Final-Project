CREATE TABLE Restaurant(
	restaurantId SERIAL,
	name VARCHAR(50) NOT NULL,
	type VARCHAR(20) NOT NULL,
	url  VARCHAR(50),
	overallRating Integer DEFAULT 1,
	CHECK (overallRating >= 1 AND overallRating <= 5),
	PRIMARY KEY (restaurantId)
);

CREATE TABLE Rater(
	userId VARCHAR(20),
	password VARCHAR(15) NOT NULL,
	email VARCHAR(50) NOT NULL,
	name VARCHAR(15),
	join_date DATE NOT NULL,
	type VARCHAR(11) DEFAULT 'online', 
	reputation INTEGER DEFAULT 1,
	CHECK (reputation >= 1 AND reputation <= 5),
	CHECK (type = 'online' OR type = 'blog' OR type = 'food critic'),
	PRIMARY KEY (userId)
);

CREATE TABLE Rating(
	userId VARCHAR(15),
	post_date DATE,
	restaurantId INTEGER,
	price_rating INTEGER NOT NULL,
	food_rating INTEGER NOT NULL,
	mood_rating INTEGER NOT NULL,
	staff_rating INTEGER NOT NULL,
	comment VARCHAR(200),
	CHECK (price_rating >= 1 AND price_rating <= 5),
	CHECK (food_rating >= 1 AND food_rating <= 5),
	CHECK (mood_rating >= 1 AND mood_rating <= 5),
	CHECK (staff_rating >= 1 AND mood_rating <= 5),

	-- Add on delete functionality

	PRIMARY KEY(userId, restaurantId, post_date),
	FOREIGN KEY(userId) REFERENCES Rater(userId),
	FOREIGN KEY(restaurantId) REFERENCES Restaurant(restaurantId)
);

CREATE TABLE Hours(
	hoursId SERIAL,
	weekDayOpen TIME,
	weekDayClose TIME,
	weekendOpen TIME,
	weekendClose TIME,
	PRIMARY KEY (hoursId)
);

CREATE TABLE Location(
	locationId SERIAL,
	first_open_date DATE NOT NULL,
	manager_name VARCHAR(20) NOT NULL,
	phone_number VARCHAR(14) NOT NULL,
	street_address VARCHAR(30) NOT NULL,
	hoursId INTEGER,
	restaurantId INTEGER,
	PRIMARY KEY(locationId),
	FOREIGN KEY(hoursId) REFERENCES Hours(hoursId),
	FOREIGN KEY(restaurantId) REFERENCES Restaurant(restaurantId)
		 ON DELETE CASCADE
);

CREATE TABLE MenuItem(
	itemId SERIAL,
	restaurantId INTEGER,
	name VARCHAR(20),
	type VARCHAR(20),
	category VARCHAR(20),
	description VARCHAR(100),
	price REAL,
	CHECK (price >= 0),
	PRIMARY KEY(itemId),
	FOREIGN KEY(restaurantId) REFERENCES Restaurant(restaurantId)
		ON DELETE CASCADE
);

CREATE TABLE RatingItem(
	userId VARCHAR(15),
	post_date DATE,
	itemId INTEGER,
	rating INTEGER,
	comment VARCHAR(200),
	CHECK (rating >= 1 AND rating <= 5),
	PRIMARY KEY(userId, itemId, post_date),

	-- Add on delete functionality 
	FOREIGN KEY(userId) REFERENCES Rater(userId),
	FOREIGN KEY(itemId) REFERENCES MenuItem(itemId)
);