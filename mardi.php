<?php

require_once('database.class.php');
require_once('theaters.class.php');

if(!empty($_POST) && isset($_POST['add']))
	else if (!empty($_POST)&& isset($_POST['delete']))
	else if (!empty($_POST)&& isset($_POST['edit'])){	
	$new = new Theater($_POST);
     $new ->save();
	 $o=new Theater($_POST)
	 header('Location: mardi.php');
	 exit();
	//var_dump($new);
	
}
else if (!empty($_POST)&& isset($_POST['delete'])){
	$d = new Theader($_POST['id']);
	$d->delete();

	header('Location: mardi.php');
	exit();
}

else if (!empty($_POST)&& isset($_POST['modify'])){
	$d = new Theader($_POST['id']);
	$d->delete();

	header('Location:mardi.php');
	exit();
}


?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Theaters</title>
</head>
<body>
	<h1>Theaters</h1>
	<?php

	/*$t1 = new Theater([
		'name' => 'UGC Bercy',
		'nbrooms' => 19,
		'city' => 'Paris',
		'plop' => 'titi'
	]);

	var_dump($t1);


	echo $t1->getCreated();


	$azerty = new Theater(1);
	$azerty2 = new Theater(10);

	var_dump($azerty);
	var_dump($azerty2);
*/
	$t = Theater::all();

	 ?>
	 <table>
	 	<thead>
	 		<tr>
	 			<th>Nom</th>
	 			<th>Nombre de salles</th>
	 			<th>Ville</th>
	 			<th>Meta-datas</th>
	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php foreach($t as $v): ?>
	 			<tr>
	 				<td><?= $v->getName() ?></td>
	 				<td><?= $v->getNbrooms() ?></td>
	 				<td><?= $v->getCity() ?></td>
	 				<td>
	 					<?= $v->getId() ?><br />
	 					<?= $v->getCreated() ?><br />
	 					<?= $v->getUpdated() ?>
	 				</td>
	 			</tr>
				
	 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		 <input type="hidden" name="id" value ="<?=$v->getId()?>">
		 	 <button type="submit" name="delete">Supprimer</button>
		 
			  </form >
			  </td>
			  </tr>

			  <?php if(!empty($_GET['edit']));
			  $o=new theater($_GET['edit']);?>

<h2>Modifier</h2>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		 <input type="hidden" name="id"value="<?= $o->getId()?>">
		 <p><input type="text" name="nbrooms" placeholder="Nombre de salles" required></p>
		 <p><input type="text" name="city" placeholder="Ville"></p>
		 <p><button type="submit" name="add">Modifier</button></p>
	



			  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		 <p><input type="text" name="name" placeholder="Nom du cinéma" required></p>
		 <p><input type="number" name="nbrooms" placeholder="Nombre de salles" required></p>
		 <p><input type="text" name="city" placeholder="Ville"></p>
		 <p><button type="submit" name="add">Modifier</button></p>
	
		</form>
	 		<?php endforeach; ?>
	 	</tbody>
	 </table>
	 <h2>Ajout d'un ciné</h2>
	 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		 <p><input type="text" name="name" placeholder="Nom du cinéma" required></p>
		 <p><input type="number" name="nbrooms" placeholder="Nombre de salles" required></p>
		 <p><input type="text" name="city" placeholder="Ville"></p>
		 <p><button type="submit" name="add">Ajouter</button></p>
		</form>
</body>
</html>
