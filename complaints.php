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
		<a href="shopping.php" id="menulinks">Finance and Shopping</a><br>
		<a href="trash.php" id="menulinks">Trash</a><br>
		<a href="complaints.php" id="menulinks">Complaints</a><br>
		<a href="members.php" id="menulinks">Members</a><br>
	</div>
	<div class="rightcol">
		<table>
			<h1 align="center" width=100%>Complaints</h1>
			<tr>
			</tr>
			<tr>
				<td>
					<?php
					    displayForm($mysqli);
					?>
				</td>
			</tr>
	  </table>
	  <?php 
	        $currentUsername = $_SESSION['username'];
	        $sql = "SELECT complaint, dateReported FROM Complaints where username = $currentUsername";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
             // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Date: " . $row["dateReported"]. " - Complaint: " . $row["complaint"]. "<br>";
                }
            } else {
                 echo "0 complaints reported so far";
            }
       ?>
	    

	</div>
</body>
</html>
<?php
    function displayForm($mysqli) {
        echo    '<form action="inputcomplaints.php" method="post">
			        <label>Date</label>
					<input type="date" name="date"><br>
				    <label>Location</label>
					<input type="text" name="location"><br>
					<label>Complaint</label>
					<input type="text" name="complaint"><br>
					<input type="submit" value="Submit">
				</form>';
    }
    function processUserInput($mysqli){
        $currentHouseID = $_SESSION['houseID'];
        $currentUsername = $_SESSION['username'];
        $Date = mysqli_real_escape_string($mysqli, $_POST['dateReported']);
        $Date = mysqli_real_escape_string($mysqli, $_POST['dateReported']);
        $Location = mysqli_real_escape_string($mysqli, $_POST['Location']);
        $Issue = mysqli_real_escape_string($mysqli, $_POST['complaint']);
        $sql = "SELECT MAX(complaintID) FROM Complaints";
        $ComplaintID = mysqli_query($sql, $mysqli);
        $ComplaintID = $ComplaintID + 1;
        $sql = "INSERT INTO `Complaints` (`complaintID`, `username`, `complaint`, `Location`, `sorted`, 'dateReported') VALUES ('1121', 'testman', 'lol', 'lol', '0', '2020-03-13')";
        if(mysqli_query($mysqli, $sql)){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
        }
    }

?>
