<!DOCTYPE html>
<html>
<head>
	<title>NEW HOUSE</title>
	<style>
		body{
  font-family: 'Open Sans', sans-serif;
  background:#33B0CC;
  margin: 0 auto 0 auto;  
  width:100%; 
  text-align:center;
  margin: 20px 0px 20px 0px;   
}
.nav{
	background-color: #33B0CC;
  border: white;
  color: white;
  margin: 0 auto 0 auto;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  //display: inline-block;
  font-size: 16px;
  cursor: pointer;
	float: left;
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
  
  <button class="nav" onclick="window.location.href = 'index.php';">Home</button>
  <button class="nav" onclick="window.location.href = 'login.php';">Login</button>
	<button class="nav" onclick="window.location.href = 'new_house.php';">New House</button>
	<button class="nav" onclick="window.location.href = 'new_member.php';">New Member</button><br><br><br><br>
	<img src="homies.png" alt="Homies logo"><br>
	<form action="newhouse_process.php" method="post">
		
  		<div class="container">
        <h1>NEW HOUSE</h1>
    		<label for="housename"><b></b></label>
    		<input type="text" placeholder="Enter House Name" name="housename" class="email" required>
   			<br>

        <label for="name"><b></b></label>
    		<input type="text" placeholder="Enter Names" name="fname" class="email" required>
            <br>

   			<label for="username"><b></b></label>
    		<input type="text" placeholder="Enter Username" name="username" class="email" required>
            <br>

            <label for="psw"><b></b></label>
            <input type="password" placeholder="Enter Password" name="psw" class="email" required>
            <br>
    
            <label for="eml"><b></b></label>
            <input type="email" placeholder="Enter Email" name="eml" class="email" required>
            <br>
    
            <label for="phone"><b></b></label>
            <input type="text" placeholder="Enter Phone number" name="pnumber" class="email" required>
    
        	<br><br>
        	<button type="submit" class = "button">Create</button>
    
  		</div>
      
	</form>

</body>
</html>