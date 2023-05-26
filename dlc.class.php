<?php 

class Dlc extends  Videosgame{


    protected $addon;

    public function __construct($addon ,$title, $nbplayers,$plateform)
    {
        parent::__construct($plateform,$title,$nbplayers);
        $this->setAddon($addon);
    }

    public function setAddon($n){

        $this->addon =(string)$n;
    }

    public function getAddon(){
        return $this->addon;
    }
}