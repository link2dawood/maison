<?php
	if(isset($_SESSION['identification']))
	{
		header('Location: ./');
		exit();
	}
	
	include(dirname(__FILE__) . '/modeles/identification.php');
	
	$erreur = null;
	
	if(count($_POST) > 0)
		$erreur = identification();
	
	include(dirname(__FILE__) . '/vues/identification.php');
?>