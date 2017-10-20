<?php
require_once("config.php");
$cli_img = new Cliente();
$img = $cli_img->selectBlob($_GET['id_usuarios'], $_GET['chave']);
header("Content-Type:" . $img['type']);
echo $img['arquivo'];
?>