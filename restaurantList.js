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

function add_restaurant(){
	var _name = $("#restaurant_name").val();
	var _type = $("#restaurant_type").val();
	var _url = $("#restaurant_url").val();
	var _opened_on = $("#opened_on").val();
	var _address = $("#address").val();
	var _manager = $("#manager").val();
	var _phone = $("#number").val();
	var _weekday_open = $("#weekday_open").val();
	var _weekday_close = $("#weekday_close").val();
	var _weekend_open = $("#weekend_open").val();
	var _weekend_close = $("#weekend_close").val();
	console.log(_weekend_open);

	$.post("./restaurantCreate.php", {name : _name, type : _type,
									  url : _url, open_date : _opened_on,
									  address : _address, manager : _manager,
									  phone : _phone, weekday_open : _weekday_open,
									  weekday_close : _weekday_close,
									  weekend_open : _weekend_open,
									  weekend_close : _weekend_close}, function(data){
		if(data.length>0) {
			$("#rating_results").html(data);
		}
	});
}

function add_menuItem(){
	var _name = $("#menu_item_name").val();
	var _type = $("#menu_item_type").val();
	var _category = $("#menu_item_category").val();
	var _description = $("#description").val();
	var _price = $("#price").val();
	var _id = $("#menuItemId").val();

	$.post("./menuItemCreate.php", {restaurant_id : _id, name : _name, type : _type, category : _category,
									description : _description, price: _price}, function(data){
		if(data.length>0) {
			$("#rating_results").html(data);
		}
	});
}
function deleteButton(button){
	console.log("here");
	var id = $(button).val();
	name = "#restaurantName"+id;
	name = $(name).val();
	$("#restaurantDelete").val(id);
	$("#myDeleteMenuModalLabel").html("<h2> Are You Sure You Want to Delete " + name +"</h2>");
}

function deleteButton(button){	
	var id = $(button).val();
	name = "#restaurantName"+id;
	name = $(name).val();
	$("#restaurantDelete").val(id);
	$("#myDeleteMenuModalLabel").html("<h2> Are You Sure You Want to Delete " + name +"</h2>");
}

function deleteMenuItemButton(button) {
	var id = $(button).val();
	console.log(id);
	name = "#menuItemDelete" +id;
	name = $(name).val();
	console.log(name);
	$("#menuItemDelete").val(id);
	$("#myDeleteMenuItemModalLabel").html("<h2> Are You Sure You Want to Delete Menu Item: " + name + "</h2>");
}

function delete_menu_item() {
	var id = $("#menuItemDelete").val();
	$.post('./deleteMenuItem.php', {itemId : id}, function(data) {
		if(data.length>0) {
			$("#rating_results").html(data);
		}
	});
	$("#search_results").hide();
	$("#restaurantInfo").hide();
}

function delete_restaurant() {
	var id = $("#restaurantDelete").val();
	$.post('./deleteRestaurant.php', {restaurantId : id}, function(data) {
		if(data.length>0) {
			$("#rating_results").html(data);
		}
	});
	$("#search_results").hide();
	$("#restaurantInfo").hide();
}

function  sendRestaurantId(button){
	var id = $(button).attr('id');
	$("#menuItemId").val(id);
}