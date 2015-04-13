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
				$retVal .= "<option value='$row[0]'>$row[0]</option>";
			}
		}
		else {
			$retVal .= "<option>No Restaurants</option>";

		}
		echo $retVal;
	}

	else if($_POST['query'] == 'D') {
		$restaurantName = $_POST['restaurant_name'];
		$d_query = "SELECT MI.name, MI.price, L.manager_name, H.weekdayOpen, H.weekendOpen, R.url FROM 
		final_project.Restaurant R, final_project.Location L, final_project.Hours H, final_project.MenuItem MI WHERE
		MI.price >= all(SELECT MI_1.price FROM final_project.MenuItem MI_1 WHERE
				MI_1.restaurantId = R.restaurantId) AND
			R.restaurantId = L.restaurantId AND L.hoursId = H.hoursId AND
			MI.restaurantId = R.restaurantId AND R.name =$1";
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
		R.restaurantId IN (SELECT MI1.restaurantId FROM final_project.MenuItem MI1 GROUP BY MI1.category)";
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

		else if($_POST['query'] == 'F') {
		$f_query = "SELECT U.name, R.name, COUNT(R8.*) FROM final_project.Rating R8, final_project.Restaurant R, final_project.Rater U WHERE
	R8.restaurantId = R.restaurantId AND R8.userId = U.userId
	 GROUP BY R.restaurantId"; 
		$statement = pg_prepare($databaseConnection, "f_query", $f_query);
		$result = pg_execute($databaseConnection, "f_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Restaurant Name</th>
									<th>Rater Name</th>
									<th>Number of Ratings</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
								<td>$row[2]</td>
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

		else if($_POST['query'] == 'G') {
		$g_query = "SELECT R.name, R.type, L.phone_number FROM final_project.Restaurant R, final_project.Location L WHERE 
	NOT EXISTS(SELECT * FROM final_project.Rating R8 WHERE
		DATEPART(yyyy,R8.post_date) = 2015 AND DATEPART(mm,R8.post_date) = 01)
	AND R.restaurantId = L.restaurantId";
		$statement = pg_prepare($databaseConnection, "g_query", $g_query);
		$result = pg_execute($databaseConnection, "g_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Restaurant Name</th>
									<th>Restaurant Type</th>
									<th>Phone Number</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
								<td>$row[2]</td>
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

	else if ($_POST['query'] == 'H_helper') {
		$H_helper_query = "SELECT R.Name FROM final_project.rater R";
		$statement = pg_prepare($databaseConnection, "H_helper", $H_helper_query);
		$result = pg_execute($databaseConnection, "H_helper", array());

		$retVal = "";
		if($result) {
			
			while($row = pg_fetch_array($result)) {
				$retVal .= "<option value='$row[0]'>$row[0]</option>";
			}
		}
		else {
			$retVal .= "<option>No Raters</option>";

		}
		echo $retVal;
	}

	else if($_POST['query'] == 'H') {
		$raterName = $_POST['rater_name'];
		$h_query = "SELECT R.name, L.first_open_date FROM final_project.Restaurant R, final_project.Location L WHERE
	R.restaurantId IN (SELECT R8.restaurantId FROM final_project.Rating R8 WHERE
		R8.staff_rating < ANY(Select Rate.staff_rating FROM final_project.Rating Rate WHERE
			Rate.userId = $1))
	AND R.restaurantId = L.restaurantId";
		$statement = pg_prepare($databaseConnection, "h_query", $h_query);
		$result = pg_execute($databaseConnection, "h_query", array($raterName));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Restaurant Name</th>
									<th>Opening Date</th>
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

	else if($_POST['query'] == 'I') {
		$restaurantType = $_POST['restaurantType'];
		$i_query = "SELECT R.name, U.name FROM final_project.Restaurant R, final_project.Rater U WHERE
	R.restaurantId IN (SELECT R8.restaurantId FROM final_project.Rating R8 WHERE
		R8.restaurantId IN (SELECT R1.restaurantId FROM final_project.Restaurant R1 WHERE
				R1.type = $1)
		AND 
		R8.food_rating >= All(SELECT Rate.food_rating FROM final_project.Rating Rate WHERE
			Rate.restaurantId IN (SELECT R2.restaurantId FROM final_project.Restaurant R2 WHERE
				R2.type = $1))
		AND
		R8.userId = U.userId)";
		$statement = pg_prepare($databaseConnection, "i_query", $i_query);
		$result = pg_execute($databaseConnection, "i_query", array($restaurantType));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Restaurant Name</th>
									<th>Rater Names</th>
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

	if($_POST['query'] == 'J') {
		$restaurantType = $_POST['restaurantType'];
		$j_query = "SELECT ROW_NUMBER() OVER(ORDER BY OverallRating DESC) AS Ranking, OverallRating, Type
 	FROM
		(SELECT AVG(overallRating) AS OverallRating, R.type AS Type FROM
		 	final_project.Restaurant R GROUP BY R.type) 
	WHERE Type = $1";
		$statement = pg_prepare($databaseConnection, "j_query", $j_query);
		$result = pg_execute($databaseConnection, "j_query", array($restaurantType));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Ranking</th>
									<th>Popularity</th>
									<th>Type</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
								<td>$row[1]</td>
								<td>$row[2]</td>
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

		else if($_POST['query'] == 'K') {
		$k_query = "SELECT U.name, U.join_date, U.reputation, R.name, R8.post_date FROM final_project.Rater U, final_project.Restaurant R, final_project.R8 Rating WHERE 
	U.userId IN (SELECT U1.userId FROM final_project.Rater U1 HAVING
		AVG(SELECT (Rate.mood_rating + Rate.food_rating) as OverallRating FROM final_project.Rating Rate WHERE
			Rate.userId = U1.userId) 
		>= ALL(SELECT OverallRating FROM (SELECT U2.userId FROM final_project.Rater U2 HAVING
			AVG(SELECT (Rate.mood_rating + Rate.food_rating) as OverallRating FROM final_project.Rating Rate WHERE
				Rate.userId = U1.userId))))
	AND R8.userId = U.userId AND R8.restaurantId = R.restaurantId";
		$statement = pg_prepare($databaseConnection, "k_query", $k_query);
		$result = pg_execute($databaseConnection, "k_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Rater Name</th>
									<th>Join Date</th>
									<th>Reputation</th>
									<th>Restaurant Name</th>
									<th>Post Date</th>
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

			else if($_POST['query'] == 'L') {
		$l_query = "SELECT U.name, U.join_date, U.reputation, R.name, R8.post_date FROM final_project.Rater U, final_project.Restaurant R, final_project.Rating R8 WHERE
	U.userId IN (SELECT U1.userId FROM final_project.Rater U1 WHERE
		(SELECT AVG(mood_rating) FROM final_project.Rating Rate WHERE Rate.userId = U1.userId)
			>= ALL(SELECT AVG(mood_rating) FROM final_project.Rating Rate GROUP BY Rate.userId)
		OR (SELECT AVG(food_rating) FROM final_project.Rating Rate WHERE Rate.userId = U1.userId)
			>= ALL(SELECT AVG(food_rating) FROM final_project.Rating Rate GROUP BY Rate.userId)
		AND R8.userId = U.userId AND R8.restaurantId = R.restaurantId";
		$statement = pg_prepare($databaseConnection, "l_query", $l_query);
		$result = pg_execute($databaseConnection, "l_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Rater Name</th>
									<th>Join Date</th>
									<th>Reputation</th>
									<th>Restaurant Name</th>
									<th>Post Date</th>
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

		else if ($_POST['query'] == 'M_helper') {
		$M_helper_query = "SELECT R.Name FROM final_project.restaurant R";
		$statement = pg_prepare($databaseConnection, "m_helper", $M_helper_query);
		$result = pg_execute($databaseConnection, "m_helper", array());

		$retVal = "";
		if($result) {
			
			while($row = pg_fetch_array($result)) {
				$retVal .= "<option value='$row[0]'>$row[0]</option>";
			}
		}
		else {
			$retVal .= "<option>No Restaurants</option>";

		}
		echo $retVal;
	}

	else if($_POST['query'] == 'M') {
		$restaurantName = $_POST['restaurant_name'];
		$m_query = "";
		$statement = pg_prepare($databaseConnection, "m_query", $m_query);
		$result = pg_execute($databaseConnection, "m_query", array($restaurantName));

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th></th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
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

				else if($_POST['query'] == 'N') {
		$n_query = "SELECT U.name, U.email FROM final_project.Rater U WHERE
	U.userId IN (SELECT R8.userId FROM final_project.Rating R8 WHERE
		(R8.price_rating + R8.food_rating + R8.mood_rating + R8.staff_rating)
		< ANY(SELECT (Rate.price_rating + Rate.mood_rating + Rate.food_rating + Rate.staff_rating) FROM final_project.Rating Rate WHERE
			Rate.userId IN (SELECT U1.userId FROM Rater U1 WHERE
				U1.name = 'John')))";
		$statement = pg_prepare($databaseConnection, "n_query", $n_query);
		$result = pg_execute($databaseConnection, "n_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Rater Name</th>
									<th>Email</th>
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

					else if($_POST['query'] == 'O') {
		$o_query = "";
		$statement = pg_prepare($databaseConnection, "o_query", $o_query);
		$result = pg_execute($databaseConnection, "o_query", array());

		$retVal = "";
		if($result) {
			$retVal .= "<table class='table table-striped table-borderd table-hover table-condensed'>
							<thead>
								<tr>
									<th>Rater Name</th>
								<tr>
							</thead>
							<tbody>";
			while($row = pg_fetch_array($result)) {
				$retVal .= "<tr>
								<td>$row[0]</td>
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