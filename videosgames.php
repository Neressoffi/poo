<?php

class videogames extends Games{
public $platform;
public function_construct($p,$t=null,$n=null){
    parent::_construct($t,$n);
    $this->setplatform($p);
}
public function setplatform($n){
    $this->platform=(string) $n;
}
public function getplatform(){
    return $this->platform;

    }
}




