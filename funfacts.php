 
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
	 			-- f. Find the total number of rating for each restaurant, for each rater. That is, the data should be
					  grouped by the restaurant, the specific raters and the numeric ratings they have received.
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryF()">List</button>
 		</div>
 		<div class = "row" id="queryFResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- g. Display the details of the restaurants that have not been rated in January 2015. That is, you
					  should display the name of the restaurant together with the phone number and the type of
					  food.
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryG()">List</button>
 		</div>
 		<div class = "row" id="queryGResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- h. Find the names and opening dates of the restaurants that obtained Staff rating that is lower
					  than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to
					  any rater of your choice.)
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="rater">Select Rater:</label>
					<select class="form-control" id="select_H"></select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryHResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- i. List the details of the Type Y restaurants that obtained the highest Food rating. Display the
					  restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y
					  refers to any restaurant type of your choice, e.g. Indian or Burger.)  
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant Type:</label>
					<select class="form-control" id="type_selection_I">
						<?php 
							foreach($RESTAURANT_TYPES as $type) {
								echo "<option value=$type>$type</option>";
							}
				 		?>
					 </select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryIResult"></div>
 	</div>
 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- j. Provide a query to determine whether Type Y restaurants are “more popular” than other
					  restaurants.  (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.)
					  Yes, this query is open to your own interpretation!
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant Type:</label>
					<select class="form-control" id="type_selection_J">
						<?php 
							foreach($RESTAURANT_TYPES as $type) {
								echo "<option value=$type>$type</option>";
							}
				 		?>
					 </select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryJResult"></div>
 	</div>

 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- k. Find the names, join‐date and reputations of the raters that give the highest overall rating, in
					  terms of the Food and the Mood of restaurants. Display this information together with the
					  names of the restaurant and the dates the ratings were done.  
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryK()">List</button>
 		</div>
 		<div class = "row" id="queryKResult"></div>
 	</div>

 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- l. Find the names and reputations of the raters that give the highest overall rating, in terms of the
					  Food or the Mood of restaurants. Display this information together with the names of the
					  restaurant and the dates the ratings were done.
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryL()">List</button>
 		</div>
 		<div class = "row" id="queryLResult"></div>
 	</div>

 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- m. Find the names and reputations of the raters that rated a specific restaurant (say Restaurant Z)
					  the most frequently. Display this information together with their comments and the names and
					  prices of the menu items they discuss. (Here Restaurant Z refers to a restaurant of your own
					  choice, e.g. Ma Cuisine).
	 		</p>
	 		<form role ="form" id="restaurantTypeSearchForm">
				<div class ="form-group">
					<label for="type">Select Restaurant:</label>
					<select class="form-control" id="select_M"></select>
				</div>
			</form>
 		</div>
 		<div class = "row" id="queryMResult"></div>
 	</div>

 	 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- n. Find the names and emails of all raters who gave ratings that are lower than that of a rater with
					  a name called John, in terms of the combined rating of Price, Food, Mood and Staff. (Note that
					  there may be more than one rater with this name).
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryN()">List</button>
 		</div>
 		<div class = "row" id="queryNResult"></div>
 	</div>

 	<div class="row">
 		<div class="row">
	 		<p>
	 			-- o. Find the names, types and emails of the raters that provide the most diverse ratings. Display this
					  information together with the restaurants names and the ratings. For example, Jane Doe may
					  have rated the Food at the Imperial Palace restaurant as a 1 on 1 January 2015, as a 5 on 15
					  January 2015, and a 3 on 4 February 2015.  Clearly, she changes her mind quite often.
	 		</p>
	 		<button type="submit" class='btn btn-default btn-info btn-sm' onclick="queryO()">List</button>
 		</div>
 		<div class = "row" id="queryOResult"></div>
 	</div>

 </div>
 <?php 
	echo "<script language='javascript' type='text/javascript' src='$ABSOLUTE_PATH/funfacts.js'></script>";
 ?>