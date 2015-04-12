
$(document).ready(function(){
	$("#queryCResult").hide();
	$("#queryDResult").hide();
	$("#queryEResult").hide();
	$("#queryFResult").hide();
	$("#queryGResult").hide();
	$("#queryHResult").hide();
	$("#queryIResult").hide();
	$("#queryJResult").hide();
	$("#queryKResult").hide();
	$("#queryLResult").hide();
	$("#queryMResult").hide();
	$("#queryNResult").hide();
	$("#queryOResult").hide();
	$.post("./queries.php", {query: 'D_helper'}, function(data){
		if(data.length>0){
			$("#select_D").html(data);
		}
	});
		$.post("./queries.php", {query: 'H_helper'}, function(data){
		if(data.length>0){
			$("#select_H").html(data);
		}
	});
		$.post("./queries.php", {query: 'M_helper'}, function(data){
		if(data.length>0){
			$("#select_M").html(data);
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
	$.post("./queries.php", {query: 'D', restaurant_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryDResult").html(data);
		}
	});
});

function queryE() {
	$.post("./queries.php", {query : 'E'}, function(data) {
		if(data>0) {
			$("#queryEResult").html(data);
		}
	});
}

function queryF() {
	$.post("./queries.php", {query : 'F'}, function(data) {
		if(data>0) {
			$("#queryFResult").html(data);
		}
	});
}

function queryG() {
	$.post("./queries.php", {query : 'G'}, function(data) {
		if(data>0) {
			$("#queryGResult").html(data);
		}
	});
}

$('#select_H').change(function() {
	$("#queryHResult").show();
	var search_val=$("#select_H").val();
	$.post("./queries.php", {query: 'H', rater_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryHResult").html(data);
		}
	});
});

$('#type_selection_I').change(function() {
	$("#queryIResult").show();
	var search_val=$("#type_selection_I").val();
	$.post("./queries.php", {query: 'I', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryIResult").html(data);
		}
	});
});

$('#type_selection_J').change(function() {
	$("#queryJResult").show();
	var search_val=$("#type_selection_J").val();
	$.post("./queries.php", {query: 'J', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryJResult").html(data);
		}
	});
});

function queryK() {
	$.post("./queries.php", {query : 'K'}, function(data) {
		if(data>0) {
			$("#queryKResult").html(data);
		}
	});
}

function queryL() {
	$.post("./queries.php", {query : 'L'}, function(data) {
		if(data>0) {
			$("#queryLResult").html(data);
		}
	});
}

$('#select_M').change(function() {
	$("#queryMResult").show();
	var search_val=$("#select_M").val();
	$.post("./queries.php", {query: 'M', restaurant_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryMResult").html(data);
		}
	});
});

function queryN() {
	$.post("./queries.php", {query : 'N'}, function(data) {
		if(data>0) {
			$("#queryNResult").html(data);
		}
	});
}

function queryO() {
	$.post("./queries.php", {query : 'O'}, function(data) {
		if(data>0) {
			$("#queryOResult").html(data);
		}
	});
}