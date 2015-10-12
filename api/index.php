<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
require_once("models/categoria.php");
require_once("util/jsonResponse.php");
require 'Slim/Slim/Slim.php';

Slim\Slim::registerAutoloader();

$app = new Slim\Slim();

$app->get('/categorias', function(){
	$categoria = new Categoria();
	$data = $categoria->getAll();
	sendResult($data);
});

$app->get('/categorias/:id', function($id){
	$categoria = new Categoria();
	$data = $categoria->get($id);
	sendResult($data);
});

$app->post('/categorias', function(){
    $request = Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody(), true); //true convierte en array asoc, false en objeto php
	
	$categoria = new Categoria();
    $result = $categoria->create($data);
	
	if($result){
		sendResult($result);
	}else{
		sendError("Error al crear la categoría");
	}
});

$app->put('/categorias', function(){
    $request = Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody(), true); 

	$categoria = new Categoria();
    $result = $categoria->update($data);
	
	if($result){
		sendResult("categoria actualizada");
	}else{
		sendError("Error al actualizar la categoría");
	}
});

$app->delete('/categorias/:id', function($id){
	$categoria = new Categoria();
	$result = $categoria->remove($id);
	if($result){
		sendResult("categoria eliminada");
	}else{
		sendError("Error al eliminar la categoría");
	}
});

$app->run();