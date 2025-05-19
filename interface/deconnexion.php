<?php
if ( isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()]) ){
		session_start() ;
}
include('../interface/applications/commun/fct-utile.php');
include('../config.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
include('../interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('../interface/applications/classes/class.Metier.php');


require_once('../interface/applications/commun/configuration.php');
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