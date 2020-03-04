<?php

// Always need to start this first
session_start();

if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    // Grab user data from the database using the username
    // Let them access the "logged in only" pages
    
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
        die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }
    
    // Then check based on what button was pressed
    if (isset($_POST['go-outside'])) {
		$sql = "UPDATE User SET outside = 1 WHERE username = '".$_SESSION['username'] . "'";
		$result = $mysqli->query($sql);
	}
	else if (isset($_POST['go-inside'])) {
		$sql = "UPDATE User SET outside = 0 WHERE username = '".$_SESSION['username'] . "'";
		$result = $mysqli->query($sql);
	}
	
	// Whether we set the status or not, go back to the alarm.
	header("Location: alarm.php");
    $mysqli -> close();
	exit;
}
else {
    // Redirect them to the login page
    header("Location: login.php");
    $_SESSION['access_attempted'] = true;
    exit;
}
?>
