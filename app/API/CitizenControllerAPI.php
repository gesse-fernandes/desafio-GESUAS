<?php

namespace app\API;

use Exception;
use PDO;

class CitizenControllerAPI
{

    private static $pdo;
    public function index($pagina_atual = 1)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        if (isset($_GET["page"])) {
            $current_page = $_GET["page"];
        } else {
            $current_page = 1;
        }
        $conexao =  CitizenControllerAPI::config();
        $limite = 6;
        $offset = ($current_page - 1) * $limite;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $sql = "SELECT * FROM citizens LIMIT {$limite} OFFSET {$offset}";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            $arrayx = [];
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $arrayx[] = $row;
                }
            } else {
                $array['error'] = "Não existe dados";
            }
            $total_registros = $conexao->query("SELECT COUNT(*) as total FROM citizens")->fetchColumn();
            $total_paginas = ceil($total_registros / $limite);
            $array['result'][] = [
                "citizens" => $arrayx,
                "total_paginas" => $total_paginas,
                "pagina_atual" => $pagina_atual
            ];
        } else {
            $array['error'] = "Método não permitido (Apenas GET`)";
        }


        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }
    public function pesquisarApi($data)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $arrayx = [];
        $method = $_SERVER['REQUEST_METHOD'];

        $conexao = CitizenControllerAPI::config();
        if ($method === 'POST') {
            parse_str(file_get_contents('php://input'), $data);
            $nis = !empty($data['nis']) ? $data['nis'] : (isset($_POST['nis']) ? $_POST['nis'] : null);
            $nis = trim($nis);
            if ($nis) {
                $sql = $conexao->prepare("SELECT * FROM citizens where nis like :nis");
                $sql->bindValue(":nis", "%" . $nis . "%");
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $arrayx[] = $row;
                        $array['result'][] = [
                            "citizens" => $arrayx,
                            "total_paginas" => 1,
                            "pagina_atual" => 1
                        ];
                    }
                } else {
                    $array['error'] = "Não existe dados";
                }
            } else {
                $array['error'] = "Envie o número do NIS";
            }
        } else {
            $array['error'] = "Método não permitido (Apenas POST`)";
        }



        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }
    public static function conifgHeader()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: Application/json");
    }
    public function storeApi($data)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $conexao = CitizenControllerAPI::config();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            parse_str(file_get_contents('php://input'), $data);
            $name = !empty($data['name']) ? $data['name'] : (isset($_POST['name']) ? $_POST['name'] : null);
            $name = trim($name);
            $nis = CitizenControllerAPI::gerenateNIS();
            if ($name) {
                if (CitizenControllerAPI::isValidNIS($nis)) {


                    $sql = $conexao->prepare("INSERT INTO citizens(id,name,nis) values(:id,:name,:nis)");
                    $sql->bindValue(":id", null);
                    $sql->bindValue(":name", $name);
                    $sql->bindValue(":nis", $nis);
                    $sql->execute();

                    $array['result'][] = [
                        'message' => $name . " com o NIS: " . $nis . " adicionado com sucesso."
                    ];

                    CitizenControllerAPI::conifgHeader();
                    return json_encode($array);
                } else {


                    $array['error'] = "NIS inválido";

                    CitizenControllerAPI::conifgHeader();
                    return json_encode($array);
                }
            } else {



                $array['error'] = "Campos não enviado";
            }
        } else {
            $array['error'] = "Método não permitido (Apenas POST`)";
        }
        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }
    public function deleteApi($id)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if ($method === 'delete') {
            $id = filter_var($id);
            if ($id) {
                $conexao = CitizenControllerAPI::config();
                $sql = $conexao->prepare("DELETE FROM citizens where id = :id");
                $sql->bindValue(":id", $id);
                $result = $sql->execute();
                if ($result) {
                    $array['result'][] = [
                        'message' => "Deletado com sucesso!",
                    ];
                    CitizenControllerAPI::conifgHeader();
                    return json_encode($array);
                } else {
                    $array['error'] = "Não foi possível deletar o registro";
                    CitizenControllerAPI::conifgHeader();
                    return json_encode($array);
                }
            } else {
                $array['error'] = "Tente Novamente";
            }
        } else {
            $array['error'] = "Método não permitido (Apenas DELETE`)";
        }
        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }

    public function editarApi($data, $id)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $conexao =  CitizenControllerAPI::config();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            parse_str(file_get_contents('php://input'), $data);
            $name = !empty($data['name']) ? $data['name'] : (isset($_POST['name']) ? $_POST['name'] : null);
            $name = trim($name);
            if ($id && $name) {
                $id = filter_var($id);
                $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $sql2 = $conexao->prepare("UPDATE citizens SET name = :name WHERE id = $id ");
                    $sql2->bindValue(":name", $name);
                    $sql2->execute();
                    $array['result'][] = [
                        'message' => 'Atualizado com sucesso.',
                    ];
                } else {
                    $array['error'] = 'Não existe dados';
                }
            } else {
                $array['error'] = 'Dados inválidos.';
            }
        } else {
            $array['error'] = 'Método não permitido (Apenas POST)';
        }
        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }
    public function existeIdApi($id)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $conexao = CitizenControllerAPI::config();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            if ($id) {
                $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $array['result'][] = [
                        'exists' => true,
                        'message' => 'Encontrado',
                    ];
                } else {
                    $array['result'][] = [
                        'exists' => false,
                        'message' => 'Não existe este id',
                    ];
                }
            } else {
                $array['error'] = "ID não fornecido";
            }
        } else {
            $array['error'] = "Método não permitido (Apenas GET`)";
        }
        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
    }
    public function getIdApi($id)
    {
        $array = [
            'error' => '',
            'result' => [],
        ];
        $arrayx = [];
        $conexao = CitizenControllerAPI::config();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            if ($id) {
                $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $arrayx = $row;
                    }
                    $array['result'][] = [
                        'status' => 'success',
                        'message' => 'Dados encontrados',
                        'data' => $arrayx
                    ];
                } else {
                    $array['error'] = "Não existe dados";
                }
            } else {
                $array['error'] = "Não foi enviado o ID";
            }
        } else {
            $array['error'] = "Método não permitido (Apenas GET)";
        }
        CitizenControllerAPI::conifgHeader();
        return json_encode($array);
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
