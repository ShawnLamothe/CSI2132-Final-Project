$(document).ready(function(){
	$('.ratings_stars').hover(
		function() {
			$(this).prevAll().andSelf().addClass('ratings_over');
			$(this).nextAll().removeClass('ratings_vote');
		},
		function() {
			$(this).prevAll().andSelf().removeClass('ratings_over');
			set_votes($(this).parent());
		}
	);

	$('.ratings_stars').bind('click', function() {
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
	}
);}