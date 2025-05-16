<?php
//***************************************************************
//        CLASS RECHERCHE RAPIDE ECHANGE DE MAISON
//***************************************************************
include_once("class.CompBDD.php");

class RechercheAvancee{
	//Construteur
	function RechercheAvancee(){
		
	}
	
	//Méthodes
	
	//Récupérer le département du membre
	function departement($code_postal){
		if(!empty($code_postal)){
			$departement = substr($code_postal, 0, 2);// exemple: 75000 retournera -> 75
		}
	return $departement;
	}

	//Extraire tous les départements disponible dans le pays et échange sélectionné
	function extraireDepartementPays($select_echange, $select_pays){
		$ancien_tableau = array();
		$pays_autorises = array(x, 102, 153, 21, 5, 6, 96, 144, 17);
		// 102=Guyane (Fr.)|153=Maroc|21=Algérie|5=France|6=Allemagne|96=Ile Guadeloupe|
		//S'assurer que le pays soit accepter
		if(array_search($select_pays, $pays_autorises)){
			//Instanciation de la classe requete SQL
			$req = new CompBDD();
			//Récupération de la requête sql
			$recSql = $req->extraireDepartementPaysMYSQL($select_echange, $select_pays);
			while($sql = mysql_fetch_array($recSql)){
				array_push($ancien_tableau, $this->departement($sql['code_postal']));
			}
			
			$nouveau_tableau = array_unique($ancien_tableau);
			
			//Trie du plus petit au plus grand
			sort ($nouveau_tableau);
			
			foreach($nouveau_tableau as $cle){
				if($cle){
					echo "<option value=\"".$cle."\"> dept. : ".$cle." - </option>\n";
				}
				else{
					echo "<option value=\"x\">".RESULTAT_INDISPONIBLE."</option>\n";
				}
			}
		}
		else{
			echo "<option value=\"x\">".RESULTAT_INDISPONIBLE."</option>\n";
		}
	}
	
	function compterAnnonceRechercheAvancee($select_echange, $select_pays, $select_departement){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$sql = $req->compterAnnonceRechercheAvancee($select_echange, $select_pays, $select_departement);
		while ($result = mysql_fetch_array($sql)){
			$total = $result['total'];
		}
		return $total;
	}
	
	function afficherDepartement($id_dept, $select_pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//Récupération de la requête sql
		$sql = $req->getChampsMYSQL("NOMDEPT","departement_".LANGUAGE,"NUMDEPT",$id_dept);
		while ($result = mysql_fetch_object($sql)){
			$departement = $result->NOMDEPT;
		}
		
		if($select_pays == 5){//FRANCE
			$rappel = $departement;
		}
		else{
			$rappel = "";
		}
		return $rappel;
	}
	
	function extraireDept($select_echange, $select_pays){
		$membre = new EspaceMembre();
		
		$ancien_tableau = array();
		$pays_autorises = array(x, 102, 153, 21, 5, 6, 96);
		$type_echange = $membre->getChamps("element", "rubriques_".LANGUAGE, "id", $select_echange);
		$tableau_pays = $membre->getChamps("pays", "pays_".LANGUAGE, "id", $select_pays);
		//S'assurer que le pays soit accepter
		if(array_search($select_pays, $pays_autorises)){
			//Instanciation de la classe requete SQL
			$req = new CompBDD();
			//Récupération de la requête sql
			$recSql = $req->extraireDepartementPaysMYSQL($select_echange, $select_pays);
			while($sql = mysql_fetch_object($recSql)){
				array_push($ancien_tableau, $this->departement($sql->code_postal));
			}
			$nouveau_tableau = array_unique($ancien_tableau);
			//Trie du plus petit au plus grand
			sort ($nouveau_tableau);
			foreach($nouveau_tableau as $cle){
				echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'recherche-avancee1-1-'.$cle.'-'.$select_echange.'-'.$select_pays.'.php">'.$type_echange.' '.$tableau_pays.' '.$this->afficherDepartement($cle, $select_pays).' dept ('.$cle.')</a></li>';
			}
		}
		else{
			echo '<li style="padding-top:10px;">'.HTTP_WARNING.' error !!</li>';
		}
	}
	
	function compterTypeEnLigne($id_pays,$type_echange){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		if($type_echange > 0 AND $type_echange <= 6){
			//ECHANGE MAISON
			$table = TABLE_LISTING_ECHANGE_MAISON;
		}
		elseif($type_echange >= 7 AND $type_echange <= 8){
			//COUCHSURFING
			$table = TABLE_LISTING_COUCHSURFING;
		}
		else{
			//ERREUR
			$table = '';
		}
		$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type_echange."' AND `pays`='".$id_pays."')";
		$result = $req->compterMembresOfflineMYSQL($requete);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
}
?>
