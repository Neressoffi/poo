<?php

class Database extends PDO{

    protected $connected = false;

    public function __construct()
    {
        if(!$this->connected){
           
            try{

                parent::__construct('mysql:host=localhost;charset=utf8;dbname=mds_2022_b3dev_classes','root','');
                $this->connected = true;

            }catch(PDOException $e){

                print 'Erreur : '.$e->getMessage();
                exit();
            }

        }
    }

    public function hydrate(array $d){
        // on sait que $d est un tableau associatif, donc on parcourt le tableau en utilisant ses clés
        foreach($d as $key => $value){
        // on constitue le nom du setter correspondant
        $setter = 'set'.ucfirst($key);
        if(method_exists($this, $setter))
            $this->$setter($value);

        }
    }

}
