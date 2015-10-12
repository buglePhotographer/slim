<?php

function sendResult($data){
	header('Content-Type: application/json; charset=utf-8');
    $result['error'] = false;
    $result['data'] = $data;
    die(json_encode($result));
}

function sendError($error){
	header('Content-Type: application/json; charset=utf-8');
    http_response_code(400);
    $result["error"] = true;
    $result["message"] = $error;
    die(json_encode($result));
}