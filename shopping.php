<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>Shopping</title>
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
		<table>
			<h1 align="center" width=100%>Shopping List</h1>
			<tr>
				<td>
					<?php echo $_GET["item1"]?>
					<?php echo $_GET["user1"]?>
					<?php echo $_GET["price1"]?>
				</td>
				<td>
					<?php echo $_GET["item2"]?>
					<?php echo $_GET["user2"]?>
					<?php echo $_GET["price2"]?>
				</td>
			</tr>
			<tr>
				<td>
					<form action="shopping.php" method="get">
						<input type="text" name="item1">
						<input type="text" name="user1">
						<input type="text" name="price1">
						<input type="submit" value="Submit">
					</form>
				</td>
				<td>
					<form action="shopping.php" method="get">
						<input type="text" name="item2">
						<input type="text" name="user2">
						<input type="text" name="price2">
						<input type="submit" value="Submit">
					</form>
				</td>
			</tr>
	  </table>
</body>
</html>
