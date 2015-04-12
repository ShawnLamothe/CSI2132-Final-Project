<?php 
	include_once 'rating_stars.php';

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
								<div class='col-sm-7 text-left'>"
								.$row[1].
								"</div>
								<div class='col-sm-2 text-right'>
										<input type='hidden' id='restaurantName$row[0]' value='$row[1]'>
										<button type='submit' class='btn btn-primary btn-sm'
											data-toggle='modal' data-target='#ratingModal' name='rateButton' value='$row[0]'id='rateButton$row[0]' onclick='rateButton(this)'>Rate</button>
								</div>
								<div class='col-sm-3 text-right'>
									<form method='POST' role='form' id='viewRestaurant$row[0]' action='$ABSOLUTE_PATH/restaurants/'>
										<input type='hidden' name='restaurant_id' value='$row[0]'/>
										<button type='submit' form='viewRestaurant$row[0]' class='btn btn-default btn-info btn-sm'>More Details</button>
									</form>
								</div>
							</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".call_user_func('ratingStar::create_stars_return', $row[4])."</td>
						</tr>";
		}
		$retVal .= "</tbody>
						</table>";
	} else {
		$retVal = "No matches!";
	}
	echo $retVal;
 ?>