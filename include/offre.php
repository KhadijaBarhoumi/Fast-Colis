<?php



// fonction qui permet de recuperer tout les offres  de chaque demande 


function recuperer_offres_par_demande($id_demande){

	$res = bd_exectuer_requete("SELECT * FROM offre  WHERE id_demande = '".$id_demande."' order by date_creation DESC ");

	$tab_offres = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_offres[] = $row;
	}
	return $tab_offres ;
}


// function qui permet d'ajouter une nouvelle offre
function offre_ajouter_par_demande (  $id_client,  $id_demande,  $titre,  $description,  $source,  $destination,  $date_livraison) {
	return  bd_exectuer_requete("INSERT INTO offre VALUES (NULL, ".$id_client." , ".$id_demande." , '".$titre."', '".$description."', '".$source."', '".$destination."', '".$date_livraison."', CURRENT_TIMESTAMP) ");
}



// fonction qui permet de supprimer une offre 

function offre_supprimer($id_offre){
	return  bd_exectuer_requete("DELETE FROM offre WHERE id = ".$id_offre." ");
}


// fonction qui permet de recupere tout les offres d'un client
function recuperer_offres_par_client($id_client){

	$res = bd_exectuer_requete("SELECT * FROM offre  WHERE id_client = '".$id_client."' order by date_creation DESC ");

	$tab_offres = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_offres[] = $row;
	}
	return $tab_offres ;
}



// fonction qui permet de recuperer tout les offres


function recuperer_offres_tout(){

	$res = bd_exectuer_requete("SELECT * FROM offre order by date_creation DESC ");

	$tab_offres = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_offres[] = $row;
	}
	return $tab_offres ;
}



function offre_recuperer($id){
	$res = bd_exectuer_requete("SELECT * FROM offre WHERE id=".$id);

	if ($res->num_rows > 0) {
		$res->data_seek(0);
    	$row = $res->fetch_assoc();
		return $row;
	}

	return null ;
}

?>