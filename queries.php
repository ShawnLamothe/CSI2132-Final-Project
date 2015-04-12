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
			$retVal .= "<option>No Restaurants</option>"
		}
		echo $retVal;
	}
 ?>