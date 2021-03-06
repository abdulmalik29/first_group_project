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
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Homies</title>
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
	    <h1>Your Homies</h1>
	    <div class="HouseID">
    	    <?php
    	        $CurrentHouseID = $_SESSION['houseID'];
    	        
                $sql= "SELECT ownerEmail FROM House WHERE houseID = \""  . $CurrentHouseID . "\"";
                $result1 = $mysqli->query($sql);
                $row = $result1->fetch_assoc();
                
                if(is_null($row["ownerEmail"])) {
                    echo  "<h2>\nHouse ID = " . $CurrentHouseID . "</h2>";
                    $namequery = $mysqli->query("SELECT housename FROM House WHERE houseID = '$CurrentHouseID'");
                    $namerow = $namequery->fetch_assoc();
                    echo  "<h2>\nHouse Name = " . $namerow["housename"] . "</h2>";
        	         echo "<form action='inputlandlord.php' method='post'>
        			           <label>Landlords Email</label>
        				    	<input type='text' name='owneremail'><br>
        				    	<input type='submit' value='Submit'>
        		    </form>";
                } else {
                    echo  "<h2>\nHouse ID = " . $CurrentHouseID . "</h2>";
                    $namequery = $mysqli->query("SELECT housename FROM House WHERE houseID = '$CurrentHouseID'");
                    $namerow = $namequery->fetch_assoc();
                    echo  "<h2>\nHouse Name = " . $namerow["housename"] . "</h2>";
                    echo  "<h2>Owner Email: " . $row["ownerEmail"] . "</h2>";
                }
    		?>
        </div>
    
           
        <?php    
            $result = mysqli_query($mysqli, "SELECT * FROM User WHERE houseID = \"" . $CurrentHouseID . "\"");
            echo "<table border='1'>
            <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Phone Number</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phonenumber'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";

            ?>
             
	</div>
</body>
</html>
<?php

function setupConnection() {
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
        die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }
    return $mysqli;
}
function closeConnection($mysqli) {
    // Always close your connection to the database cleanly!
    $mysqli -> close();
}
?>
