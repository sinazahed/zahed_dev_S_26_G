<?php

function siteUrl($route){
    return $_ENV['BASE_URL'] . $route;
}

function assetUrl($route){
    return site_url("assets/" . $route);
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