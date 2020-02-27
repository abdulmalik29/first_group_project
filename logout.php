<?php
session_start();

// This is a temporary page just so the sessions works.
session_destroy();
header("Location: index.php");
?>
