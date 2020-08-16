<?php
	//connexion à la base de données
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=goldenfleece;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
	
	
	//ajout d'un nouveau membre
	if(isset($_POST['add'])) {
		$name = strip_tags($_POST['name']);
		$reqInsert = $db->prepare("INSERT INTO argonauts (name) VALUES (:name)");
		$reqInsert->execute(array('name'=> $name));	
	}
	
	//récupération de la liste des membres
	$liste="";
	$reqSelect="SELECT * FROM argonauts";
	$reponse = $db->query('SELECT * FROM argonauts');
	while ($donnees = $reponse->fetch()){
		$liste.="<div class=\"member-item\">".$donnees['name']."</div>";
	}
	$reponse->closeCursor(); 
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Golden fleece</title>
		<link rel="stylesheet" href="crew.css" />
	</head>

	<body> 
		<header>
		<h1>
			<img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
			Les Argonautes
		</h1>
		</header>

		<main>
		<h2>Ajouter un(e) Argonaute</h2>
		<form class="new-member-form" action="" method="post">
			<label for="name">Nom de l&apos;Argonaute</label>
			<input id="name" name="name" type="text" placeholder="Charalampos" />
			<button type="submit" name='add'>Envoyer</button>
		</form>
		
		<h2>Membres de l'équipage</h2>
		<section class="member-list">
			<?php echo $liste; ?>
		</section>
		</main>

		<footer>
		<p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
		</footer>

	</body>
</html>