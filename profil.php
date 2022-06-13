<?php 
	session_start();

	include_once 'include/bd.php';
	include_once 'include/client.php';

	// si le client n'est pas connecter on fait une redirection vers la page d'acceuil
	if (!client_est_connecter()) {
		header('location:index.php');
	}

	$erreur = false; 
	$message = "Modifier votre profil.";

	if(isset($_POST['submit'])) {

		// recuperation des valeurs du formulaire
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		//$email = $_POST['email'];
		$mot_de_passe_ancien = $_POST['mot_de_passe_ancien'];
		$mot_de_passe_nouveau = $_POST['mot_de_passe_nouveau'];
		$naissance = $_POST['naissance'];
		$sexe = $_POST['sexe'];
		$adresse = $_POST['adresse'];
		$telephone = $_POST['telephone'];

		$photo = charger_fichier('photo');
		$cin = false;//charger_fichier('cin');

		$client = client_recuperer_connecter();

		if ($photo==false) $photo = $client['photo'];
		if ($cin==false) $cin =$client['cin'];

		if ($mot_de_passe_ancien=='') {
			$mot_de_passe_ancien = $client['mot_de_passe'];
		} else {
			if (md5($mot_de_passe_ancien) == $client['mot_de_passe']) {
				$mot_de_passe_ancien = md5($mot_de_passe_nouveau) ;
			} else {
				$erreur = true;
				$message = "Votre ancien mot de passe n'est pas le bon.";
			}
		}	


		if (!$erreur) {
			$res = client_modifier_info($client['email'],$mot_de_passe_ancien,$photo, $cin,$nom ,$prenom,$naissance,$sexe ,$telephone , $adresse);
			// si le resultat est true  => redurection vers index.php ( page home du site )
			if ($res) {
				$message = "Votre profil a été modifié avec succès.";
			}else{
				$message = "Une erreur a survenu lors de la moification de votre profil. Veuillez vérifier les champs.";
			}
		}



	}


	$client = client_recuperer_connecter();


?>
<html>
	<head>
		<title>Mon Profil</title>
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
						<li class='active' ><a href="profil.php"> <span class="glyphicon glyphicon glyphicon-user"></span>  Mon Profil</a></li>
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
		  <h1 align="center"> Mon Profil</h1>
		  <p align="center"><?=$message?></p>
		</div>

		<div class='row'>
			<div class="col-md-2 col-md-offset-5">
        		<img src="<?=$client['photo']?>" height='200px'>
    		</div>
		</div>
		<div class='clearfix'></div>

		<form class="form-horizontal" role="form" id="profil" method='post'  enctype="multipart/form-data" >

			<div class="form-group">
			    <label class="control-label col-sm-2" for="nom">Nom:</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name='nom' id="nom" placeholder="Nom" value='<?= $client['nom']?>'>
			    </div>
			</div>


		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Prénom:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name='prenom' id="prenom" placeholder="Prénom" value='<?= $client['prenom']?>'>
		    </div>
		  </div>

		


		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Email:</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" name='email' id="email" placeholder="E-mail" value='<?= $client['email']?>' disabled>
		    </div>
		  </div>


		  <div class="form-group">
		    <label class="control-label col-sm-2" for="mot_de_passe">Ancien mot de passe:</label>
		    <div class="col-sm-10">
		      <input type="password" name='mot_de_passe_ancien' class="form-control" id="mot_de_passe_ancien" placeholder="Ancien mot de passe">
		    </div>
		  </div>

		   <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Nouveau mot de passe:</label>
		    <div class="col-sm-10">
		      <input type="password" name='mot_de_passe_nouveau' class="form-control" id="mot_de_passe_nouveau" placeholder="Nouveau mot de passe">
		    </div>
		  </div>




		  <div class="form-group">
		 <label class="control-label col-sm-2" for="naissance">Date de naissance:</label>
		 <div class="col-sm-10">
		    <input type="date" class="form-control" name='naissance' id="naissance" placeholder="Date de naissance" value='<?= $client['naissance']?>'>
		 </div>
		</div>

		<div class="form-group">
		    <label class="control-label col-sm-2" for="sexe">Sexe:</label>
		    <div class="col-sm-10">
		      <select id='sexe' name='sexe' class="form-control" value='<?= $client['sexe']?>'>
					<option value='0' > Homme </option>
					<option value='1' > Femme </option>
				</select>
		    </div>
		</div>


	  <div class="form-group">
	    <label class="control-label col-sm-2" for="adresse">Adresse:</label>
	    <div class="col-sm-10">
	      <textarea id='adresse' name='adresse' class="form-control"><?= $client['adresse']?></textarea>
	    </div>
	  </div>

	   <div class="form-group">
	    <label class="control-label col-sm-2" for="telephone">Téléphone:</label>
	    <div class="col-sm-10">
	      <input type="text" name='telephone' class="form-control" id="telephone" placeholder="Téléphone" value='<?= $client['telephone']?>'>
	    </div>
	  </div>


	  	<div class="form-group">
			<label class="control-label col-sm-2" for="photo">Photo de profil:</label>
			<div class="col-sm-10">
				<input type="file" class="form-control" name='photo' id="photo">
			</div>
		</div>

<!--
		<div class="form-group">
			<label class="control-label col-sm-2" for="cin">Carte d'identité nationale:</label>
			<div class="col-sm-10">
				<input type="file" class="form-control" name='cin' id="cin">
			</div>
		</div>
-->


		<div class="form-group">
	      <div class="col-sm-offset-2 col-sm-10">
		      <button type='submit' class="btn btn-success" name='submit' >Modifier</button>
		    </div>
		  </div>
		</form>


		<?php include_once "footer.php"; ?>


	</div>


	<script type="text/javascript">

	$( "#profil" ).submit(function( event ) {

		if (!valider_fomulaire()) {
			event.preventDefault();
		}	

	});


	function valider_fomulaire(){

		if ($("#nom").val().length < 3  ){
			alert("Veuillez remplir le champ 'Nom'");
			return false ;
		}


		if ($("#prenom").val().length < 3  ){
			alert("Veuillez remplir le champ 'Prénom'");
			return false;
		}

		if ($("#email").val().length < 3  ){
			alert("Veuillez remplir le champ 'Email'");
			return false;
		}


		if ($("#mot_de_passe_ancien").val().length > 0) {

			if ($("#mot_de_passe_ancien").val().length < 6  ){
				alert("Le champ 'Ancien mot de passe' doit contenir au moins 6 caracteres.");
				return false;
			}

			if ($("#mot_de_passe_nouveau").val().length < 6  ){
				alert("Le champ 'Nouveau mot de passe' doit contenir au moins 6 caracteres.");
				return false;
			}
		};

		
		if ($("#adresse").val().length < 3  ){
			console.log($("#adresse").val());
			alert("Veuillez remplir le champ 'Adresse'");
			return false;
		}

		isnum = /^\d+$/.test($("#telephone").val());
		if (!isnum) {
			alert("Veuillez remplir le champ 'Téléphone' correctement");
			return false
		}

		if ($("#telephone").val().length != 8  ){
			alert("le champ 'Téléphone' doit contenir 8 chiffres ");
			return false;
		}

		
		return true; 
	}



	</script>




</body>
</html>
