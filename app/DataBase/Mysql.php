<?php
namespace app\database;
use Exception;

class Mysql{

    private  $pdo;

    public  function getInstancia()
    {
        if($this->pdo == null)
        {
            try {
                $this->pdo = new \PDO('mysql:host=localhost;dbname=sistemaCidadao', 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (Exception $erro) {
                    echo 'erro ao conectar </br>';
                    error_log($erro->getMessage());

            }
        }
        return $this->pdo;
    }

}