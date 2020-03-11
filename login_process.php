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
    
    $sql = "SELECT username, password, houseID FROM User";
    $result = $mysqli->query($sql);
    if($result){
        while($row = $result->fetch_assoc()) {
            // echo("username: " . $row["username"] . "<br>");
            if($row["username"] == $uname){
                if(password_verify($psw, $row["password"])){
                    $_SESSION['username'] = $uname;
                    $_SESSION['houseID'] = $row["houseID"];
                    // End here and redirect to alarm page
                    $mysqli -> close();
                    header("Location: alarm.php");
                    exit;
                }
            }
        }
        
    }

    $mysqli -> close();
    // Must have failed to find correct user
    header("Location: login.php");


?>
