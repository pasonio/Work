<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<form action="checklogin.php" method="POST">
						<div class="form-group">
							<label for="inputName">Name</label>
							<input type="name" name="username" class="form-control" id="inputName" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="inputPassword">Password</label>
							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
						</div>
						<input type="submit" value="Login"/>
						<a href="index.php">Go back</a>
					</form>
				</div>
			</div>
		</div>
		<?php 
			require( "connect.php");
			/*Creating table for outcoming emails*/
			$list_table = "CREATE TABLE list (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				receiver TEXT NOT NULL,
				subject TEXT NOT NULL,
				body TEXT NOT NULL,
				date_posted VARCHAR(30) NOT NULL
			)";

			$mysqli->query( $list_table ); ?>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>