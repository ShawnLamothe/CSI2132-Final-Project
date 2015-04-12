
$(document).ready(function(){
	$("#queryCResult").hide();
	console.log('here');
	$.post("./queries.php", {query: 'D_helper'}, function(data){
		console.log('here');
		if(data.length>0){
			console.log('here');
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

$('#selection_D').change(function() {
	$("#queryDResult").show();
	var search_val=$("#selection_D").val();
	$.post("./queries.php", {query: 'D', restaurantName : search_val}, function(data){
		if(data.length>0) {
			$("#queryDResult").html(data);
		}
	});
});