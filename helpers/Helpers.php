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
    unsetFlashData();
}

function redirectBack(){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function json($data,$status=null){
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode(['data' => $data]);
}

function hashPassword(string $password){
    return md5($password);
}

function setUserSessionData(object $user){
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->name;
    $_SESSION['email'] = $user->email;
}

function isLogedIn(){
    if(isset($_SESSION['id']))
        redirectBack();
}

function setFlashData(string $key, string $value){
    $_SESSION['flash'][$key]=$value;
}

function unsetFlashData(){
    unset($_SESSION['flash']);
}

function hasFlashData(string $key){
    if(!isset($_SESSION['flash'][$key]))
        return null;
    return $_SESSION['flash'][$key]; 
}