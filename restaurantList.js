$(document).ready(function(){
	$("#search_results").slideUp();
	$("#restaurantSearchButton").on('click', function(e){
		e.preventDefault();
		ajax_search();
	});
	$("#restaurantSearch").keyup(function(e){
		e.preventDefault();
		ajax_search();
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