<?php 
	$name = $_POST['name'];
	$type = $_POST['type'];
	$url = $_POST['url'];
	$manager = $_POST['manager'];
	$phone_number = $_POST['phone'];
	$address = $_POST['address'];
	$open_date = $_POST['open_date'];
	$weekday_open = $_POST['weekday_open'];
	$weekday_close = $_POST['weekday_close'];
	$weekend_close = $_POST['weekend_close'];
	$weekend_open = $_POST['weekend_open'];

	$retVal = "";

	$restaurantCreateQuery="INSERT INTO final_project.restaurant(name, type, url)
		 VALUES ($1, $2, $3)";
	$createStatement = pg_prepare($databaseConnection, "restaurantCreate", $restaurantCreateQuery);
	$result = pg_execute($databaseConnection, "restaurantCreate", array($name, $type, $url));
	if(!$result) {
		$retVal .= "<p>Restaurant Create Failed!</p>";
	}	 
	else {
		$hoursCreateQuery="INSERT INTO final_project.hours(weekDayOpen, weekDayClose, weekendOpen, weekendClose)
			VALUES ($1, $2, $3, $4)";
		$createStatement = pg_prepare($databaseConnection, "hoursCreate", $hoursCreateQuery);
		$result = pg_execute($databaseConnection, "hoursCreate", array($weekday_open, $weekday_close, $weekend_open, $weekend_close));
		if(!$result) {
			$retVal .= "<p>Restaurant Create Failed!</p>";
			pg_execute($databaseConnection, "DELETE * FROM final_project.restaurant R WHERE
					R.name=$name AND R.type=$type AND R.ur=$url");
		} else {
			$query = "SELECT hoursId FROM final_project.hours WHERE
						weekDayOpen = $1 AND weekDayClose = $2 AND weekendClose=$3
						AND weekendOpen = $4";
			$statement = pg_prepare($databaseConnection, "hoursQuery", $query);
			$result = pg_execute($databaseConnection, "hoursQuery", array($weekday_open, $weekday_close, $weekend_open, $weekend_close));
			$hours = pg_fetch_array($result);

			$query = "SELECT restaurantId FROM final_project.restaurant R WHERE
					R.name=$1 AND R.type=$2 AND R.url=$3";
			$statement = pg_prepare($databaseConnection, "queryRestaurant", $query);
			$result = pg_execute($databaseConnection, "queryRestaurant", array($name, $type, $url));
			$restaurant = pg_fetch_array($result);

			$locationCreateQuery="INSERT INTO final_project.location(first_open_date, manager_name, phone_number, street_address, hoursId, restaurantId)
				VALUES ($1, $2, $3, $4, $5, $6)";
			$createStatement = pg_prepare($databaseConnection, "locationCreate", $locationCreateQuery);
			$result = pg_execute($databaseConnection, "locationCreate", array($open_date, $manager, $phone_number, $address, $hours[0], $restaurant[0]));

			if(!$result) {
				$retVal .= "<p>Restaurant Create Failed!</p>";
				$query = "DELETE * restaurantId FROM final_project.restaurant R WHERE
					R.name=$1 AND R.type=$2 AND R.url=$3";
				$statement = pg_prepare($databaseConnection, "queryRestaurant", $query);
				$result = pg_execute($databaseConnection, "queryRestaurant", array($name, $type, $url));

				$query = "DELETE * FROM final_project.hours WHERE
						hoursId=$1";
				$statement = pg_prepare($databaseConnection, "deleteHours", $query);
				$statement =pg_execute($databaseConnection, "deleteHours", array($hours[0]));
			} else {
				$retVal .= "<p>Restaurant Creation Succesful</p>";
			}
		}
	}

	echo $retVal;

 ?>