<?php

use app\Application;


date_default_timezone_set("America/Sao_Paulo");

require('vendor/autoload.php');
define("INCLUDE_PATH", "http://localhost/desafio-GESUAS/");
define("INCLUDE_PATH_STATIC", "http://localhost/desafio-GESUAS/app/Views/pages/");

$app = new Application();
$app->run();
