<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/administrateur.php';
	include_once '../include/reclamation.php';


	if (!admin_est_connecter()) {
		header('location:login.php');
	}

	// suppression d'une reclamation
	if(isset($_GET['supprimer'])){
		$id_reclamation = $_GET['id_reclamation'];
		reclamation_supprimer($id_reclamation);
	}


	$tableau_reclamation = reclamation_recuperer_tout();


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

		    <li  ><a href="index.php">Tableau de board</a></li>
			<li><a href="gestion_utilisateur.php">Gestion des Utilisateurs</a></li>
			<li><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li><a href="gestion_offres.php">Gestion des Offres</a></li>
			<li class='active' ><a href="gestion_reclamation.php">Gestion des Reclamations</a></li>

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

		<h1>La liste des réclamations:</h1>
		<br>
		<div class='row'>

			<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>Identifiant</th>
			        <th>Créer par</th>
			        <th>Titre</th>
			        <th>Description</th>
			       	<th>date d'ajout</th>
			       	<th>Action</th>
			      </tr>
			    </thead>

			    <tbody>

				    <?php
				     foreach ($tableau_reclamation as $reclamation) {
				     	echo "<tr>";
				     	echo "<td>".$reclamation['id']."</td>";
				     	echo "<td><a href='afficher_utilisateur.php?id_client=".$reclamation['id_client']."'>".$reclamation['id_client']."</a></td>";
				     	
				     	echo "<td>".$reclamation['titre']."</td>";
				     	echo "<td>".$reclamation['description']."</td>";
				     	echo "<td>".$reclamation['date_creation']."</td>";
				     	echo "<td>";
				     	echo "<a href='gestion_reclamation.php?supprimer&id_reclamation=".$reclamation['id']."'>Supprimer</a>";
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
