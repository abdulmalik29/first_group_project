<?php

// Always start this first
session_start();

if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    // Grab user data from the database using the username
    // Let them access the "logged in only" pages
    $mysqli = setupConnection();
}
else {
    // Redirect them to the login page
    echo "aaaaah";
    header("Location: login.php");
    $_SESSION['access_attempted'] = true;
    exit;
}
?>
<!DOCTYPE html>
<html>
	<head>

		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Alarm</title>
		
	  .box1 {
      border: 1px solid;
      padding: 10px;
      box-shadow: 5px 10px;
      }
      
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
		    <h1>In/Out</h1>
		    
		   
		    <?php 
		    getPeople($mysqli); 
		    ?>

		    <h3>Are you in?</h3>
		    <?php
		    showAlarmForm($mysqli);
		    closeConnection($mysqli);
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
?>


<?php
function getPeople($mysqli) {
    $currentHouseID = $_SESSION['houseID'];

    $outsideSql="SELECT username, name FROM User WHERE outside = 0 AND houseID = " . $currentHouseID;
    $outsideRecords = $mysqli->query($outsideSql);
    $outsideCount = 0;
    $outsideString = "";
    while($row = $outsideRecords->fetch_assoc())
    {
        $outsideString = $outsideString . '<p>' . $row['name'] . '</p>';
	$outsideCount = $outsideCount + 1;
    }
    
    $insideSql= "SELECT username, name FROM User WHERE outside = 1 AND houseID = " . $currentHouseID;
    $insideRecords = $mysqli->query($insideSql);
    $insideCount = 0;
    
    echo '<div class="alarm">
	<h2>Who is in:</h2>';
    echo $outsideString;
    </div>;
    
    echo '<div class="alarm>
	<h2>Who is out:</h2>';
    while($row = $insideRecords->fetch_assoc())
    {
	echo '<p>' . $row['name'] . '</p>';
	$insideCount = $insideCount + 1;
    }
    while ($outsideCount > $insideCount) {
	echo '<p>.</p>';
	$insideCount = $insideCount + 1;
    }
   </div>;
}
?>

<?php
function showAlarmForm($mysqli) {
    $currentUsername = $_SESSION['username'];

    $outsideSql="SELECT outside FROM User WHERE username = '" . $currentUsername ."'";
    $outsideRecords = $mysqli->query($outsideSql);
    
    $row = $outsideRecords->fetch_assoc();
    if ($row) {
	echo '<form action="set_alarm.php" method="post">';
	
	if ($row['outside'] === "0") {
	    echo '<p align="center"><button type="submit" class="alarm" id="yes" name="go-outside">Leave house</button></p>';
	    
	}
	else {
	    echo '<p align="center"><button type="submit" class="alarm" id="no" name="go-inside">Enter house</button></p>';
	}
	echo '</form>';
    }
}

function closeConnection($mysqli) {
    // Always close your connection to the database cleanly!
    $mysqli -> close();
}
?>
