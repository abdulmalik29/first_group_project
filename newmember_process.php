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
    $hid = ($_POST["houseid"]);
    $hname = ($_POST["housename"]);
    $fullname = ($_POST["fullname"]);
    $uname = ($_POST["username"]);
    $psw = ($_POST["psw"]);
    $email = ($_POST["eml"]);
    $phone_number = ($_POST["pnumber"]);
    
    $password = password_hash($psw, PASSWORD_DEFAULT);

    $sql1 = "SELECT houseID, housename FROM House";
    $result = $mysqli->query($sql1);
    if($mysqli->query($sql1)){
        while($row = $result->fetch_assoc()) {
            if($row["houseID"] == $hid){
                if($row["housename"] == $hname){
                    $sql2 = "INSERT INTO User (username, password, email, phonenumber, name, houseID, outside) VALUES ('$uname', '$password', '$email', '$phone_number', '$fullname', '$hid', '0')";
                    if($mysqli->query($sql2)){
                        $_SESSION['username'] = $uname;
                        $_SESSION['houseID'] = $row["houseID"];
                        header("Location: alarm.php");
                        }
                    else{
                        echo($mysqli->error);
                        header("Location: new_member.php"); 
                    }
                }
            }
        }
    }
    else{
        echo($mysqli->error);
        header("Location: new_member.php"); 
    }
    
    $mysqli -> close();

?>