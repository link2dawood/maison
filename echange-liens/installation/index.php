<?php
	if(file_exists('../inc/config.inc.php'))
	{
		header('Location: ../');
		exit();
	}
	
	include('index.modele.php');
	
	$erreur = null;
	
	if(count($_POST) > 0)
		$erreur = installation();
	
	include('index.vue.php');
?>