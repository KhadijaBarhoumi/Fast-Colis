

<?php

// fonction qui permet de recuperer tout les avis sur un utilisateu
function avis_recuprer_avis_utilisateur( $id_utilisateur){

	$res = bd_exectuer_requete("SELECT * FROM avis  WHERE id_client_destinataire = ".$id_utilisateur." order by date_creation DESC ");
	$tab_avis = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_avis[] = $row;
	}
	return $tab_avis ;
}

// fonction qui permet d'ajouter un nouveau avis sur un utlisateur
//  `id` `id_client_source` `note` `text` `id_client_destinataire` `date_creaction`
function  avis_ajouter_avis ( $id_client_source , $note , $text , $id_client_destinataire ) {
	return  bd_exectuer_requete("INSERT INTO avis VALUES (NULL, ".$id_client_source." , ".$note." , '".$text."', ".$id_client_destinataire.", CURRENT_TIMESTAMP) ");
}




?>