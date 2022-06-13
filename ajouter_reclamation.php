<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/reclamation.php";

	$client = client_recuperer_connecter();

	if ($client==null) {
		header("location:index.php");
	}

	$message ='';

	if (isset($_POST['submit'])) {

		$id_client =  $client['id']  ;
		$titre = $_POST['titre'];
		$description = $_POST['description'];

		$res = reclamation_ajouter($id_client , $titre , $description );

		if ($res  ) {
			$message = "Votre réclamation a été envoyer avec succès.";
		}

	}

?>



<html>
	<head>
		<title>Ajouter réclamation</title>
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
						<li class="active"><a href="ajouter_reclamation.php"> <span class="glyphicon glyphicon-envelope"></span> Ajouter une réclamation</a></li>			
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
		  <h1 align="center">Ajouter une reclamation :</h1>
		  <p align="center">Veuillez remplir ce formulaire pour ajouter une reclamation.</p>
		</div>

		<?php  if ( $message != '') {?>
			<div class="alert alert-success ">
			  <strong>Informations : </strong>  <?= $message ?>
			</div>
		<?php  }?>

		<div class="row">
			<form class="form-horizontal" role="form" id="ajouter_reclamation" method='post'  enctype="multipart/form-data" >

				<div class="form-group">
				    <label class="control-label col-sm-2" for="titre">Titre:</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name='titre' id="titre" placeholder="Titre">
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
				      <button type='submit' class="btn btn-success" name='submit' >Envoyer</button>
				    </div>
				</div>
			</form>
		</div>

		<?php include_once "footer.php"; ?>

	</div>

		
	




	<script type="text/javascript">

	$( "#ajouter_reclamation" ).submit(function( event ) {
		if (!valider_fomulaire()) {
			event.preventDefault();
		}	
	});


	function valider_fomulaire(){

		
		if ($("#titre").val().length < 3  ){
			alert("Veuillez remplir le champ 'Titre'.");
			return false ;
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
