<?php
require_once 'libs/Controller.php';
require_once 'models/User.php';

class IndexController extends Controller
{

    /**
     *
     * @param int $id
     */
    public function indexAction($id = 0)
    {
        $user = new User();

        $this->getView()->setMessage('' . $id);
        $this->getView()->render('views/index/index.phtml');
    }
}