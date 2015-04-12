$(document).ready(function(){
	$("#queryCResult").hide();
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