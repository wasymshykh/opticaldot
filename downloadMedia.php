<?php
require_once "configMedia.php";
require_once "imgupload.class.php";

$img = new ImageUpload;
$img->downloadImage($_GET['id']);

?>
