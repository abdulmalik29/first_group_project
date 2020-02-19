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
    echo("user in database");
    session_start();
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['uname'] ) && isset( $_POST['psw'] ) ) {
            // Getting submitted user data from database
            $con = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
            $stmt = $con->prepare("SELECT * FROM User WHERE username = ?");
            $stmt->bind_param('s', $_POST['uname']);
            $stmt->execute();
            $result = $stmt->get_result();
        	$user = $result->fetch_object();
        		
        	// Verify user password and set $_SESSION
        	if ( password_verify( $_POST['psw'], $user->password ) ) {
        		$_SESSION['username'] = $user->ID;
        	}
        }
    }
}
$mysqli -> close();
?>
