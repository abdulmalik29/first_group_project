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

$sql = "SELECT username, password FROM User";
$result = $mysqli->query($sql);
if($result){
    while($row = $result->fetch_assoc()) {
        //echo("username: " . $row["username"] . "<br>");
        if($row["username"] == $uname){
            if($row["password"] == $psw){
                header("location = https://web.cs.manchester.ac.uk/s99954fh/first_group_project/members.php");
            }
        }
    }
}
else{
    echo("error");
}


$mysqli -> close();
?>
