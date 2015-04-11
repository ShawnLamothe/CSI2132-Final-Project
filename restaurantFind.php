<?php 
	$term = $_POST['restaurantSearch'];
	$query = "SELECT * FROM final_project.restaurant WHERE name LIKE '%' || $1 ||'%'";
	$statement = pg_prepare($databaseConnection, "restaurantSearch", $query);
	$result = pg_execute($databaseConnection, "restaurantSearch", array($term));

	$retVal = '';

	if(pg_num_rows($result) > 0) {
		$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
						<thead>
							<tr>
								<th>Restaurant Name</th>
								<th>Type</th>
								<th>Website</th>
								<th>Overall Rating</th>
							</tr>
						</thead>
						<tbody>";
		while($row=pg_fetch_array($result)) {
			$retval .= "<tr>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
						</tr>";
		}
		$retval .= "</tbody>
						</table>";
	} else {
		$retVal = "No matches!";
	}
	echo $retVal;
 ?>