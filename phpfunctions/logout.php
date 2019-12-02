<?php
session_start();
//Stop session
session_unset();
//Redirect back to homepage
header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
?>