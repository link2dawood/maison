<?php
//***********************************************
//               CLASS FLUX XML
//***********************************************
include("class.CompBDD.php");

class FluxXml{
	//Constructeur
	function FluxXml(){
		
	}
	
	//Méthodes
	
	//Récupérer les 10 derniers articles...
	function listerUrlListProfilXML(){
		$req = new CompBDD();
		$mysql = $req->listerLienProfilMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo "<url>\n"
				."<loc>".HTTP_SERVEUR."profil-".$sql->id.".php</loc>\n"
				."</url>\n";
		}
	}
	
	function listerUrlListProfil(){
		$req = new CompBDD();
		$mysql = $req->listerLienProfilMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo HTTP_SERVEUR."profil-".$sql->id.".php<br />\n";
		}
	}
	
	function getUrlListArticleBlog($table){
		$req = new CompBDD();
		$mysql = $req->getUrlListArticleBlogMYSQL($table);
		while($sql = mysql_fetch_object($mysql)){
			echo HTTP_BLOG."article-".$sql->id_cat."-".$sql->id_article.".php<br />\n";
		}
	}
	
	function getUrlListArticleBlogXML($table){
		$req = new CompBDD();
		$mysql = $req->getUrlListArticleBlogMYSQL($table);
		while($sql = mysql_fetch_object($mysql)){
			echo "<url>\n"
				."<loc>".HTTP_BLOG."article-".$sql->id_cat."-".$sql->id_article.".php</loc>\n"
				."</url>\n";
		}
	}
	
	function getUrlListMotsCles(){
		$req = new CompBDD();
		$mysql = $req->getUrlListMotsClesMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo HTTP_SERVEUR."echange-1-".$sql->id_mots.".php<br />\n";
		}
	}
	
	function getUrlListMotsClesXML(){
		$req = new CompBDD();
		$mysql = $req->getUrlListMotsClesMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo "<url>\n"
				."<loc>".HTTP_SERVEUR."echange-1-".$sql->id_mots.".php</loc>\n"
				."</url>\n";
		}
	}
	
	function getUrlListDepartements($table,$num){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$mysql = $req->getDepartementMYSQL($table);
		while ($sql = mysql_fetch_object($mysql)){
			for($i=1;$i<=8;$i++){
				echo HTTP_SERVEUR."recherche-avancee1-1-".$sql->numdept."-".$i."-".$num.".php<br />\n";
			}
		}
	}
	
	function getUrlListDepartementsXML($table,$num){
		$req = new CompBDD();
		$mysql = $req->getDepartementMYSQL($table);
		while($sql = mysql_fetch_object($mysql)){
			for($i=1;$i<=8;$i++){
				echo "<url>\n"
					."<loc>".HTTP_SERVEUR."recherche-avancee1-1-".$sql->numdept."-".$i."-".$num.".php</loc>\n"
					."</url>\n";
			}
		}
	}
	
	function getFluxXmlDesAnnonces($id_echange, $id_pays){
		$membre = new EspaceMembre();
		$req = new CompBDD();
		
		//1- Obtenir le type d'échange
		$type = $membre->getChamps("element", "rubriques_".LANGUAGE, "id", $id_echange);
		//3- Obtenir le reste de l'annonce
		if($id_echange > 0 AND $id_echange <=6){
			//PARTIE ECHANGE
			$table = TABLE_LISTING_ECHANGE_MAISON;
		}
		else{
			//PARTIE COUCHSURFING
			$table = TABLE_LISTING_COUCHSURFING;
		}
		$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$id_echange."' AND `pays`='".$id_pays."')";
		
		$mysql = $req->afficherExtraitAnnoncesMYSQL(0, 20, $requete);
		
		//Récupérer le nb de ligne de résultat
		$nbResultat = mysql_num_rows($mysql);
		//Solution1: il n'y a pas de résultat à cette recherche
		if($nbResultat == 0){
			echo "<item>\n"
				."<title>".TEXTE_28."</title>\n"
				."<link>".HTTP_SERVEUR."</link>\n"
				."<description>".TEXTE_29."</description>\n"
				."</item>\n";
		}
		else{
			while($sql = mysql_fetch_object($mysql)){
				$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $sql->id);
				$annonce = $membre->getTable($table, "identifiant", $sql->id);
				$pays = $membre->getChamps("pays", "pays_".LANGUAGE, "id", $id_pays);
				
				echo "<item>\n"
					."<title>".TEXTE_30." ".$type." - ".TEXTE_31." ".$identite->ville." - ".TEXTE_32." ".$pays."</title>\n"
					."<link>".HTTP_SERVEUR."profil-".$sql->id.".php</link>\n"
					."<description>".TEXTE_33." ".$annonce->date1." ".TEXTE_34." ".$annonce->date2."</description>\n"
					."</item>\n";
			}
		}
	}
	
	function listerUrlListCarnetDeVoyage(){
		$req = new CompBDD();
		$mysql = $req->listerUrlListCarnetDeVoyageMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo HTTP_SERVEUR."carnet-de-voyage-".$sql->identifiant.".php<br />\n";
		}
	}
	
	function listerCarnetDeVoyageXML(){
		$req = new CompBDD();
		$mysql = $req->listerUrlListCarnetDeVoyageMYSQL();
		while($sql = mysql_fetch_object($mysql)){
			echo "<url>\n"
				."<loc>".HTTP_SERVEUR."carnet-de-voyage-".$sql->identifiant.".php</loc>\n"
				."</url>\n";
		}
	}
}
?>
