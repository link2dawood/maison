<?php
	include(dirname(__FILE__) . '/modeles/verifications.php');
	
	if(isset($_GET['url']) AND isset($_GET['retour']) AND isset($_GET['mail']) AND isset($_GET['titre']))
	{
		header('Content-type:text/html; charset=iso-8859-1');
		$resultat = testerLien();
	}
	
	if(count($_POST) > 0)
		supprimerLiens();
	
	$liste_sites = listeSites();
	
	include(dirname(__FILE__) . '/vues/verifications.php');
?>