<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';
	include_once '../include/statestique.php';


	$tableau_offres = recuperer_offres_tout();
	$offre = null;
	 

	if (!admin_est_connecter()) {
		header('location:login.php');
	}

	if (isset($_GET['voir']) && isset($_GET['id_offre'])) {
		$offre = offre_recuperer( $_GET['id_offre'] );
	}

	if (isset($_GET['supprimer']) && isset($_GET['id_offre'])) {
		$offre = offre_supprimer( $_GET['id_offre'] );
		header("location:gestion_offres.php");
	}

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
			<li><a href="gestion_utilisateur.php">Gestion des Utilisateurs</a></li>
			<li ><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li  class='active' ><a href="gestion_offres.php">Gestion des Offres</a></li>
			<li><a href="gestion_reclamation.php">Gestion des Reclamations</a></li>

		</ul>

	    <ul class="nav navbar-nav navbar-right">
	    	<?php if (client_est_connecter() ) { ?>
	      		<li><a href="login.php?deconnecter"><span class="glyphicon glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
	      	<?php } else {  ?>
	      		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
	      	<?php } ?>

	    </ul>
	  </div>
	</nav>

	<div class='container'>

		<?php if ( $offre != null ) { ?>
			<div class="row"> 
				<h2>Détails de l'offre : <?php echo $offre['id']; ?></h2>
				<a href="gestion_offres.php?supprimer&id_offre=<?php echo $offre['id']?>">Supprimer</a>
				<?php

					echo "<p>Identificant : ".$offre['id']."</p>";
				    echo "<p>De la demande : <a href='gestion_demandes.php?voir&id_demande=".$offre['id_demande']."'>".$offre['id_demande']."</a></p>";
				    echo "<p>Titre : ".$offre['titre']."</p>";
				    echo "<p>Description : ".$offre['description']."</p>";
				    echo "<p>Traget : ".$offre['source']." à ".$offre['destination']."</p>";
				    echo "<p>Crée par : ".$offre['id_client']."</p>";
				    echo "<p>Le : ".$offre['date_creation']."</p>";
				?>

			</div>
			<hr>
		<?php } ?>


		<h1>La liste des offres:</h1>
		<br>
		<div class='row'>

			<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>Identifiant</th>
			        <th>Titre</th>
			        <th>Source</th>
			        <th>Destination</th>
			        <th>Crée par</th>

			       	<th>date d'ajout</th>
			       	<th>Action</th>
			      
			      </tr>
			    </thead>

			    <tbody>

				    <?php
				     foreach ($tableau_offres as $offre) {
				     	echo "<tr>";
				     	echo "<td>".$offre['id']."</td>";
				     	echo "<td>".$offre['titre']."</td>";
				     	echo "<td>".$offre['source']."</td>";
				     	echo "<td>".$offre['destination']."</td>";
				     	echo "<td>".$offre['id_client']."</td>";
				     	echo "<td>".$offre['date_creation']."</td>";
				     	echo "<td>";
				     	echo "<a href='gestion_offres.php?voir&id_offre=".$offre['id']."' >Voir</a>&nbsp;";
				     	echo "<a href='gestion_offres.php?supprimer&id_offre=".$offre['id']."' >Supprimer</a>";
				     	echo "</td>";
				     	echo "</tr>";
				     }


				    ?>

			    </tbody>
			  </table>

		</div>

	</div>

		






</body>
</html>
