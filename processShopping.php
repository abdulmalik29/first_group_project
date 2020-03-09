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
    $b_name = $_SESSION['username'];
    $i_name =  mysqli_real_escape_string($mysqli, $_POST['item_name']);
    $i_price = mysqli_real_escape_string($mysqli, $_POST['item_price']);
    
    $sql1 = "SELECT MAX(shoppingID) FROM Shopping";
    
    $number_of_rows = "SELECT COUNT(*) FROM Shopping";
    if ($number_of_rows == 0){
        $next_ID = 0;
    } else {
        $next_ID = "SELECT MAX(shoppingID) FROM Shopping" + 1;
    }
    
    $sql = "INSERT INTO Shopping (shoppingID, buyerName, item, price, houseID) VALUES ('$next_ID', '$b_name', '$i_name', '$i_price', '$currentHouseID')";
        
    
    if($mysqli->query($sql)) {       
        echo "<script>
             alert('Records added successfully'); 
             window.history.go(-1);
     </script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }
?>