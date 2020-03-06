<?php
    session_start();

    if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
        // Grab user data from the database using the user_id
        // Let them access the "logged in only" pages
        require_once('config.inc.php');
        $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
    
        // Check for errors before doing anything else
        if($mysqli -> connect_error) {
    	die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
        }
    }
    else {
        // Redirect them to the login page
        header("Location: login.php");
        $_SESSION['access_attempted'] = true;
        exit;
    }

    
    $currentHouseID = $_SESSION['houseID'];
    $currentUsername = $_SESSION['username'];
    $Date = mysqli_real_escape_string($mysqli, $_POST['date']);
    $Location = mysqli_real_escape_string($mysqli, $_POST['location']);
    $Issue = mysqli_real_escape_string($mysqli, $_POST['complaint']);
    $sql1 = "SELECT MAX(complaintID) FROM Complaints";
    $ComplaintID = mysqli_query($mysqli, $sql1);
    $ComplaintID = $ComplaintID + 1;
    $sql = "INSERT INTO `Complaints` (`complaintID`, `username`, `complaint`, `Location`, `sorted`, 'dateReported') VALUES ('1121', 'testman', 'lol', 'lol', '0', '2020-03-13')";
    if($mysqli->query($sql)) {       
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }