$(document).ready(function(){
	$('.ratings_stars_select').hover(
		function() {
			$(this).prevAll().andSelf().addClass('ratings_over');
			$(this).nextAll().removeClass('ratings_vote');
		},
		function() {
			$(this).prevAll().andSelf().removeClass('ratings_over');
			set_votes($(this).parent());
		}
	);

	$('.ratings_stars_select').bind('click', function() {
		var star = this;
		var widget = $(this).parent();

		var clicked_on = $(star).attr('class');
		clicked_on = clicked_on.substring(0,6);
		$(widget).val(clicked_on);
		set_votes(widget);
	});
});

function set_votes(widget) {
	var clicked_on = $(widget).val();
	$(widget).find('.' +clicked_on).prevAll().andSelf().addClass('ratings_vote');
	$(widget).find('.' +clicked_on).nextAll().removeClass('ratings_vote');
}

function clearStars() {
	$('.rate_widget').each(function(i) {
		var widget = this;
		$(widget).val('star_1');
		set_votes(widget);
	});
	$("#myModalLabel").html("");
}

function rateButton(button) {
	var buttonID = $(button).val();
	var nameId = "#restaurantName" +buttonID;
	var data = $(nameId).val();
	data = "<h4 class='modal-title'> Rate: " + data + "</h4>";
	$("#myModalLabel").html(data);
	$("#restaurantId").val(buttonID);
}

function menuRateButton(button) {
	var buttonID = $(button).val();
	var menuItemId = "#menuItem"+buttonID;
	var data = $(menuItemId).val();
	data = "<h4 class='modal-title'> Rate: " + data + "</h4>";
	$("#myMenuModalLabel").html(data);
	$("#menuItemId").val(buttonID);
}

function submitRating() {
	var out_data = {};
	$('.rate_widget').each(function(i) {
		var widget = this;
		if($(widget).attr('id') != 'menu_food_rating') {
			out_data[$(widget).attr('id')] = $(widget).val();
		}
	});
	out_data['comment'] = $("textarea#comment").val();
	out_data['id'] = $("#restaurantId").val();
	$.post("./submitRating.php", out_data, function(data){
		$("#rating_results").html(data);
	});
}

function submitMenuRating() {
	var out_data = {};
	out_data['menu_food_rating'] = $("#menu_food_rating").val();
	out_data['menu_comment'] = $("textarea#menu_comment").val();
	out_data['id'] = $("#menuItemId").val();
	$.post("./submitMenuRating.php", out_data, function(data){
		$("#rating_results").html(data);
	});
}