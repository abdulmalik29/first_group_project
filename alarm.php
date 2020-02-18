<!DOCTYPE html>
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>
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
			<h2>Who is in:</h2>
			<a>Ben</a>
			<h2>Who is out:</h2>
			<a>Rahul</a>
            <h3>Are you in?</h3>
            <a>Yes </a></br>
            <a>No </a>
            <?php
            getOutsidePeople()
            ?>
		</div>
	</body>
</html>

<?php

// Connect to the database
function testSQL()
{
    // Load the configuration file containing your database credentials
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
        die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }
    $sql = "SELECT * FROM User";
    $records = $mysqli->query($sql);
    $output = "
		<table border='2'>
			<th>Username</th>
			<th>Email</th>
			<th>Phone Number</th>
            <th>Name</th>
            <th>HouseID</th>
            <th>Outside?</th>
		";
    while ($row = $records->fetch_assoc())
    {
        $output .= "
            <tr>
                <td>$row[username]</td>
                <td>$row[email]</td>
                <td>$row[phonenumber]</td>
                <td>$row[name]</td>
                <td>$row[houseID]</td>
                <td>$row[outside]</td>
            </tr>
        ";
    }
	$output .="</table>";
	echo ($output);


    // Always close your connection to the database cleanly!
    $mysqli -> close();
}
function getOutsidePeople() {
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
        die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }

    // Issue to be addressed - how do we know who is logged in?
    $currentUsername = "testman";
    $currentUserQuery = "SELECT username, houseID FROM User WHERE username = \"" . $currentUsername . "\"";
    $currentUserRecords = $mysqli->query($currentUserQuery);
    if (is_null($currentUserRecords)) {
        die("Current user not found!");
    }
    $currentUserRow = $currentUserRecords->fetch_assoc();

    $outsideSql="SELECT username, name, houseID, outside FROM User WHERE houseID = " . $currentUserRow[houseID];
    $outsideRecords = $mysqli->query($outsideSql);
    while($row = $outsideRecords->fetch_assoc())
    {
        echo "<p>$row[name]: outside is $row[outside]</p>";
    }
}
?>
