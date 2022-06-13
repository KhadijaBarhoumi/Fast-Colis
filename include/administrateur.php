<?php


// fonction qui permet de connecter un admin 
function  admin_se_connecter($email,$mot_de_passe) {
	$res = bd_exectuer_requete("SELECT * FROM administrateur WHERE email='".$email."'  AND mot_de_passe='".$mot_de_passe."'");
	if ($res->num_rows > 0 ) {
		// le login et le mot de passe ne sont pas valide
		$_SESSION['connecter_admin'] = "oui";
		$_SESSION['email_admin'] = $email;
		return true ;
	} else {
		// erreur login et mot de passe
		return false ;
	}
}

// fonction qui permet de deconncter un admin deja connecter 
function  admin_se_deconnecter() {
	if(isset($_SESSION['connecter_admin'])){
		$_SESSION['connecter_admin'] = "non";
	}
}


// fonction qui permet de tester si le admin est connecter ou non 
function admin_est_connecter() {
	if (isset($_SESSION['connecter_admin']) && ($_SESSION['connecter_admin'] == 'oui')  ) {
		return true ;
	}
	return false ;
}


?>