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
function displayBoughtForm($mysqli){
    echo
    '   <label>Item</label>
	    <input type="text" name="item_name" required><br>
		<label>Price</label>
		<input type="text" name="item_price" pattern="\d*.\d*" required><br>
		<label>For</label>
		<input type="text" name="owner_name" required><br>
		<input type="submit" value="Submit" name="submit_btn">
	</form>
	';
				
}
function displayRequestForm($mysqli){
    echo
    '   <label>Item</label>
	    <input type="text" name="item_name" required><br>
		<label>From</label>
		<input type="text" name="item_price" pattern="\d*.\d*" required><br>
	</form>
	';
}

function displayItems($mysqli){
        $currentHouseID = $_SESSION['houseID'];
        $b_name = $_SESSION['username'];
        
        $items1="SELECT buyerName, item, price FROM Shopping WHERE houseID = " . $currentHouseID . " AND buyerName = " . $b_name;
        $itemRecords1 = $mysqli->query($items1);
        
        $items2="SELECT buyerName, item, price FROM Shopping WHERE houseID = " . $currentHouseID . " AND shoppingID = (SELECT shoppingID FROM ShoppingSharedTo WHERE username = " . $b_name . ")";
        $itemRecords2 = $mysqli->query($items2);
        
        $items3="SELECT item FROM Request WHERE houseID = " . $currentHouseID;
        $itemRecords3 = $mysqli->query($items3);
        
        echo 'You bought:<br><table align="left" cellspacing="5" cellpadding="8">
            <tr>
            <td align="left">Buyer name</td>
            <td align="left">Item</td>
            <td align="left">Price</td>
            </tr>';
        
        while($row = $itemRecords1->fetch_assoc())
        {
            echo '<tr><td align="left">' .
                $row['buyerName'] . '</td><td align="left">' .
                $row['item'] . '</td><td align="left">' .
                $row['price'] . '</td>';
        }
        echo '</table>';
        
        echo 'Bought for you:<br>
            <table align="left" cellspacing="5" cellpadding="8">
            <tr>
            <td align="left">Buyer name</td>
            <td align="left">Item</td>
            <td align="left">Price</td>
            </tr>';
        
        while($row = $itemRecords2->fetch_assoc())
        {
            echo '<tr><td align="left">' .
                $row['buyerName'] . '</td><td align="left">' .
                $row['item'] . '</td><td align="left">' .
                $row['price'] . '</td>';
        }
        echo '</table>';
        
        echo 'Requested:<br>
            <table align="left" cellspacing="5" cellpadding="8">
            <tr>
            <td align="left">Buyer name</td>
            <td align="left">Item</td>
            <td align="left">Price</td>
            </tr>';
        
        while($row = $itemRecords3->fetch_assoc())
        {
            echo '<tr><td align="left">' . $row['item'] . '</td>';
        }
        echo '</table>';
    }

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>Finance</title>
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
			<h1 align="center" width=100%>Finance and Shopping</h1>
			<tr>
			    <?php
			        displayItems($mysqli);
			    ?>
			</tr>
			<tr>
				<td>
				<script>
                    function typeFunction() {
                        var type = document.getElementById("typeSelect").value;
                        if(type == "Request"){
                            <?php
                                displayRequestForm($mysqli);
                            ?>
                        }else{
                            <?php
                                displayBoughtForm($mysqli);
                            ?>
                        }
                    }
                </script>
				<form action="processShopping.php" method="post">
			        <label>Type</label>
			        <select id="typeSelect" name="shopping_type" onchange="typeFunction()">
			            <option value="Bought">Bought</option>
                        <option value="Request">Request</option>
                    </select><br>
			    <?php
                    displayBoughtForm($mysqli);
                ?>
				</td>
			</tr>
	  </table>
</body>
</html>
