<?php

// un fichier qui contient tout les fonctions utile des demandes

// permet de recuperer tout les demandes
function demande_recuprer_tout () {
	$res = bd_exectuer_requete("SELECT * FROM demande order by date_creation DESC");
	// tableau des demandes initialement vide
	$tab_demandes = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_demandes[] = $row;
	}
	return $tab_demandes ;
}


// fonction qui permet de chercher tout les demandes qui contienne un mot
//$titre , $description ,$source ,$destination 
function demande_recuprer_recherche ($mot) {
	$res = bd_exectuer_requete("SELECT * FROM demande WHERE titre LIKE '%".$mot."%' OR description LIKE '%".$mot."%' OR  destination LIKE '%".$mot."%' or source LIKE '%".$mot."%' order by date_creation DESC");
	// tableau des demandes initialement vide
	$tab_demandes = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_demandes[] = $row;
	}
	return $tab_demandes ;
}

function demande_recuprer_demande_client( $id ) {

	$res = bd_exectuer_requete("SELECT * FROM demande  WHERE id_client = '".$id."' order by date_creation DESC ");

	$tab_demandes = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_demandes[] = $row;
	}
	return $tab_demandes ;
}






// function qui permet d'ajoute une nouvelle demande 
function  demande_ajouter($id_client, $titre , $description ,$source ,$destination  ,$date_livraison   ) {
	return  bd_exectuer_requete("INSERT INTO demande VALUES (NULL, ".$id_client." , '".$titre."', '".$description."', '".$source."', '".$destination."', '".$date_livraison."', CURRENT_TIMESTAMP) ");
}



// fonction qui permet de recupere les info d'une demande par son id

function demande_recuperer ( $id ) {
	$res = bd_exectuer_requete("SELECT * FROM demande WHERE id=".$id);

	if ($res->num_rows > 0) {
		$res->data_seek(0);
    	$row = $res->fetch_assoc();
		return $row;
	}

	return null ;
}


// fonction qui permet de supprimer une demande par sont id
function demande_supprimer($id) {
	return  bd_exectuer_requete("DELETE FROM demande WHERE id = ".$id." ");
}

?>