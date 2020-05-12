<?php

require_once 'View.php';

class Controller
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }
    public function getView(){
        return $this->view;
    }
}