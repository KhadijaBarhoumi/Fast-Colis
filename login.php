<?php 

	session_start();
	include_once "include/bd.php";
	include_once "include/client.php";

	if (isset($_GET['deconnecter'])) {
		client_se_deconnecter();
		header("location:index.php");
	}
	else
	{
		$client = client_recuperer_connecter();
		// redirection ver la page index si le client est connecter
		if ($client!=null) {
			header("location:index.php");
		}
	}

	$erreur_authentification = false ;
	$message_erreur ="";
 
	if (isset($_POST['submit'])) {

		$email = $_POST['email'];
		$mot_de_passe = $_POST['mot_de_passe'];

		$res = client_se_connecter($email,$mot_de_passe);

		if ($res == 0) {
			header("location:profil.php");
		} else {
			if ($res == 2) {
				$erreur_authentification = true ;
				$message_erreur ="<p>Erreur d'authentification : Votre compte a été désactivé par l'administrateur</p>";
				client_se_deconnecter();
			}
			else 
			{
				$erreur_authentification = true ;
				$message_erreur ="<p>Erreur d'authentification : Veuillez vérifier votre email et mot de passe.</p>";

			}
			
		}
	}
?>



<html>
	<head>
		<title>Authentification</title>
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
		
		<div class="jumbotron">
		  <h1 align="center"> Login   </h1>

		  <p align="center">Veuillez remplir ce formulaire pour se connecter.</p>
		
		</div>

		<?php  if ( $erreur_authentification ) {?>
			<div class="alert alert-danger ">
			  <?= $message_erreur ?>
			</div>
		<?php  }?>

		<form class="form-horizontal col-md-5" role="form" id="login" method="post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">
		    <div align="center">Email:</div>
		    </label>
		    <div class="col-sm-10">
		      <div align="center">
		        <input type="email" class="form-control" name='email' id="email" placeholder="E-mail">
	            </div>
		    </div>
		  </div>


		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Mot de passe:</label>
		    <div class="col-sm-10">
		      <div align="center">
		        <input type="password" name='mot_de_passe' class="form-control" id="mot_de_passe" placeholder="Mot de passe">
	            </div>
		    </div>
		  </div>

		<div class="form-group">
	      <div class="col-sm-offset-2 col-sm-10">
		   <div align="center">
		      <button type='submit' class="btn btn-success" name='submit' >Se connecter</button>
		     </div>
		    </div>
		  </div>
		</form>


	</div>


	<script type="text/javascript">

	$( "#login" ).submit(function( event ) {

		if (!valider_fomulaire()) {
			event.preventDefault();
		}	

	});


	function valider_fomulaire(){

		if ($("#email").val().length < 3  ){
			alert("Veuillez remplir le champ 'Email'");
			return false;
		}


		if ($("#mot_de_passe").val().length < 6  ){
			alert("Le champ 'Mot de passe' doit contenir au moins 6 caracteres.");
			return false;
		}

		return true; 
	}



	</script>




</body>
</html>
