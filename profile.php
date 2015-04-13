<br><bt><br><br>
<div class="container">

	<h1>My Profile</h1>
<?php if(isset($_SESSION['currentUser'])) { ?>
	<div class="row col-sm-12">
	<button type='submit' class='btn btn-primary bth-info btn-lg '
					data-toggle='modal' data-target='#deleteAccountModal' name='rateButton'>Delete Account</button>
	</div>	
<?php } 
	else {?>
	<p>Please Login to View Profile Information</p>
<?php  }?>	
</div>

<div class="modal fade" id="deleteAccountModal" role="dialog" aria-labelledby="myMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
				<div id="myMenuModalLabel">
					<h2>Are You Sure You Would Like to Delete Your Account?</h2>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="account" value="<?php echo $_SESSION['currentUser'][0] ?>"/>
				<button class="btn btn-success" form="menuRatingForm" type="submit" value="Add" id="addMenuItem" data-dismiss="modal" onclick="delete_account()">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" type="javascript" src="<?php echo $ABSOLUTE_PATH?>/profile.js"></script>