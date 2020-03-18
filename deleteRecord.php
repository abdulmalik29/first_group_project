<?php

    require_once 'shopping.php';

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
    
    $id = 4;
    
    if (isset($_POST['del_b'])) {
        deleteShoppingItem($mysqli, $id);
        header("Location: /shopping.php");
        die;
    } else if (isset($_POST['del_r'])) {
        deleteRequestItem($mysqli, $id);
        header("Location: /shopping.php");
        die;
    }
?>