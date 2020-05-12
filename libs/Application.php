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
    public function __construct()
    {
        $controllerDirectory = $_SERVER['DOCUMENT_ROOT'] . '/controllers/'; // emplacement par défaut de nos controllers
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
        }
    }
}