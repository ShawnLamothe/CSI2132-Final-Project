<!DOCTYPE html>
<html>
	<head>
		<?php
			header("Content-Type: text/html");
			include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';

			$router = new AltoRouter();
			$router->setBasePath('/~shawnlamothe/CSI2132/Final_Project');
			/* Setup the URL routing. */

			//Main routes
			$router->map('GET', '/', 'home.php', 'home');
			$router->map('GET', '/home/', 'home.php', 'home-home');
			$router->map('GET', '/login/', 'login.php', 'login');

			/*Match the current request */
			$match = $router->match();
			if(!$match) {
				header("HTTP/1.0 404 Not Found");
				require '404.html';
				exit;
			}
			session_start();
			if(array_key_exists('login', $_POST)) {
				$userId=$_POST['userId'];
				$passs
			}
			if(!isset($_SESSION['studentnum'])) {
				if($match['target'] != 'login.php') {
					echo "Please " . "<a href=/~shawnlamothe/CSI2132/Final_Project/login/>Login</a>";
				}
			}
			$connection_string = "host=web0.site.uottawa.ca port=15432 dbname=slamo025 user=slamo025 password=TcSlKw6221";
			$databaseConnection = pg_connect($connection_string) or die('Could not connect: ' . pg_last_error());
		  ?>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title>Insert Clever Title</title>
	</head>

	<body>

		<div>
			<?php 
				// Performing SQL query
				/*
				$query = 'SELECT * FROM public.artist';
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());

				// Printing results in HTML

				echo "<table>\n";
				while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
					echo "\t<tr>\n";
					foreach ($line as $col_value) {
						echo "\t\t<td>$col_value</td>\n";
					}
					echo "\t</tr>\n";
				}
				echo "</table>\n";

				// Free resultset
				pg_free_result($result);
				// Closing connection
				pg_close($databaseConnection);
				*/
			 ?>
		</div>
		<?php 
			require $match['target'];
	 	?>
	</body>
</html>