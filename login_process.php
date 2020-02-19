<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

// Check for errors before doing anything else
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST")
      {
       // username and password sent from form 
         $myusername=mysqli_real_escape_string($db,$_POST['uname']); 
         $mypassword=mysqli_real_escape_string($db,$_POST['pword']); 
     
         $sql="SELECT username FROM User WHERE username='$myusername' and password='$mypassword'";
         $result=mysqli_query($db,$sql);
         $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
         $active=$row['active'];
     
         $count=mysqli_num_rows($result);
     
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count==1)
        {
         session_register("myusername");
         $_SESSION['login_user']=$myusername;
     
         header("location: members.php");
        }
        else 
        {
        $error="Your Login Name or Password is invalid";
        }
      }
}

$mysqli -> close();
?>
