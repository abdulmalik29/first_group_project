<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

// Check for errors before doing anything else
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$uname = ($_POST["uname"]);
$psw = ($_POST["psw"]);

$sql = "SELECT * FROM Users";
$result = $mysqli->query($sql);

echo($result);

$mysqli -> close();
?>
