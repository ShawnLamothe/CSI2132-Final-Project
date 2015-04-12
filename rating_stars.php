<?php 
	class ratingStar {
		public static function create_stars($numStars) {
			?>
			<div class="form-group rate_widget" value="star_1">
			<?php
			for($i = 0; $i<$numStars; $i++) {
				$star = $i + 1;
			?>
				<div class="star_$star ratings_stars ratings_vote"></div>
			<?php } 
			for($i=0; $i<5-$numStars;$i++) {
				$star = $numStars + $i +1;
			?>	
				<div class="star_$star ratings_stars"></div>
			<?php  }?>
			</div>
			<?php
		}

		public static function create_stars_return($numStars) {
			$retVal = "";
			$retVal .= "<div class='form-group rate_widget' value='star_1'>";
			for($i = 0; $i<$numStars; $i++) {
				$star = $i + 1;
				$retVal .="<div class='star_$star ratings_stars ratings_vote'></div>";
			} 
			for($i=0; $i<5-$numStars;$i++) {
				$star = $numStars + $i +1;	
				$retVal .="<div class='star_$star ratings_stars'></div>";
			}
			$retVal.="</div>";
			return $retVal;
		}
	}
 ?>