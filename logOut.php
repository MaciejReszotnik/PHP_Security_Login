<?php
session_start(); 

$_SESSION['error']="Zostałeś wylogowany";
unset($_SESSION['user']);
header('Location: index.php');


?>