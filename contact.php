<?php 
	
	session_start();

	include_once 'include/bd.php';
	include_once 'include/client.php';
	$client = client_recuperer_connecter();

	if (isset($_GET['submit'])) {
		//envoyer un email
		$to      = 'admin@opendelivery.com';
		$subject = 'Contact du site opendelivery : '.$_GET['nom'];
		$message = $_GET['message'];
		$headers = 'From: '.$_GET['email'] . "\r\n" .
		'Reply-To: admin@opendelivery.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		$email_envoye = true;
	}
?>
<html>
	<head>
		<title>Contact</title>
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

		    <li><a href="apropos.php">A propos</a></li>
			<li class='active' ><a href="contact.php">Contactez-nous</a></li>

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
		  <h1 align="center">Contact</h1>
		  <p align="center">Vous pouvez nous contacter : </p>
		</div>

	


		<div class='row'>

			<h2>Par Email :</h2>

			<div class="col col-md-3" >
				<a href="mailto:nidhal.daly@gmail.com"> <span class="glyphicon glyphicon-envelope"></span> </a> Barhoumi Khadija <br>
				<a href="mailto:rayhanaadem12345@gmail.com"> <span class="glyphicon glyphicon-envelope"></span> </a>Mnasri Wala </div>
			
			
		</div>

		<hr>

		<div class='row'>
			<h2>Par Téléphone : </h2>
			<p>
				Nidhal Delli : +216 22 000 000<br>
				Hanene Hammami : +216 23 000 000<br>
			</p>
		</div>

		<hr>



		<div class='row'>
			<h2>Par Message : </h2>

				
			<form class="form-horizontal" role="form" id="contact">

				<div class="form-group">
				    <label class="control-label col-sm-2" for="nom">Nom:</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name='nom' id="nom" placeholder="Nom">
				    </div>
				</div>


			
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="email">Email:</label>
			    <div class="col-sm-6">
			      <input type="email" class="form-control" name='email' id="email" placeholder="E-mail">
			    </div>
			  </div>


			  <div class="form-group">
			    <label class="control-label col-sm-2" for="message">Message:</label>
			    <div class="col-sm-6">
			      <textarea id='message' name='message' class="form-control" placeholder="Message"></textarea>
			    </div>
			  </div>

			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-6">
			      <button type='submit' class="btn btn-success" name='submit' >Envoyer</button>
			    </div>
			  </div>
			</form>
		

		
	</div>


	<script type="text/javascript">

	<?php // affichage d'un message alert
		if (isset($email_envoye) && $email_envoye == true) {
			echo "alert('Votre message a bien été envoyé.');";
		}
	?>

	$( "#contact" ).submit(function( event ) {
		if (!valider_fomulaire()) {
			event.preventDefault();
		}	
	});


	function valider_fomulaire(){

		if ($("#nom").val().length < 3  ){
			alert("Veuillez remplir le champ 'Nom'.");
			return false ;
		}

		if ($("#email").val().length < 3  ){
			alert("Veuillez remplir le champ 'Email'.");
			return false;
		}

		if ($("#message").val().length < 3  ){
			alert("Veuillez remplir le champ 'Message'.");
			return false;
		}

		return true;
	}

	</script>


	<?php include_once "footer.php"; ?>

</div>


</body>
</html>
