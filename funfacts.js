
$(document).ready(function(){
	$("#closeC").hide();
	$("#closeD").hide();
	$("#closeE").hide();
	$("#closeF").hide();
	$("#closeG").hide();
	$("#closeH").hide();
	$("#closeI").hide();
	$("#closeJ").hide();
	$("#closeK").hide();
	$("#closeL").hide();
	$("#closeM").hide();
	$("#closeN").hide();
	$("#closeO").hide();
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
	$("#closeC").show();
	var search_val=$("#type_selection_C").val();
	$.post("./queries.php", {query: 'C', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryCResult").html(data);
		}
	});
});

$('#select_D').change(function() {
	$("#queryDResult").show();
	$("#closeD").show();
	var search_val=$("#select_D").val();
	$.post("./queries.php", {query: 'D', restaurant_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryDResult").html(data);
		}
	});
});

function queryE() {
	$("#queryEResult").show();
	$("#closeE").show();
	$.post("./queries.php", {query : 'E'}, function(data) {
		if(data.length>0) {
			$("#queryEResult").html(data);
		}
	});
}


function queryF() {
	$("#closeF").show();
	$("#queryFResult").show();
	$.post("./queries.php", {query : 'F'}, function(data) {
		if(data.length>0) {
			$("#queryFResult").html(data);
		}
	});
}

function queryG() {
	$("#closeG").show();
	$("#queryGResult").show();
	$.post("./queries.php", {query : 'G'}, function(data) {
		if(data.length>0) {
			$("#queryGResult").html(data);
		}
	});
}

$('#select_H').change(function() {
	$("#queryHResult").show();
	$("#closeH").show();
	var search_val=$("#select_H").val();
	$.post("./queries.php", {query: 'H', rater_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryHResult").html(data);
		}
	});
});

$('#type_selection_I').change(function() {
	$("#closeI").show();
	$("#queryIResult").show();
	var search_val=$("#type_selection_I").val();
	$.post("./queries.php", {query: 'I', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryIResult").html(data);
		}
	});
});

$('#type_selection_J').change(function() {
	$("#closeJ").show();
	$("#queryJResult").show();
	var search_val=$("#type_selection_J").val();
	$.post("./queries.php", {query: 'J', restaurantType : search_val}, function(data){
		if(data.length>0) {
			$("#queryJResult").html(data);
		}
	});
});

function queryK() {
	$("#closeK").show();
	$("#queryKResult").show();
	$.post("./queries.php", {query : 'K'}, function(data) {
		if(data.length>0) {
			$("#queryKResult").html(data);
		}
	});
}

function queryL() {
	$("#closeL").show();
	$("#queryLResult").show();
	$.post("./queries.php", {query : 'L'}, function(data) {
		if(data.length>0) {
			$("#queryLResult").html(data);
		}
	});
}

$('#select_M').change(function() {
	$("#closeM").show();
	$("#queryMResult").show();
	var search_val=$("#select_M").val();
	$.post("./queries.php", {query: 'M', restaurant_name : search_val}, function(data){
		if(data.length>0) {
			$("#queryMResult").html(data);
		}
	});
});

function queryN() {
	$("#closeN").show();
	$("#queryNResult").show();
	$.post("./queries.php", {query : 'N'}, function(data) {
		if(data.length>0) {
			$("#queryNResult").html(data);
		}
	});
}

function closeBox(button){
	var value = $(button).val();
	var close_value = "#close"+value;
	var result_close_calue = "#query"+value+"Result";
	$(close_value).hide();
	$(result_close_calue).hide();
}

function queryO() {
	$("#closeO").show();
	$("#queryOResult").show();
	$.post("./queries.php", {query : 'O'}, function(data) {
		if(data.length>0) {
			$("#queryOResult").html(data);
		}
	});
}