


<?php 

// fonction qui permet d'ajouter une nouvelle reclamation


function reclamation_ajouter($id_client,$titre,$description){
	return  bd_exectuer_requete("INSERT INTO reclamation VALUES (NULL, ".$id_client." , '".$titre."', '".$description."', CURRENT_TIMESTAMP) ");
}



// fonction qui perment de recuperer tout les reclamations
function reclamation_recuperer_tout() {

	$res = bd_exectuer_requete("SELECT * FROM reclamation  order by date_creation DESC ");

	$tab_reclamation = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_reclamation[] = $row;
	}
	return $tab_reclamation ;
}

// fonction qui permet de supprimer une reclamation
function reclamation_supprimer($id) {
	return  bd_exectuer_requete("DELETE FROM reclamation WHERE id = ".$id." ");
}





?>