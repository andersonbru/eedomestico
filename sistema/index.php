<?php
session_start();
require_once("vendor/autoload.php");
require_once("config.php");
require_once("funcoes.php");


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
	'debug'=>TRUE,
    'templates.path' => './views'
));

//$app->contentType('text/html; charset=utf-8');

$app->get('/', function() use ($app){
	$app->render('login.php');
});

$app->get('/principal', function() use ($app){
	valida_logado();	
	$app->render('principal.php');
});

$app->get('/logout', function() use ($app){
		
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	unset($_SESSION['usuario']);
	
	$app->redirect('/');
});

$app->get('/teste', function() use ($app){
	$app->render('teste.php');
});

$app->notFound(function () use ($app) {
    $app->render('/404.php');
});

include_once('./controls/acesso.php');
include_once('./controls/menu.php');


$app->run();

?>