<?php 
ob_start();
session_start();
include 'Links/config.php';
unset($_SESSION['customer']);
header("location: login.php "); 
?>