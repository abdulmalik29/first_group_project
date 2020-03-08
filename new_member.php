<!DOCTYPE html>
<html>
<head>
	<title>NEW MEMBER REGISTER</title>
</head>

<body>

	<img src="homies.png" alt="Homies logo"><br>
	<h1>NEW MEMBER REGISTER</h1>
  
	<form action="newmember_process.php" method="post">
		
  		<div class="container">
        <label for="houseid"><b>House ID</b></label>
        <input type="text" placeholder="Enter house ID" name="houseid" required>
        <br>

    		<label for="housename"><b>House Name</b></label>
    		<input type="text" placeholder="Enter House Name" name="housename" required>
   			<br>
   			
   			<label for="fullname"><b>Fullname</b></label>
    		<input type="text" placeholder="Enter first and surname" name="fullname" required>
   			<br>

   			<label for="username"><b>Username</b></label>
    		<input type="text" placeholder="Enter Username" name="username" required>
        <br>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <br>

        <label for="eml"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="eml" required>
        <br>

        <label for="phone"><b>Phone number</b></label>
        <input type="text" placeholder="Enter Phone number" name="pnumber" required>

    		<br><br>
    		<button type="submit">Create</button>

    		<br>
    		<label>
      			<input type="checkbox" checked="checked" name="remember"> Remember me
    		</label>
  		</div>
	</form>

</body>
</html>