<!DOCTYPE html>
<?php

// Always start this first
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


function displayForm($mysqli) {
        echo    '<form action="processShopping.php" method="post">
			        <label>Item</label>
					<input type="text" name="item_name" required><br>
					<label>Price</label>
					<input type="text" name="item_price" pattern="\d*" required><br>
					<label>For</label>
					<input type="text" name="owner_name" required><br>
					<input type="submit" value="Submit" name="submit_btn">
				</form>';
    }
function displayItems(){
        $query = "SELECT buyerName, item, price FROM Shopping";
        $response = @mysql_query($mysqli, $query);
        if ($response){
            echo '<table align="left" cellspacing="5" cellpadding="8">
            <tr>
            <td align="left">Buyer name</td>
            <td align="left">Item</td>
            <td align="left">Price</td>
            </tr>';

            while($row = mysqli_fetch_array($response)){
                echo '<tr><td align="left">' .
                $row['buyerName'] . '</td><td align="left">' .
                $row['item'] . '</td><td align="left">' .
                $row['price'] . '</td><td align="left"></tr>';
            }
            echo '</table>';
        } else {
            echo "Couldn't issue database query";
            echo mysqli_error($mysqli);
        }
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
		<a href="alarm.php" id="menulinks">In/Out</a><br>
	    <a href="shopping.php" id="menulinks">Finance and Shopping</a><br>
		<a href="trash.php" id="menulinks">Trash</a><br>
		<a href="complaints.php" id="menulinks">Complaints</a><br>
		<a href="members.php" id="menulinks">Members</a><br>
		<a href="logout.php" id='logout'>Logout</a><br>
	</div>
	<div class="rightcol">
		<table>
			<h1 align="center" width=100%>Shopping List</h1>
			<tr>
			    <?php
			        //displayItems();
			    ?>
			</tr>
			<tr>
				<td>
				<?php
				    displayForm($mysqli);
				?>
				</td>
			</tr>
	  </table>
	  <p>CHANGED AGAIN</p>
</body>
</html>
