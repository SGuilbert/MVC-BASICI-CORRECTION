<?php
require_once 'libs/Controller.php';

class HelloController extends Controller
{
    public function indexAction($id = 0)
    {
        $this->getView()->setMessage('HelloController World from HelloController Controller IndexController action!');
        $this->getView()->render('views/hello/index.phtml');
    }
}