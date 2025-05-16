<?php
	session_start();

	if(!file_exists('../inc/config.inc.php'))
	{
		header('Location: ../installation/');
		exit();
	}
	
	if(!isset($_SESSION['identification']) AND $_GET['page'] != 'identification')
		header('Location: index.php?page=identification');
	
	include('../inc/config.inc.php');
	include('../inc/liste_noire.class.php');
	include('../inc/liens.class.php');
	
	$menu = '<div id="menu"><a href="?page=accueil">Accueil</a> | <a href="?page=ajout">Ajouter un site</a> | <a href="?page=configuration">Modifier la configuration</a> | <a href="?page=liste_noire">Gestion de la liste noire</a> | <a href="?page=suppression">Supprimer un site</a> | <a href="?page=verifications">Vérifier la présence des liens retour</a></div>';
	$footer = '<div id="footer">Propulsé par <a href="http://www.paidpr.com">PaidPR</a>, <a href="#">Scripts SEO</a> » <a href="#">Script échange de liens automatique</a> <b>GRATUIT</b></div>';
	
	if(isset($_GET['page']) AND !empty($_GET['page']) AND is_file('pages/' . $_GET['page'] . '.php'))
		include('pages/' . $_GET['page'] . '.php');
	else
		include('pages/accueil.php');
?>