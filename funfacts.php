 
<?php 	include_once 'rating_stars.php'; ?>
 <br><br><br><br>
 <div class="container">
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- c. For each user‐specified category of restaurant, list the manager names together with the date
					  that the locations have opened. The user should be able to select the category (e.g. Italian or
					  Thai) from a list.
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant Type:</label>
					<select class="form-control" id="type_selection_C">
						<?php 
							foreach($RESTAURANT_TYPES as $type) {
								echo "<option value=$type>$type</option>";
							}
				 		?>
					 </select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryCResult"></div>
 	</div>
 </div>
 <?php 
	echo "<script language='javascript' type='text/javascript' src='$ABSOLUTE_PATH/funfacts.js'></script>";
 ?>