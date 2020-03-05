<!DOCTYPE html>
<?php

// Always start this first
session_start();

if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    //$mysqli = setupConnection();
}
else {
    // Redirect them to the login page
    header("Location: login.php");
    $_SESSION['access_attempted'] = true;
    exit;
}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>Shopping</title>
</head>
<body>
	<div class="leftcol">
		<h1 align=center>HOMIES</h1>
		<a href="alarm.php" id="menulinks">Alarm</a><br>
	    <a href="shopping.php" id="menulinks">Finance and Shopping</a><br>
		<a href="trash.php" id="menulinks">Trash</a><br>
		<a href="complaints.php" id="menulinks">Complaints</a><br>
		<a href="members.php" id="menulinks">Members</a><br>
	</div>
	<div class="rightcol">
	    <?php
	        require_once('config.inc.php');
            $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
             // Check for errors before doing anything else
            if($mysqli -> connect_error) {
                die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
            }
            return $mysqli;
            
            #$Date = mysqli_real_escape_string($mysqli, $_POST['dateReported']);
            #mysqli_real_escape_string($_POST['shoppigID']), 
            $name = mysqli_real_escape_string($mysqli, $_POST['buyerName']);
            $itemBought = mysqli_real_escape_string($mysqli, $_POST['item']);
            $itemPrice = mysqli_real_escape_string($mysqli, $_POST['price']); 
            #mysqli_real_escape_string($_POST['houseID'])
            
            $sql = "INSERT INTO Shopping (shoppingID, buyerName, item, price, houseID) VALUES (1, $name, $itemBought, $itemPrice, 1)";
            
            #$insert = $mysqli->query[$sql];
            
            if(mysqli_query($mysqli, $sql)){
                    echo "Records added successfully.";
            } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
            }
        ?>
		<table>
			<h1 align="center" width=100%>Shopping List</h1>
			<tr>
			</tr>
			<tr>
				<td>
					<form action="" method="post">
					    <label>Name</label>
						<input type="text" name="buyerName">
						<label>Item</label>
						<input type="text" name="item">
						<label>Price</label>
						<input type="text" name="price">
						<input type="submit" value="Submit">
					</form>
				</td>
			</tr>
	  </table>
</body>
</html>
