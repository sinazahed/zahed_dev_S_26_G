<?php

function siteUrl($route){
    return $_ENV['BASE_URL'] . $route;
}

function notFound(){
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    view('errors.404');
    die();
}

function view($path, $data=[]){
    extract($data);
    $path=str_replace('.', '/', $path);
    include_once BASE_PATH . "views/$path.php";
}

function redirectBack(){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function json($data,$status=null){
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode(['data' => $data]);
}