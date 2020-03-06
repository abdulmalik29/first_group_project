<!DOCTYPE html>
<?php

// Always start this first
session_start();

if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    //$mysqli = setupConnection();
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
	<title>Trash and Recycling</title>
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
        <style>
            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
                }
        </style>

        <p>
            <h1 align="center">Recycling Bins You Should Use</h1>

            <figure>
            <h2 align="center">Brown bin or container</h2>
                <img  src="https://www.manchester.gov.uk/images/brown_bin_image.jpg" style="width:500px;height:250px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <figure>
                <img  src="https://www.manchester.gov.uk/images/brown_bin_not_allowed_image.jpg" style="width:500px;height:125px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <figure>
                <img  src="https://www.manchester.gov.uk/images/blue_bin_image.jpg" style="width:500px;height:250px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <figure>
                <img  src="https://www.manchester.gov.uk/images/blue_bin_not_allowed_image.jpg" style="width:500px;height:125px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <figure>
                <img  src="https://www.manchester.gov.uk/images/green_bin_image.jpg" style="width:500px;height:250px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <figure>
                <img  src="https://www.manchester.gov.uk/images/green_bin_not_allowed_image.jpg" style="width:500px;height:125px;">
                <figcaption align ="center">© 2020 Manchester City Council</figcaption>
            </figure>

            <h2 align="center">Enter Your Postcode To Check Bin Collection Schedule</h2>


         <div style="text-align: center">
                <a href="https://www.manchester.gov.uk/bincollections/">CLICK HERE</a>
         </div>

        <p/>
    </div>
</body>
</html>
