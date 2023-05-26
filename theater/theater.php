<?php
    class Theater extends Database{

    protected $id;
    protected $created;
    protected $updated;
    protected $name;
    protected $nbrooms;
    protected $city;

    public function __construct($d){
           parent::__construct();

           if(is_array($d)){
            $this->hydrate($d);
         }
          else if(is_int($d) || (int) $d>0){
               $d=(int)$d;
               $r = $this->prepare('SELECT * FROM theaters WHERE id = :i');
               $r->execute([':i' => $d]);
               
               if($r->rowCount() > 0)
               $this->hydrate($r->fetch(PDO::FETCH_ASSOC));	
               
               
            }
            //
    }

    // SET
    public function setId($id){
        $this->id = (int)$id;
    }

    public function setCreated($created){
        $this->created = (string)$created;
    }

    public function setUpdated($updated){
        $this->updated =(string)$updated;
    }
    public function setName($n){
        $this->name = (string)$n;
    }

    public function setNbrooms($nb){
        $this->nbrooms = ((int) $nb > 0 )? (int) $nb : null;
    }

    public function setCity($c){
        $this->city = ucfirst(strtolower($c));
    }

    // GET

    public function getId(){
        return $this->id;
    }

    public function getCreated(){
       $d = new DateTime($this->created);
         return $d->format('d/m/Y h:i:s' );
    }

    public function getUpdated(){
        $d = new DateTime($this->updated);
        return $d->format('d/m/Y h:i:s' );
    }

    public function getName(){
        return $this->name;
    }

    public function getNbRooms(){
        return $this->nbrooms;
    }

    public function getCity(){
        return $this->city;
    }

public function save(){
    if(empty($this->id)){
        $r = $this->prepare('INSERT INTO theaters (name, nbrooms, city, created) VALUES (:n, :nb, :c, NOW())');
        $r->execute([
            ':n' => $this->name,
            ':nb' => $this->nbrooms,
            ':c' => $this->city
        ]);
        $this->id = $this->lastInsertId();
        $this->created = date('Y-m-d H:i:s');
    }
    else{
        $r = $this->prepare('UPDATE theaters SET name = :n, nbrooms = :nb, city = :c, updated = NOW() WHERE id = :i');
        $r->execute([
            ':n' => $this->name,
            ':nb' => $this->nbrooms,
            ':c' => $this->city,
            ':i' => $this->id
        ]);
        $this->updated = date('Y-m-d H:i:s');
    }
}

public function isValid(){
    if(empty($this->name) || strlen($this->name) >50 || empty($this->nbrooms) || empty($this->city) || strlen($this->city) > 50){ 
        return false;
    }
    return true;
}

public function delete(){
    if(!empty($this->id)){
        $r = $this->prepare('DELETE FROM theaters WHERE id = :i');
        $r->execute([':i' => $this->id]);
        $this->id = null;
    }
}

    public static function all(){
        $sql = new Database();

        $tAll = [];

        // on recup toutes les lignes
        $r= $sql->prepare('SELECT * FROM theaters 
            ORDER BY CURDATE() - created ASC');
        $r->execute();    

        while($one = $r-> fetch(PDO::FETCH_ASSOC)){
           array_push($tAll, new Theater($one));
        }

        return $tAll;
    }
}

