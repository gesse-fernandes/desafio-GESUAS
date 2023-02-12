<?php

namespace app\Controllers;

use app\Views\MainView;
use app\Database\Mysql;
use app\Models\CitizenModels;
use app\Utilidades\Utilidades;
use PDO;

class HomeController
{
    private $main;
    private $pdo;
    private $util;
    public function __construct()
    {

        $this->pdo = new Mysql();
        $this->main = new MainView();
        $this->util = new Utilidades();
    }
    public function index($pagina_atual = 1)
    {
        if (isset($_GET["page"])) {
            $current_page = $_GET["page"];
          } else {
            $current_page = 1;
          }
        $limite = 6;
        $offset = ($current_page - 1) * $limite;
        $conexao = $this->pdo->getInstancia();
        $sql = "SELECT * FROM citizens LIMIT {$limite} OFFSET {$offset}";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $array = [];
        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array[] =  new CitizenModels();
        }
        $total_registros = $conexao->query("SELECT COUNT(*) as total FROM citizens")->fetchColumn();
        $total_paginas = ceil($total_registros / $limite);
        $dados = array(
            "citizens" => $array,
            "total_paginas" => $total_paginas,
            "pagina_atual" => $pagina_atual
        );
        $this->main->render("home", $dados);
    }
    

    public function store(){

    }
    public function pesquisar($nis = null){
        
        $conexao = $this->pdo->getInstancia();
        $sql = $conexao->prepare("SELECT * FROM citizens where nis like :nis");
        $sql->bindValue(":nis", "%" . $nis . "%");
        $sql->execute();
        $array = [];
        if ($sql->rowCount() > 0) {
            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array[] =  new CitizenModels();
        }
        $dados = array(
            "citizens" => $array,
            "total_paginas" => 1,
            "pagina_atual" => 1
        );
        return $dados;
    }
    public function existeId($id = null){}
    public function delete()
    {

        if (isset($_POST['deletar'])) {

            $id = $_POST['id'];
            if ($id) {
                $conexao = $this->pdo->getInstancia();
                $sql = $conexao->prepare("DELETE FROM citizens where id = :id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                $this->util->alertaDelete("Deletado com sucesso!");
                $this->util->redirect(INCLUDE_PATH);
            } else {
                $this->util->erro("Tente Novamente");
                $this->util->redirect(INCLUDE_PATH);
            }
        }
    }
    public function editar(){}
}
