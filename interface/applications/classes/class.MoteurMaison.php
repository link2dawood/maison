<?php
//********************************************************
//             CLASS MOTEUR DE RECHERCHE
//********************************************************
include_once("class.CompBDD.php");

class MoteurMaison{
	
	//Constructeur
	function MoteurMaison(){
		
	}
	
	//METHODES
	
	//Enregistrer le mot-clé en base
	function insertionMotCle($motCle, $motCleEncoder, $dateEnregistrement){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$req->insertMotCleEnBaseMYSQL($motCle, $motCleEncoder, $dateEnregistrement);
	}
	
	//Compter le nb de mots-clés en base
	function compterNombreMotCle($motCle){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$recSql = $req->compterAnnonceEnBaseAvecMotCleMYSQL($motCle);
		while($sql = mysql_fetch_array($recSql)){
			$nb_Annonces = $sql['nb_Annonces'];
		}
		return $nb_Annonces;
	}
	
	//Compter le nomdre de mots-clés globale dans la base
	function compterTotalMotsCles(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$sql = $req->compterTotalMotsClesMYSQL();
		while ($result = mysql_fetch_array($sql)){
			$nb_mots = $result['nb_mots'];
		}
		return $nb_mots;
	}
	//Récupérer les mots-clés par fractions...
	function getListingParMotsCles($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$sql = $req->getListingParMotsClesMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		while ($result = mysql_fetch_object($sql)){
			echo '<em><a href="'.HTTP_SERVEUR.'echange-1-'.$result->id_mots.'.php" title="'.$result->element_mot.'">'.$result->element_mot.'</a></em> |';
		}
	}
}
?>
