<?php

// Always start this first
session_start();

// Session is yet to be implemented
// Once it is, uncomment this and it should work.

//if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
//} else {
    // Redirect them to the login page
//    header("Location: login.php");
//}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Alarm</title>
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
		    <h1>Alarm</h1>
		    <div class="alarm">
			<h2>Who is in:</h2>
			<a>Ben</a>
		    </div>
		    <div class="alarm">
			<h2>Who is out:</h2>
			<a>Rahul</a>
		    </div>
		    <h3>Are you in?</h3>
		    <a href="alarm.php" class="alarm" id="yes">Yes </a>
		    <a href="alarm.php" class="alarm" id="no">No </a>
		    <?php
		    $mysqli = setupConnection();
		    getOutsidePeople($mysqli);
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
function getOutsidePeople($mysqli) {
    $currentUsername = "peter2123";
    //$currentUsername = $_SESSION['username'];
    
    //$currentUserQuery = "SELECT username, houseID FROM User WHERE username = \"" . $currentUsername . "\"";
    //$currentUserRecords = $mysqli->query($currentUserQuery);
    //if (is_null($currentUserRecords)) {
    //    die("Current user not found!");
    //}
    //$currentUserRow = $currentUserRecords->fetch_assoc();
    //$outsideSql="SELECT username, name, houseID, outside FROM User WHERE houseID = " . $currentUserRow["houseID"];
    
    
    //$currentHouseID = $_SESSION['houseID'];
    $currentHouseID = 0;

    $outsideSql="SELECT username, name, houseID, outside FROM User WHERE houseID = " . $currentHouseID;
    $outsideRecords = $mysqli->query($outsideSql);
    while($row = $outsideRecords->fetch_assoc())
    {
        echo "<p>$row[name]: outside is $row[outside]</p>";
    }
}
function closeConnection($mysqli) {
    // Always close your connection to the database cleanly!
    $mysqli -> close();
}
?>
