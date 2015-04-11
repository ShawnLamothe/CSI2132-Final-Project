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
			$retVal .= "<tr>
							<td>
								<div class='col-sm-6 text-left'>"
								.$row[1].
								"</div>
								<div class='col-sm-6 text-right'>
										<button type='submit' class='btn btn-default bth-info btn-sm'
											 data-toggle='modal' data-target='#ratingModal'>Rate</button>
										<button type='submit' class='btn btn-default btn-info btn-sm'>More Details</button>
									</form>
								</div>
							</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
						</tr>";
		}
		$retVal .= "</tbody>
						</table>";
	} else {
		$retVal = "No matches!";
	}
	echo $retVal;
 ?>