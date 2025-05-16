<?php
	class ListeNoire
	{
		var $chemin;
		var $liens = array();
		
		function ListeNoire($path)
		{
			$this->chemin = $path;
			
			if(file_exists($this->chemin))
			{
				$fichier = file_get_contents($this->chemin);
				if($fichier != null)
					$this->liens = explode("\n",$fichier);
			}
		}
		
		function ajouterLien($url)
		{
			$this->liens[] = $url;
		}
		
		function enregistrer()
		{
			$out = null;
			
			foreach($this->liens as $un_lien)
				$out .= $un_lien . "\n";
			$out = preg_replace('#' . "\n" . '$#','',$out);
			
			$fichier = fopen($this->chemin,'w');
			fputs($fichier,$out);
			fclose($fichier);
		}
		
		function estPresent($url,$exactement = false)
		{
			if($exactement)
				return in_array($url,$this->liens);
			
			foreach($this->liens as $un_site)
			{
				$domaine = preg_replace('#^http://www\.#','http://',$un_site);
				$domaine = preg_replace('#^http://([^/]+)/?.*$#','$1',$domaine);
				if(preg_match('#^http://(www\.)?' . $domaine . '#',$url))
					return true;
			}
			return false;
		}
		
		function nombreDeLiens()
		{
			return count($this->liens);
		}
		
		function supprimerLien($url)
		{
			foreach($this->liens as $key => $value)
			{
				if(similar_text($value,$url) == strlen($url))
					unset($this->liens[$key]);
			}
		}
	}
?>