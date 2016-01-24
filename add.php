<?php
	require ( "connect.php" );
	session_start();
	if( $_SESSION['user'] ){
	} else {
		header( 'location:index.php' );
	}

	if ( $_SERVER['REQUEST_METHOD'] = "POST" ) {
		//Added an if to keep the page secured

		$receiver = $mysqli->real_escape_string( $_POST['receiver'] );
		$from = "phpmailertest253@gmail.com";
		$name = $_SESSION['user'];
		$subject = $mysqli->real_escape_string( $_POST['subject'] );
		$body = $mysqli->real_escape_string( $_POST['body'] );
		$date_posted = strftime( "%d.%m.%Y %R" );//date

		$result = $mysqli->query( "INSERT INTO list ( receiver, subject, body, date_posted  ) VALUES ( '$receiver', '$subject', '$body', '$date_posted' ) " );

		require_once( "phpmailer/class.phpmailer.php" );
		define("username", "phpmailertest253@gmail.com");//gmail username
		define("password", "Lkbyysq1992");//gmail password
		function smtpmailer( $to, $from, $from_name, $subject, $body ) {
			global $error;
			$mail = new PHPMailer();//create new object
			$mail->IsSMTP();//enable SMTP
			$mail->SMTPDebug = 0;//debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true;//authentication enabled 
			$mail->SMTPSecure = "ssl";//secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = username;
			$mail->Password = password;
			$mail->SetFrom($from, $from_name);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($to);
			if (!$mail->Send()) {
				$error = "Mail error: " .$mail->ErrorInfo;
				return false;
			} else {
				$error = "Message sent!";
				return true;
			}
		}
		smtpmailer( $receiver, $from, $name, $subject, $body );

		header( "location: home.php" );

	} else {
		header( 'location:home.php' );//redirect back to home
	}
	