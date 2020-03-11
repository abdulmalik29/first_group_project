<?php
session_start();

// Destroy the session which logs out the user.
session_destroy();
header("Location: index.php");
?>
