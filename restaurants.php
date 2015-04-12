
<?php 
	include_once 'rating_stars.php';
 ?>
 <br><br><br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant Type:</label>
					<select class="form-control" id="type_selection"onchange="run()">
						<?php 
							foreach($RESTAURANT_TYPESß as $type) {
								echo "<option value=$type>$type</option>";
							}
				 		?>
					 </select>
				</div>
				<div class ="form-group">
					<label for='restaurant' id="restaurantTypeLabel">Select Restaurant:</label>
					<select class='form-control' id='restaurantsByType' onchange="run()">;
					</select>
				</div>
				<button type='submit' form ='restaurantTypeSearchForm' class='btn btn-default btn-sm' value='restaurantTypeSearch' name='restaurantTypeSearch' id="restaurantTypeSearchButton">Search</button>
			</form>
		</div>
		<div class="col-sm-6">
			<form role="form" id="restaurantSearchForm" method="POST">
				<div class="form-group">
					<label for="restaurantSearch">Search Resraurants:</label>
					<input class="form-control" type="text" name="restaurantSearch" id="restaurantSearch"/>
				</div>
				<button type='submit' form ='restaurantSearchForm' class='btn btn-default btn-sm' value='restaurantSearch' name='restaurantSearch' id="restaurantSearchButton">Search</button>
			</form>
		</div>
	</div>
	<div class="row" id="rating_results"></div>
	<div class="row" id="search_results"></div>

	<?php if($match['name'] == 'viewRestaurant') {  
		$restaurantId = $_POST['restaurant_id'];
		$restaurantQuery = "SELECT * FROM final_project.restaurant R WHERE R.restaurantId =$1";
		$statement = pg_prepare($databaseConnection, 'restaurantView', $restaurantQuery);
		$result = pg_execute($databaseConnection, 'restaurantView', array($restaurantId));
		$restaurant=pg_fetch_array($result);

		$locationQuery = "SELECT * FROM final_project.location L WHERE L.restaurantId =$1";
		$statement = pg_prepare($databaseConnection, 'locationQuery', $locationQuery);
		$result = pg_execute($databaseConnection, 'locationQuery', array($restaurant[0]));
		
		$locations = [];
		$hours = [];
		$counter = 0;
		while($locationRow=pg_fetch_array($result)) {
			$locations[$counter] = $locationRow;
			$hoursQuery = "SELECT * FROM final_project.hours H WHERE H.hoursId =$1";
			$statement = pg_prepare($databaseConnection, 'hoursQuery', $hoursQuery);
			$hoursResult = pg_execute($databaseConnection, 'hoursQuery', array($locationRow[5]));
			$hoursRow =pg_fetch_array($hoursResult);
			$hours[$counter] = $hoursRow;
			$counter += 1; 
		}
	?>

	<div class="row">
		<div class="row">
			<div class="col-sm-2">
				<h1><?php echo $restaurant[1];?></h1>
			</div>
			<div class="col-sm-10">
				<input type='hidden' id='<?php echo "restaurantName$restaurant[0]" ?>' value="<?php echo $restaurant[1]?>"]>
				<button type='submit' class='btn btn-primary bth-info btn-sm '
					data-toggle='modal' data-target='#ratingModal' name='rateButton' 
						value="<?php  echo $restaurant[0]?>" id="<?php echo 'rateButton$restuarant[0]' ?>" onclick='rateButton(this)'>Rate</button>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<h2>Information: </h2>
				<p>
					<label>Type: </label>
					<?php echo $restaurant[2];?>
				</p>
				<p>
					<label>Website: </label>
					<?php echo $restaurant[3];?>
				</p>
				<p>
					<label>Overall Rating: </label>
					<?php echo call_user_func('ratingStar::create_stars_return', $restaurant[4]);?>
				</p>
			</div>
			<div class="col-sm-8">
				<h2>Locations: </h2>
				<table class='table table-striped table-borderd table-hover table-condensed'>
					<thead>
						<tr>
							<th>Street Adress</th>
							<th>Phone Number</th>
							<th>Manager Name</th>
							<th>Opened On</th>
							<th>Hours of Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$locationCounter = 0;
							foreach($locations as $loc) {
								echo"<tr>";
									echo"<td>$loc[4]</td>";
										echo"<td>$loc[3]</td>";
										echo"<td>$loc[2]</td>";
										echo"<td>$loc[1]</td>";
										echo"<td>";
											echo"<div class ='col-sm-6'>";
												echo"<p>";
												echo"	<label>Weekday Open: </label>";
												echo	$hours[$locationCounter][1];
												echo"</p>";
												echo"<p>";
													echo"<label>Weekdend Open: </label>";
													echo $hours[$locationCounter][3];
												echo"</p>";
											echo"</div>";
											echo"<div class ='col-sm-6'>";
												echo"<p>";
													echo"<label>Weekday Close: </label>";
													echo$hours[$locationCounter][2];
												echo"</p>";
												echo"<p>";
													echo"<label>Weekdend Close: </label>";
													echo $hours[$locationCounter][4];
												echo"</p>";
											echo"</div>";
										echo"</td>";
									echo "</tr>";
								$locationCounter += 1;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php 
			$menuQuery = "SELECT * FROM final_project.MenuItem M WHERE M.restaurantId = $1";
			$statement = pg_prepare($databaseConnection, 'menuQuery', $menuQuery);
			$menuResult = pg_execute($databaseConnection, 'menuQuery', array($restaurant[0]));
			$menuItems = [];
			$counter = 0;
			while($menuItem=pg_fetch_array($menuResult)) {
				$menuItems[$counter] = $menuItem;
				$counter += 1; 
			}
		 ?>
		<div class="row">
			<div class = "col-sm-12">
				<h2>Menu</h2>
				<table class='table table-striped table-borderd table-hover table-condensed'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Type</th>
							<th>Category</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($menuItems as $menuItem) {
						 ?>
						 	<tr>
						 		<td>
							 		<div class="col-sm-6 text-left">
							 			<?php echo $menuItem[2];?>
							 		</div>
							 		<div class="col-sm-4 text-right">
							 			<input type='hidden' id='<?php echo "menuItem$menuItem[0]" ?>' value="<?php echo $menuItem[2]?>"]>
										<button type='submit' class='btn btn-primary bth-info btn-sm '
											data-toggle='modal' data-target='#menuRatingModal' name='menuRateButton' 
												value="<?php  echo $menuItem[0]?>" id="<?php echo "menuRateButton$menuItem[0]" ?>" onclick='menuRateButton(this)'>Rate</button>
							 		</div>
									<div class='col-sm-2 text-right'>
										<form method='POST' role='form' id='<?php echo "viewMenuItem$menuItem[0]" ?>' action='<?php echo "$ABSOLUTE_PATH/menu-item/" ?>'>
											<input type='hidden' name='menu_item_id' value='<?php echo $menuItem[0] ?>'/>
											<button type='submit' form='<?php echo "viewMenuItem$menuItem[0]" ?>' class='btn btn-default btn-info btn-sm'>View Ratings</button>
										</form>
									</div>
						 		</td>
						 		<td><?php echo $menuItem[5]; ?></td>
						 		<td><?php echo $menuItem[6]; ?></td>
						 		<td><?php echo $menuItem[3]; ?></td>
						 		<td><?php echo $menuItem[4]; ?></td>
						 	</tr>
						 <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php 
			$ratingQuery = "SELECT U.name, R8.food_rating, R8.price_rating, R8.mood_rating,
				R8.staff_rating, R8.comment, R8.post_date FROM final_project.rating R8, final_project.rater U WHERE 
					R8.restaurantId = $1 AND R8.userId = U.userId ORDER BY R8.post_date desc LIMIT 10";
			$statement = pg_prepare($databaseConnection, "ratingsQuery", $ratingQuery);
			$result = pg_execute($databaseConnection, "ratingsQuery", array($restaurant[0]));
			$ratings = [];
			$counter = 0;
			while($rating = pg_fetch_array($result)) {
				$ratings[$counter] = $rating;
				$counter++;
			}
		 ?>
		<div class="row">
			<div class="col-sm-12">
				<h2>Recent ratings</h2>
				<table class='table table-striped table-borderd table-hover table-condensed'>
					<thead>
						<tr>
							<th>Rater</th>
							<th>Food</th>
							<th>Price</th>
							<th>Mood</th>
							<th>Staff</th>
							<th>Comment</th>
							<th>Rated On</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($ratings as $rating) {
						 ?>
						 		<tr>
						 			<td><?php echo $rating[0] ?></td>
						 			<td><?php call_user_func('ratingStar::create_stars', $rating[1]) ?></td>
						 			<td><?php call_user_func('ratingStar::create_stars', $rating[2]) ?></td>
						 			<td><?php call_user_func('ratingStar::create_stars', $rating[3]) ?></td>
						 			<td><?php call_user_func('ratingStar::create_stars', $rating[4]) ?></td>
						 			<td><p><?php echo $rating[5] ?></p></td>
						 			<td><?php echo $rating[6] ?></td>
						 		</tr>
						 <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php 
		if($match['name'] == 'viewMenuItem') { 

	?>
	<?php } ?>

	<div class="modal fade" id="ratingModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearStars()">&times;</button>
					<div id="myModalLabel"></div>
				</div>
				<div class ="modal-body">
					<form role="form" id="ratingForm" method="POST">
						<div class="rating">
							<label for="food_rating">Food: </label>
							<div class="form-group rate_widget" id="food_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_stars_select ratings_vote"></div>
							 	<div class="star_2 ratings_stars ratings_stars_select"></div>
							 	<div class="star_3 ratings_stars ratings_stars_select"></div>
							 	<div class="star_4 ratings_stars ratings_stars_select"></div>
							 	<div class="star_5 ratings_stars ratings_stars_select"></div>
							 </div>
						</div>
						<div class ="rating">
							<label for="price_rating">Price: </label>
							<div class="form-group rate_widget" id="price_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_stars_select ratings_vote"></div>
							 	<div class="star_2 ratings_stars ratings_stars_select"></div>
							 	<div class="star_3 ratings_stars ratings_stars_select"></div>
							 	<div class="star_4 ratings_stars ratings_stars_select"></div>
							 	<div class="star_5 ratings_stars ratings_stars_select"></div>
							 </div>
						</div>
						<div class ="rating">
							<label for="mood_rating">Mood: </label>
							<div class="form-group rate_widget" id="mood_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_stars_select ratings_vote"></div>
							 	<div class="star_2 ratings_stars ratings_stars_select"></div>
							 	<div class="star_3 ratings_stars ratings_stars_select"></div>
							 	<div class="star_4 ratings_stars ratings_stars_select"></div>
							 	<div class="star_5 ratings_stars ratings_stars_select"></div>
							 </div>
						</div>
						 <div class ="rating">
							<label for="staff_rating">Staff: </label>
							<div class="form-group rate_widget" id="staff_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_stars_select ratings_vote"></div>
							 	<div class="star_2 ratings_stars ratings_stars_select"></div>
							 	<div class="star_3 ratings_stars ratings_stars_select"></div>
							 	<div class="star_4 ratings_stars ratings_stars_select"></div>
							 	<div class="star_5 ratings_stars ratings_stars_select"></div>
							 </div>
						</div>
						<div class="form-group">
							<label for="comment">Leave A Comment: </label>
							<textarea class="form-control" required="true" id="comment" rows="4"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="restaurantId" value=""/>
					<input class="btn btn-success" type="submit" value="Rate" id="submitRating" data-dismiss="modal" onclick="submitRating()">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearStars()">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="menuRatingModal" role="dialog" aria-labelledby="myMenuModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearStars()">&times;</button>
					<div id="myMenuModalLabel"></div>
				</div>
				<div class ="modal-body">
					<form role="form" id="menuRatingForm" method="POST">
						<div class="rating">
							<div class="form-group rate_widget" id="menu_food_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_stars_select ratings_vote"></div>
							 	<div class="star_2 ratings_stars ratings_stars_select"></div>
							 	<div class="star_3 ratings_stars ratings_stars_select"></div>
							 	<div class="star_4 ratings_stars ratings_stars_select"></div>
							 	<div class="star_5 ratings_stars ratings_stars_select"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="comment">Leave A Comment: </label>
							<textarea class="form-control" required="true" id="menu_comment" rows="4"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="menuItemId" value=""/>
					<input class="btn btn-success" type="submit" value="Rate" id="submitRating" data-dismiss="modal" onclick="submitMenuRating()">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearStars()">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	echo "<script language='javascript' type='text/javascript' src='$ABSOLUTE_PATH/restaurantList.js'></script>";
	echo "<script language='javascript' type='text/javascript' src='$ABSOLUTE_PATH/ratingWidget.js'></script>";
 ?>