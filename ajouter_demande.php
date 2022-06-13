<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";
	include_once "include/demande.php";

	$client = client_recuperer_connecter();

	if ($client==null) {
		header("location:index.php");
	}


	$message = '' ;


	if (isset($_POST['submit'])) {

		$id_client =  $client['id']  ;
		$titre = $_POST['titre'];
		$source = $_POST['source'];
		$destination = $_POST['destination'];
		$date_livraison = $_POST['date_livraison'];
		$description = $_POST['description'];

		$res = demande_ajouter($id_client ,$titre,$description,$source,$destination ,$date_livraison  );

		if ($res  ) {
			$message = "Votre demande a été ajouter avec succès.";
		}

	}

?>



<html>
	<head>
		<title>Ajouter Demande</title>
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
						<li class='active'><a href="ajouter_demande.php"> <span class="glyphicon glyphicon glyphicon-plus"> </span> Nouvelle Demande</a></li>
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


		<div class="jumbotron">
		  <h1>Ajouter une demande :</h1>
		  <p>Veuillez remplir ce formulaire pour ajouter une nouvelle demande.</p>
		</div>

		<?php  if ( $message != '') {?>
			<div class="alert alert-success ">
			  <strong>Informations : </strong>  <?= $message ?>
			</div>
		<?php  }?>

			<form class="form-horizontal" role="form" id="ajouter_demande" method='post'  enctype="multipart/form-data" >

				<div class="form-group">
				    <label class="control-label col-sm-2" for="titre">Titre:</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name='titre' id="titre" placeholder="Titre">
				    </div>
				</div>



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

		

		
		<?php include_once "footer.php"; ?>
	

	</div>


	<script type="text/javascript">

	$( "#ajouter_demande" ).submit(function( event ) {
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
