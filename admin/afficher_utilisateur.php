<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';
	include_once '../include/statestique.php';

	if (!admin_est_connecter()) {
		header('location:login.php');
	}

	if (!isset($_GET['id_client'])) {
		header('location:gestion_utilisateur.php');
	}

	if (isset($_GET['activer'])) {
		client_changer_active($_GET['id_client'],$_GET['activer']);
	}

	if (isset($_GET['supprimer'])) {
		demande_supprimer($_GET['id_demande']);
	}

	$client = client_recuperer_info_par_id($_GET['id_client']);

	$client_demandes = demande_recuprer_demande_client($_GET['id_client']);

	$client_avis= avis_recuprer_avis_utilisateur($_GET['id_client']);
	 

?>
<html>
	<head>
		<title>Admin</title>
		<meta charset="UTF-8"> 
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="../js/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
<body>


	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Opendevilery: Administration |</a>
	    </div>
	    <ul class="nav navbar-nav">

		   <li ><a href="index.php">Tableau de board</a></li>
			<li class='active' > <a href="gestion_utilisateur.php">Gestion des Utilisateurs</a></li>
			<li><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li><a href="gestion_offres.php">Gestion des Offres</a></li>
			<li><a href="gestion_reclamation.php">Gestion des Reclamations</a></li>

		</ul>

	    <ul class="nav navbar-nav navbar-right">
	    	<?php if (admin_est_connecter()) { ?>
	      		<li><a href="login.php?deconnecter"><span class="glyphicon glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
	      	<?php } else {  ?>
	      		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Se Connecter</a></li>
	      	<?php } ?>

	    </ul>
	  </div>
	</nav>

	<div class='container'>


		<h1> Détails de l'utilisateur :<?=$client['prenom']?> &nbsp; <?=$client['nom']?></h1>
		<br><br>

		<?php if ($client['active']==1):?>
		<a href="afficher_utilisateur.php?activer=0&id_client=<?=$client['id']?>" class='btn btn-danger'> Désactiver</a><br><br>
		<?php else:?>
		<a href="afficher_utilisateur.php?activer=1&id_client=<?=$client['id']?>" class='btn btn-success'> Activer</a><br><br>
		<?php endif?>

		<div class="row">
			<div class="col-md-4">
				<b>Nom</b> : <?=$client['nom']?> <br>
				<b>Prénom</b> : <?=$client['prenom']?>  <br>
				<b>E-mail</b> : <?=$client['email']?>  <br>
				<b>Sexe	</b> : <?=$client['sexe'] == 0 ? 'Homme' : 'Femme' ?>  <br>
				<b>Adresse</b> : <?=$client['adresse']?>  <br>
				<b>Téléphone</b> : <?=$client['telephone']?>  <br>
			</div>

			<div class="col-md-4" >
				CIN<br>
				<img src="../<?=$client['cin']?>" width=120px> <br>

				
			</div>

			<div class="col-md-4" >
				Photo de profil<br>	
				<img src="../<?=$client['photo']?>" width=120px> <br>

			</div>
		</div>

		

		<hr>
		<h2>Les demandes de cet utilisateur</h2>
		<hr>
		<?php

		if (count($client_demandes) ==0 ) {
			echo "Pas de demandes.";
		}
		foreach ($client_demandes as $demande) {

			$client = client_recuperer_info_par_id($demande['id_client']) ;
			echo"<div class='row demande'>";
				echo "<div class='col col-md-10'>";
					echo "<h4>".$demande['titre']."</h4> ";
					echo "<h6> De <i>".$demande['source']."</i> à <i>".$demande['destination']."</i> </h6>";
					echo "<h6> A livrer le : ".$demande['date_livraison']."</h6>";
					echo "<p>".$demande['description']."  </p>";
				echo "</div>";
			
			echo "<div class='col col-md-2'> <a class='btn btn-danger' href ='afficher_utilisateur.php?&id_client=".$client['id']."&supprimer&id_demande=".$demande['id']."'> <span class='glyphicon glyphicon glyphicon-trash'></span>  Supprimer</a> </div>" ;

			echo"</div>";
			echo "<hr>";
		}
		?>
			

	</div> 
			
			
	</div>


		
		 
		
		

	</div>

		






</body>
</html>
