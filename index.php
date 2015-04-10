<!DOCTYPE html>
<html>
	<head>
		<?php
			//set up routes 
			header("Content-Type: text/html");
			include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';

			$router = new AltoRouter();
			$router->setBasePath('/~shawnlamothe/CSI2132/CSI2132-Final-Project');
			/* Setup the URL routing. */

			//Main routes
			$router->map('GET', '/', 'home.php', 'home');
			$router->map('GET', '/home/', 'home.php', 'home-home');
			$router->map('GET', '/login/', 'login.php', 'login-form');
			$router->map('POST', '/login/', 'home.php', 'login-action');
			$router->map('GET', '/register/', 'register.php', 'register-form');
			$router->map('POST', '/register/', 'login.php', 'register-action');
			$router->map('GET', '/restaurants/', 'restaurants.php', 'restaurants');
			$router->map('GET', '/raters/', 'raters.php', 'raters');
			$router->map('GET', '/profile/', 'profile.php', 'profile');
			$router->map('GET', '/funfacts/', 'funfacts.php', 'fun-facts');


			/*Match the current request */
			$match = $router->match();
			if(!$match) {
				header("HTTP/1.0 404 Not Found");
				require '404.html';
				exit;
			}
			//-------------------------------------------------------------------------

			$connection_string = "host=web0.site.uottawa.ca port=15432 dbname=slamo025 user=slamo025 password=TcSlKw6221";
			$databaseConnection = pg_connect($connection_string) or die('Could not connect: ' . pg_last_error());


			session_start();

			//check for user attempting to login
			if(array_key_exists('login', $_POST)) {
				$userId=$_POST['userId'];
				$password=$_POST['password'];

				$query="SELECT * FROM Final_Project.Rater R WHERE R.userId = $1 AND R.password = $2";
				$statement = pg_prepare($databaseConnection, "login", $query);
				$result = pg_execute($databaseConnection, "login", array($userId, $password));

				if(!$result) {
					die("Error in SQL query:" .pg_last_error());
					exit;
				}
				$row_count = pg_num_rows($result);
				if($row_count > 0) {
					$row = pg_fetch_array($result);
					$_SESSION['currentUser'] = $row;
				}
				else {
					$match['target'] = 'login.php';
					echo "Invalid Username or Passowrd";
				}
			}

			//handle user-registration
			if($match["name"] == 'register-action') {
				if($_POST['password'] != $_POST['repeatPassword']) {
					$match['target'] = 'register.php';
					echo "Passwords Do Not Match";
				}
				else {
					$query="SELECT * FROM Final_Project.Rater R WHERE R.userId = $1";
					$statement = pg_prepare($databaseConnection, "ps", $query);
					$result = pg_execute($databaseConnection, "ps", array($_POST['userId']));
					if(pg_num_rows($result) > 0) {
						$match['target'] = 'register.php';
						echo "Username Already Exists";
					}
					else {
						$userId = $_POST['userId'];
						$password = $_POST['password'];
						$email = $_POST['email'];
						$name = $_POST['name'];
						$join_date = date('Y-m-d');
						$type = $_POST['type'];
						$createQuery="INSERT INTO final_project.rater(userId, password, email, name,
							 join_date, type) VALUES ('$userId', '$password', '$email', '$name',
							 '$join_date', '$type')";
						$createStatement = pg_prepare($databaseConnection, "accountCreate", $createQuery);
						$result = pg_execute($databaseConnection, "accountCreate", array());
						if(!$result) {
							echo "Error Creating Account";
							$match['target'] = 'register.php';
						}	 
						else {
							echo "Account Creation Succesful, Please Login";
						}
					}
				}
			}

			//check to see if user is currently not logged in to set login link
			if(!isset($_SESSION['currentUser'])) {
				if($match['target'] != 'login.php' && $match['target'] != 'register.php') {
					echo "Please " . "<a href=/~shawnlamothe/CSI2132/CSI2132-Final-Project/login/>Login</a>";
				}
			}
		  ?>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title>Insert Clever Title</title>
	</head>

	<body>
		<p>
			<a href="/~shawnlamothe/CSI2132/CSI2132-Final-Project/restaurants/">Search For A Restautant</a>
			<a href="/~shawnlamothe/CSI2132/CSI2132-Final-Project/raters/">Find a Rater</a>
			<a href="/~shawnlamothe/CSI2132/CSI2132-Final-Project/profile/">Profile</a>
			<a href="/~shawnlamothe/CSI2132/CSI2132-Final-Project/funfacts/">Fun Facts</a>
		</p>
		<?php 
			require $match['target'];
	 	?>
	</body>
</html>