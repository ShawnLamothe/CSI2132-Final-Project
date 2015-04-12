$(document).ready(function(){
	$("#queryCResults").hide();
});

$('#type_selection_C').change(function() {
	$("#queryCResults").show();
	var search_val=$("#type_selection_C").val();
	$.post("./queries.php", {query: 'C', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryCResults").html(data);
		}
	});
});