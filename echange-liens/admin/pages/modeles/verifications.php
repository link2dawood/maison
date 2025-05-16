<?php
	function listeSites()
	{
		$return = null;
		
		$liste_sites = new Liens('txt/liens.txt');
		$liste_sites_non_bannis = $liste_sites->liensNonBannis();
		
		$i = 0;
		
		foreach($liste_sites_non_bannis as $un_site)
		{
			if($un_site[RETOUR] != null) // si le lien retour existe, donc si l'admin a ajouté un site sans spécifier de lien retour, on n'analyse pas
			{
				$return .= '<input type="hidden" id="url' . $i . '" value="' . urlencode($un_site[URL]) . '" />' . "\n";
				$return .= '<input type="hidden" id="mail' . $i . '" value="' . urlencode($un_site[EMAIL]) . '" />' . "\n";
				$return .= '<input type="hidden" id="titre' . $i . '" value="' . urlencode($un_site[TITRE]) . '" />' . "\n";
				if($GLOBALS['config']['lien_retour'] == PARTOUT)
					$return .= '<input type="hidden" id="retour' . $i . '" value="' . urlencode($un_site[RETOUR]) . '" />' . "\n";
				else
					$return .= '<input type="hidden" id="retour' . $i . '" value="' . urlencode(preg_replace('#^http(s)?://([^/]+)/?.*$#', 'http$1://$2', $un_site[RETOUR])) . '" />' . "\n";
				$i++;
			}
		}
		
		return $return;
	}
	
	function supprimerLiens()
	{
		$liste_sites = new Liens('txt/liens.txt');
		$i = 0;
		
		while(isset($_POST['checkbox' . $i]))
		{
			$liste_sites->supprimerLien($_POST['url' . $i]);
			
			$infos = $liste_sites->getInformations($_POST['url' . $i]);
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
			$headers .= 'Reply-To: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			
			if($GLOBALS['config']['lien_retour'] == PARTOUT)
				mail($infos[EMAIL], 'Votre site a été supprimé de ' . $GLOBALS['config']['nom_du_site'], 'Votre site ' . $infos[TITRE] . ' a été supprimé de ' . $GLOBALS['config']['nom_du_site'] . ' car le lien de retour n\'y est plus.', $headers);
			else
				mail($infos[EMAIL], 'Votre site a été supprimé de ' . $GLOBALS['config']['nom_du_site'], 'Votre site ' . $infos[TITRE] . ' a été supprimé de ' . $GLOBALS['config']['nom_du_site'] . ' car le lien de retour n\'y est plus. Il faut qu\'il soit présent sur la page d\'accueil de votre site.', $headers);
			
			$i++;
		}
		$liste_sites->enregistrer();
	}
	
	function testerLien()
	{
		$contenu = file_get_contents($_GET['retour']);
		if(!$contenu)
			return 'ERREUR';
		
		if(preg_match('#<a href="' . $GLOBALS['config']['url_du_site_principal'] . '">#i', $contenu))
			return 'VALIDE';
		
		return 'INVALIDE';
	}
?>