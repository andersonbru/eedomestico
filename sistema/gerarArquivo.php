<?php
require_once("config.php");
$arquivos 	= new Arquivos();
$arquivo 	= $arquivos->selectBlobMd5($_GET['id']);
header("Content-Type:" . $arquivo['tipo']);
echo $arquivo['arquivo'];
?>