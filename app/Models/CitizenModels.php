<?php

namespace app\Models;
class CitizenModels{
    private $id;
    private $name;
    private $nis;



    public function __construct($id = null, $name=null, $nis = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nis = $nis;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getNis(){
        return $this->nis;
    }

    public function setNis($nis){
        $this->nis = $nis;
    }

    function gerenateNIS(){
        $n1 = rand(100,999);
        $n2 = rand(100,999);
        $n3 = rand(100,999);
        $n4 = rand(10,99);
        return "$n1.$n2.$n3-$n4";
      }
      function isValidNIS($nis) {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $nis);
      }
    
}
