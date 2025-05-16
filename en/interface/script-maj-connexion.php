<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_METIER);
$metier = new Metier();


//------------------------------------------------------------
//       SCRIPT MISE A JOUR DES CONNEXIONS OBSOLETES
//------------------------------------------------------------

$metier->tousLesConnectes(time());


?>
