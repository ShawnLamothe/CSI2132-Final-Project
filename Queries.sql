

-------------------------- Restaurants and menus -----------------------------------------

-- a. Display all the information about a user‐specified restaurant. That is, the user should select the
-- name of the restaurant from a list, and the information as contained in the restaurant and
-- location tables should then displayed on the screen.

Select R.name, R.type, R.url, R.overallRating, L.first_open_date, L.manager_name,
	L.phone_number, L.street_adress, H.mondayOpen, H.mondayClose, H.tuesdayOpen, H.tuesdayClose,
	H.wednesdayOpen, H.wednesdayClose, H.thursdayOpen, H.thursdayOpenClose, H.fridayOpen, H.fridayClose,
	H.saturdayOpen, H.saturdayClose, H.sundayOpen, H.sundayClose FROM Restaurant R, Location L, Hours H WHERE
		R.name = $restaurantName AND R.restaurantId = L.restaurantId AND L.hoursId = H.hoursId;

-- b. Display the full menu of a specific restaurant. That is, the user should select the name of the
-- restaurant from a list, and all menu items, together with their prices, should be displayed on the
-- screen. The menu should be displayed based on menu item categories.   

Select MI.name, MI.price, MI.overallRating, MI.description, MI.category FROM MenuItem MI WHERE
	MI.restaurantId = (Select R.restaurantId FROM Restaurant R WHERE
			R.name = restaurantName)
	ORDER BY category ASC;

-- c. For each user‐specified category of restaurant, list the manager names together with the date
-- that the locations have opened. The user should be able to select the category (e.g. Italian or
-- Thai) from a list

Select L.manager_name, L.first_open_date FROM Location L WHERE
	L.restaurantId = (Select R.restaurantId FROM Restaurant R WHERE
		R.category = restuarantCategory);

-- d. Given a user‐specified restaurant, find the name of the most expensive menu item. List this
-- information together with the name of manager, the opening hours, and the URL of the
-- restaurant. The user should be able to select the restaurant name (e.g. El Camino) from a list.

Select MI.name, MI.price, L.manager_name, H.mondayOpen, H.tuesdayOpen, H.wednesdayOpen,
	H.thursdayOpen, H.fridayOpen, H.saturdayOpen, H.sundayOpen, R.url FROM 
		Restaurant R, Location L, Hours H, MenuItem MI WHERE
		MI.price >= all(Select MI1.price FROM MenuItem MI1) AND
			R.restaurantId = L.restaurantId AND L.hoursId = H.hoursId AND
			MI.restaurantId = R.restaurantId;

-- e. For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
-- or desert), list the average prices of menu items for each category.   

SELECT R.type, MI.category, AVG(MI.price) AS average_price FROM MenuItem MI, Restaurant R GROUP BY
  	R.type HAVING
		R.restaurantId = (SELECT MI.restaurantId FROM MenuItem MI GROUP BY MI.category);


--------------------------- Ratings of restaurants ------------------------------------------------

-- f. Find the total number of rating for each restaurant, for each rater. That is, the data should be
-- grouped by the restaurant, the specific raters and the numeric ratings they have received.
SELECT U.name, R.name, COUNT(R8.*) FROM Rating R8, Restaurant R, Rater U WHERE
	R8.restaurantId = R.restaurantId AND R8.userId = U.userId
	 GROUP BY R.restaurantId; 


-- g. Display the details of the restaurants that have not been rated in January 2015. That is, you
-- should display the name of the restaurant together with the phone number and the type of
-- food.

Select R.name, R.type, L.phone_number FROM Restaurant R, Location L WHERE 
	NOT EXISTS(SELECT * FROM Rating R8 WHERE
		DATEPART(yyyy,R8.post_date) = 2015 AND DATEPART(mm,R8.post_date) = 01)
	AND R.restaurantId = L.restaurantId;

-- h. Find the names and opening dates of the restaurants that obtained Staff rating that is lower
-- than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to
-- any rater of your choice.)

Select R.name, L.first_open_date FROM Restaurant R, Location L WHERE
	R.restaurantId IN (SELECT R8.restaurantId FROM Rating R8 WHERE
		R8.staff_rating < ANY(Select Rate.staff_rating FROM Rating Rate WHERE
			Rate.userId = $ratingUser))
	AND R.restaurantId = L.restaurantId;

-- i. List the details of the Type Y restaurants that obtained the highest Food rating. Display the
-- restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y
-- refers to any restaurant type of your choice, e.g. Indian or Burger.)  
	
--CONFIRMED

Select R.name, U.name FROM Restaurant R, Rater U WHERE
	R.restaurantId IN (SELECT R8.restaurantId FROM Rating R8 WHERE
		R8.restaurantId IN (SELECT R1.restaurantId FROM Restaurant R1 WHERE
				R1.type = $inputType)
		AND 
		R8.food_rating >= All(SELECT Rate.food_rating FROM Rating Rate WHERE
			Rate.restaurantId IN (SELECT R2.restaurantId FROM Restaurant R2 WHERE
				R2.type = $inputType))
		AND
		R8.userId = U.userId);

-- j. Provide a query to determine whether Type Y restaurants are “more popular” than other
-- restaurants.  (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.)
-- Yes, this query is open to your own interpretation!

SELECT ROW_NUMBER() OVER(ORDER BY OverallRating DESC) AS Ranking, OverallRating, Type
 	FROM
		(SELECT AVG(overallRating) AS OverallRating, R.type AS Type FROM
		 	Restaurant R GROUP BY R.type) 
	WHERE Type = $inputType;

---------------------------- Raters and their ratings ----------------------------------------------

-- k. Find the names, join‐date and reputations of the raters that give the highest overall rating, in
-- terms of the Food and the Mood of restaurants. Display this information together with the
-- names of the restaurant and the dates the ratings were done.

SELECT U.name, U.join_date, U.reputation, R.name, R8.post_date FROM Rater U, Restaurant R, R8 Rating WHERE 
	U.userId IN (SELECT U1.userId FROM Rater U1 HAVING
		AVG(SELECT (Rate.mood_rating + Rate.food_rating) as OverallRating FROM Rating Rate WHERE
			Rate.userId = U1.userId) 
		>= ALL(SELECT OverallRating FROM (SELECT U2.userId FROM Rater U2 HAVING
			AVG(SELECT (Rate.mood_rating + Rate.food_rating) as OverallRating FROM Rating Rate WHERE
				Rate.userId = U1.userId))))
	AND R8.userId = U.userId AND R8.restaurantId = R.restaurantId;

-- l. Find the names and reputations of the raters that give the highest overall rating, in terms of the
-- Food or the Mood of restaurants. Display this information together with the names of the
-- restaurant and the dates the ratings were done.

SELECT U.name, U.join_date, U.reputation, R.name, R8.post_date FROM Rater U, Restaurant R, R8 Rating WHERE
	U.userId IN (SELECT U1.userId FROM Rater U1 WHERE
		(SELECT AVG(mood_rating) FROM Rating Rate WHERE Rate.userId = U1.userId)
			>= ALL(SELECT AVG(mood_rating) FROM Rating Rate GROUP BY Rate.userId)
		OR (SELECT AVG(food_rating) FROM Rating Rate WHERE Rate.userId = U1.userId)
			>= ALL(SELECT AVG(food_rating) FROM Rating Rate GROUP BY Rate.userId)
		AND R8.userId = U.userId AND R8.restaurantId = R.restaurantId;

-- m. Find the names and reputations of the raters that rated a specific restaurant (say Restaurant Z)
-- the most frequently. Display this information together with their comments and the names and
-- prices of the menu items they discuss. (Here Restaurant Z refers to a restaurant of your own
-- choice, e.g. Ma Cuisine).

-- do one ot the the or or both

SELECT U.name, U.reputation, R8.comment, 

-- n. Find the names and emails of all raters who gave ratings that are lower than that of a rater with
-- a name called John, in terms of the combined rating of Price, Food, Mood and Staff. (Note that
-- there may be more than one rater with this name).

-- CONFIRMED

SELECT U.name, U.email FROM Rater U WHERE
	U.userId IN (SELECT R8.userId FROM Rating R8 WHERE
		(R8.price_rating + R8.food_rating + R8.mood_rating + R8.staff_rating)
		< ANY(SELECT (Rate.price_rating + Rate.mood_rating + Rate.food_rating + Rate.staff_rating) FROM Rating Rate WHERE
			Rate.userId IN (SELECT U1.userId FROM Rater U1 WHERE
				U1.name = 'John')));

-- o. Find the names, types and emails of the raters that provide the most diverse ratings. Display this
-- information together with the restaurants names and the ratings. For example, Jane Doe may
-- have rated the Food at the Imperial Palace restaurant as a 1 on 1 January 2015, as a 5 on 15
-- January 2015, and a 3 on 4 February 2015.  Clearly, she changes her mind quite often.

-- use standard deviaton

SELECT U.name, U.type, U.emails, R.name, R8. 




