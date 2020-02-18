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
			<input type="date" id="dateReported" name="dateReported" placeholder="Date(dd/mm/yyyy)"><br>
			<label for="location">Location</label><br>
			<input type="text" id="Location" name="Location" placeholder="Location"><br>
			<label for="issue">Issue</label><br>
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
    require_once('config.inc.php');
    $mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

    // Check for errors before doing anything else
    if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
    }
   
    
    $Date = mysqli_real_escape_string($mysqli, $_REQUEST['dateReported']);
    $Location = mysqli_real_escape_string($mysqli, $_REQUEST['Location']);
    $Issue = mysqli_real_escape_string($mysqli, $_REQUEST['complaint']);
    
     // Attempt insert query execution
    $sql = "INSERT INTO Complaints (dateReported, Location, complaint) VALUES ('$Date', '$Location', '$Issue')";
    if(mysqli_query($mysqli, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }
    // Close connection
    mysqli_close($mysqli);
?>
?>