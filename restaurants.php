
<?php 
	$restaurantTypes = array('indian','fast-food');
 ?>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<form role ="form">
				<div class ="form-group">
					<label for="type">Select Restaurant Type:</label>
					<select class="form-control" id="type" onchange="filterRestaurants();">
						<?php 
							foreach($restaurantTypes as $type) {
								echo "<option>$type</option>";
							}
				 		?>
					 </select>
				</div>
				<div class ="form-group">
					<label for"restaurant">Select Restaurant:</label>
					<select class="form-control" id="type">
						<?php 

					 	?>
					</select>
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<form role="form" id="restaurantSearchForm" method="POST">
				<div class="form-group">
					<label for="restaurantSearch">Search Resraurants:</label>
					<input class="form-control" type="text" name="restaurantSearch" id="restaurantSearch"/>
				</div>
				<button type='submit' form ='restaurantSearchForm' class='btn btn-default btn-sm restaurantSearchButton' value='restaurantSearch' name='restaurantSearch' id="restaurantSearchButton">Search</button>
			</form>
		</div>
	</div>
	<div class="row" id="search_results"></div>
</div>
<script language="javascript" type='text/javascript' src="/~shawnlamothe/CSI2132/CSI2132-Final-Project/restaurantList.js"></script>