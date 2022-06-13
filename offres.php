<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/demande.php";
	include_once "include/offre.php";
	
	$client = client_recuperer_connecter();

	if ($client==null) {
		header('location:index.php');
	}

	$tableau_offres_client = recuperer_offres_par_client ( $client['id'] );

	if (isset($_GET['supprimer'])) {
		if (isset($_GET['id_offre'])) {
			offre_supprimer($_GET['id_offre']) ;
			header('location:offres.php');
		}
	}

?>



<html>
	<head>
		<title>Mes offres</title>
		<meta charset="UTF-8"> 
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- Style du site-->
		<link rel="stylesheet" href="css/style.css">
		<!-- jQuery library -->
		<script src="js/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

	</head>
<body>


	<nav class="navbar navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#"><img src="images/logo.png" class='logo-img'></a>
	    </div>
	    <ul class="nav navbar-nav">
			<li ><a href="index.php">Accueil</a></li>
			<?php if (!client_est_connecter()){ ?>
				<li><a href="inscription.php">Inscription</a></li>
			<?php } ?>

			<?php if (client_est_connecter()){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?=$client['prenom'] ?> <span class="caret"></span></a>
					<ul class="dropdown-menu ">
						<li ><a href="ajouter_demande.php"> <span class="glyphicon glyphicon glyphicon-plus"> </span> Nouvelle Demande</a></li>
						<li role="separator" class="divider"></li>
						<li ><a href="profil.php"> <span class="glyphicon glyphicon glyphicon-user"></span>  Mon Profil</a></li>
						<li role="separator" class="divider"></li>
						<li  ><a href="mes_demandes.php" > <span class="glyphicon glyphicon glyphicon-star-empty"> </span> Mes Demandes</a></li>
						<li class='active' ><a href="offres.php"> <span class="glyphicon glyphicon glyphicon-star"></span>   Mes Offres</a></li>	
						<li role="separator" class="divider"></li>
						<li ><a href="ajouter_reclamation.php"> <span class="glyphicon glyphicon-envelope"></span> Ajouter une réclamation</a></li>				
					</ul>
		        </li>
		    <?php } ?>

		    <li><a href="apropos.php">A propos</a></li>
			<li><a href="contact.php">Contactez-nous</a></li>

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


		<div class="jumbotron">
		  <h1> Mes Offres</h1>
		  <p> </p>
		</div>

	<?php
	foreach ($tableau_offres_client as $offre) {

		$demande = demande_recuperer($offre['id_demande']) ;


		echo"<div class='row offre'>";
			
			echo "<div class='col col-md-10'>";
				echo "<h4> Offre sur la demande : <a href='details_demande.php?id_demande=".$demande['id']."'> <i>".$demande['titre']."</i>  </a> </h3><hr>";
				echo "<h4>".$offre['titre']."</h4>";
				echo "<h6> De <i>".$offre['source']."</i> à <i>".$offre['destination']."</i> </h6>";
				echo "<h6> A livrer le : ".$offre['date_livraison']."</h6>";
				echo "<p>".$offre['description']."</p>";
				
			echo "</div>";
			echo "<div class='col col-md-2'> <a class='btn btn-danger' href ='offres.php?supprimer&id_offre=".$offre['id']."'> <span class='glyphicon glyphicon glyphicon-trash'></span>  Supprimer</a> </div>" ;
		echo"</div>";
	}
	?>

	<?php include_once "footer.php"; ?>

</body>
</html>
