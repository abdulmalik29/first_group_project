<!DOCTYPE html>
<?php

// Always start this first
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
    '<form action="processShopping.php" method="POST">
    <label>Item</label>
	    <input type="text" name="item_name_b" required><br>
		<label>Price</label>
		<input type="number" step="0.01" name="item_price_b" required><br>
		<label>For</label>
		<input type="text" name="owner_name_b" required><br>
		<input type="submit" value="Bought" name="submit_btn_b">
	</form>
	';
				
}
function displayRequestForm($mysqli){
    echo
    '<form action="processShopping.php" method="POST">   
    <label>Item</label>
	    <input type="text" name="item_name_r" required width="200px"><br>
		<label>From</label>
		<input type="text" name="requester" required><br>
		<input type="submit" value="Request" name="submit_btn_r">
	</form>
	';
}

function displayItems($mysqli){
        $currentHouseID = $_SESSION['houseID'];
        $b_name = $_SESSION['username'];
        
        //$items1="SELECT shoppingID, buyerName, item, price FROM Shopping WHERE houseID = " . $currentHouseID . " AND buyerName = " . $b_name;
        $stmt1 = $mysqli->prepare("SELECT shoppingID, buyerName, item, price FROM Shopping WHERE houseID = ? AND buyerName = ?");
        $stmt1->bind_param("ss", $currentHouseID, $b_name);

        //$itemRecords1 = $mysqli->query($items1);
        $itemRecords1 = $stmt1->execute();
        $itemRecords1 = $stmt1->store_result();

        
        $items2="SELECT buyerName, item, price FROM Shopping WHERE houseID = " . $currentHouseID . " AND shoppingID IN (SELECT shoppingID FROM ShoppingSharedTo WHERE username = '" . $b_name . "')";
        $stmt2 = $mysqli->prepare("SELECT buyerName, item, price FROM Shopping WHERE houseID = ? AND shoppingID IN (SELECT shoppingID FROM ShoppingSharedTo WHERE username = ?)");
        $stmt2->bind_param("ss", $currentHouseID, $b_name);
        $itemRecords2 = $stmt2->execute();
        $itemRecords2 = $stmt2->store_result();
        // $itemRecords2 = $mysqli->query($items2);
        
        $items3="SELECT requestID, requesterName, item FROM Request WHERE houseID = " . $currentHouseID . " AND requestID IN (SELECT requestID FROM RequestSharedTo WHERE username = '" . $b_name . "')";
        $stmt3 = $mysqli->prepare("SELECT requestID, requesterName, item FROM Request WHERE houseID = ? AND requestID IN (SELECT requestID FROM RequestSharedTo WHERE username = ?)");
        $stmt3->bind_param("ss", $currentHouseID, $b_name);
        $itemRecords3 = $stmt3->execute();
        $itemRecords3 = $stmt3->store_result();

        //$itemRecords3 = $mysqli->query($items3);
        
        echo '<div style="float: left; width: 50%">
            <div style="height: 175px; width: 100%; overflow: auto;">
            <table width="100%" align="left" cellspacing="5" cellpadding="8">
            <tr width="100%"><th colspan="3" align="center" width="100%">You Bought</th></tr><tr>
            <td align="left">Item</td>
            <td align="left">Price</td>
            <td align="left">Del</td>
            </tr>';
            
        if (is_null($itemRecords1)) {
            echo '</table></div><br>';
        }
        else {
            echo $itemRecords1;
            while($row = $itemRecords1->fetch_assoc())
            {
                echo '<tr width="100%"><td align="left">' .
                    $row['item'] . '</td><td align="left">' .
                    $row['price'] . '</td>
                    <td align="left"><form action="shopping.php?operation=delete&shoppingID=' . $row['shoppingID']. '" method="POST"><input type="submit" style="background-color: #f44336; font-size: 10px;" value="X" name="del_b"></form></td>
                    </tr>';
            }
            echo '</table></div><br>';
        }
        
        echo '<div style="height: 175px; width: 100%; overflow: auto;"><table width="100%" align="left" cellspacing="5" cellpadding="8">
            <tr width="100%"><th colspan="4" align="center" width="100%">Your Debts</th></tr><tr>
            <td align="left">Buyer</td>
            <td align="left">Item</td>
            <td align="left">Price</td>
            </tr>';
        
        if (is_null($itemRecords2)) {
            echo '</table></div><br>';
        }
        else {
            while($row = $itemRecords2->fetch_assoc())
            {
                echo 
                '<tr width="100%"><td align="left">' . $row['buyerName'] . 
                    '</td><td align="left">' . $row['item'] . 
                    '</td><td align="left">' . $row['price'] .
                    '</td></tr>';
            }
            echo '</table></div><br>';
            }
        echo '<div style="height: 175px; width: 100%; overflow: auto;">
            <table align="left" cellspacing="5" cellpadding="8" width="100%">
            <tr width="100%"><th colspan="3" align="center">Requested Items</th></tr>
            <tr width="100%"><td align="left">Item</td><td align="left">Requester</td><td align="left">Del</td></tr>';
        
        
        if (is_null($itemRecords3)) {
            echo '</table></div><br>';
        }
        else {
            while($row = $itemRecords3->fetch_assoc())
            {
                echo 
                '<tr width="100%"><td align="left">' . $row['item'] . '</td><td align="left">' . $row['requesterName'] . 
                '</td>
                <td align="left"><form action="shopping.php?operation=delete&requestID=' . $row['requestID'] . '" method="POST"><input type="submit" style="background-color: #f44336; font-size: 10px;" value="X"  name="del_r"></form></td>
                </tr>';
            }
            echo '</table></div></div>';
        }
    }
    
function deleteShoppingItem($mysqli, $id){
    $sql1 = "DELETE FROM Shopping WHERE shoppingID = " . $id;
    $sql2 = "DELETE FROM ShoppingSharedTo WHERE shoppingID = " . $id;
    $result1 = $mysqli->query($sql1);
    $result2 = $mysqli->query($sql2);
    if(!$result1 || !$result2){
        throw new Exception("Cannot delete Request");
    }
}
function deleteRequestItem($mysqli, $id){
    $sql1 = "DELETE FROM Request WHERE requestID = " . $id;
    $sql2 = "DELETE FROM RequestSharedTo WHERE requestID = " . $id;
    $result1 = $mysqli->query($sql1);
    $result2 = $mysqli->query($sql2);
    if(!$result1 || !$result2){
        throw new Exception("Cannot delete Request");
    }
    
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
		<a href="members.php" id="menulinks">Your Homies</a><br>
		<a href="logout.php" id='logout'>Logout</a><br>
	</div>
	<div class="rightcol">
		<h1 align="center" width=100%>Finance and Shopping</h1>
	    <?php
	    if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == 'delete' && isset($_REQUEST["shoppingID"])){
            deleteShoppingItem($mysqli, $_REQUEST["shoppingID"]);
        }
        if(isset($_REQUEST["operation"]) && $_REQUEST["operation"] == 'delete' && isset($_REQUEST["requestID"])){
            deleteRequestItem($mysqli, $_REQUEST["requestID"]);
        }
		    displayItems($mysqli);
		?>
		<div class="alarm" align="left">
		<?php
            displayBoughtForm($mysqli);
        ?>
        </div>
        <div class="alarm" align="left">
		<?php
		    displayRequestForm($mysqli);
		?>
		</div>
	</div>
</body>
</html>
