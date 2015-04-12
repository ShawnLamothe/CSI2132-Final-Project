 
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
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- d. Given a user‐specified restaurant, find the name of the most expensive menu item. List this
					  information together with the name of manager, the opening hours, and the URL of the
					  restaurant. The user should be able to select the restaurant name (e.g. El Camino) from a list.
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant:</label>
					<select class="form-control" id="select_D"></select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryDResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- e. For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main
				      or desert), list the average prices of menu items for each category.   
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryE()">List</button>
 		</div>
 		<div class = "row" id="queryEResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 		</p>
 		</div>
 	</div>
 </div>
 <?php 
	echo "<script language='javascript' type='text/javascript' src='$ABSOLUTE_PATH/funfacts.js'></script>";
 ?>