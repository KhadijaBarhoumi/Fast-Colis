<?php 
	
	session_start();

	include_once 'include/bd.php';
	include_once 'include/client.php';

	$client = client_recuperer_connecter();
?>
<html>
	<head>
		<title>A Propos</title>
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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?=$client['prenom'] ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li ><a href="ajouter_demande.php"> <span class="glyphicon glyphicon glyphicon-plus"> </span> Nouvelle Demande</a></li>
						<li role="separator" class="divider"></li>
						<li ><a href="profil.php"> <span class="glyphicon glyphicon glyphicon-user"></span>  Mon Profil</a></li>
						<li role="separator" class="divider"></li>
						<li ><a href="mes_demandes.php" > <span class="glyphicon glyphicon glyphicon-star-empty"> </span> Mes Demandes</a></li>
						<li ><a href="offres.php"> <span class="glyphicon glyphicon glyphicon-star"></span>   Mes Offres</a></li>	
						<li role="separator" class="divider"></li>
						<li ><a href="ajouter_reclamation.php"> <span class="glyphicon glyphicon-envelope"></span> Ajouter une réclamation</a></li>				
					</ul>
		        </li>
		    <?php } ?>

		    <li class='active' ><a href="apropos.php">A propos</a></li>
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
		  <h1 align="center"> A Propos</h1>
		  <p> </p>
		</div>

		<div class='row'>

			<h2>Le site</h2>
			<p>
				Le site Fast-Colis est le premier site internet de livraison à la demande en Tunisie. 
Aujourd’hui, il est à sa première version, que nous avons voulue facile à utiliser et rapide, avec des fonctionnalités pour vous faciliter à trouver rapidement des offres de livraison.
			</p>

			<h2>Notre mission</h2>
			<p>
 Notre première mission est de vous aider à trouver des offres de livraison le plus rapide et efficace que possible. Notre savoir-faire, c’est la livraison et la communication. De notre connaissance de l’univers de la livraison, nous avons assemblé les ingrédients nécessaires pour vous faire découvrir la manière de livraison la plus sympa qui soit et vous offrir une expérience réussie ! Il est à la portée de tout le monde de déposer une annonce sur un service de livraison. Nous sommes persuadés que la livraison, même pratiqué de temps en temps, est un moyen efficace de gagné un peut d'agent et a rendre un service au gents. Nos objectifs. 
			</p>

			<h2>Nos objectifs</h2>
			<p>
			- L’efficacité : Optimiser les recherches, permettre aux utilisateurs de trouver rapidement une demande. <br/>
 - La rapidité : Le site est disponible pour tout le monde donc il aura toujours plusieurs offre a une demande. <br/>
 - La confiance et la sécurité : Il y a un système complet qui permet de vérifier tout les demandes et les offres posté sur le site. <br/>
 - La simplicité : faciliter la recherche et la publication des demandes de livraison. <br/>
 - L'instantanéité : Votre demande de livraison sera postée directement après la validation de la demande<br/>
			</p>



	</div>














	<?php include_once "footer.php"; ?>

</div>

		






</body>
</html>
