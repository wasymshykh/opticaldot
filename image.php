<?php
require_once "configMedia.php";
require_once "imgupload.class.php";

$img = new ImageUpload;
$img->showImage($_GET['id']);

?>
