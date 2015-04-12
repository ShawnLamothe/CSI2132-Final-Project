<?php 
	$comment = $_POST['comment'];
	$food_rating = $_POST['food_rating'];
	$mood_rating = $_POST['mood_rating'];
	$staff_rating = $_POST['staff_rating'];
	$price_rating = $_POST['price_rating'];
	$id = $_POST['id'];

	$post_date = date('Y-m-d');
	$userId = $_SESSION['currentUser'][0];

	$food_rating = substr($food_rating, -1);
	$mood_rating = substr($mood_rating, -1);
	$price_rating = substr($price_rating, -1);
	$staff_rating = substr($staff_rating, -1);

	$createRatingQuery="INSERT INTO final_project.rating(userId, post_date, restaurantId, 
				price_rating, food_rating, mood_rating, staff_rating, comment) VALUES ($1, $2, $3, 
				$4, $5, $6, $7, $8)";
	$createRatingStatement = pg_prepare($databaseConnection, "ratingCreate", $createRatingQuery);
	$result = pg_execute($databaseConnection, "ratingCreate", array($userId, $post_date,
			$id, $price_rating, $food_rating,$mood_rating,$staff_rating, $comment));
	$data = '<p>';
	if(!$result) {
		$data .= 'rating failed';
	}	 
	else {
		$data .= 'Rating Successful!';
	}
	$data .="</p>";
	echo $data;
 ?>