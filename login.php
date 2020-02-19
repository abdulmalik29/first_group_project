<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
</head>

<body>
	<img src="homies.png" alt="Homies logo"><br>
	<h1>MEMBER LOGIN</h1>
	<form action="login_process.php" method="post">
		
  		<div class="container">
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