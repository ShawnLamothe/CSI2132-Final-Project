<?php 
	$restaurantId = $_POST['restaurantId'];
	$query = "DELETE FROM final_project.restaurant R WHERE R.restaurantId = $1";
	$statement = pg_prepare($databaseConnection, "deleteRestaurant", $query);
	$result = pg_execute($databaseConnection, "deleteRestaurant", array($restaurantId));

	$retVal = "";
	if($result) {
		$retVal .= "Restaurant Deleted";
	} else {
		$retVal .= "Restaurant Delete Failed!";
	}
	echo $retVal;
 ?>