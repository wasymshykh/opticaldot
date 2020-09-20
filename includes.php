<?php

ob_start();
session_start();

error_reporting(E_ALL & ~E_NOTICE);

$timestamp = $time = time();
//$userId = $userid = $_SESSION['user'];

require_once "config.php";
require_once "pdo_connection.php";
require_once "admin/functions.php";

//$permission = $loginStatus = checkLoginStatusUser();

?>