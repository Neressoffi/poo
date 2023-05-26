<?php Class Theater extends Database{

protected $id;
protected $created;
protected $updated;
protected $name;
protected $nbrooms;
protected $city;


public function __construct($d){
    parent::__construct();

    if(is_array($d)){
        /*
        $this->setId($d['id']);
        $this->setCreated($d['created']);
        $this->setUpdated($d['updated']);
        $this->setName($d['name']);
        $this->setNbrooms($d['nbrooms']);
        $this->setCity($d['city']);
        */
        $this->hydrate($d);
    }
    elseif( is_int($d) || (int) $d > 0){

        $r = $this->prepare("SELECT * FROM `theaters` WHERE id = :i");
        $r->execute([':i' => $d]);

        if($r->rowCount() > 0 ){
            $this->hydrate($r->fetch(PDO::FETCH_ASSOC));
        }
    }
    //si on a un resultat 
}

            public function setId($d){
                $this->id = (int) $d;
            }
            public function setCreated($d){
                $this->created = (string) $d;
            }
            public function setUpdated($d){
                $this->updated = (string) $d;
            }
            public function setName($d){
                $this->name = (string) $d;
            }
            public function setNbrooms($d){
                $this->nbrooms = (int) $d;
            }
            public function setCity($d){
                $this->city = (string) $d;
            }


            public function getId(){
                return $this->id;
            }
            public function getCreated(){
                $d = new DateTime($this->created);
                return $d->format('d/m/Y h:i:s');
            }
            public function getUpdated(){
                $d = new DateTime($this->updated);
                return $d->format('d/m/Y h:i:s');
            }
            public function getName(){
                return $this->name;
            }
            public function getNbrooms(){
                return $this->nbrooms;
            }
            public function getCity(){
                return $this->city;
            }
            //function sauvegarde
        public function save(){
            if(empty($this->id)){
               $n= $this->prepare('INSERT INTO theaters (name,nbrooms,city) VALUES (:name,:nbrooms,:city)');
               $n->execute([':name'=>$this->name,':nbrooms' =>$this->nbrooms,
               ':city'=>$this ->city]);

            }
        }



        public function delete(){
            
               $n= $this->prepare('DELETE FROM theaters WHERE id=:i');
               $n->execute([':i'=>$this->id]);
        }


               public function modifier(){
            
                $n= $this->prepare('UPDATE theaters SET WHERE id=:i');
                $n->execute([':i'=>$this->id]);
 
               }


            public static function all(){
                
                //On crée une isntance de BDD

                $sql = new Database();
                $tALL = [];

                //On recup toutes les lignes 
                $r = $sql->prepare('SELECT * FROM `theaters` ORDER BY name;');
                $r->execute();

                while($one = $r->fetch(PDO::FETCH_ASSOC)){

                    array_push($tALL, new Theater($one));
                }

                return $tALL;

            }

    //$r =$sql->prepare('DELECT FROM `theaters`where );
    //$r->execute();   

}
