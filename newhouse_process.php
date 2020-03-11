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
    
    $password = password_hash($psw, PASSWORD_DEFAULT);
    
    //$sql1 = "INSERT INTO House (housename, masterusername) VALUES ('$hname', '$uname')";
    $stmt = $mysqli->prepare("INSERT INTO House (housename, masterusername) VALUES (?, ?)");
    $stmt->bind_param('ss', $hname, $uname);
    
    //$result = $mysqli->query($sql1);
    $result = $stmt->execute();
    if($result){
        $sql = "SELECT houseID, housename FROM House";
        $result = $mysqli->query($sql);
        if($result){
            while($row = $result->fetch_assoc()) {
                if($row["housename"] == $hname){
                    $hid = $row["houseID"];
                    }
                }
            }
        //$sql2 = "INSERT INTO User (username, password, email, phonenumber, name, houseID, outside) VALUES ('$uname', '$password', '$email', '$phone_number', '$names', '$hid', '0')";
        $stmt = $mysqli->prepare("INSERT INTO User (username, password, email, phonenumber, name, houseID, outside) VALUES (?, ?, ?, ?, ?, ?, '0')");
        $stmt->bind_param('ssssss', $uname, $password, $email, $phone_number, $names, $hid);
        
        //if($mysqli->query($sql2)){
        if($stmt->execute()){
            $_SESSION['username'] = $uname;
            $_SESSION['houseID'] = $hid;
            header("Location: alarm.php");
        }
        else{
            echo($mysqli->error);
            //header("Location: new_house.php"); 
        }
    }
    else{
        echo($mysqli->error);
        //header("Location: new_house.php"); 
        // must have failed to create house
    }
    

    $mysqli -> close();

?>
