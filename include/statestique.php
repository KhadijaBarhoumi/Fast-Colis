
<?php


//
function stat_nombre_totale_demandes()
{
	$res = bd_exectuer_requete("SELECT * FROM demande ");
	return $res->num_rows ;
}


//
function stat_nombre_totale_demandes_ajourdhui()
{
	$res = bd_exectuer_requete("SELECT * FROM demande WHERE DATE_FORMAT(date_creation,'%m-%d-%Y') = DATE_FORMAT(NOW(),'%m-%d-%Y')");
	return $res->num_rows ;
}


//
function stat_nombre_totale_offres()
{
	$res = bd_exectuer_requete("SELECT * FROM offre ");
	return $res->num_rows ;
}

//
function stat_nombre_totale_offres_ajourdhui()
{
	$res = bd_exectuer_requete("SELECT * FROM offre WHERE DATE_FORMAT(date_creation,'%m-%d-%Y') = DATE_FORMAT(NOW(),'%m-%d-%Y')");
	return $res->num_rows ;
}

//
function stat_nombre_totale_utilisateurs()
{
	$res = bd_exectuer_requete("SELECT * FROM client ");
	return $res->num_rows ;
}

//
function stat_nombre_totale_utilisateurs_ajourdhui()
{
	$res = bd_exectuer_requete("SELECT * FROM client WHERE DATE_FORMAT(date_creation,'%m-%d-%Y') = DATE_FORMAT(NOW(),'%m-%d-%Y')");
	return $res->num_rows ;
}



// statestique des demandes par date


function stat_demandes_par_mois()
{
	//$res = bd_exectuer_requete("SELECT COUNT(*)  AS nombre , DATE_FORMAT(date_creation,'%d-%Y') AS mois FROM demande GROUPE BY DATE_FORMAT(date_creation,'%d-%Y') ");
	//return $res->num_rows ;
}

?>