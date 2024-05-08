<?php
define('BASE_PATH', __DIR__ . "/../");
session_start();

include BASE_PATH . "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$request=new App\Core\Request;
include BASE_PATH . "helpers/Helpers.php";
include BASE_PATH . "routes/web.php";
include BASE_PATH . "routes/api.php";



