<!DOCTYPE html>
<?php
session_start();

// If logged in, don't try to login again.

if ( isset( $_SESSION['username'] ) && isset( $_SESSION['houseID'] ) ) {
    header("Location: alarm.php");
}


?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>
	<style>
		body{
  font-family: 'Open Sans', sans-serif;
  background:#33B0CC;
  margin: 0 auto 0 auto;  
  width:100%; 
  text-align:center;
  margin: 20px 0px 20px 0px;   
}

p{
  font-size:12px;
  text-decoration: none;
  color:#ffffff;
}

h1{
  font-size:1.5em;
  color:#525252;
}

.container{
  background:white;
  width:300px;
  border-radius:6px;
  margin: 0 auto 0 auto;
  padding:0px 0px 70px 0px;
  border: #2980b9 4px solid; 
}

.username{
  background:#ecf0f1;
  border: #ccc 1px solid;
  border-bottom: #ccc 2px solid;
  padding: 8px;
  width:250px;
  color:#AAAAAA;
  margin-top:10px;
  font-size:1em;
  border-radius:4px;
}

.password{
  border-radius:4px;
  background:#ecf0f1;
  border: #ccc 1px solid;
  padding: 8px;
  width:250px;
  font-size:1em;
}

.submit{
  background:#3498db;
  width:125px;
  padding-top:10px;
  padding-bottom:10px;
  color:white;
  border-radius:4px;
  border: #27ae60 1px solid;
  
  margin-top:5px;
  margin-bottom:5px;
  float:left;
  margin-left:16px;
  font-weight:800;
  font-size:0.8em;
}

.button:hover{
  background:#2CC06B; 
}
	</style>
</head>

<body>
	<img src="homies.png" alt="Homies logo"><br>
	
	<form action="login_process.php" method="post">
		
  		<div class="container">
      <h1>MEMBER LOGIN</h1>
		<?php			
			if (isset($_SESSION['access_attempted'])) {
				echo "<h2>You must log in to view that page.</h2>";
				unset($_SESSION['access_attempted']);
			}
		?>
    		<label for="uname"></label>
    		<input type="text" placeholder="Enter Username" name="uname" class="username" required>
   			<br>

   			<label for="psw"></label>
    		<input type="password" placeholder="Enter Password" name="psw" class="email" required>

    		<br><br>
    		<button type="submit" class = "submit">Login</button>

    		<br>
  		</div>

  		
	</form>
</body>
</html>
