
<?php 
	$restaurantTypes = array('Indian','Burger');
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
							foreach($restaurantTypes as $type) {
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
	<div class="row" id="search_results"></div>

	<div class="modal fade" id="ratingModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearStars()">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Rate</h4>
				</div>
				<div class ="modal-body">
					<form role="form" id="ratingForm" method="POST">
						<div class="rating">
							<label for="food_rating">Food: </label>
							<div class="form-group rate_widget" id="food_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_vote"></div>
							 	<div class="star_2 ratings_stars"></div>
							 	<div class="star_3 ratings_stars"></div>
							 	<div class="star_4 ratings_stars"></div>
							 	<div class="star_5 ratings_stars"></div>
							 </div>
						</div>
						<div class ="rating">
							<label for="price_rating">Price: </label>
							<div class="form-group rate_widget" id="price_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_vote"></div>
							 	<div class="star_2 ratings_stars"></div>
							 	<div class="star_3 ratings_stars"></div>
							 	<div class="star_4 ratings_stars"></div>
							 	<div class="star_5 ratings_stars"></div>
							 </div>
						</div>
						<div class ="rating">
							<label for="mood_rating">Mood: </label>
							<div class="form-group rate_widget" id="mood_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_vote"></div>
							 	<div class="star_2 ratings_stars"></div>
							 	<div class="star_3 ratings_stars"></div>
							 	<div class="star_4 ratings_stars"></div>
							 	<div class="star_5 ratings_stars"></div>
							 </div>
						</div>
						 <div class ="rating">
							<label for="staff_rating">Staff: </label>
							<div class="form-group rate_widget" id="staff_rating" value="star_1">
							 	<div class="star_1 ratings_stars ratings_vote"></div>
							 	<div class="star_2 ratings_stars"></div>
							 	<div class="star_3 ratings_stars"></div>
							 	<div class="star_4 ratings_stars"></div>
							 	<div class="star_5 ratings_stars"></div>
							 </div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input class="btn btn-success" type="submit" value="Rate" id="submitRating">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearStars()">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script language="javascript" type='text/javascript' src="$ABSOLUTE_PATH/restaurantList.js"></script>
<script language="javascript" type='text/javascript' src="$ABSOLUTE_PATHs/ratingWidget.js"></script>