<?php

namespace app\Controllers;

use app\Views\MainView;
use app\Database\Mysql;
use app\Models\CitizenModels;
use app\Utilidades\Utilidades;
use PDO;

class CitizenController
{
    private $main;
    private $pdo;
    private $citens;
    private $util;
    public function __construct()
    {
        $this->pdo = new Mysql();
        $this->main = new MainView();
        $this->citens = new CitizenModels();
        $this->util = new Utilidades();
    }

    public function index()
    {
        $this->main->render('citizen');
    }

    public  function store()
    {
        $conexao = $this->pdo->getInstancia();
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            if (isset($_POST['acao'])) {
                if (isset($_POST['cadCid'])) {
                    $name = $_POST['name'];
                    $nis = $this->citens->gerenateNIS();
                    if ($this->citens->isValidNIS($nis)) {
                        $this->citens->setName($name);
                        $this->citens->setNis($nis);

                        $sql = $conexao->prepare("INSERT INTO citizens(id,name,nis) values(:id,:name,:nis)");
                        $sql->bindValue(":id", $this->citens->getId());
                        $sql->bindValue(":name", $this->citens->getName());
                        $sql->bindValue(":nis", $this->citens->getNis());
                        $sql->execute();


                        $this->util->alertaAdd("$name com o NIS: $nis");
                        $this->util->redirect(INCLUDE_PATH);
                    }
                }
            }
        }
    }

    public function pesquisar($id = null)
    {

        $conexao = $this->pdo->getInstancia();
        $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $array = [];
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $array = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array =  new CitizenModels();
        }
        $dados = $array;
        return $dados;
    }

    public function existeId($id = null)
    {
        $conexao = $this->pdo->getInstancia();
        $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

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
                $this->util->redirect(INCLUDE_PATH . '/citizen?id=' . $_POST['id']);
            }
        }
    }

    public function editar()
    {
        $conexao = $this->pdo->getInstancia();
     
      
            if (isset($_POST['UpCid'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                if ($id && $name) {
                    $sql = $conexao->prepare("UPDATE citizens SET name = :name WHERE id = $id ");
                    $sql->bindValue(":name", $name);
                    $sql->execute();

                    $this->util->alertaUp("Atualizado Com sucesso");
                    $this->util->redirect(INCLUDE_PATH);
                }
            }
    }
    
}
