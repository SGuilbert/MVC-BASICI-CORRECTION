<?php

/**
 * Class Application
 * Point de départ de l'application
 *   -gère le routage (instancier le bon controller en fonction de l'URL)
 *   -gère le dispatching (exécuter la bonne action du controller)
 * @TODO definir des constantes de config (répertoires...)
 */

class Application
{
    private $controller = null;
    private $action = null;
    private $params = null;

    public function __construct()
    {
        /*$controllerDirectory = $_SERVER['DOCUMENT_ROOT'] . '/controllers/'; // emplacement par défaut de nos controllers
        // 1. router
        $tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));

        // 2. Dispatcher
        $controllerName = ucfirst($tokens[1]).'Controller'; // construction du nom de la classe
        // vérification de l'existence d'un controller pour l'url demandée

        if (isset($tokens[1]) && file_exists($controllerDirectory. $controllerName . '.php')) {

            require_once($controllerDirectory . $controllerName . '.php'); // inclusion de la classe (meme nom de fichier que la classe)
            $controller = new $controllerName; // instanciation du controller
            if (isset($tokens[2])) {//l'action existe? (url complète)
                $actionName = $tokens[2] . 'Action'; // construction du nom de la fonction action
                if (isset($tokens[3])) {//Y-a-t-il un parametre?
                    $controller->{$actionName}($tokens[3]); // passage du paramètre à la méthode
                } else { // pas de paramètre dans l'URL
                    $controller->{$actionName}(); // appel de la méthode sans paramètre
                }
            } else { // pas d'action dans l'URL
                // default action
                $controller->IndexAction();
            }
        } else {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/ErrorController.php');
            $controllerName = 'ErrorController';
            $controller = new $controllerName;
            $controller->IndexAction();
        }*/
        $this->parseURL();
        $this->route();
        $this->dispatch();

    }

    /**
     * Decoupe l'url
     * initialise les attributs controller, action, params
     */
    private function parseURL(){
        $tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
        if(isset($tokens[1])){//le parametre controller existe dans l'url
            $this->controller = $tokens[1];
            if (isset($tokens[2])){//le parametre action existe dans l'url
                $this->action=$tokens[2];
                if (isset($tokens[3])){
                    $params = $tokens[3];
                }
            }
            else{//pas de parametre action => index
                $this->action = 'index';
            }
        }
        else{//pas de parametre controller=> index
            $this->controller = 'index';
        }
    }

    /**+
     * instancie le controller
     *  -reconstruit le nom
     *  -vérifie l'existence de la classe
     *  -instancie le controller adhoc dans l'attribut controller
     */
    private function route(){
        $controllerDirectory = $_SERVER['DOCUMENT_ROOT'] . '/controllers/'; // emplacement par défaut de nos controllers
        $this->controller .= 'Controller'; // on complete pour coller à la convention de nommage
        if (file_exists($controllerDirectory. $this->controller . '.php')){
            require_once($controllerDirectory . $this->controller . '.php'); // inclusion de la classe (meme nom de fichier que la classe)
            $this->controller = new $this->controller;
        }
        else{
            $this->error('Controller not found');
        }
    }

    /**
     * -reconstruit le nom
     * -verifie l'existance de la méthode correspondant à l'action
     * -execute la méthode et lui passe les paramètres
     */
    private function dispatch(){
        $this->action = $this->action . 'Action';// on complete pour coller à la convention de nommage
        if (method_exists($this->controller,$this->action)){
            if($this->params){
                $this->controller->{$this->action}($this->params);
            }
            else{
                $this->controller->{$this->action}();
            }
        }
        else{
            $this->error('actionMethod does not exists');
        }
    }

    private function error($message){
        echo "<h1>{$message}</h1>";
    }
}