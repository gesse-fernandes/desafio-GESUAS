<?php

use app\API\CitizenControllerAPI;
use PHPUnit\Framework\TestCase;
use app\Models\CitizenModels;
use app\Database\Mysql;
use app\Views\MainView;

class CitizenTest extends TestCase
{


    public function testIndex()
    {
        $con = new Mysql();
        $limite = 6;
        $offset = (1) * $limite;
        $conexao = $con->getInstancia();
        $sql = "SELECT * FROM citizens LIMIT {$limite} OFFSET {$offset}";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $array = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array[] = new CitizenModels();
        }
        $total_registros = $conexao->query("SELECT COUNT(*) as total FROM citizens")->fetchColumn();
        $total_paginas = ceil($total_registros / $limite);
        $dados = array(
            "citizens" => $array,
            "total_paginas" => $total_paginas,
            "pagina_atual" => 1
        );
        $mainView = new MainView($dados);
        $this->assertInstanceOf(MainView::class, $mainView);
    }
    public function testeStore()
    {

        $con = new Mysql();
        $citens = new CitizenModels();
        $conexao = $con->getInstancia();
        $nis = $citens->gerenateNIS();
        if ($citens->isValidNIS($nis)) {
            $citens->setName('John Doe');
            $citens->setNis($nis);

            $sql = $conexao->prepare("INSERT INTO citizens(id,name,nis) values(:id,:name,:nis)");
            $sql->bindValue(":id", $citens->getId());
            $sql->bindValue(":name", $citens->getName());
            $sql->bindValue(":nis", $citens->getNis());
            $sql->execute();

            $this->assertEquals('John Doe', $citens->getName());
        }
    }
    public function testPesquisar()
    {
        $con = new Mysql();
        $conexao = $con->getInstancia();

        // Recuperar todos os NIS da tabela
        $stmt = $conexao->prepare("SELECT nis FROM citizens");
        $stmt->execute();
        $nisArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Seleciona um NIS aleatório
        $selectedNis = $nisArray[array_rand($nisArray)];

        // Realiza a pesquisa
        $sql = $conexao->prepare("SELECT * FROM citizens where nis like :nis");
        $sql->bindValue(":nis", "%" . $selectedNis . "%");
        $sql->execute();
        $array = [];
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array[] =  new CitizenModels();
        }

        // Verifica se o NIS sorteado está presente no resultado
        $found = false;
        foreach ($array as $citizen) {
            if ($citizen->getNis() == $selectedNis) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
    }
    public function testeExisteId()
    {
        $con = new Mysql();
        $conexao = $con->getInstancia();
        $stmt = $conexao->prepare("SELECT id FROM citizens");
        $stmt->execute();
        $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $selectedId = $idArray[array_rand($idArray)];
        $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $sql->bindValue(":id", $selectedId);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $array[] = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array[] =  new CitizenModels();
        }
        $found = false;
        foreach ($array as $citizen) {
            if ($citizen->getId() == $selectedId) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
    }
    public function testSelecionaId()
    {

        $con = new Mysql();
        $conexao = $con->getInstancia();
        $sql = $conexao->prepare("SELECT id FROM citizens");
        $sql->execute();
        $idArray = $sql->fetchAll(PDO::FETCH_COLUMN);
        $selectedId = $idArray[array_rand($idArray)];
        $sql = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $sql->bindValue(":id", $selectedId);
        $sql->execute();
        $array = [];
        if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $array = new CitizenModels($row['id'], $row['name'], $row['nis']);
            }
        } else {
            $array =  new CitizenModels();
        }

        $this->assertNotEmpty($array);
    }
    public function testDelete()
    {
        $con = new Mysql();
        $conexao = $con->getInstancia();


        $stmt = $conexao->prepare("SELECT id FROM citizens");
        $stmt->execute();
        $idArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $selectedId = $idArray[array_rand($idArray)];


        $check = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $check->bindValue(":id", $selectedId);
        $check->execute();
        $this->assertTrue($check->rowCount() > 0);


        $sql = $conexao->prepare("DELETE FROM citizens where id = :id");
        $sql->bindValue(":id", $selectedId);
        $sql->execute();

        $check = $conexao->prepare("SELECT * FROM citizens where id = :id");
        $check->bindValue(":id", $selectedId);
        $check->execute();
        $this->assertTrue($check->rowCount() == 0);
    }
    public function testEditar()
    {
        $newName = "Novo Nome";
        $con = new Mysql();
        $conexao = $con->getInstancia();
        $sql = $conexao->prepare("SELECT id FROM citizens");
        $sql->execute();
        $idArray = $sql->fetchAll(PDO::FETCH_COLUMN);
        $selectedId = $idArray[array_rand($idArray)];
        $id = $selectedId;
        $name = $newName;
        if ($id && $name) {
            $sql = $conexao->prepare("UPDATE citizens SET name = :name WHERE id = $id ");
            $sql->bindValue(":name", $name);
            $sql->execute();
        }

        $sql = $conexao->prepare("SELECT name FROM citizens WHERE id = $id");
        $sql->execute();
        $citizen = $sql->fetch();
        $this->assertEquals($name, $citizen["name"]);
    }
    public function testIndexApi()
    {
        $controller = new CitizenControllerAPI();
        $result = $controller->index();
        $resultArray = json_decode($result, true);
        $this->assertNotEmpty($resultArray);
        $this->assertArrayHasKey('citizens', $resultArray);
        $this->assertArrayHasKey('total_paginas', $resultArray);
        $this->assertArrayHasKey('pagina_atual', $resultArray);
        $this->assertGreaterThan(0, count($resultArray['citizens']));
        $this->assertGreaterThan(0, $resultArray['total_paginas']);
        $this->assertGreaterThan(0, $resultArray['pagina_atual']);
    }
    public function testPesquisarApi()
    {
        $con = new Mysql();
        $conexao = $con->getInstancia();
    
    
        $stmt = $conexao->prepare("SELECT nis FROM citizens");
        $stmt->execute();
        $nisArray = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $selectedNis = $nisArray[array_rand($nisArray)];
        $_SERVER['REQUEST_METHOD'] = 'POST';
    
    
        $_POST['nis'] = $selectedNis;
        $controller = new CitizenControllerAPI();
        $result = $controller->pesquisarApi();
        $resultArray = json_decode($result, true);
        $this->assertNotEmpty($resultArray);
        $this->assertArrayHasKey('citizens', $resultArray);
        $this->assertArrayHasKey('total_paginas', $resultArray);
        $this->assertArrayHasKey('pagina_atual', $resultArray);
        $this->assertGreaterThan(0, $resultArray['total_paginas']);
        $this->assertGreaterThan(0, $resultArray['pagina_atual']);
    }
    public function testStoreApiSuccess()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['name'] = 'John Doe';

        $controller = new CitizenControllerAPI();
        $result = $controller->storeApi();
        $resultArray = json_decode($result, true);

        $this->assertArrayHasKey('status', $resultArray);
        $this->assertArrayHasKey('message', $resultArray);
        $this->assertEquals('success', $resultArray['status']);
        $this->assertStringContainsString('adicionado com sucesso.', $resultArray['message']);
    }

 
}
