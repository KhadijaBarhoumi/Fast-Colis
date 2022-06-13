<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';
	include_once '../include/statestique.php';


	$tableau_client = client_recuperer_tout();


	if (isset($_GET['activer'])) {
		 
	} 
 

	if (!admin_est_connecter()) {
		header('location:login.php');
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
			<li class='active' ><a href="gestion_utilisateur.php">Gestion des Utilisateurs</a></li>
			<li><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li><a href="gestion_offres.php">Gestion des Offres</a></li>
			<li><a href="gestion_reclamation.php">Gestion des Reclamations</a></li>

		</ul>

	    <ul class="nav navbar-nav navbar-right">
	    	<?php if (admin_est_connecter() ) { ?>
	      		<li><a href="login.php?deconnecter"><span class="glyphicon glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
	      	<?php } else {  ?>
	      		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
	      	<?php } ?>

	    </ul>
	  </div>
	</nav>

	<div class='container'>

		<h1>La liste des Utilisateurs:</h1>
		<br>
		<div class='row'>

			<table class="table table-striped">
			    <thead>
			      <tr>
			      	<th>Identifiant</th>
			        <th>Nom</th>
			        <th>Prénom</th>
			        <th>Sexe</th>
			        <th>Email</th>
			        <th>Téléphone</th>
			       	<th>date d'inscription</th>
			       	<th>Action</th>
			      </tr>
			    </thead>

			    <tbody>

				    <?php
				     foreach ($tableau_client as $client) {
				     	echo "<tr>";
				     	echo "<td>".$client['id']."</td>";
				     	echo "<td>".$client['nom']."</td>";
				     	echo "<td>".$client['prenom']."</td>";
				     	echo "<td>". ( (  $client['sexe'] == 0 )? 'Homme' : 'Femme' )."</td>";
				     	echo "<td>".$client['email']."</td>";
				     	echo "<td>".$client['telephone']."</td>";
				     	echo "<td>".$client['date_creation']."</td>";
				     	echo "<td><a href='afficher_utilisateur.php?id_client=".$client['id']."'>Voir</a></td>";
				     	echo "</tr>";
				     }


				    ?>

			    </tbody>
			  </table>



		 
			
		</div>

		 
		



		
		 
		
		

	</div>

		






</body>
</html>
