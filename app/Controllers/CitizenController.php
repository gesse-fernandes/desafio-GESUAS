<?php
namespace app\Controllers;
use app\Views\MainView;
use app\database\Mysql;
use app\Models\CitizenModels;
use app\Utilidades\Utilidades;
class CitizenController{
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

    public function index(){
        $this->main->render('citizen');
    }
    
    public  function store(){
        $conexao = $this->pdo->getInstancia();
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            if(isset($_POST['acao'])){
                if(isset($_POST['cadCid'])){
                    $name = $_POST['name'];
                    $nis = $this->citens->gerenateNIS();
                    if($this->citens->isValidNIS($nis)){
                        $this->citens->setName($name);
                        $this->citens->setNis($nis);

                      $sql = $conexao->prepare("INSERT INTO citizens(id,name,nis) values(:id,:name,:nis)");
                      $sql->bindValue(":id",$this->citens->getId());
                      $sql->bindValue(":name",$this->citens->getName());
                      $sql->bindValue(":nis",$this->citens->getNis());
                      $sql->execute();

                      $this->util->alerta("Cadastrado com Sucesso!");
                      
                      $this->util->redirect(INCLUDE_PATH);

                    }
                }
            }
        }
    }



}
