<?php
if ( isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()]) ){
		session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

//***************************************************
//               PAGE DE DECONNEXION
//***************************************************

if(empty($_SESSION['pseudo_client'])){
	//RENVOI ACCUEIL
	redirection('0', HTTP_SERVEUR);
}
else{
	//SUPPRIMER LA CONNEXION
	$metier->deleteConnexionMetier($_SESSION['id_client'], $_SESSION['pseudo_client']);
	
	detruireSession();
	
	redirection('0', HTTP_SERVEUR);
}

?>