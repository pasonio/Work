<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Body Message</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<a href='home.php'>Go back</a>
				<?php
				session_start();
					//connect to gmail mailbox
					$mail = '{imap.gmail.com:993/imap/ssl}INBOX';
					$name = $_SESSION['ename'];
					$pass = $_SESSION['epass'];

					/*try to connect*/
					$inbox = imap_open( $mail, $name, $pass ) or
						die( "Cannot connect to Gmail: " . imap_last_error());

					$emails = imap_search( $inbox, 'SINCE ' . date( 'd-M-Y', strtotime( "-1 day" ) ) );
					rsort( $emails );
					$header = imap_check( $inbox );
					$range = $header->Nmsgs;
					if( $emails ) {
						foreach ($emails as $email_number ) {
							$overview = imap_headerinfo( $inbox, $email_number );
							$message = imap_fetchbody( $inbox, $email_number, 2 );
							$structure = imap_fetchstructure( $inbox, $email_number );

							if ( isset( $structure->parts ) && is_array( $structure->parts) && isset( $structure->parts[1])) {
								$part  = $structure->parts[1];

								if ( $part->encoding == 3 ) {
									$message = imap_base64( $message );
								}
								else if ( $part->encoding == 1 ) {
									$message = imap_8bit( $message );
								}
								else {
									$message = imap_qprint( $message );
								}
							}
							$output = "<div class='message-text'>";
							$output .= "<span><strong>From: </strong>" . imap_utf8( $overview->fromaddress ) . "</span><br />";
							$output .= "<span><strong>Subject: </strong>" . imap_utf8( $overview->subject ) . "</span><br />";
							$output .= "<span><strong>Date: </strong>" . $overview->date . "</span><br />";
							$output .= "<span><strong>Message: </strong>" . $message . "</span><br />";
							$output .= "</div>";
						echo $output;
						}
					}
				?>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
