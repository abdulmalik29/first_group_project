<!DOCTYPE html>
<html>
<head>
	<title>NEW MEMBER REGISTER</title>
	<style>
		body{
  font-family: 'Open Sans', sans-serif;
  background:#3498db;
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

.box{
  background:white;
  width:300px;
  border-radius:6px;
  margin: 0 auto 0 auto;
  padding:0px 0px 70px 0px;
  border: #2980b9 4px solid; 
}

.email{
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

.button{
  background:#2ecc71;
  width:125px;
  padding-top:5px;
  padding-bottom:5px;
  color:white;
  border-radius:4px;
  border: #27ae60 1px solid;
  
  margin-top:20px;
  margin-bottom:20px;
  float:left;
  margin-left:16px;
  font-weight:800;
  font-size:0.8em;
}

.button:hover{
  background:#2CC06B; 
}

#btn2{
  float:left;
  background:#3498db;
  width:125px;  padding-top:5px;
  padding-bottom:5px;
  color:white;
  border-radius:4px;
  border: #2980b9 1px solid;
  
  margin-top:20px;
  margin-bottom:20px;
  margin-left:10px;
  font-weight:800;
  font-size:0.8em;
}

#btn2:hover{ 
background:#3594D2; 
}
	</style>
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