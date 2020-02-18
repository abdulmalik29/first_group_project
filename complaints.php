<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complaints</title>
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
		<h1>Complaints</h1>	
		<form action="/action_page.php"><br>
			<label for="date">Date</label><br>
			<input type="text" id="date" name="date" placeholder="Date(dd/mm/yyyy)"><br>
			<label for="location">Location</label><br>
			<input type="text" id="location" name="location" placeholder="Location"><br>
			<label for="issue">Issue</label><br>
			<select id="issue" name="issue">	
				<option value="waterleak">Water Leak</option>
				<option value="notworking">Device not Working</option>
				<option value="break">Breakage</option>
			</select>  
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
<?php
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }
    $CurrentHouseID = "0";
    $result = mysqli_query($mysqli, "SELECT * FROM User WHERE houseID = \"" . $CurrentHouseID . "\"");
    $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
    $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
    $email = mysqli_real_escape_string($link, $_REQUEST['email']);
    
     // Attempt insert query execution
    $sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
    if(mysqli_query($link, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    // Close connection
    mysqli_close($link);
?>
?>