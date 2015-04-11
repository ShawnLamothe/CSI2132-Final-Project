
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
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Rate</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<script language="javascript" type='text/javascript' src="/~shawnlamothe/CSI2132/CSI2132-Final-Project/restaurantList.js"></script>