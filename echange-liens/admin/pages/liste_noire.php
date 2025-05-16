<?php
	include(dirname(__FILE__) . '/modeles/liste_noire.php');
	
	$liste = new Liste();
	$erreur = null;

	if(isset($_GET['ajouter']))
		$erreur = $liste->ajouterSite($_GET['ajouter']);

	if(isset($_GET['suppression']))
		$erreur = $liste->supprimerSite($_GET['suppression']);
	
	if($_POST['action'] == 'ajouter')
		$erreur = $liste->ajouterSite($_POST['url']);
	elseif($_POST['action'] == 'supprimer')
		$erreur = $liste->supprimerSite($_POST['url']);
	
	$pagination_sites = $liste->paginationSites();
	$liste_sites = $liste->listeSites();
	
	$pagination_liste_noire = $liste->paginationListeNoire();
	$liste_sites_liste_noire = $liste->listeSitesListeNoire();
	
	include(dirname(__FILE__) . '/vues/liste_noire.php');
?>