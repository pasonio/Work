<?php
session_start();
$servername = $_SESSION['server'];
$username = $_SESSION['usern'];
$password = $_SESSION['pass'];
$db = "test_db";

$mysqli = new mysqli( $servername, $username, $password, $db );

if ( $mysqli->connect_error ) {
	die( "Connection failed: " . $mysqli->connect_error );
}
?>