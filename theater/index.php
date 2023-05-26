<?php
require_once('Database.php');
require_once('theater.php');

//Add button
if(!empty($_POST)&& (isset($_POST['add'])) || isset($_POST['update'])){
    $url= "";
    $t = new Theater($_POST);
    if($t->isValid())
        $t->save();
    else{
        $url = "?error=1";
    }
    
    header('Location: index.php'.$url);
    exit();
    
}
//Delete button
elseif(!empty($_POST)&& isset($_POST['delete'])){
    $t = new Theater($_POST['id']);
    $t->delete();
    
    header('Location: index.php');
    exit();
}
//Update button


// Condition edit url
if(isset($_GET['edit']) && empty($_GET['edit'])){
    header('Location: index.php');
    exit();}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
</head>
<body>
    <?php
    $t = Theater::all();
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Nombre de salles</th>
                <th>Ville</th>
                <th>méta-datas</th>
                <th>Action</th>
            </tr>
        </thead>

    <tbody>
        <?php foreach($t as $v): ?>
            <tr>
                <td> <?= $v->getId()?></td>
                <td><?= $v->getName()?></td>
                <td><?= $v->getNbRooms()?></td>
                <td><?= $v->getCity()?></td>
                <td>
                    <br />
                    <?= $v->getCreated()?> <br />
                    <?= $v->getUpdated()?> 
                </td>
                <td>
                <!-- form button delete -->
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $v->getId()?>">
                    <input type="submit" name="delete" value="Supprimer">
                </form>
        </td>
                <!-- form update -->
                <td>
                
            <!-- a href get Id location  -->
            <a href="index.php?edit=<?= $v->getId()?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <h1>Formulaire</h1>
   <!-- Create a formulaire for poo database -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="name" id="name" placeholder ="Nom de cinéma" required>
        <br />
        <input type="number" name="nbrooms" placeholder="Nombre de salles" required>
        <br />
        <input type="text" name="city" id="city" placeholder="Nom de la ville" required>
        <br />
        <button type="submit" name="add">ajouter</button>
    </form>

   <?php if(!empty($_GET['edit'])): 
    $o = new Theater($_GET['edit']);?>
    <h1>Modifier</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="id" value="<?= $o->getId() ?>">
        <input type="text" name="name" id="name" placeholder ="Nom de cinéma" value="<?= $o->getName()?>">
        <br />
        <input type="number" name="nbrooms" placeholder="Nombre de salles" value ="<?= $o->getNbRooms()?>">
        <br />
        <input type="text" name="city" id="city" placeholder="Nom de la ville"  value ="<?= $o->getCity()?>" >
        <br />
        <button type="submit" name="update">ajouter</button>
    </form>
    <?php endif; ?>
</body>
</html>