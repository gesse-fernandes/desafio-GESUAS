<?php

namespace app\Views;

class MainView{
    public  function render($fileName, $array = null)
    {
        include('pages/'.$fileName. '.php');
    }
}