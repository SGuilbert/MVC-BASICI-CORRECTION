<?php
require_once 'libs/Controller.php';

class ErrorController extends Controller
{
    public function IndexAction()
    {
        $this->getView()->setMessage("The controller doesn't exist!") ;
        $this->getView()->render('views/error/index.phtml');
    }
}