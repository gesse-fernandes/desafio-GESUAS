<?php

namespace app\API;

use Exception;
use PDO;

class CitizenControllerAPI
{

    private static $pdo;
    public function index($pagina_atual = 1)
    {
        if (isset($_GET["page"])) {
            $current_page = $_GET["page"];
        } else {
            $current_page = 1;
        }
        $conexao =  CitizenControllerAPI::config();
        $limite = 6;
        $offset = ($current_page - 1) * $limite;

        $sql = "SELECT * FROM citizens LIMIT {$limite} OFFSET {$offset}";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $array = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array[] = $row;
            }
        } else {
            $array[] = array();
        }
        $total_registros = $conexao->query("SELECT COUNT(*) as total FROM citizens")->fetchColumn();
        $total_paginas = ceil($total_registros / $limite);
        $dados = array(
            "citizens" => $array,
            "total_paginas" => $total_paginas,
            "pagina_atual" => $pagina_atual
        );
        header('Content-Type: application/json');
        return json_encode($dados);
    }
    public function pesquisarApi()
    {
        $array = [];
        $method = $_SERVER['REQUEST_METHOD'];
        $conexao = CitizenControllerAPI::config();
        if ($method === 'POST') {
            $nis = filter_input(INPUT_POST, 'nis');
        }
        if ($nis) {
            $sql = $conexao->prepare("SELECT * FROM citizens where nis like :nis");
            $sql->bindValue(":nis", "%" . $nis . "%");
            $sql->execute();
            if ($sql->rowCount() > 0) {
                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $array[] = $row;
                }
            } else {
                $array[] = array();
            }
        }
        $dados = array(
            "citizens" => $array,
            "total_paginas" => 1,
            "pagina_atual" => 1
        );
        return json_encode($dados);
    }
    public function storeApi()
    {
        $conexao = CitizenControllerAPI::config();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $name =$_POST['name'];
            $nis = CitizenControllerAPI::gerenateNIS();
            if (CitizenControllerAPI::isValidNIS($nis)) {


                $sql = $conexao->prepare("INSERT INTO citizens(id,name,nis) values(:id,:name,:nis)");
                $sql->bindValue(":id", null);
                $sql->bindValue(":name", $name);
                $sql->bindValue(":nis", $nis);
                $sql->execute();

                $response = array();
                $response['status'] = 'success';
                $response['message'] = $name . " com o NIS: " . $nis . " adicionado com sucesso.";
                return json_encode($response);
            } else {
                $response = array();
                $response['status'] = 'error';
                $response['message'] = 'NIS inválido';
                return json_encode($response);
            }
        }
    }
    public static function  gerenateNIS()
    {
        $n1 = rand(100, 999);
        $n2 = rand(100, 999);
        $n3 = rand(100, 999);
        $n4 = rand(10, 99);
        return "$n1.$n2.$n3-$n4";
    }
    public static function isValidNIS($nis)
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $nis);
    }



    public static function config()
    {

        if (self::$pdo == null) {
            try {
                self::$pdo = new \PDO('mysql:host=localhost;dbname=sistemaCidadao', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (Exception $erro) {
                echo 'erro ao conectar </br>';
                error_log($erro->getMessage());
            }
        }
        return self::$pdo;
    }
}
