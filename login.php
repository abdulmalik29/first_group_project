<!DOCTYPE html>
<?php
session_start();

// If logged in, don't try to login again.
// ----- Should be uncommented once logout page is implemented.

//if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) {
//    header("Location: alarm.php");
//}

$password =  password_hash('1234test', PASSWORD_DEFAULT);
echo($password);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>
</head>

<body>
	<img src="homies.png" alt="Homies logo"><br>
	<h1>MEMBER LOGIN</h1>
	<form action="login_process.php" method="post">
		
  		<div class="container">
		<?php			
			if (isset($_SESSION['access_attempted'])) {
				echo "<h2>You must log in to view that page.</h2>";
				unset($_SESSION['access_attempted']);
			}
		?>
    		<label for="uname"><b>Username</b></label>
    		<input type="text" placeholder="Enter Username" name="uname" required>
   			<br>

   			<label for="psw"><b>Password</b></label>
    		<input type="password" placeholder="Enter Password" name="psw" required>

    		<br><br>
    		<button type="submit">Login</button>

    		<br>
    		<label>
      			<input type="checkbox" checked="checked" name="remember"> Remember me
    		</label>
  		</div>

  		
  		<div class="container" style="background-color:#f1f1f1">
    		<span class="password"><a href="#">Forgot password?</a></span>
  		</div>
	</form>
</body>
</html>
