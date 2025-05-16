<?php
	if(!file_exists('inc/config.inc.php'))
	{
		header('Location: installation/');
		exit();
	}
	
	include('inc/config.inc.php');
	include('inc/liste_noire.class.php');
	include('inc/liens.class.php');
	include('index.modele.php');
	
	$accueil = new Accueil();
	$erreur = null;
	
	if(count($_POST) > 0)
		$erreur = $accueil->ajouterLien();
	
	$nbre_sites = $accueil->nombreSites();
	$derniers_sites = $accueil->derniersSites();
	$pagination = $accueil->pagination();
	$liste_sites = $accueil->listeSites();
	
	$form = null; // si le lien retour peut �tre partout, $form contiendra un champ texte demandant o� se situe ce lien retour
				// si l'envoi de mails a �t� activ� par l'admin, ajout d'un champ texte demandant l'email du visiteur (champ facultatif)
	$note = null; // affiche une note si le lien retour doit �tre � l'accueil du site
	
	if($config['lien_retour'] == PARTOUT)
		$form .= 'Entrez l\'url de la page contenant le lien retour : <input type="text" name="url_retour" maxlength="255" value="http://' . htmlspecialchars(preg_replace('#^http://(.*)$#', '$1', $url_retour)) . '" /><br />';
	if($config['envoi_de_mails'] == OUI)
		$form .= 'Vous pouvez sp�cifier votre adresse e-mail (facultatif) : <input type="text" name="mail" maxlength="100" value="' . htmlspecialchars($mail) . '" /><br />';
	
	if($config['lien_retour'] == ACCUEIL)
		$note = '<em>Note : Le lien retour doit �tre plac� � l\'accueil du site.</em>';
	
	include('index.vue.php');
?>