<?php

include "bootstrap/Init.php";

$router = new App\Core\Routing\Router();

$className = "App\\Core\\Database\\Drivers\\" . ucfirst($_ENV['DB_DRIVER']).'Driver';
$mysqlDriver = new $className();

App\Core\Database\Model::setDatabase($mysqlDriver);


$router->handle();