<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
require_once("init.php");
require_once("categorias.php");
require 'Slim/Slim/Slim.php';
Slim\Slim::registerAutoloader();

$categoria = new Categoria();
//var_dump($categoria->listCategorias());
$app = new Slim\Slim();
$app->post('/createCategoria', function(){
    $json = $app->request->getBody();
    $categoria->createCategoria($json);
});
$app->get('/categorias', $categoria->listCategorias());


$app->run();

function json($result){
  header('Content-Type: application/json; charset=utf-8');
  die(json_encode($result));
}
