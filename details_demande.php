<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/demande.php";
	include_once "include/offre.php";



	
	$client = client_recuperer_connecter();




	if (isset($_POST['submit'])) {

		if ($client!=null) {

			$id_client =  $client['id']  ;
			$titre = $_POST['titre'];
			$source = $_POST['source'];
			$destination = $_POST['destination'];
			$date_livraison = $_POST['date_livraison'];
			$description = $_POST['description'];
			$id_demande = $_POST['id_demande'];

			$res = offre_ajouter_par_demande($id_client ,$id_demande,$titre,$description,$source,$destination ,$date_livraison  );
			header("location :details_demande.php?id_demande=".$id_demande);	
		}
	}

	if (!isset($_GET['id_demande'])) {
		header('location:index.php');	
	}

	if (isset($_GET['supprimer']) && isset($_GET['id_offre']) ) {

		$id_offre = $_GET['id_offre'] ;

		offre_supprimer($id_offre) ;
	}


	$demande = demande_recuperer($_GET['id_demande']) ;
	if ($demande == null ) {
		header('location:index.php');	
	}

	$client_createur = client_recuperer_info_par_id($demande['id_client']) ;


?>



<html>
	<head>
		<title>Demande</title>
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

		<?php
			$tableau_offres = recuperer_offres_par_demande($demande['id']);
		?>
		

		<h2><?=$demande['titre']?></h2>

		<h3>De : <?=$demande['source']?> à <?=$demande['destination']?> </h3>
		
		<h5>Publié par :&nbsp;<?=$client_createur['nom']?> &nbsp;<?=$client_createur['prenom']?>  </h5>
		
		<p class='well'> <?=$demande['description']?> </p>

		<div class='clearfix'>  </div>
		
		<?php

		if ( client_est_connecter() && $client['id']!= $client_createur['id']) {
			echo "<button class='btn btn-primary' id='proposer_une_offre'><span class='glyphicon glyphicon glyphicon-ok'> </span> Proposer une offre</button>";
		}

		?>

		

		<div class='row ' id='nouvelle_offre'>
			<h3>Veuillez remplir ce formulaire.</h3>
				<form class="form-horizontal" role="form" id="ajouter_offre" method='post'  enctype="multipart/form-data" >

					<div class="form-group">
					    <label class="control-label col-sm-2" for="titre">Titre:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name='titre' id="titre" placeholder="Titre">
					    </div>
					</div>

					<input type='hidden' name='id_demande' value='<?=$_GET['id_demande']?>'> 

					<div class="form-group">
					    <label class="control-label col-sm-2" for="source">Source:</label>
					    <div class="col-sm-10">
					      <select id='source' name='source' class="form-control">
					      		<option value=''>Veuillez selectionner la source</option> 
								<option value='Ariana'>Ariana</option> 
								<option value='Béja'>Béja</option>
								<option value='Ben Arous'>Ben Arous</option> 
								<option value='Bizerte'>Bizerte</option>
								<option value='Gabès'>Gabès</option> 
								<option value='Gafsa'>Gafsa</option>
								<option value='Jendouba'>Jendouba</option> 
								<option value='Kairouan'>Kairouan</option>
								<option value='Kasserine'>Kasserine</option> 
								<option value='Kébili'>Kébili</option>
								<option value='El Kef'>El Kef</option> 
								<option value='Mahdia'>Mahdia</option>
								<option value='Manouba'>Manouba</option> 
								<option value='Médenine'>Médenine</option>
								<option value='Monastir'>Monastir</option> 
								<option value='Nabeul'>Nabeul</option>
								<option value='Sfax'>Sfax</option> 
								<option value='Sidi Bouzid'>Sidi Bouzid</option>
								<option value='Siliana'>Siliana</option> 
								<option value='Sousse'>Sousse</option>
								<option value='Siliana'>Siliana</option> 
								<option value='Tataouine'>Tataouine</option>
								<option value='Tozeur'>Tozeur</option> 
								<option value='Tunis'>Tunis</option>
								<option value='Zaghouan'>Zaghouan</option>
							</select>
					    </div>
					</div>


					<div class="form-group">
					    <label class="control-label col-sm-2" for="destination">Destincation:</label>
					    <div class="col-sm-10">
					      <select id='destination' name='destination' class="form-control">
					      		<option value=''>Veuillez selectionner la destination</option> 
								<option value='Ariana'>Ariana</option> 
								<option value='Béja'>Béja</option>
								<option value='Ben Arous'>Ben Arous</option> 
								<option value='Bizerte'>Bizerte</option>
								<option value='Gabès'>Gabès</option> 
								<option value='Gafsa'>Gafsa</option>
								<option value='Jendouba'>Jendouba</option> 
								<option value='Kairouan'>Kairouan</option>
								<option value='Kasserine'>Kasserine</option> 
								<option value='Kébili'>Kébili</option>
								<option value='El Kef'>El Kef</option> 
								<option value='Mahdia'>Mahdia</option>
								<option value='Manouba'>Manouba</option> 
								<option value='Médenine'>Médenine</option>
								<option value='Monastir'>Monastir</option> 
								<option value='Nabeul'>Nabeul</option>
								<option value='Sfax'>Sfax</option> 
								<option value='Sidi Bouzid'>Sidi Bouzid</option>
								<option value='Siliana'>Siliana</option> 
								<option value='Sousse'>Sousse</option>
								<option value='Siliana'>Siliana</option> 
								<option value='Tataouine'>Tataouine</option>
								<option value='Tozeur'>Tozeur</option> 
								<option value='Tunis'>Tunis</option>
								<option value='Zaghouan'>Zaghouan</option>
							</select>
					    </div>
					</div>


				<div class="form-group">
				    <label class="control-label col-sm-2" for="date_livraison">Date de livraison:</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" name='date_livraison' id="date_livraison" placeholder="Date de livraison">
				    </div>
				</div>


				<div class="form-group">
				    <label class="control-label col-sm-2" for="description">Description:</label>
				    <div class="col-sm-10">
				      <textarea id='description' name='description' class="form-control" rows=15></textarea>
				    </div>
				</div>


				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type='submit' class="btn btn-success" name='submit' >Ajouter</button>
				    </div>
				  </div>
				</form>
			</div>


		<h3>Les offres reliées à cette demande</h3>
		<div class='clearfix'>  </div>

		<?php

		if (count($tableau_offres)==0) {
			echo("<p><i>Pas d'offre pour cette demande.</i></p>");
		}

		foreach ($tableau_offres  as $offre ) {
			$client_offre = client_recuperer_info_par_id($offre['id_client']) ;
			echo "<div class='row offre '>" ;
				echo "<a href='profil_client.php?id_client=".$client_offre['id']."'>";
				echo "<div class='col col-md-2 '> <img src='".$client_offre['photo']."' class='img-responsive '   width='100' height='100' ><br>  ".$client_offre['nom']."&nbsp;".$client_offre['prenom']." </div>" ;
				echo "</a>";
				echo "<div class ='col col-md-8  well well-sm'>";
				if ($client['id']==$client_offre['id']) {
					echo "<h4>".$offre['titre']." ";
					echo "<a class='btn btn-danger' href ='details_demande.php?id_demande=".$demande['id']."&supprimer&id_offre=".$offre['id']."'> <span class='glyphicon glyphicon glyphicon-trash'></span>  </a> ";
					echo "</h4>";
				} else {
					echo "<h4>".$offre['titre']." </h4>";
				}
				echo "<p>".$offre['description']."</p>";
				echo "<p> Le trajet :  De <b>".$offre['source']."</b> à <b>".$offre['destination']." </b></p>";
				echo "<p> La date de livaison :  ".$offre['date_livraison']." </b></p>";
				echo "<p> Créer le :  ".$offre['date_creation']." </b></p>";
		
				echo "</div>" ;
			echo "</div>" ;
		}

		?>

		<?php include_once "footer.php"; ?>

	</div>


	<script type="text/javascript">

	$("#nouvelle_offre").hide();
	$('#proposer_une_offre').click(function (){
		$("#nouvelle_offre").slideToggle( "slow", function() {
    	// Animation complete.
  		});
	});




	$( "#ajouter_offre" ).submit(function( event ) {
		if (!valider_fomulaire()) {
			event.preventDefault();
		}	
	});


	function valider_fomulaire(){

		
		if ($("#titre").val().length < 3  ){
			alert("Veuillez remplir le champ 'Titre'.");
			return false ;
		}

		if ($("#source").val()== '' ){
			alert("Veuillez selectionner la source.");
			return false;
		}

		if ($("#destination").val()== '' ){
			alert("Veuillez selectionner la destination.");
			return false;
		}


		if ($("#date_livraison").val()== '' ){
			alert("Veuillez remplir le champ 'Date'.");
			return false;
		}


		if ($("#description").val().length < 3  ){
			alert("Veuillez remplir le champ 'Description'.");
			return false ;
		}
		
		return true; 
	}





	</script>




</body>
</html>
