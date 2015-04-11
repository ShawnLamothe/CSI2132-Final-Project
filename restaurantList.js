$(document).ready(function(){
	$("#restaurantsByType").hide();
	$("#restaurantTypeLabel").hide();
	$("#restaurantTypeSearchButton").hide();
	$("#search_results").slideUp();
	$("#restaurantSearchButton").on('click', function(e){
		e.preventDefault();
		ajax_search();
	});
	$("#restaurantTypeSearchButton").on('click', function(e){
		e.preventDefault();
		ajax_searchType();
	});
	$("#restaurantSearch").keyup(function(e){
		e.preventDefault();
		ajax_search();
	});
});

$('#restaurantsByType').change(function(){
	$("#restaurantTypeSearchButton").show();
});

$('#type_selection').change(function() {
	$("#restaurantsByType").show();
	$("#restaurantTypeLabel").show();
	var search_val=$("#type_selection").val();
	$.post("./filterRestaurants.php", {restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#restaurantsByType").html(data);
		}
	});
});

function ajax_search(){
	$("#search_results").show();
	var search_val=$("#restaurantSearch").val();
	$.post("./restaurantFind.php", {restaurantSearch : search_val}, function(data) {
		if(data.length>0){
			$("#search_results").html(data);
		}
	});
}

function ajax_searchType(){
	$("#search_results").show();
	var search_val=$("#restaurantsByType").val();
	$.post("./restaurantFind.php", {restaurantSearch : search_val}, function(data) {
		if(data.length>0){
			$("#search_results").html(data);
		}
	});
}