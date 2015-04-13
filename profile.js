function delete_account() {
	$.post('./deleteAccount.php');
	$.get('/~shawnlamothe/CSI2132/CSI2132-Final-Project/logout/');
	$.get('/~shawnlamothe/CSI2132/CSI2132-Final-Project/');
}