<?php
	function modifications()
	{
		$erreur = null;
		
		$login = (get_magic_quotes_gpc()) ? stripslashes($_POST['login']) : $_POST['login'];
		if($login == null)
			$erreur = 'Merci d\'entrer un pseudo';
		
		$pass1 = (get_magic_quotes_gpc()) ? stripslashes($_POST['pass1']) : $_POST['pass1'];
		$pass2 = (get_magic_quotes_gpc()) ? stripslashes($_POST['pass2']) : $_POST['pass2'];
		
		if($pass1 != $pass2)
			$erreur = 'Les 2 mots de passe ne sont pas identiques !';
		
		$i = 1;
		$noms_du_site = null;
		while(isset($_POST['nom_du_site' . $i]))
		{
			if($_POST['nom_du_site' . $i] != null)
			{
				$noms_du_site .= '\'';
				$noms_du_site .= (get_magic_quotes_gpc()) ? $_POST['nom_du_site' . $i] : addslashes($_POST['nom_du_site' . $i]);
				$noms_du_site .= '\'';
				if(isset($_POST['nom_du_site' . $i]))
					$noms_du_site .= ',';
			}
			$i++;
		}
		if($noms_du_site == null)
			$erreur = 'Merci d\'entrer au moins un titre pour le site !';
		
		$url_du_site_principal = (get_magic_quotes_gpc()) ? $_POST['url_du_site_principal'] : addslashes($_POST['url_du_site_principal']);
		if(preg_match('#/$#',$url_du_site_principal))
			$url_du_site_principal = preg_replace('#/$#','',$url_du_site_principal);
		if(!preg_match('#^http://[^/]+$#',$url_du_site_principal))
			$erreur = 'Merci d\'entrer une url valide du type : http://adresse.com';
		
		$lien_retour = ($_POST['a_lien_retour_page_interne'] == 'on') ? 'PARTOUT' : 'ACCUEIL';
		
		$type_de_liens = $_POST['lien_en_dur_ou_redirection'];
		if($type_de_liens == null)
			$erreur = 'Merci de spécifier le type de liens (en dur ou redirection ?)';
		
		$envoi_de_mails = ($_POST['a_envoi_mails'] == 'on') ? 'OUI' : 'NON';
		
		$ajout_pages_internes = ($_POST['a_ajout_pages_internes'] == 'on') ? 'OUI' : 'NON';
		
		$liens_xxx = ($_POST['a_liens_xxx'] == 'on') ? 'OUI' : 'NON';
		
		$nbre_lien_par_page = intval($_POST['nbre_lien_par_page']);
		if($nbre_lien_par_page == 0)
			$erreur = 'Merci d\'entrer un nombre valide de lien par page';
		
		$possibilite_ajouter_plusieurs_titres = ($_POST['possibilite_ajouter_plusieurs_titres'] == 'on') ? 'OUI' : 'NON';
		
		$classement = $_POST['classement'];
		if($classement == null)
			$erreur = 'Merci de choisir le type de classement';
		
		$mail_admin = $_POST['mail_admin'];
		if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mail_admin))
			$erreur = 'Merci d\'entrer un mail valide';
		
		if($erreur == null)
		{
			$out = '<?php' . "\n";
			$out .= "\t" . 'define(\'DUR\',0);' . "\n";
			$out .= "\t" . 'define(\'REDIRECTION\',1);' . "\n";
			$out .= "\t" . 'define(\'NON\',0);' . "\n";
			$out .= "\t" . 'define(\'OUI\',1);' . "\n";
			$out .= "\t" . 'define(\'ACCUEIL\',0);' . "\n";
			$out .= "\t" . 'define(\'PARTOUT\',1);' . "\n";
			$out .= "\t" . 'define(\'CROISSANT\',0);' . "\n";
			$out .= "\t" . 'define(\'DECROISSANT\',1);' . "\n\n";
			$out .= "\t" . '$config = array(' . "\n";
			$out .= "\t\t" . '\'login\' => \'' .$login . '\',' . "\n";
			$out .= "\t\t" . '\'pass\' => \'' .$pass1 . '\',' . "\n";
			$out .= "\t\t" . '\'noms_du_site\' => array (' .$noms_du_site . '),' . "\n";
			$out .= "\t\t" . '\'url_du_site_principal\' => \'' . $url_du_site_principal . '\',' . "\n";
			$out .= "\t\t" . '\'lien_retour\' => ' . $lien_retour . ',' . "\n";
			$out .= "\t\t" . '\'type_de_liens\' => ' . $type_de_liens . ',' . "\n";
			$out .= "\t\t" . '\'envoi_de_mails\' => ' . $envoi_de_mails . ',' . "\n";
			$out .= "\t\t" . '\'ajout_pages_internes\' => ' . $ajout_pages_internes . ',' . "\n";
			$out .= "\t\t" . '\'liens_xxx\' => ' . $liens_xxx . ',' . "\n";
			$out .= "\t\t" . '\'nbre_lien_par_page\' => ' . $nbre_lien_par_page . ',' . "\n";
			$out .= "\t\t" . '\'classement\' => ' . $classement . ',' . "\n";
			$out .= "\t\t" . '\'mail_admin\' => \'' . $mail_admin . '\'' . "\n";
			$out .= "\t" . ');' . "\n\n";
			$out .= "\t" . '$config[\'nom_du_site\'] = $config[\'noms_du_site\'][mt_rand(0,count($config[\'noms_du_site\']) - 1)];' . "\n";
			$out .= '?>';
			
			$fichier = fopen('../inc/config.inc.php','w');
			fputs($fichier,$out);
			fclose($fichier);
		}
		
		if($erreur == null)
			return '<span class="title">Modifications enregistrées</span><hr />Les modifications ont été enregistrées avec succès !<br /><br />';
		
		return '<span class="title">Erreur</span><hr />' . $erreur . '<br /><br />';
	}
	
	function titres()
	{
		$i = 1;
		$return = null;
		foreach($GLOBALS['config']['noms_du_site'] as $un_nom)
		{
			$return .= '<label for="nom_du_site' . $i . '">Nom du site n°' . $i . ' : </label><input type="text" name="nom_du_site' . $i . '" id="nom_du_site' . $i . '" value="' . $un_nom . '" /><br />';
			$i++;
		}
		
		return '<p id="titres">' . $return . '</p>';
	}
?>