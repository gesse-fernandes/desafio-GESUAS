<?php
//aqui é o arquivo de rotas para a API EndPoints:  /store,/pesquisar, /delete/id, /edit/id, /indexOne/id, /existeId/id
use app\API\CitizenControllerAPI;

$route = $_GET['route'] ?? 'index';
require("CitizenControllerAPI.php");
$citizenControllerAPI = new CitizenControllerAPI();
$data = json_decode(file_get_contents('php://input'), true);
switch ($route) {

    case 'index':
        echo $citizenControllerAPI->index();
        break;
    case 'store':
        echo $citizenControllerAPI->storeApi($data);
        break;
    case 'pesquisar':
        echo $citizenControllerAPI->pesquisarApi($data);
        break;
    case 'delete':
        $id = $_GET['id'] ?? null;
        echo $citizenControllerAPI->deleteApi($id);
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        echo $citizenControllerAPI->editarApi($data, $id);
        break;
    case 'indexOne':
        $id = $_GET['id'] ?? null;
        echo $citizenControllerAPI->getIdApi($id);
        break;
    case 'existeId':
        $id = $_GET['id'] ?? null;
        echo $citizenControllerAPI->existeIdApi($id);
        break;
}
