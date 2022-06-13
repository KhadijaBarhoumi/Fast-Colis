<?php 
	
	session_start();

	include_once 'include/bd.php';
	include_once 'include/client.php';
	include_once 'include/avis.php';

	if (!isset($_GET['id_client'])) {
		header('client: index.php');
	}

	$client_connecter = client_recuperer_connecter();

	$profil_client = client_recuperer_info_par_id($_GET['id_client']);

	if ($profil_client==null) {
		header('client: index.php');
	}


	if (isset($_POST['submit'])) {

		if (client_est_connecter()) {
			$id_client_source  = $client_connecter['id'] ;
			$id_client_destincation = $profil_client['id'];
			$note  = $_POST['note'];
			$texte = $_POST['texte'];

			avis_ajouter_avis($id_client_source , $note,$texte , $id_client_destincation);
		}

	}

	$tableau_avis = avis_recuprer_avis_utilisateur($profil_client['id']);



	?>
<html>
	<head>
		<title>Profil Client</title>
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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?=$client_connecter['prenom'] ?> <span class="caret"></span></a>
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

		    <li ><a href="apropos.php">A propos</a></li>
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
		
		 

		<div class='row'>

			<h2>Profil utilisateur </h2>
			<div class='clearfix'></div>

			<div class='col col-md-3'><img  width=100% src="<?=$profil_client['photo']?>" ></div>
			<div class='col col-md-9'>

				<b>Nom</b> : <?=$profil_client['nom']?> <br>
				<b>Prénom</b> : <?=$profil_client['prenom']?>  <br>
				<b>E-mail</b> : <?=$profil_client['email']?>  <br>
				<b>Sexe	</b> : <?=$profil_client['sexe'] == 0 ? 'Homme' : 'Femme' ?>  <br>
				<b>Adresse</b> : <?=$profil_client['adresse']?>  <br>
				<b>Téléphone</b> : <?=$profil_client['telephone']?>  <br>
			</div>


		</div>


		<div class='clearfix'></div>

			<h2>Les avis des utilisateurs</h2>
			

			<?php

			if (count($tableau_avis)==0) {
				echo("<p><i>Pas d'avis sur cet utilisateur.</i></p>");
			}

			foreach ($tableau_avis  as $avis ) {
				$client_avis = client_recuperer_info_par_id($avis['id_client_source']) ;
				echo "<div class='row avis '>" ;
					echo "<a href='profil_client.php?id_client=".$client_avis['id']."'>";
					echo "<div class='col col-md-2 '> <img src='".$client_avis['photo']."' class='img-responsive '   width='50' height='50' >  ".$client_avis['nom']."&nbsp;".$client_avis['prenom']." </div>" ;
					echo "</a>";
					echo "<div class ='col col-md-10  well well-sm'>";

					for ($i=0; $i  < 5  ; $i++) { 
						if (  $i >= $avis['note'] ) {
							echo '<span class="glyphicon glyphicon glyphicon-star-empty"> </span>';
						} else {
							echo '<span class="glyphicon glyphicon glyphicon-star"> </span>';
						}
					}
					echo "<p>   ".$avis['texte']." </b></p>";
			
					echo "</div>" ;
				echo "</div>" ;
			}

			?>

			<?php

			// si ce n'est pas le client lui meme il peut ajouter un avis
			if ( client_est_connecter()  && $client_connecter['id'] != $profil_client['id']) {
				
			?>

			 
			<div class='clearfix'></div>

			<form class="form-horizontal well well-sm " role="form" id="avis_formulaire" method='post'  enctype="multipart/form-data" >
				<div class="col-sm-2" for="nom"></div>
				<div class="col-sm-10">Ajouter un avis:</div>
				<div class='clearfix'></div>
				<div class="form-group">
				    <label class="control-label col-sm-2" for="nom">Note</label>
				    <div class="col-sm-10">
				      	<select id='note' name='note' class="form-control">
				      		<option value=''>Note</option> 
							<option value='1'>&#9733; &#9734; &#9734; &#9734; &#9734; </option>
							<option value='2'>&#9733; &#9733; &#9734; &#9734; &#9734; </option> 
							<option value='3'>&#9733; &#9733; &#9733; &#9734; &#9734; </option>
							<option value='4'>&#9733; &#9733; &#9733; &#9733; &#9734; </option> 
							<option value='5'>&#9733; &#9733; &#9733; &#9733; &#9733; </option>
						</select>
				    </div>
				</div>

				<div class="form-group">
				    <label class="control-label col-sm-2" for="texte">Texte:</label>
				    <div class="col-sm-10">
				      <textarea id='texte' name='texte' class="form-control"></textarea>
				    </div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type='submit' class="btn btn-success" name='submit' >Ajouter</button>
					</div>
				</div>

			</form>


			<script type="text/javascript">

			$("#avis_formulaire").submit(function( event ) {
				if (!valider_fomulaire()) {
					event.preventDefault();
				}	
			});
			


			function valider_fomulaire(){
				
				if ( $("#note").val() == '' ){
					alert("Veuillez choisir une note.");
					return false ;
				}


				if ( $("#texte").val().length < 3  ){
					alert("Veuillez remplir le champ 'Texte'.");
					return false;
				}

				return true;
			}


			</script>

			<?php

			}


			?>

		<?php include_once "footer.php"; ?>


		</div>

		






</body>
</html>
