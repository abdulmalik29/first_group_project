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

$query = "SELECT username FROM Users WHERE username = $uname";
$query_run = my_sql_query($query);
if (mysql_num_rows($query_run)==1) 
{
    echo "Username in database.";
}

$mysqli -> close();
?>
