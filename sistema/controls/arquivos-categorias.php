<?php
$app->get('/arquivos-categorias-json', function() use ($app){
	valida_logado();
	$class = new ArquivosCategorias();
	$result = $class->load();
	die(json_encode($result));
});
?>