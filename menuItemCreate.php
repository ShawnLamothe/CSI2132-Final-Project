<?php 
	$name = $_POST['name'];
	$type = $_POST['type'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$id = $_POST['restaurant_id'];

	$retVal = "";

	$menuItemCreateQuery="INSERT INTO final_project.menuItem(restaurantId, name, type, category, description, price)
		 VALUES ($1, $2, $3, $4, $5, $6)";
	$createStatement = pg_prepare($databaseConnection, "menuItemCreate", $menuItemCreateQuery);
	$result = pg_execute($databaseConnection, "menuItemCreate", array($id, $name, $type, $category, $description, $price));
	if(!$result) {
		$retVal .= "<p>Menu Item Create Failed!</p>";
	}	
	else {
		$retVal .= "<p>Menu Item Created!</p>";
	}
	echo $retVal;
 ?>