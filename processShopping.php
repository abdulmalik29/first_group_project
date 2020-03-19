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
    $u_name = $_SESSION['username'];
    
    if (isset($_POST['submit_btn_b'])) {
        //get next index and values from input
        $i_name =  mysqli_real_escape_string($mysqli, $_POST['item_name_b']);
        $o_name = mysqli_real_escape_string($mysqli, $_POST['owner_name_b']);
        $i_price = mysqli_real_escape_string($mysqli, $_POST['item_price_b']);
        
        //put records into database
        $sql1 = "INSERT INTO Shopping (buyerName, item, price, houseID) VALUES ('$u_name', '$i_name', '$i_price', '$currentHouseID')";
        $sql2 = "INSERT INTO ShoppingSharedTo (username, houseID) VALUES ('$o_name', '$currentHouseID')";   
    } else if (isset($_POST['submit_btn_r'])){
        $i_name =  mysqli_real_escape_string($mysqli, $_POST['item_name_r']);
        $r_name = mysqli_real_escape_string($mysqli, $_POST['requester']);
        
        //put records into database
        $sql1 = "INSERT INTO Request (requesterName, item, houseID) VALUES ('$u_name', '$i_name', '$currentHouseID')";
        $sql2 = "INSERT INTO RequestSharedTo (username, houseID) VALUES ('$r_name', '$currentHouseID')";
    }
    
    if($mysqli->query($sql1) && $mysqli->query($sql2)) {       
        echo "<script>
             alert('Records added successfully'); 
             window.history.go(-1);
     </script>";
    } else{
        echo "ERROR: Could not able to execute $sql1 or $sql2 " . mysqli_error($mysqli);
    }
?>