<?php
namespace  app;

class Application{
    private $controller;

    private function setApp()
    {
        $loadName = 'app\Controllers\\';
        $url = explode("/",@$_GET['url']);
       
        
        
        if($url[0]=='')
        {
            $loadName.='Home';
        }else{
            $loadName.=ucfirst(strtolower($url[0]));
        }
        $loadName.='Controller';

        if(file_exists($loadName . '.php'))
        {
            $this->controller = new $loadName();
        }else{
            include('Views/pages/404.php');
            die();
        }

    }
    public function run()
    {
        $this->setApp();
        $this->controller->index();
        $this->controller->store();
        $this->controller->pesquisar();
        $this->controller->existeId();
        $this->controller->delete();
        $this->controller->editar();
    }
}
