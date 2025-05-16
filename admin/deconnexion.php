<?php
if ( isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()]) ){
		session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);

//***************************************************
//               PAGE DE DECONNEXION
//***************************************************

if(empty($_SESSION['admin'])){
	//RENVOI ACCUEIL
	redirection(0, HTTP_ADMIN);
}
else{
	//SUPPRIMER LA CONNEXION
	detruireSession();
	echo '<p style="font-size:20px;text-align:center;margin-top:80px;font-weight:bolder;color:grey;">Vous avez été déconnecté avec succès !</p>';
	redirection(3, HTTP_ADMIN);
}