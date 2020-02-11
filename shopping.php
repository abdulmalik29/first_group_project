<!DOCTYPE html>
<?php
$database_host = "dbhost.cs.man.ac.uk";
$database_user = "d42339bs";
$database_pass = "DB123456";
$group_dbnames = "2019_comp10120_y9";
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames);

// Check for errors before doing anything else
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

// Always close your connection to the database cleanly!
$mysqli -> close();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* 
{
  box-sizing: border-box;
}

.leftcol {
  border: 1px solid black;
  float: left;
  width: 20%;
  height: 100%;
  background-color: #33B0CC;
  align: center;
}
.rightcol {
  border: 1px solid black;
  float: left;
  width: 70%;
  height: 100%;
  background-color: #33B0CC;
}
.selected{
  width: 100%;
  background-color: blue;
}
a{
  border: 1px solid black;
  padding: 15px 25px;
  background-color: grey;
  color: white;
  width: 100px;
  text-align: center;
  text-decoration: none; 
  display: inline-block;
  width: 100%;
}
input{
  display: inline-block;
  width = 33%;
}
.innerRight{
  float: right;
  width: 50%;
  border: 1px solid black;
  height: 100%;
}
.innerLeft{
  float: left;
  width: 50%;
  border: 1px solid black;
  height: 100%;
}
td{
  width: 50%;
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>
</head>
<body bgcolor="#33B0CC">
  <div class="leftcol">
    <h1 align=center>HOMIES</h1>
    <a href="index.php">About</a><br>
	<a href="alarm.php">Alarm</a><br>
	<a href="chat.php">Chat</a><br>
	<a href="shopping.php" class="selected">Shopping List</a><br>
	<a href="finance.php">Finance</a><br>
	<a href="trash.php">Trash</a><br>
	<a href="complaints.php">Complaints</a><br>
	<a href="members.php">Members</a><br>
  </div>
  <div class="rightcol">
  <table>
	<h1 align="center">Shopping List</h1>
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
	<tr></tr>
  </table>
</body>
</html>
