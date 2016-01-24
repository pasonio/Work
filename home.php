<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Home page</title>
	</head>
	<?php
	session_start(); //starts the session
	if ( $_SESSION['user'] ) { //checks if user is logged in 
	} else {
		header( 'location: index.php' );//redirects if user is not logged in
	}
	//connect to gmail mailbox
	if( isset( $_POST['mailsub']) ) {
		$mail = '{imap.gmail.com:993/imap/ssl}INBOX';
		$name = $_POST['ename'];
		$pass = $_POST['epass'];
		$_SESSION['ename'] = $name;
		$_SESSION['epass'] = $pass;
	}
	?>
	<body>
		<div class="container">
			<a href="logout.php">Click here to logout</a>
			<div class="row">
				<div class="col-xs-12">
					<a class="btn btn-default" data-toggle="modal" data-target="#send-form">Create a message</a>
					<input form="delform" type="submit" name="delete" class="btn btn-default" value="Delete chosen messages"/>
				</div>
			</div>
			<div id="send-form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<h2>Sending form</h2>
					</div>
					<div class="modal-body">
						<form action="add.php" method="POST">
							<div class="form-group">
								<label for="receiver">Receiver</label>
								<input type="text" name="receiver" class="form-control" id ="receiver" />
							</div>
							<div class="form-group">
								<label for="subject">Letter subject</label>
								<input type="text" name="subject" class="form-control" id="subject" />
							</div>
							<div class="form-group">
								<label for="body">Letter body</label>
								<textarea type="text" name="body" class="form-control" id="body"></textarea>
							</div>
							<input type="submit" class="btn btn-default" value="Send" />
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="mailsub" class="col-xs-3">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<h5>Fill below fields to connect to your e-mail(expect Gmail account)</h5>
						<label for="ename">Username</label>
						<input name="ename" type="textarea"/><br />
						<label for="epass">Password</label>
						<input name="epass" type="password"/><br />
						<input type="submit" name="mailsub" class="btn btn-default"/>
					</form>
				</div>
				<div class="col-xs-3">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#">Mail</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="sectionA" class="tab-pane active">
							<a href="#inbox" class="inbox">Inbox</a>
							<a href="#outbox" class="outbox">Outbox</a>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<form id='delform' action='delete.php' method='GET'>
						<table id="outbox" class="table table-striped" style="display:none">
							<thead>
								<tr>
									<th>
										<input type="checkbox" name="toggle" id="toggle"/>
									</th>
									<th>To<span id="namesort" class="glyphicon glyphicon-triangle-bottom"></span></th>
									<th>Letter's subject</th>
									<th>Receiving date<span id="datesort" class="glyphicon glyphicon-triangle-bottom"></span></th>
								</tr>
							</thead>
								<tbody>
									<?php
										require ( "connect.php" );
										if ( $result = $mysqli->query( "SELECT id, receiver, subject, date_posted FROM list" ) ) {

											while ( $row = $result->fetch_array( MYSQLI_BOTH ) ) { ?>
												<tr>
													<td align='center'><input name="multiple[]" type="checkbox" value="<?php echo $row['id']; ?>"/></td>
													<td align='center'><?php echo $row['receiver']; ?></td>
													<td align='center'><?php echo $row['subject']; ?></td>
													<td align='center'><?php echo $row['date_posted']; ?></td>
												</tr>
											<?php }
										} ?>
								</tbody>
						</table>
						<table id="inbox" class="table table-striped">
							<thead>
								<tr>
									<th>Sender</th>
									<th>Letter's subject</th>
									<th>Receiving date</th>
								</tr>
							</thead>
							<tbody>
								<?php
								/*try to connect*/
								if( isset($_POST['mailsub'])) {
									$inbox = imap_open( $mail, $name, $pass ) or
									die( "Cannot connect to Gmail: " . imap_last_error());
								}
								/*grab emails*/
								$emails = imap_check( $inbox );

								$range = $emails->Nmsgs . ":" . ( $emails->Nmsgs - 2 );

								/*if emails are returned, cycle through each...*/
								if( $emails ) {

									/*for every email...*/
									foreach( $emails as $email_number ) {

										/* get information specific to this email*/
										$overview = imap_fetch_overview( $inbox, $range );

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
										/*begin output var*/
										$output = '<tr>';
											$output .= '<td>' . imap_utf8( $overview[2]->from ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[2]->subject ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[2]->date ) . '</td>';
										$output .= '</tr>';
										$output .= '<tr>';
											$output .= '<td>' . imap_utf8( $overview[1]->from ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[1]->subject ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[1]->date ) . '</td>';
										$output .= '</tr>';
										$output .= '<tr>';
											$output .= '<td>' . imap_utf8( $overview[0]->from ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[0]->subject ) . '</td>';
											$output .= '<td>' . imap_utf8( $overview[0]->date ) . '</td>';
										$output .= '</tr>';
									}
									echo $output;
								}

								/*close the connection*/
								imap_close($inbox); ?>
								<div class='del'>
									<label for="remove">Delete incoming messages</label>
									<input type="checkbox" name="remove"/><br />
								</div>
								<a class="message" href="body.php">See the body of messages</a> 
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var toggle = document.getElementById('toggle');

			toggle.onclick = function() {

				var multiple = document.getElementsByName( 'multiple[]' );
				
				for ( i = 0; i < multiple.length; i ++ ) {
					multiple[i].checked = this.checked;
				}
			}
		</script>
	</body>
</html>