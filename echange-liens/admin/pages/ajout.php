<?php
	include(dirname(__FILE__) . '/modeles/ajout.php');
	
	$code_retour = '<a href="' . $config['url_du_site_principal'] . '">' . $config['nom_du_site'] . '</a>';
	
	$ajout = new Ajout();
	
	$erreur = null;
	
	if(count($_POST) > 0)
		$erreur = $ajout->ajouterSite();
	
	$form = null;
	
	if($config['lien_retour'] == PARTOUT)
		$form .= 'Entrez l\'url de la page contenant le lien retour : <input type="text" name="url_retour" maxlength="255" value="http://' . htmlspecialchars(preg_replace('#^http://(.*)$#','$1',$url_retour)) . '" /><br />';
	if($config['envoi_de_mails'] == OUI)
		$form .= 'Vous pouvez spécifier votre adresse e-mail (facultatif) : <input type="text" name="mail" maxlength="100" value="' . htmlspecialchars($mail) . '" /><br />';
	
	if($config['lien_retour'] == ACCUEIL)
		$notes = 'Le lien retour doit être placé à l\'accueil du site. <input type="checkbox" name="lien_retour" id="lien_retour" /> <label for="lien_retour">Ce site a le droit de ne pas placer de lien de retour.</label>';
	else
		$notes = 'Note : le lien retour n\'est pas obligatoire.';
	
	include(dirname(__FILE__) . '/vues/ajout.php');
?>