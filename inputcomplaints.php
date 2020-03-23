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
    $sql= "SELECT ownerEmail FROM House WHERE houseID = "  . $currentHouseID;
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if(is_null($row["ownerEmail"])) {
        echo "<script>
                 alert('Landlord Email must be added to send complaints'); 
                 window.history.go(-1);
         </script>";
    } else {
        $Date = mysqli_real_escape_string($mysqli, $_POST['date']);
        $Location = mysqli_real_escape_string($mysqli, $_POST['location']);
        $Issue = mysqli_real_escape_string($mysqli, $_POST['complaint']);
        $sql = "INSERT INTO Complaints (username, complaint, Location, sorted, dateReported, houseID) VALUES ('$currentUsername', '$Issue', '$Location', '0', '$Date', '$currentHouseID')";
        if($mysqli->query($sql)) {       
            echo "<script>
                 alert('Records added successfully'); 
                 window.history.go(-1);
         </script>";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
        
    }