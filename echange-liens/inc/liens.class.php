<?php
	define('URL',1);
	define('TITRE',2);
	define('DESCRIPTION',3);
	define('EMAIL',4);
	define('RETOUR',5);
	
	class Liens
	{
		var $chemin;
		var $liens = array();
		
		function Liens($path)
		{
			$this->chemin = $path;
			if(file_exists($this->chemin)) // si le fichier texte existe, on récupère les liens
			{
				$fichier = file_get_contents($this->chemin);
				
				$contenu = explode('{',$fichier);
				foreach($contenu as $key => $value)
				{
					if($value != null)
					{
						$this->decodeAccolades($value);
						$this->liens[] = explode("\n", $value);
						unset($this->liens[count($this->liens) - 1][0]); // ne contient rien
						unset($this->liens[count($this->liens) - 1][6]); // contient l'accolade fermante
						unset($this->liens[count($this->liens) - 1][7]); // ne contient rien
					}
				}
			}
		}
		
		function ajouterLien($url, $titre, $description, $mail, $retour)
		{
			$this->encodeAccolades($url);
			$this->encodeAccolades($titre);
			$this->encodeAccolades($description);
			$this->encodeAccolades($retour);
			
			$temp = array(
				URL => $url,
				TITRE => $titre,
				DESCRIPTION => $description,
				EMAIL => $mail,
				RETOUR => $retour
			);
			
			$this->liens[] = $temp;
		}
		
		function decodeAccolades(&$string)
		{
			$string = str_replace('&accolade;', '{', $string);
			$string = str_replace('&amp;', '&', $string);
		}
		
		function encodeAccolades(&$string)
		{
			$string = str_replace('&', '&amp;', $string);
			$string = str_replace('{', '&accolade;', $string);
		}
		
		function enregistrer()
		{
			$out = null;
			foreach($this->liens as $un_lien)
			{
				$out .= '{' . "\n";
				$out .= $un_lien[URL] . "\n";
				$out .= $un_lien[TITRE] . "\n";
				$out .= $un_lien[DESCRIPTION] . "\n";
				$out .= $un_lien[EMAIL] . "\n";
				$out .= $un_lien[RETOUR] . "\n";
				$out .= '}' . "\n";
			}
			
			$fichier = fopen($this->chemin,'w');
			fputs($fichier,$out);
			fclose($fichier);
		}
		
		function estPresent($lien, $exactement = false)
		{
			if($exactement)
			{
				foreach($this->liens as $un_site)
				{
					if(similar_text($un_site[URL], $lien) == strlen($lien))
						return true;
				}
			}
			else
			{
				foreach($this->liens as $un_site)
				{
					$domaine = preg_replace('#^http://www\.#','http://', $un_site[URL]);
					$domaine = preg_replace('#^http://([^/]+)/?.*$#','$1', $domaine);
					if(preg_match('#^http://(www\.)?' . $domaine . '#', $lien))
						return true;
				}
			}
			
			return false;
		}
		
		function getInformations($url)
		{
			foreach($this->liens as $un_lien)
			{
				if(similar_text($un_lien[URL],$url) == strlen($url))
					return $un_lien;
			}
			return false;
		}
		
		function liensNonBannis()
		{
			$temp = array();
			$liste_noire = new ListeNoire(str_replace('liens', 'liste_noire', $this->chemin));
			
			foreach($this->liens as $un_lien)
			{
				if(!$liste_noire->estPresent($un_lien[URL]) AND $un_lien[URL] != null)
					$temp[] = $un_lien;
			}
			
			return $temp;
		}
		
		function nombreLiens()
		{
			return count($this->liens);
		}
		
		function supprimerLien($lien)
		{
			foreach($this->liens as $key => $value)
			{
				if(similar_text($value[URL],$lien) == strlen($lien))
					unset($this->liens[$key]);
			}
		}
	}
?>