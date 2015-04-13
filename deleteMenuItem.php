<?php 
	$itemId = $_POST['itemId'];
	$query = "DELETE FROM final_project.MenuItem MI WHERE MI.itemId = $1";
	$statement = pg_prepare($databaseConnection, "deleteMenuItem", $query);
	$result = pg_execute($databaseConnection, "deleteMenuItem", array($itemId));

	$retVal = "";
	if($result) {
		$retVal .= "Menu Item Deleted";
	} else {
		$retVal .= "Menu Item Delete Failed!";
	}
	echo $retVal;
 ?>