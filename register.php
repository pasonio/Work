<html>
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<form action="register.php" method="POST">
						<div class="form-group">
							<label for="inputName">Name</label>
							<input type="text" name="username" class="form-control" id="inputName" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="inputEmail">Email</label>
							<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="inputPassword">Password</label>
							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
						</div>
						<input type="submit" value="Register"/>
						<a href="index.php">Go back</a>
					</form>
				</div>
			</div>
		</div>
		<?php
		require ("connect.php" );
		/*Creating MySQL table for users*/ 
		$user_table = "CREATE TABLE users (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			password VARCHAR(30) NOT NULL,
			email VARCHAR(30) NOT NULL
		)";

		$mysqli->query( $user_table );
		/*Setting validation for register fields*/
		if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

			if( $_POST ) {
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$bool = true;

				if ( $result = $mysqli->prepare( 'SELECT username, email, password FROM users LIMIT 30') ) {
					
					$result->bind_param( 'sss', $name, $mail, $pass );

					$result->execute();

					$result->bind_result( $name, $mail, $pass );

					while ( $row = $result->fetch() ) {
						$table_users = $name; //the first username row is passed on to $table_users, and so on until the query is finished
						$table_emails = $mail;
						if ( $username == $table_users ) // checks if there are any matching fields
						{
							$bool = false; //sets bool to false
							Print '<script>alert( "Username has been taken!" );</script>'; //Prompts the user
							Print '<script>window.location.assign( "register.php" );</script>'; //redirects to register.php
						}
					}
				}
				if ( $bool ) // checks if bool is true
				{
					$mysqli->query( "INSERT INTO users ( username, email, password ) VALUES ( '$username', '$email', '$password' )"); //Inserts the value to table users
					Print '<script>alert( "Successfully Registered!" );</script>'; //Prompts the user
					Print '<script>window.location.assign( "login.php" );</script>'; //redirects to register.php
				}
			}
		}
		?>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>