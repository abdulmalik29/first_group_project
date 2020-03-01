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
			<label for="dateReported">Date</label><br>
			<input type="date" id="dateReported" name="dateReported" placeholder="Date(dd/mm/yyyy)"><br>
			<label for="Location">Location</label><br>
			<input type="text" id="Location" name="Location" placeholder="Location"><br>
			<label for="complaint">Issue</label><br>
			<select id="complaint" name="complaint">	
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
    function setupConnection() {
        require_once('config.inc.php');
        $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

         // Check for errors before doing anything else
        if($mysqli -> connect_error) {
            die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
        }
        return $mysqli;
    }

   
    
    $Date = mysqli_real_escape_string($mysqli, $_POST['dateReported']);
    $Location = mysqli_real_escape_string($mysqli, $_POST['Location']);
    $Issue = mysqli_real_escape_string($mysqli, $_POST['complaint']);
    
     // Attempt insert query execution
    $sql = "INSERT INTO Complaints (Location, complaint) VALUES ('$Location', '$Issue')";
    if(mysqli_query($mysqli, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }
    // Close connection
    mysqli_close($mysqli);
    
    function closeConnection($mysqli) {
    // Always close your connection to the database cleanly!
    $mysqli -> close();
    }

?>
