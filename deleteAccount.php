<?php 
	$user = $_SESSION['currentUser'];
	$query = "DELETE FROM final_project.rater U WHERE U.userId = $1";
	$statement = pg_prepare($databaseConnection, "deleteAccount", $query);
	$result = pg_execute($databaseConnection, "deleteAccount", array($user[0]));
 ?>