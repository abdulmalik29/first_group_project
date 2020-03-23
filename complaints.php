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
<style>
    button::-moz-focus-inner,
    input::-moz-focus-inner { border: 0; padding: 0; }
    .container{
      background:white;
      border-radius:6px;
      margin: 0 auto 0 auto;
      padding:0px 0px 70px 0px;
    }

    .dateform{
      border-radius:4px;
      background:#ecf0f1;
      border: #ccc 1px solid;
      padding: 8px;
      margin-top:10px;
      width:250px;
      font-size:1em;
    }

    .locform{
      border-radius:4px;
      background:#ecf0f1;
      border: #ccc 1px solid;
      padding: 8px;
      margin-top:10px;
      width:250px;
      font-size:1em;
    }
    
    .comform{
      border-radius:4px;
      background:#ecf0f1;
      border: #ccc 1px solid;
      padding: 8px;
      margin-top:10px;
      width:250px;
      font-size:1em;
    }
    
    .submit{
      background:#3498db;
      width:125px;
      padding-top:15px;
      padding-bottom:10px;
      color:white;
      border-radius:4px;
      border: #27ae60 1px solid;
      margin-top:0px;
      margin-bottom:0px;
      margin-left:85px;
      font-weight:800;
      font-size:0.8em;
    }
    
    .button:hover{
      background:#2CC06B; 
    }

</style>
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
	    <h1 align="center" width=100%>Complaints</h1>
	    <div class="container">
		<!--<table id="complaints_Table">-->
			<!--<tr>-->
			<!--</tr>-->
			<!--<tr>-->
			<!--    <td>-->
		    <?php
			    displayForm($mysqli);
		    ?>
			<!--	</td>	-->
			<!--</tr>	-->
	  <!--</table>-->
	  <?php
	        $currentUsername = $_SESSION['username'];
	        $sql = "SELECT complaint, dateReported, Location FROM Complaints where username = $currentUsername";
            $result = $mysqli->query($sql);
            echo '<td colspan="1">
                    <div class="scrollit">';
            echo '<table border="0" cellspacing="1" cellpadding="5">
                    <tr>
                        <th>Date</th>
                        <th>Complaint</th>
                        <th>Location</th>
                    </tr>';

            if ($result) {
             // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["dateReported"]. "</td><td> " . $row["complaint"]. "</td><td>". $row["Location"]. "</td></tr>";
                }
            } else {
                 echo "0 complaints reported so far";
            }
            echo "</table>";
            echo "</div>";
       ?>

    </div>  
	</div>
</body>
</html>
<?php
    function displayForm($mysqli) {
        echo    '<form action="inputcomplaints.php" method="post">
			            <label>Date</label>
					    <input type="date" name="date" class="dateform"><br>
				        <label>Location</label>
				    	<input type="text" name="location" class="locform"><br>
				    	<label>Complaint</label>
				    	<input type="text" name="complaint" class="comform"><br>
				    	<input type="submit" value="Submit" class="submit">
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
