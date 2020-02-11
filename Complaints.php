<!DOCTYPE html>
<html>
<head>
<title>Complaints</title>
<style>
body {
  background-color: grey;
  text-align: center;
  color: white;
  font-family: Arial, Helvetica, sans-serif;

}
div.alarm {
  position: absolute;
  top: 100px;
  left: 20px;
}
div.chat {
  position: absolute;
  top: 130px;
  left: 20px;

}
div.shopping {
  position: absolute;
  top: 160px;
  left: 20px;
 
}
div.finance {
  position: absolute;
  top: 190px;
  left: 20px;
}
div.trash {
  position: absolute;
  top: 220px;
  left: 20px;
}
div.com {
  position: absolute;
  top: 250px;
  left: 20px;
}
div.mem {
  position: absolute;
  top: 280px;
  left: 20px;
 
}
div.info {
  position: absolute;
  top: 310px;
  left: 20px;

}
input[type=text], select {
  width: 60%;
  padding: 12px 20px;
  margin: 18px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;

}

input[type=submit] {
  width: 50%;
  background-color: #FF0000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div.form {
  border-radius: 5px;
  background-color: ##ffffff;
  padding: 20px;
  
}
</style>
</head>
<body>

<h1>Complaints</h1>
<div class="alarm">
<a href="alarm.html">Alarm</a>
</div>
<div class="chat">
<a href="chat.html">Chat</a>
</div>
<div class="shopping">
<a href="shopping_list.html">Shopping List</a>
</div>
<div class="finance">
<a href="finance.html">Finance</a>
</div>
<div class="trash">
<a href="trash.html">Trash and Recycling</a>
</div>
<div class="com">
<a href="complaints.html">Complaints</a>
</div>
<div class="mem">
<a href="members.html">Members</a>
</div>
<div class="info">
<a href="info.html">Info</a>
</div>
<div class="form">
  <form action="/action_page.php">
    <div class="date">
      <label for="date">Date</label>
    </div>
    <input type="text" id="date" name="date" placeholder="Date(dd/mm/yyyy)">
    <div class="loc">
      <label for="location">Location</label>
    </div>
    <input type="text" id="location" name="location" placeholder="Location">
    <div>
      <label for="issue">Issue</label>
    </div>
    <select id="issue" name="issue">
      <option value="waterleak">Water Leak</option>
      <option value="notworking">Device not Working</option>
      <option value="break">Breakage</option>
    </select>
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>