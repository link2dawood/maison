<?php 
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

	if(!empty($_SESSION['id_client'])){
		//ON PROTEGE LA CONNEXION CONSTANTE...ON CHARGE LA NOUVELLE PERIODE
		$nouvelle_periode = time() + TEMPS_MAJ_CONNEXION;
		$membre->updateConnexion($nouvelle_periode, $_SESSION['id_client'], $_SESSION['pseudo_client']);
	}
	
	//METTRE A JOUR TOUS LES CONNECTES
	$metier->tousLesConnectes(time());	
	
			
?>
<div id="maj"></div>