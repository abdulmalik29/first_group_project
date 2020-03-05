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
		<a href="chat.php" id="menulinks">Chat</a><br>
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
            $sql = "INSERT INTO Shopping (shoppingID, buyerName, item, price, houseID) VALUES (mysqli_real_escape_string($_POST['shoppigID']), mysqli_real_escape_string($_POST['buyerName']), mysqli_real_escape_string($_POST['item']), mysqli_real_escape_string($_POST['price']), mysqli_real_escape_string($_POST['houseID']))";
            $insert = $mysqli->query[$sql];
        ?>
		<table>
			<h1 align="center" width=100%>Shopping List</h1>
			<tr>
			</tr>
			<tr>
				<td>
					<form action="" method="post">
						<input type="text" name="shoppingID">
						<input type="text" name="buyerName">
						<input type="text" name="item">
						<input type="text" name="price">
						<input type="text" name="houseID">
						<input type="submit" value="Submit">
					</form>
				</td>
			</tr>
	  </table>
</body>
</html>
