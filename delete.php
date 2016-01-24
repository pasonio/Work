<?php
	require ( "connect.php" );
	session_start();//starts the session
	if ( $_SESSION['user'] ) {
	} else {
		header( 'location:index.php' );
	}
	//connect to gmail mailbox
	$mail = '{imap.gmail.com:993/imap/ssl}INBOX';
	$name = 'phpmailertest253@gmail.com';
	$pass = 'Lkbyysq1992';
	/*try to connect*/
	$inbox = imap_open( $mail, $name, $pass ) or
	die( "Cannot connect to Gmail: " . imap_last_error());


	if ( isset( $_GET['delete'] ) ) {

		$id = $_GET['multiple'];
		$countcheck = count( $_GET['multiple'] );

		for ( $i=0; $i<$countcheck; $i++ ) {
			$del_id = $id[$i];
			$sql = "DELETE FROM list WHERE id=" . $del_id . "";
			$result = $mysqli->query($sql) or die( mysqli_error( $mysqli ) );
		}
		/*Delete messages in inbox*/
		if( isset( $_GET['remove'] ) ) {
			if ( $inbox ) {

				$emails = imap_search( $inbox, "ALL" );
				if( $emails ) {
					$i = 1;
					foreach ($emails as $email_number ) {
						imap_delete( $inbox, $email_number );

						$i++;
						if ( $i > 20 ) {
							break;
						}
					}
					$done = imap_expunge( $inbox );
				}
			}
		}
		header( "location:home.php");
	}
?>