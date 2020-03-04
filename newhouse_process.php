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
    $hname = ($_POST["housename"]);
    $names = ($_POST["fname"]);
    $uname = ($_POST["username"]);
    $psw = ($_POST["psw"]);
    $email = ($_POST["eml"]);
    $phone_number = ($_POST["pnumber"]);
    
    echo($hname);
    echo($names);
    echo($uname);
    echo($email);
    echo($phone_number);
    
    
    $password = password_hash($psw, PASSWORD_DEFAULT);
    echo($password);
    
    $sql1 = "INSERT INTO House (housename, masterusername) VALUES ('$hname', '$uname')";
    if($mysqli->query($sql1)){
        $sql2 = "INSERT INTO User (username, password, email, phonenumber, name, outside) VALUES ('$uname', '$password', '$email', '$phone_number', '$names', '0')";
        if($mysqli->query($sql2)){
            $_SESSION['username'] = $uname;
            $_SESSION['houseID'] = $row["houseID"];
            header("Location: alarm.php");
        }
        else{
            echo("error at the user level");
            //header("Location: alarm.php"); 
        }
    }
    else{
        echo("error at the house level");
        //header("Location: new_house.php"); 
        // must have failed to create house
    }
    

    $mysqli -> close();

?>
