<?php
session_start();
session_unset();
header("Location: http://{$_SERVER['HTTP_HOST']}/4ww3recreationalparks/index.php");
?>