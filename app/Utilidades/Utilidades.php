<?php 
namespace app\Utilidades;

class Utilidades{

    public function redirect($url){
        echo '<script>window.location.href="' . $url . '"</script>';
        die();
    }

    public function alerta($mensagem){
        echo "<script>alert('$mensagem');</script>";
   
     
    }
}
?>