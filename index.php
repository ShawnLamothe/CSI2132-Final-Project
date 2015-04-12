<!DOCTYPE html>
<html>
	<head>
		<title>Insert Clever Title</title>
		<link rel="stylesheet" type="text/css" href="/~shawnlamothe/CSI2132/CSI2132-Final-Project/ratingStyle.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<?php

			$RESTAURANT_TYPESß = array('Indian','Burger');
			require 'absolute_path.php';
			require 'altorouter.php';

			header("Content-Type: text/html");

			$router = new AltoRouter();
			$router->setBasePath($ABSOLUTE_PATH);
			/* Setup the URL routing. */

			//Main routes
			$router->map('GET', '/', 'home.php', 'home');
			$router->map('GET', '/home/', 'home.php', 'home-home');
			$router->map('GET', '/login/', 'login.php', 'login-form');
			$router->map('POST', '/login/', '', 'login-action');
			$router->map('GET', '/logout/', '', 'logout');
			$router->map('GET', '/register/', 'register.php', 'register-form');
			$router->map('POST', '/register/', 'login.php', 'register-action');
			$router->map('GET', '/restaurants/', 'restaurants.php', 'restaurants');
			$router->map('GET', '/raters/', 'raters.php', 'raters');
			$router->map('GET', '/profile/', 'profile.php', 'profile');
			$router->map('GET', '/funfacts/', 'funfacts.php', 'fun-facts');
			$router->map('POST', '/restaurants/restaurantFind.php', 'restaurantFind.php', 'restaurantFind');
			$router->map('POST', '/restaurants/filterRestaurants.php', 'filterRestaurants.php', 'filterRestaurants');
			$router->map('POST', '/restaurants/submitRating.php', 'submitRating.php', 'submitRating');
			$router->map('POST', '/restaurants/submitMenuRating.php', 'submitMenuRating.php', 'submitMenuRating');
			$router->map('POST', '/restaurants/', 'restaurants.php', 'viewRestaurant');
			$router->map('POST', '/menu-item/', 'restaurants.php', 'viewMenuItem');

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
				$match['target'] = $_SESSION['page'];
				$row_count = pg_num_rows($result);
				if($row_count > 0) {
					$row = pg_fetch_array($result);
					$_SESSION['currentUser'] = $row;
				}
				else {
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
			else if($match["name"] == 'logout') {
				$match['target'] = $_SESSION['page'];
				unset($_SESSION['currentUser']);
			}
		  ?>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Insert Clever Food Title</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<?php 
							if($match['target']=='home.php') {
								echo "<li class='active'> <a>Home</a></li>";
							}
							else {
								echo "<li><a href='$ABSOLUTE_PATH/home/'>Home</a></li>";
							}
							if($match['target']=='restaurants.php') {
								echo "<li class='active'><a>Find a Restaurant</a></li>";
							} else {
								echo "<li><a href ='$ABSOLUTE_PATH/restaurants/'>Find a Restaurant</a></li>";
							}
							if($match['target']=='raters.php') {
								echo "<li class='active'><a>Find a Rater</a></li>";
							} else {
								echo "<li><a href ='$ABSOLUTE_PATH/raters/'>Find a Rater</a></li>";
							}
							if($match['target']=='funfacts.php') {
								echo "<li class='active'><a>Fun Facts</a></li>";
							} else {
								echo "<li><a href ='$ABSOLUTE_PATH/funfacts/'>Fun Facts</a></li>";
							}
							if($match['target']=='profile.php') {
								echo "<li class='active'><a>My Profile</a></li>";
							} else {
								echo "<li><a href ='$ABSOLUTE_PATH/profile/'>My Profile</a></li>";
							}
						 ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php 
							if(!isset($_SESSION['currentUser'])) {
								if($match['target'] != 'register.php') {
									echo "<li><a href='$ABSOLUTE_PATH/register/'>
										<span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
								}
								echo "<li>
										<form method='POST' action='$ABSOLUTE_PATH/login/' class='form-inline' role='form' id='loginForm'>
											<div class='form-group'>
												<label for='userId'>User ID:</label>
												<input type='text' class='form-control input-sm' id='userId' name='userId' placeholder='Enter User ID'/>
											</div>
											<div class='form-group'>
												<label for='password'>Password:</label>
												<input type='password' class='form-control input-sm' id='password' name='password' placeholder='Enter Password'/>
											</div>
											<button type='submit' form = 'loginForm' class='btn btn-default btn-xs' value='login' name='login'>Login</button>
										</form>
									</li>";
							}
							else{
								$name = $_SESSION['currentUser'][3];
								echo "<li><a>$name</a></li>";
								echo "<li>
										<a href='$ABSOLUTE_PATH/logout/''>
											<span class='glyphicon glyphicon-log-out'></span>
											Log Out
										</a>
									  </li>";
							}
						 ?>
					</ul>
				</div>
			</div>
		</nav>
		<?php 
			$_SESSION['page'] = $match['target'];
			require $match['target'];
	 	?>
	</body>
</html>