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
    $o_name = mysqli_real_escape_string($mysqli, $_POST['owner_name']);
    
    $sql1 = "INSERT INTO Shopping (buyerName, item, price, houseID) VALUES ('$b_name', '$i_name', '$i_price', '$currentHouseID')";
    
    $newIDquery="SELECT MAX(shoppingID) FROM Shopping";
    $newID = $mysqli->query($newIDquery);
    $row = $newID->fetch_assoc();
    
    $sql2 = "INSERT INTO ShoppingSharedTo (shoppingID, username, houseID) VALUES ('$row', '$o_name', '$currentHouseID')";
    
    if($mysqli->query($sql1) && $mysqli->query($sql2)) {       
        echo "<script>
             alert('Records added successfully'); 
             window.history.go(-1);
     </script>";
    } else{
        echo "ERROR: Could not able to execute $sql1 or $sql2 " . mysqli_error($mysqli);
    }
?>