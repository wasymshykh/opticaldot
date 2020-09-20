<?php

//echo phpinfo();

/*
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
      $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			var_dump($mysqli);
      echo true;
   } catch (mysqli_sql_exception $e) {
      throw $e;
   } 
		*/
//ob_start();
	try {

	$str = sprintf('mysql:host=%s;dbname=%s',DB_HOST,DB_NAME);
	$PDO = new PDO($str, DB_USER, DB_PASS);
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e) {
	if (DEBUG_MODE) {
	die('Error: ' . $e->getMessage(). $e->getTraceAsString());
	}
	}


?>