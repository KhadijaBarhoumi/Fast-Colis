<?php

// fichier contient des fonctions utile pour le client 



// fonction qui permet d'inscrire un client 
function client_inscription( $email  , $mot_de_passe , $photo,$cin, $nom , $prenom , $naissance , $sexe ,$telephone ,  $adresse  ){
	//requete
	$req = "INSERT INTO client VALUES (NULL, '".$email."', '".$mot_de_passe."', '".$photo."', '".$cin."', '".$nom."', '".$prenom."', '".$naissance."', ".$sexe.", '".$telephone."', '".$adresse."', 0, CURRENT_TIMESTAMP) ";
	// execution de la requete SQL
	return  bd_exectuer_requete($req);
}


// fonction qui permet de modifier le profil d'un client
function client_modifier_info( $email  , $mot_de_passe, $photo, $cin,  $nom , $prenom , $naissance , $sexe ,$telephone ,  $adresse  ){
	//cryptage md5 
	//$mot_de_passe_md5 = md5($mot_de_passe);
	// execution de la requete SQL
	$requete = "UPDATE client SET  mot_de_passe= '".$mot_de_passe."',photo= '".$photo."',cin= '".$cin."', nom= '".$nom."', prenom= '".$prenom."', naissance='".$naissance."', sexe= ".$sexe.", telephone='".$telephone."', adresse='".$adresse."'  WHERE email='".$email."' ";
	return  bd_exectuer_requete($requete);
}


// fonction qui permet de connecter un client 
function  client_se_connecter($email,$mot_de_passe) {
	//cryptage md5 
	$mot_de_passe_md5 = $mot_de_passe;
	$res = bd_exectuer_requete("SELECT * FROM client WHERE email='".$email."'  AND mot_de_passe='".$mot_de_passe_md5."'");
	if ($res->num_rows > 0 ) {
		// le login et le mot de passe ne sont pas valide
		$_SESSION['connecter'] = "oui";
		$_SESSION['email_client'] = $email;

		//  recupere les infos du c
		$res->data_seek(0);
    	$row = $res->fetch_assoc();

    	if ($row['active'] == 1) {
    		return 0 ;
    	} else {
    		return 2; // compte désactivé
    	}

	} else {
		// erreur login et mot de passe
		return 1 ;
	}
}


// fonction qui permet de deconncter un client deja connecter 
function  client_se_deconnecter() {
	if(isset($_SESSION['connecter'])){
		$_SESSION['connecter'] = "non";
	}
}


// fonction qui permet de tester si le client est connecter ou non 
function client_est_connecter() {
	if (isset($_SESSION['connecter']) && ($_SESSION['connecter'] == 'oui')  ) {
		return true ;
	}
	return false ;
}


// fonction qui permet de recuperer les informations d'un client par son email
function client_recuperer_info($email) {
	$res = bd_exectuer_requete("SELECT * FROM client WHERE email='".$email."'");

	if ($res->num_rows > 0) {
		$res->data_seek(0);
    	$row = $res->fetch_assoc();
		return $row;
	}

	return null ;
}



// fonction qui permet de recuperer les informations d'un client par son id
function client_recuperer_info_par_id($id) {
	$res = bd_exectuer_requete("SELECT * FROM client WHERE id=".$id);

	if ($res->num_rows > 0) {
		$res->data_seek(0);
    	$row = $res->fetch_assoc();
		return $row;
	}

	return null ;
}

// function qui retourne les informations du client connecter
function client_recuperer_connecter () {

	if (client_est_connecter()) {
		$email_client = $_SESSION['email_client'] ;
		return client_recuperer_info($email_client);
	} else {
		return null ;
	}
}




// fonction qui permet de charget un fichier sur le serveur 
function charger_fichier ( $fichier) {

	// si le fichier a charger n'est pas dans la requete
	if (!isset($_FILES[$fichier])) return false;

	// creation du chemain du fichier 
	$dossier_de_chargement = "images/";
	$nom_fichier = basename($_FILES[$fichier]["tmp_name"]);

	$extention = end((explode(".", $_FILES[$fichier]["name"])));

	// test sur le type du fichier 
	if (strtoupper ($extention) != 'JPG'  &&  strtoupper ($extention) != 'JPEG'  && strtoupper ($extention) != 'PNG' ) {
		return false ;	
	} 

	// creation du nouveau chemain
	$chemin = $dossier_de_chargement .$nom_fichier .".".$extention ;

	// placer le fichier dans le  dossier de chargement 
	if (move_uploaded_file($_FILES[$fichier]['tmp_name'], $chemin)) {
		return $chemin ;
	} else {
		false ;
	}
}


// fonction qui permet de recupere tout les clients
function client_recuperer_tout () {
	$res = bd_exectuer_requete("SELECT * FROM client order by date_creation DESC");
	// tableau des clients initialement vide
	$tab_client = []; 
	for( $i = 0 ; $i<$res->num_rows; $i++ ) {
		$res->data_seek($i);
    	$row = $res->fetch_assoc();
    	$tab_client[] = $row;
	}
	return $tab_client ;
}


function client_changer_active($id_client, $active) {

$requete = "UPDATE client SET active='".$active."'  WHERE id=".$id_client." ";
	return  bd_exectuer_requete($requete);

}



?>