<?php
	include(dirname(__FILE__) . '/modeles/configuration.php');
	
	$erreur = null;
	
	if(count($_POST) > 0)
		$erreur = modifications();
	
	include('../inc/config.inc.php');
	
	$titres = titres();
	
	include(dirname(__FILE__) . '/vues/configuration.php');
?>