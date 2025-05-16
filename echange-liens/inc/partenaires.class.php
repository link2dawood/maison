<?php
	include(dirname(__FILE__) . '/config.inc.php');
	include(dirname(__FILE__) . '/liens.class.php');
	include(dirname(__FILE__) . '/liste_noire.class.php');
	
	class Partenaires
	{
		var $nbre_liens;
		var $sep_gauche;
		var $sep_droit;
		var $var_ordre;
		
		function Partenaires()
		{
			global $config;
			
			$this->nbre_liens = $config['nbre_lien_par_page'];
			$this->sep_gauche = null;
			$this->sep_droit = null;
			$this->var_ordre = $config['classement'];
		}
		
		function getPartenaires()
		{
			$liens = new Liens(dirname(__FILE__) . '/../admin/txt/liens.txt');
			$partenaires = $liens->liensNonBannis();
			
			$start = 0;
			$end = $this->nbre_liens;
			
			if($end > $this->nbre_liens)
				$end = $this->nbre_liens;
			
			if($liens->nombreLiens() == 0)
				return $this->sep_gauche . 'Aucun site n\'est inscrit. Soyez le premier à inscrire le votre !' . $this->sep_droit;
			
			$return = null;
			
			if($this->var_ordre == CROISSANT)
			{
				for($i = $start; $i < $end; $i++)
				{
					if(isset($partenaires[$i]))
						$return .= $this->sep_gauche . '<a href="' . $partenaires[$i][URL] . '">' . $partenaires[$i][TITRE] . '</a> : ' . $partenaires[$i][DESCRIPTION] . $this->sep_droit;
					else
						$i = $end;
				}
			}
			else
			{
				$start = $liens->nombreLiens() - 1;
				$end = $liens->nombreLiens() - $this->nbre_liens - 1;
				for($i = $start; $i > $end; $i--)
				{
					if(isset($partenaires[$i]))
						$return .= $this->sep_gauche . '<a href="' . $partenaires[$i][URL] . '">' . $partenaires[$i][TITRE] . '</a> : ' . $partenaires[$i][DESCRIPTION] . $this->sep_droit;
					else
						$i = $end;
				}
			}
			
			return $return;
		}
		
		function ordre($ordre)
		{
			$this->var_ordre = $ordre;
		}
		
		function nombreAafficher($nbre_liens)
		{
			$this->nbre_liens = $nbre_liens;
		}
		
		function separateurs($sep_gauche, $sep_droit)
		{
			$this->sep_gauche = $sep_gauche;
			$this->sep_droit = $sep_droit;
		}
	}
?>