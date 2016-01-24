<html>
	<head>
		<meta charset="utf-8">
		<title>Test</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<a href="login.php">Login</a>
				</div>
				<div class="col-xs-6">
					<a id="register" href="register.php">Register</a>
				</div>
			</div>
			<div class="row">
				<div id="database" class="col-xs-12">
					<form id="maildata" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<h5>Fill below fields to connect to your database(phpmyadmin)</h5>
						<label for="servername">Server name</label><br />
						<input type="textarea" name="servername"/><br/>
						<label for="user">Username</label><br />
						<input type="textarea" name="user"/><br/>
						<label for="pass">Password</label><br />
						<input type="password" name="pass"/><br/>
						<input id="mail-submit" type="submit" name="dbase" class="btn btn-default"/>
					</form>
				</div>
			</div>
		</div>
		<?php
		session_start();
			/*Creating global variables for database*/
			if(isset( $_POST['dbase'])) {
				$server = $_POST['servername'];
				$user = $_POST['user'];
				$pass = $_POST['pass'];

				$_SESSION['server'] = $server;
				$_SESSION['usern'] = $user;
				$_SESSION['pass'] = $pass;

				$mysqli = new mysqli( $server, $user, $pass );

				if ( $mysqli->connect_error ) {
					die( "Connection failed: " . $mysqli->connect_error );
				}

				$database = "CREATE DATABASE test_db";
				$mysqli->query( $database );

				$mysqli->close();
			}
		?>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>