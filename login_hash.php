<?php
session_start();

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
    
    $password =  password_hash($psw, PASSWORD_DEFAULT);

    echo($password);
    
?>
