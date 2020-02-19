<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

// Check for errors before doing anything else
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}
else{
    session_start();
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
            // Getting submitted user data from database
            $con = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
            $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $result = $stmt->get_result();
        	$user = $result->fetch_object();
        		
        	// Verify user password and set $_SESSION
        	if ( password_verify( $_POST['password'], $user->password ) ) {
        		$_SESSION['user_id'] = $user->ID;
        	}
        }
    }
}
$mysqli -> close();
?>
