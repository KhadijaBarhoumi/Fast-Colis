<?php



// Fichier qui contient des fonctions qui permet de utiliser la base de données
// 




// fonction qui permet de se connecter a la base de données
function bd_connecter(){

	// Les acces du serveur mysql
	$serveur = 'localhost' ;
	$utilisateur = 'root' ;
	$mot_de_passe = '' ;
	$nom_base = 'livraison';

	$mysqli = new mysqli($serveur, $utilisateur, $mot_de_passe, $nom_base );
	if ($mysqli->connect_errno) {
	    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	    return null;
	}
	return $mysqli ;
}




// function qui permet d'executer une requete SQL et elle retourne le resultat
function bd_exectuer_requete( $requete ){
	$mysqli = bd_connecter();
	if ($mysqli == null) {
		return null;
	}
	return $mysqli->query($requete);
}



?>
