<?php
	class Suppression
	{
		var $pagination;
		var $nbre_sites;
		var $liste_noire;
		var $liste_sites;
		
		function Suppression()
		{
			$this->liste_noire = new ListeNoire('txt/liste_noire.txt');
			$this->liste_sites = new Liens('txt/liens.txt');
		}
		
		function listeSites()
		{
			$start = $this->pagination * $GLOBALS['config']['nbre_lien_par_page'] - $GLOBALS['config']['nbre_lien_par_page'];
			$end = $this->pagination * $GLOBALS['config']['nbre_lien_par_page'];
			
			if($end > $this->nbre_sites)
				$end = $this->nbre_sites;
			
			if($this->nbre_sites == 0)
				return 'Aucun site n\'est inscrit.';
			
			$return = null;
			
			if($GLOBALS['config']['classement'] == CROISSANT)
			{
				for($i = $start; $i < $end; $i++)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? '../goto.php?url=' . urlencode($this->liste_sites->liens[$i][URL]) : $this->liste_sites->liens[$i][URL];
					$return .= '<a href="' . $lien . '">' . $this->liste_sites->liens[$i][TITRE] . '</a>  | <a href="?page=suppression&amp;suppression=' . urlencode($this->liste_sites->liens[$i][URL]) . '" onclick="javascript:return confirm(\'Etes-vous sûr de supprimer ce lien ?\');">Supprimer</a><br />' . "\n";
				}
			}
			else
			{
				$start = $this->nbre_sites - $start - 1;
				// - 1 car imaginons qu'on ait 4 sites : les indices seront 0,1,2, et 3. Donc 4 ($nbre_sites) - 0 ($start) = 4 (ce n'est qu'un exemple, c'est aussi celui le plus parlant). Problème : aucun site à l'indice 4, donc on rajoute - 1
				$end = $this->nbre_sites - $end - 1;
				for($i = $start; $i > $end; $i--)
				{
					$lien = ($GLOBALS['config']['type_de_liens'] == REDIRECTION) ? '../goto.php?url=' . urlencode($this->liste_sites->liens[$i][URL]) : $this->liste_sites->liens[$i][URL];
					$return .= '<a href="' . $lien . '">' . $this->liste_sites->liens[$i][TITRE] . '</a> | <a href="?page=suppression&amp;suppression=' . urlencode($this->liste_sites->liens[$i][URL]) . '" onclick="javascript:return confirm(\'Etes-vous sûr de supprimer ce lien ?\');">Supprimer</a><br />' . "\n";
				}
			}
			
			return $return;
		}
		
		function pagination()
		{
			$this->nbre_sites = 0;
			foreach($this->liste_sites->liens as $un_site)
			{
				if(!$this->liste_noire->estPresent($un_site[URL]))
					$this->nbre_sites++;
			}
			
			if(isset($_GET['pagination']))
				$this->pagination = intval($_GET['pagination']);
			else
				$this->pagination = 1;
			if($this->pagination == 0)
				$this->pagination = 1;
			
			$nbre_pages = ceil($this->nbre_sites / $GLOBALS['config']['nbre_lien_par_page']);
			
			for($i = 1; $i <= $nbre_pages; $i++)
				$liste_pages .= '<a href="?page=suppression&amp;pagination=' . $i . '">' . $i . '</a> - ';
			$liste_pages = preg_replace('# - $#','',$liste_pages);
			
			if($nbre_pages == 0)
				return null;
			
			return 'Pages : ' . $liste_pages . '<br /><br />';
		}
		
		function supprimerSiteGet()
		{
			$this->liste_sites->supprimerLien($_GET['suppression']);
			$this->liste_sites->enregistrer();
		}
		
		function supprimerSitePost()
		{
			$url = (get_magic_quotes_gpc() == OUI) ? stripslashes($_POST['url']) : $_POST['url'];
			
			$infos = $this->liste_sites->getInformations($url);
			
			if(!$infos)
				return '<span class="title">Erreur</span><hr />L\'url spécifiée est introuvable !<br /><br />';
			
			$this->liste_sites->supprimerLien($url);
			$this->liste_sites->enregistrer();
			
			if($_POST['envoi_mail'] == 'on')
			{
				if($mail != null)
				{
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
					$headers .= 'Reply-To: ' . $GLOBALS['config']['mail_admin'] . "\r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($infos[EMAIL], 'Votre site a été supprimé de ' . $GLOBALS['config']['nom_du_site'], 'Votre site ' . $infos[TITRE] . ' a été supprimé de ' . $GLOBALS['config']['nom_du_site'] . ' !', $headers))
						return '<span class="title">Erreur</span><hr />Le site a été supprimé, mais le mail n\'a pu être envoyé au webmaster.<br /><br />';
				}
			}
			
			return '<span class="title">Site supprimé</span><hr />Le site a été supprimé avec succès !<br /><br />';
		}
	}
?>