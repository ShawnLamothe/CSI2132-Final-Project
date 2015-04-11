<?php 
	$term = $_POST['restaurantType'];
	$query = "SELECT R.name FROM final_project.Restaurant R WHERE R.type = $1";
	$statement = pg_prepare($databaseConnection, "restaurantByType", $query);
	$result = pg_execute($databaseConnection, "restaurantByType", array($term));

	$retVal = '';

	if(pg_num_rows($result) > 0) {
		while($row=pg_fetch_array($result)) {
			$retVal .= "<option value=".$row[0].">".$row[0]."</option>";
		}
	} 
	else {
		$retVal .= "<select class='form-control' id='restaurantsByType'>
						<option>No Restaurants<option>
					</select>";
	}
	echo $retVal;
 ?>