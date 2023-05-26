
<?php 

class Game {

    protected $title;
    protected $nbplayers;

    //Constructeur
    public function __construct($title = null, $nbplayers = null){

        $this->setTitle($title);
        $this->setNbplayers($nbplayers); // condition sous forme d'opératuer ternaire 

    }

    //Accesseurs 
    public function setTitle($n){

        $this->title = ucfirst(strtolower($n));
    }
    public function setNbplayers($n){

        $this->nbplayers = ((int)$n > 0) ? (int) $n : null; 
    }

    public function getTitle(){

        return $this->title;
    }

    public function getNbplayers(){

        return $this->nbplayers;
    }
}

