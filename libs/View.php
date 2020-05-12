<?php

/**
 * Class View
 * En charge de la vue:
 * -selection de la vue
 * -initialisation des contenus ($contenus, $message)
 */
class View
{
    private $message = null;
    private $contenus = null;
    public function __construct()
    {
        echo 'View constructeur';
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getContenus()
    {
        return $this->contenus;
    }

    /**
     * @param array $contenus
     */
    public function setContenus($contenus)
    {
        $this->contenus = $contenus;
    }

    /**
     * @param $viewScript
     */
    public function render($viewScript)
    {
        require($viewScript);
    }
}