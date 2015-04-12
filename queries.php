<?php 
	if($_POST['query'] == 'C') {
		$restaurantType = $_POST['restaurantType'];
		$c_query = "SELECT L.manager_name, L.first_open_date FROM final_project.Location L WHERE
						L.restaurantId IN (SELECT R.restaurantId FROM final_project.Restaurant R WHERE
							R.type = $1)";
		$statement = pg_prepare($databaseConnection, "c_query", $c_query);
		$result = pg_execute($databaseConnection, "c_query", array($restaurantType));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Manager Name</th>
									<th>Opened On</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
							</tr>";
			}
				$retVal .=		"</tbody>
							</table>";
		}
		else {
			$retVal .= "<p>Query Failed!</p>";
		}
		echo $retVal;
	}

	else if ($_POST['query'] == 'D_helper') {
		$D_helper_query = "SELECT R.Name FROM final_project.restaurant R";
		$statement = pg_prepare($databaseConnection, "d_helper", $D_helper_query);
		$result = pg_execute($databaseConnection, "d_helper", array());

		$retVal = "";
		if($result) {
			
			while($row = pg_fetch_array($result)) {
				$retVal .= "<option value=$row[0]>$row[0]</option>";
			}
		}
		else {
			$retVal .= "<option>No Restaurants</option>";

		}
		echo $retVal;
	}

	else if($_POST['query'] == 'D') {
		$restaurantName = $_POST['restaurantName'];
		$d_query = "SELECT MI.name, MI.price, L.manager_name, H.weekdayOpen, H.weekendOpen, R.url FROM 
		final_project.Restaurant R, final_project.Location L, final_project.Hours H, final_project.MenuItem MI WHERE
		MI.price >= all(Select MI1.price FROM final_project.MenuItem MI1 WHERE
				MI1.restaurantId = R.restaurantId) AND
			R.restaurantId = L.restaurantId AND L.hoursId = H.hoursId AND
			MI.restaurantId = R.restaurantId AND R.name=$1";
		$statement = pg_prepare($databaseConnection, "d_query", $d_query);
		$result = pg_execute($databaseConnection, "d_query", array($restaurantName));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Manager</th>
									<th>Weekday Opening</th>
									<th>Weekend Opening</th>
									<th>URL</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
								<td>$row[2]</td>
								<td>$row[3]</td>
								<td>$row[4]</td>
								<td>$row[5]</td>
							</tr>";
			}
				$retVal .=		"</tbody>
							</table>";
		}
		else {
			$retVal .= "<p>Query Failed!</p>";

		}
		echo $retVal;
	}


	else if($_POST['query'] == 'E') {
		$e_query = "SELECT R.type, MI.category, AVG(MI.price) AS average_price FROM final_project.MenuItem MI, final_project.Restaurant R GROUP BY
  	R.type HAVING
		R.restaurantId = (SELECT MI.restaurantId FROM final_project.MenuItem MI GROUP BY MI.category)";
		$statement = pg_prepare($databaseConnection, "e_query", $e_query);
		$result = pg_execute($databaseConnection, "e_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Restaurant Type</th>
									<th>Meal Category</th>
									<th>Average Price</th>
									<th>Weekday Opening</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
								<td>$row[2]</td>
								<td>$row[3]</td>
							</tr>";
			}
				$retVal .=		"</tbody>
							</table>";
		}
		else {
			$retVal .= "<p>Query Failed!</p>";

		}
		echo $retVal;
	}

 ?>