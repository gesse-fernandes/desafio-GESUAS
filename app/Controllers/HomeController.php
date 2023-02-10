<?php

namespace app\Controllers;

use app\Views\MainView;
use app\database\Mysql;
use app\Models\CitizenModels;
use PDO;

class HomeController
{
    private $main;
    private $pdo;
    public function __construct()
    {

        $this->pdo = new Mysql();
        $this->main = new MainView();
    }
    public function index()
    {
        $conexao = $this->pdo->getInstancia();
        $sql = "SELECT * FROM citizens";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $array = [];
        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
          
        } else {
            $array[] = array();
        }
        $this->main->render("home", $array);
    }
}
