<!DOCTYPE html>

<html>
<head>
	<title>INDEX</title>
</head>
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}
.button {
	background-color: #33B0CC;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
	float: left;
}

.about{
  padding: 50px;
  text-align: center;
  background-color: #33B0CC;
  color: white;
}
.button:hover {
  background-color: #555;
}
.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}
.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<!-- ......................................................... -->
<body>

	<img src="homies.png" alt="Homies Logo" style="width:100%">
	<!-- <h1>HOMIES</h1> -->
	<button class="button" onclick="window.location.href = 'login.php';">Login</button>
	<button class="button">New House</button>
	<button class="button">New Member</button>
	<!-- <a href="login.php">Login</a>
	<a href="new_house.php">New House</a>
	<a href="new_member.php">New Member</a> -->

	<div class="about">
	<h1>About Homies</h1>
	<p>Homies is an online system that makes sharing a house easier! Forget the problems of who owes who what, do I need to set the alarm? Do we need milk or not? All of these issues can now be kept track of and stored in one place. If you're at the shop and dont know if you need milk or not, just log into Homies and voilà! Yes you do. Homies helps you to keep track of all of these simple things that are usually spread over many group chats and hidden in random messages. </p>
</div>

<h2 style="text-align:center">Functionalities:</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <div class="container">
        <h2>Alarm</h2>
				<p>The alarm function allows house members to let other members of the house to know whether or not they are present inside the house. This allows them to find out whether or not they have to set an alarm or not. </p>
      </div>
    </div>
  </div>

	<div class="row">
	  <div class="column">
	    <div class="card">
	      <div class="container">
	        <h2>Shopping List</h2>
					<p>This funtion allows you as the user to let everyone know when something is out in your house. If you are runing out of butter but you are busy for the next couple of hours or know someone else is heading to the shop then you can just add it into the shopping list for the next person who is at the shop to log in and check. </p>
	      </div>
	    </div>
	  </div>

		<div class="row">
			<div class="column">
				<div class="card">
					<img src= "money.jpg" alt="money pic" style = width="160" height="160">
					<div class="container">
						<h2>Finances</h2>
						<p>The shopping list also takes care of who owes who what. If one friend has made a specific request then you can keep track of your finances </p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column">
					<div class="card">
						<div class="container">
							<h2>Complaints</h2>
							<p>Here you and all the other members of your house will be able to lodge any complaints etc via an online form that will be stored in the database and be sent to the landlord. Allowing you to easily keep track of when and what was complained about. </p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column">
						<div class="card">
							<div class="container">
								<h2>Chat</h2>
								<p>The chat is very straightforward, it is a central chat for the house that will allow users to talk about anything. It can serve as a location to only discuss house related things or as a mainy group chat for memes and the like! </p>
							</div>
						</div>
					</div>
</body>
</html>
