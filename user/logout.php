<?php
// Initialiseer sessie, gooi alle variabelen weg, en vernietig sessie.

session_start();
$_SESSION = array();
session_destroy();

header("location: login.php");
exit();
?>
