
$(document).ready(function(){
	$("#queryCResult").hide();
	$.post("./queries.php", {query: 'D_helper'}, function(data){
		if(data.length>0){
			$("#select_D").html(data);
		}
	});
});


$('#type_selection_C').change(function() {
	$("#queryCResult").show();
	var search_val=$("#type_selection_C").val();
	$.post("./queries.php", {query: 'C', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryCResult").html(data);
		}
	});
});

$('#select_D').change(function() {
	$("#queryDResult").show();
	var search_val=$("#select_D").val();
	console.log("here");
	$.post("./queries.php", {query: 'D', restaurant_name : search_val}, function(data){
		console.log("here");
		if(data.length>0) {
			console.log("here");
			$("#queryDResult").html(data);
		}
	});
});

function queryE() {
	$.post(".queries.php", {query : 'E'}, function(data) {
		if(data>0) {
			$("#queryEResult").html(data);
		}
	});
}