<?php
use app\Application;

session_start();

date_default_timezone_set("America/Sao_Paulo");

require('vendor/autoload.php');
define("INCLUDE_PATH_STATIC", "http://localhost/SistemaCidadao/app/Views/pages/");
define("INCLUDE_PATH","http://localhost/SistemaCidadao/");
$app = new Application();
$app->run();

?>