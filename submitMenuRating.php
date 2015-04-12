<?php 
	$comment = $_POST['menu_comment'];
	$rating = $_POST['menu_food_rating'];
	$id = $_POST['id'];

	$post_date = date('Y-m-d');
	$userId = $_SESSION['currentUser'][0];

	$rating = substr($rating, -1);

	$createMenuRatingQuery="INSERT INTO final_project.ratingItem(userId, post_date, itemId, 
				rating, comment) VALUES ($1, $2, $3, $4, $5)";
	$createMenuRatingStatement = pg_prepare($databaseConnection, "menuRatingCreate", $createMenuRatingQuery);
	$result = pg_execute($databaseConnection, "menuRatingCreate", array($userId, $post_date,
			$id, $rating, $comment));
	$data = '<p>';
	if(!$result) {
		$data .= 'Menu Item Rating failed';
	}	 
	else {
		$data .= 'Menu Item Rating Successful!';
	}
	$data .="</p>";
	echo $data;
 ?>