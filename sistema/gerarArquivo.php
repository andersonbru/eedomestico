<?php
require_once("config.php");
$cli_img = new Cliente();
$img = $cli_img->selectBlobMd5($_GET['id']);
header("Content-Type:" . $img['type']);
echo $img['arquivo'];
?>