<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Members</title>
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
	    <h1>Members</h1>
	    <?php
           


            $result = mysqli_query($con,"SELECT * FROM User");

            echo "<table border='1'>
            <tr>
            <th>Name</th>
            <th>E-Mail</th>
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

            mysqli_close($con);
            ?>
		
	</div>
</body>
</html>