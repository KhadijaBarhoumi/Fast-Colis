
<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';


	$erreur = false ;

	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$mot_de_passe = $_POST['mot_de_passe'];

		if (admin_se_connecter($email , $mot_de_passe  )) {
			header('location:index.php');
		} else {
			$erreur = true ;
		}
	}

	if (isset($_GET['deconnecter'])) {
		admin_se_deconnecter();
	}


	?>
<html>
	<head>
		<title>Admin</title>
		<meta charset="UTF-8"> 
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="../js/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>

	</head>
<body>

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Opendevilery: Administration |</a>
	    </div>
	    <ul class="nav navbar-nav">

		    

		</ul>

	    <ul class="nav navbar-nav navbar-right">
	    	<?php if (admin_est_connecter() ) { ?>
	      		<li><a href="login.php?deconnecter"><span class="glyphicon glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
	      	<?php } else {  ?>
	      		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
	      	<?php } ?>

	    </ul>
	  </div>
	</nav>

	<div class='container'>
		

		<h1> Authentification Administrateur</h1>


		<br><br>
		<p>
			<?php

			if ($erreur) {
				echo "<div class='alert alert-danger'>";
			  		echo "<strong>Erreur email et mot de passe</strong>";
				echo "</div>";	
			} 

			?>

		</p>
		<form class="form-horizontal " role="form" id="login" method=post>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Email:</label>
		    <div class="col-sm-5">
		      <input type="email" class="form-control" name='email' id="email" placeholder="E-mail">
		    </div>
		  </div>


		  <div class="form-group">
		    <label class="control-label col-sm-2" for="mot_de_passe">Mot de passe:</label>
		    <div class="col-sm-5">
		      <input type="password" name='mot_de_passe' class="form-control" id="mot_de_passe" placeholder="Mot de passe">
		    </div>
		  </div>

		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-5">
		      <button type='submit' class="btn btn-success" name='submit' >Se connecter</button>
		    </div>
		  </div>
		</form>
	</div>




</body>
</html>