<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/demande.php";
	
	$client = client_recuperer_connecter();

	$client = client_recuperer_connecter();
	// redirection ver la page index si le client n'est pas connecter
	if ($client==null) {
		header("location:index.php");
	}

	$tableau_demandes_client = demande_recuprer_demande_client ( $client['id'] );

	if (isset($_GET['supprimer'])) {
		if (isset($_GET['id_demande'])) {
			demande_supprimer($_GET['id_demande']) ;
			header('location:mes_demandes.php');
		}
	}

?>



<html>
	<head>
		<title>Mes demandes</title>
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
						<li class='active' ><a href="mes_demandes.php" > <span class="glyphicon glyphicon glyphicon-star-empty"> </span> Mes Demandes</a></li>
						<li ><a href="offres.php"> <span class="glyphicon glyphicon glyphicon-star"></span>   Mes Offres</a></li>	
						<li role="separator" class="divider"></li>
						<li ><a href="ajouter_reclamation.php"> <span class="glyphicon glyphicon-envelope"></span> Ajouter une r??clamation</a></li>				
					</ul>
		        </li>
		    <?php } ?>

		    <li><a href="apropos.php">A propos</a></li>
			<li><a href="contact.php">Contactez-nous</a></li>

		</ul>

	    <ul class="nav navbar-nav navbar-right">
	    	<?php if (client_est_connecter() ) { ?>
	      		<li><a href="login.php?deconnecter"><span class="glyphicon glyphicon glyphicon-log-out"></span> Se d??connecter</a></li>
	      	<?php } else {  ?>
	      		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
	      	<?php } ?>

	    </ul>
	  </div>
	</nav>



	<div class='container'>


		<div class="jumbotron">
		  <h1 align="center"> Mes demandes</h1>
		  <p> </p>
		</div>

	<?php
	foreach ($tableau_demandes_client as $demande) {
		echo"<div class='row demande'>";
			
			echo "<div class='col col-md-10'>";
				echo "<h4>".$demande['titre']."</h4>";
				echo "<h6> De <i>".$demande['source']."</i> ?? <i>".$demande['destination']."</i> </h6>";
				echo "<h6> A livrer le : ".$demande['date_livraison']."</h6>";
				if (strlen($demande['description']) >150)
					echo "<p>".substr($demande['description'],0,150)."...&nbsp;<a href='details_demande.php?id_demande=".$demande['id']."'>Lire plus</a></p>";
				else
					echo "<p>".$demande['description']."&nbsp;<a href='details_demande.php?id_demande=".$demande['id']."'>Lire plus</a></p>";
				
			echo "</div>";
			echo "<div class='col col-md-2'> <a class='btn btn-danger' href ='mes_demandes.php?supprimer&id_demande=".$demande['id']."'> <span class='glyphicon glyphicon glyphicon-trash'></span>  Supprimer</a> </div>" ;
		echo"</div>";
	}
	?>

	<?php include_once "footer.php"; ?>



</body>
</html>
