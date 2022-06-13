<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';
	include_once '../include/statestique.php';


	$tableau_demandes = demande_recuprer_tout();
	$demande = null;
	 

	if (!admin_est_connecter()) {
		header('location:login.php');
	}

	if (isset($_GET['voir']) && isset($_GET['id_demande'])) {
		$demande = demande_recuperer( $_GET['id_demande'] );
	}

	if (isset($_GET['supprimer']) && isset($_GET['id_demande'])) {
		$demande = demande_supprimer( $_GET['id_demande'] );
		header("location:gestion_demandes.php");
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
			<li class='active' ><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li><a href="gestion_offres.php">Gestion des Offres</a></li>
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

		<?php if ( $demande != null ) { ?>
			<div class="row"> 
				<h2>Détails de la demande : <?php echo $demande['id']; ?></h2>
				<a href="gestion_demandes.php?supprimer&id_demande=<?php echo $demande['id']?>">Supprimer</a>
				<?php
					echo "<p>Identificant : ".$demande['id']."</p>";
				    echo "<p>Titre : ".$demande['titre']."</p>";
				    echo "<p>Description : ".$demande['description']."</p>";
				    echo "<p>Traget : ".$demande['source']." à ".$demande['destination']."</p>";
				    echo "<p>Crée par : ".$demande['id_client']."</p>";
				    echo "<p>Le : ".$demande['date_creation']."</p>";
				?>

			</div>
			<hr>
		<?php } ?>


		<h1>La liste des demandes:</h1>
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
				     foreach ($tableau_demandes as $demande) {
				     	echo "<tr>";
				     	echo "<td>".$demande['id']."</td>";
				     	echo "<td>".$demande['titre']."</td>";
				     	echo "<td>".$demande['source']."</td>";
				     	echo "<td>".$demande['destination']."</td>";
				     	echo "<td>".$demande['id_client']."</td>";
				     	echo "<td>".$demande['date_creation']."</td>";
				     	echo "<td>";
				     	echo "<a href='gestion_demandes.php?voir&id_demande=".$demande['id']."' >Voir</a>&nbsp;";
				     	echo "<a href='gestion_demandes.php?supprimer&id_demande=".$demande['id']."' >Supprimer</a>";
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
