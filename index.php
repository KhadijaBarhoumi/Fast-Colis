<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/demande.php";

	$tableau_demandes = [];

	if (isset($_GET['recherche']) && strlen($_GET['recherche']) > 3 ) {
		$tableau_demandes = demande_recuprer_recherche ($_GET['recherche']);
	} else {
		$tableau_demandes = demande_recuprer_tout ();
	}
	
	$client = client_recuperer_connecter();

?>



<html>
	<head>
		<title>OpenDelivery : Accueil</title>
		<meta charset="UTF-8"> 
		<!-- Latest compiled and minified CSS -->
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
			<li class='active'><a href="index.php">Accueil</a></li>
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
		<?php include"slide.php" ?>
   
		</div>



		<div class='clearfix'></div>


	<!-- Le filtre-->

	<div  class="row" >  


		<form class="form-inline recherche col-md-4 col-sm-12" role="form" >

			<div class="form-group">
			    <label for="email"></label>
			    <input type="text" class="form-control" id="recherche" name='recherche' placeholder=' Chercher dans le site'>
			  </div>

			<button type="submit" class="btn btn-info" >
		      <span class="glyphicon glyphicon-search"></span> Recherche
		    </button>

		</form>

	</div>



	<!-- Les offres -->

	<?php
	foreach ($tableau_demandes as $demande) {
		$client = client_recuperer_info_par_id($demande['id_client']) ;
		echo"<div class='row demande'>";
			echo "<a href='profil_client.php?id_client=".$client['id']."'>";
			echo "<div class='col col-md-2'> <img src='".$client['photo']."' class='img-responsive' width='100' height='100' ><br>  ".$client['nom']."&nbsp;".$client['prenom']." </div>" ;
			echo "</a>";
			echo "<div class='col col-md-10'>";
				echo "<h4><a href='details_demande.php?id_demande=".$demande['id']."'>".$demande['titre']."</a></h4>";
				echo "<h6> De <i>".$demande['source']."</i> à <i>".$demande['destination']."</i> </h6>";
				echo "<h6> A livrer le : ".$demande['date_livraison']."</h6>";
				if (strlen($demande['description']) >150)
					echo "<p>".substr($demande['description'],0,150)."...&nbsp;<a href='details_demande.php?id_demande=".$demande['id']."'>Lire plus</a></p>";
				else
					echo "<p>".$demande['description']."&nbsp;<a href='details_demande.php?id_demande=".$demande['id']."'>Lire plus</a></p>";
				
			echo "</div>";
		echo"</div>";
	}
	?>





	<?php include_once "footer.php"; ?>


			

</div> 

	
	<!-- animation du logo-->
	<script type="text/javascript">
		$('.logo-img').css( { 'transition' : 'all 0.1s ease-in-out', 'transform' : 'translateX(-300px)' } );
		$(document).ready(function(){
			$('.logo-img').css( { 'transition' : 'all 1.0s ease-in-out', 'transform' : 'translateX(0px)' }  );			 
		});
	</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script><script  src="./script.js"></script>

	





</body>
</html>
