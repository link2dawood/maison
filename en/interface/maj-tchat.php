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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_MESSAGERIE_2);

echo '<ul>';
	//AFFICHER TOUTES LES DEMANDES MESSENGER
	echo $membre->afficherToutesLesDemandesMessenger($_SESSION['id_client'], $_SESSION['pseudo_client']);	
	echo '</ul>';
?>
