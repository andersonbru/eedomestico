<?php
chdir('layout/assets/');
$arquivo = getcwd().'/assets.zip';
$destino = getcwd();

$zip = new ZipArchive;
$zip->open($arquivo);
if ($zip->extractTo($destino)== TRUE) {
	echo 'Ok';
} else {
	echo 'Erro';
}
$zip->close();


die(getcwd());
?>