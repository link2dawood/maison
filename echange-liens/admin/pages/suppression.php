<?php
	include(dirname(__FILE__) . '/modeles/suppression.php');
	
	$suppression = new Suppression();
	
	$erreur = null;
	
	if(isset($_GET['suppression']))
		$suppression->supprimerSiteGet();
	
	if(count($_POST) > 0)
		$erreur = $suppression->supprimerSitePost();
	
	$pagination = $suppression->pagination();
	$liste_sites = $suppression->listeSites();
	
	$form_mail = null;
	
	if($config['envoi_de_mails'] == OUI)
		$form_mail = '<input type="checkbox" name="envoi_mail" checked="checked" id="envoi_mail" /> <label for="envoi_mail">Envoyer un mail au webmaster si l\'e-mail a été spécifié</label><br />';
	
	include(dirname(__FILE__) . '/vues/suppression.php');
?>