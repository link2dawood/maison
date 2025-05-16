<?php
	class Liste
	{
		var $pageListeNoire;
		var $pageSites;
		
		function ajouterSite($url)
		{
			$liste_noire = new ListeNoire('txt/liste_noire.txt');
			
			$erreur = null;
			
			$url = (get_magic_quotes_gpc() == OUI) ? stripslashes($url) : $url;
			if($url == null)
				$erreur = 'Merci d\'entrer une url !';
			
			if($liste_noire->estPresent($url))
				$erreur = 'Ce site est d�j� sur liste noire !';
			
			if($erreur == null)
			{
				$liste_noire->ajouterLien($url);
				
				if($_POST['envoi_mail'] == 'on')
				{
					$liens = new Liens('txt/liens.txt');
					$infos = $liens->getInformations($url);
					if($infos[EMAIL] != null)
					{
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
						$headers .= 'Reply-To: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
						$headers .= 'X-Mailer: PHP/' . phpversion();
						
						if(!mail($infos[EMAIL], 'Votre site a �t� banni de ' . $GLOBALS['config']['nom_du_site'], 'Votre site ' . $infos[TITRE] . ' a �t� ajout� � la liste noire de ' . $GLOBALS['config']['nom_du_site'] . ' !', $headers))
							$erreur = 'Le site a �t� ajout� � la liste noire, mais le mail n\'a pu �tre envoy� au webmaster.';
					}
				}
				
				$liste_noire->enregistrer();
			}
			
			if($erreur == null)
				return '<span class="title">Site ajout�</span><hr />Le site a �t� ajout� � la liste noire avec succ�s !<br /><br />';
			
			return '<span class="title">Erreur</span><hr />' . $erreur . '<br /><br />';
		}
		
		function listeSites()
		{
			$liste_noire = new ListeNoire('txt/liste_noire.txt');
			$liste_sites = new Liens('txt/liens.txt');
			
			$liste_sites_non_bannis = $liste_sites->liensNonBannis();
			
			$nbre_sites = count($liste_sites_non_bannis);
			
			$start = $this->pageSites * $GLOBALS['config']['nbre_lien_par_page'] - $GLOBALS['config']['nbre_lien_par_page'];
			$end = $this->pageSites * $GLOBALS['config']['nbre_lien_par_page'];
			
			if($end > $nbre_sites)
				$end = $nbre_sites;
			
			if($nbre_sites == 0)
				return 'Aucun site n\'est inscrit.';
			
			$return = null;
			
			if($GLOBALS['config']['classement'] == CROISSANT)
			{
				for($i = $start; $i < $end; $i++)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? 'goto.php?url=' . urlencode($liste_sites_non_bannis[$i][URL]) : $liste_sites_non_bannis[$i][URL];
					$return .= '<a href="' . $lien . '">' . $liste_sites_non_bannis[$i][TITRE] . '</a> | <a href="?page=liste_noire&amp;ajouter=' . urlencode($liste_sites_non_bannis[$i][URL]) . '" onclick="javascript:return confirm(\'Etes-vous s�r de vouloir ajouter ce site � la liste noire ?\');">Ajouter</a><br />';
				}
			}
			else
			{
				$start = $nbre_sites - $start - 1;
				// - 1 car imaginons qu'on ait 4 sites : les indices seront 0,1,2, et 3. Donc 4 ($nbre_sites) - 0 ($start) = 4 (ce n'est qu'un exemple, c'est aussi celui le plus parlant). Probl�me : aucun site � l'indice 4, donc on rajoute - 1
				$end = $nbre_sites - $end - 1;
				for($i = $start; $i > $end; $i--)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? 'goto.php?url=' . urlencode($liste_sites_non_bannis[$i][URL]) : $liste_sites_non_bannis[$i][URL];
					$return .= '<a href="' . $lien . '">' . $liste_sites_non_bannis[$i][TITRE] . '</a> | <a href="?page=liste_noire&amp;ajouter=' . urlencode($liste_sites_non_bannis[$i][URL]) . '" onclick="javascript:return confirm(\'Etes-vous s�r de vouloir ajouter ce site � la liste noire ?\');">Ajouter</a><br />';
				}
			}
			
			return $return;
		}
		
		function listeSitesListeNoire()
		{
			$liste_sites = new ListeNoire('txt/liste_noire.txt');
			
			$nbre_sites = $liste_sites->nombreDeLiens();
			
			$start = $this->pageListeNoire * $GLOBALS['config']['nbre_lien_par_page'] - $GLOBALS['config']['nbre_lien_par_page'];
			$end = $this->pageListeNoire * $GLOBALS['config']['nbre_lien_par_page'];
			
			if($end > $nbre_sites)
				$end = $nbre_sites;
			
			if($nbre_sites == 0)
				return 'Aucun site n\'est pr�sent sur la liste noire.';
			
			$return = null;
			
			if($GLOBALS['config']['classement'] == CROISSANT)
			{
				for($i = $start; $i < $end; $i++)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? '../goto.php?url=' . urlencode($liste_sites->liens[$i]) : $liste_sites->liens[$i];
					$return .= '<a href="' . $lien . '">' . $liste_sites->liens[$i] . '</a> : <a href="?page=liste_noire&amp;suppression=' . urlencode($liste_sites->liens[$i]) . '" onclick="javascript:return confirm(\'Voulez-vous supprimer ce site de la liste noire ?\');">Supprimer</a><br />' . "\n";
				}
			}
			else
			{
				$start = $nbre_sites - $start - 1;
				$end = $nbre_sites - $end - 1;
				for($i = $start; $i > $end; $i--)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? '../goto.php?url=' . urlencode($liste_sites->liens[$i]) : $liste_sites->liens[$i];
					$return .= '<a href="' . $lien . '">' . $liste_sites->liens[$i] . '</a> : <a href="?page=liste_noire&amp;suppression=' . urlencode($liste_sites->liens[$i]) . '" onclick="javascript:return confirm(\'Voulez-vous supprimer ce site de la liste noire ?\');">Supprimer</a><br />' . "\n";
				}
			}
			
			return $return;
		}
		
		function paginationListeNoire()
		{
			$liste_sites = new ListeNoire('txt/liste_noire.txt');
			
			$nbre_sites = $liste_sites->nombreDeLiens();
			
			if(isset($_GET['pagination']))
				$this->pageListeNoire = intval($_GET['pagination']);
			else
				$this->pageListeNoire = 1;
			if($this->pageListeNoire == 0)
				$this->pageListeNoire = 1;
			
			$nbre_pages = ceil($nbre_sites / $GLOBALS['config']['nbre_lien_par_page']);
			
			for($i = 1; $i <= $nbre_pages; $i++)
				$liste_pages .= '<a href="?page=liste_noire&amp;pagination=' . $i . '">' . $i . '</a> - ';
			$liste_pages = preg_replace('# - $#','',$liste_pages);
			
			if($nbre_pages != 0)
				return 'Pages : ' . $liste_pages . '<br /><br />';
			
			return null;
		}
		
		function paginationSites()
		{
			$liste_sites = new Liens('txt/liens.txt');
			
			$nbre_sites = $liste_sites->nombreLiens();
			
			if(isset($_GET['pagination']))
				$this->pageSites = intval($_GET['pagination']);
			else
				$this->pageSites = 1;
			if($this->pageSites == 0)
				$this->pageSites = 1;
			
			$nbre_pages = ceil($nbre_sites / $GLOBALS['config']['nbre_lien_par_page']);
			
			for($i = 1; $i <= $nbre_pages; $i++)
				$liste_pages .= '<a href="?page=liste_noire&amp;pagination=' . $i . '">' . $i . '</a> - ';
			$liste_pages = preg_replace('# - $#', '' , $liste_pages);
			
			if($nbre_pages != 0)
				return 'Pages : ' . $liste_pages . '<br /><br />';
			
			return null;
		}
		
		function supprimerSite($url)
		{
			$liste_noire = new ListeNoire('txt/liste_noire.txt');
			
			$erreur = null;
			
			$url = (get_magic_quotes_gpc() == OUI) ? stripslashes($url) : $url;
			if($url == null)
				$erreur = 'Merci d\'entrer une url !';
			
			if(!$liste_noire->estPresent($url))
				$erreur = 'Le site n\'est pas sur la liste noire !';
			
			if($erreur == null)
			{
				$liste_noire->supprimerLien($url);
				
				if($_POST['envoi_mail'] == 'on')
				{
					$liens = new Liens('txt/liens.txt');
					$infos = $liens->getInformations($url);
					if($infos[EMAIL] != null)
					{
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
						$headers .= 'Reply-To: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
						$headers .= 'X-Mailer: PHP/' . phpversion();
						
						if(!mail($infos[EMAIL],'Votre site a �t� d�banni de ' . $GLOBALS['config']['nom_du_site'],'Votre site ' . $infos[TITRE] . ' a �t� retir� de la liste noire de ' . $GLOBALS['config']['nom_du_site'] . ' !', $headers))
							$erreur = 'Le site a �t� supprim� de la liste noire, mais le mail n\'a pu �tre envoy� au webmaster.';
					}
				}
				
				$liste_noire->enregistrer();
			}
			
			if($erreur == null)
				return '<span class="title">Site supprim�</span><hr />Le site a �t� supprim� de la liste noire avec succ�s !<br /><br />';
			
			return '<span class="title">Erreur</span><hr />' . $erreur . '<br /><br />';
		}
	}
?>