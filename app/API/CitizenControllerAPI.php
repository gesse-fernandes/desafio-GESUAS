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

