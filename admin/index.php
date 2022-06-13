<?php 
	
	session_start();

	include_once '../include/bd.php';
	include_once '../include/client.php';
	include_once '../include/demande.php';
	include_once '../include/offre.php';
	include_once '../include/avis.php';
	include_once '../include/administrateur.php';
	include_once '../include/statestique.php';


	if (!admin_est_connecter()) {
		header('location:login.php');
	}


	$statestique_demande =stat_demandes_par_mois();

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

		    <li class='active' ><a href="index.php">Tableau de board</a></li>
			<li><a href="gestion_utilisateur.php">Gestion des Utilisateurs</a></li>
			<li><a href="gestion_demandes.php">Gestion des Demandes</a></li>
			<li><a href="gestion_offres.php">Gestion des Offres</a></li>
			<li><a href="gestion_reclamation.php">Gestion des Reclamations</a></li>

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


		<div class='row'>

			<div class='col col-md-4' >
				<h2>Demandes</h2>
				<p>Nombre total des demandes : <?=stat_nombre_totale_demandes()?><p>
				<p>Nombre des demandes aujourd'hui : <?=stat_nombre_totale_demandes_ajourdhui()?><p>
			</div>

			<div class='col col-md-4' >
				<h2>Offres</h2>
				<p>Nombre total des offres : <?=stat_nombre_totale_offres()?><p>
				<p>Nombre des offres aujourd'hui : <?=stat_nombre_totale_offres_ajourdhui()?><p>
			</div>

			<div class='col col-md-4' >
				<h2>Utilisateurs</h2>
				<p>Nombre total des utilisateurs : <?=stat_nombre_totale_utilisateurs()?><p>
				<p>Nombre d'utilisateurs inscrit aujourd'hui : <?=stat_nombre_totale_utilisateurs_ajourdhui()?><p>
			</div>

		</div>

		<br>
		<br>

		<div class='row'>
			
			<div class='col col-md-12' id ='chart' >


			</div>


		</div>

		
		<script type="text/javascript">
		/*$(function () {
    	$('#chart').highcharts({
		        chart: {
		            type: 'line'
		        },
		        title: {
		            text: ''
		        },
		        subtitle: {
		            text: "Nombre de demandes pas mois"
		        },
		        xAxis: {
		            categories: 
['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre ', 'octobre', 'novembre', 'décembre']
		        },
		        yAxis: {
		            title: {
		                text: "Nobre de demandes"
		            }
		        },
		        plotOptions: {
		            line: {
		                dataLabels: {
		                    enabled: false
		                },
		                enableMouseTracking: true
		            }
		        },
		        series: [{
		            name: 'Nombre de demandes',
		            data: [7, 6, 9, 14.5, 18, 21, 25, 26, 23, 18, 13, 9]
		        }]
		    });
		});*/
		</script>

	</div>

	

</body>
</html>
