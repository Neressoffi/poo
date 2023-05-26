<?php
require_once('games.php');
require_once('videosgames.php');
require_once('dlc.class.php');
require_once('database.class.php');
require_once('theaters.class.php');

if(!empty($_POST) && (isset($_POST['add']) || isset($_POST['edit']))){
    $url = "";
    $new = new Theater($_POST);
    if($new->isValid())
        $new->save();

    else
        $url="?plante";
    
    header('Location:resultclassvg.php'.$url);
    
    var_dump($new);
    
}elseif(!empty($_POST) && isset($_POST['supp'])){
    
    
    $new = new Theater($_POST['id']);
    $new->delete();
    
    header('Location:resultclassvg.php');
    
}


if(isset($_GET['edit']) && empty($_GET['edit'])){

    header('Location: resultclassbg.php');
    exit();
}




/*$jeu1 = new Game('cluedo', 5);




$jeu2 = new Videosgame('pc','fifa',10);



echo $jeu2->getTitle();


$ext = new Dlc('Path of fire','Guild Wars 2', '1','PC');

var_dump($ext);


$cinema = new Theater([
    'nom' => 'Avatar',
    'city' => 'paris',
    'nbrooms' => 20,
    'id' => null,
    'updated' => null,
    'created' => '2020-12-03  08:45:12'
]);

var_dump($cinema);
    $test = new Theater(1);
    var_dump($test);

   print $test->getName();
   print $test->getNbrooms();

   */
    $t = Theater::all();

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamess</title>
</head>
<body>
<h1>Games</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Nombre de salles</th>
            <th>Ville</th>
            <th>Meta-Dates</th>
            <th>Editer</th>

        </tr>
    </thead>
    <tbody>

    <?php foreach($t as $v): ?>
        <tr>
            <td><?= $v->getName(); ?></td>
            <td><?= $v->getNbrooms(); ?></td>
            <td><?= $v-> getCity();?></td>
            <td><?= $v-> getId(); ?><br>
                <?= $v-> getCreated(); ?><br>
                <?= $v-> getUpdated(); ?>
        </td>

    <td>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <button type="sumbit" name="supp">Supprimer</button>
               
                <a href="<?= $_SERVER['PHP_SELF']?>?edit=<?= $v->getId(); ?>">Editer</a>
                <input type="hidden" name="id"value="<?= $v->getId();?>">
        </form>
    </td>
        </tr>
    </tbody>
<?php endforeach;  ?>
</table>


<form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">

<p><input type="text" name="name" placeholder="Non du cinéma" required></p>

<p><input type="number" name="nbrooms" placeholder="Nombre de salles" required></p>
<p><input type="text" name="city" placeholder="Ville"></p>
<p><button type="submit" name="add">Ajouter</button></p>

</form>


<?php  
if(!empty($_GET['edit'])){
    $o= new Theater($_GET['edit']);

    ?>
<form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">
<p><input type="text" name="name" placeholder="Non du cinéma" required value="<?= $o->getName(); ?>"></p>
    <input type="hidden" name="id" value="<?= $o->getId(); ?>">
<p><input type="number" name="nbrooms" placeholder="Nombre de salles" required value="<?= $o->getNbrooms(); ?>"></p>
<p><input type="text" name="city" placeholder="Ville" value="<?= $o->getCity(); ?>"></p>
<p><button type="submit" name="edit" value="">Modifier</button></p>

</form>
<?php } ?>

    
</body>
</html>