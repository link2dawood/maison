<?php
//***********************************************
//               CLASS LOGIN
//***********************************************
include("class.CompBDD.php");

class Login{
	//Constructeur
	function Login(){
		
	}
	
	//Méthodes
	//Contrôle du login et mot de passe en base
	function controleLogin($pseudo, $motDePasse){
		$req = new CompBDD();
		$array = array();
		
		$sql = $req->controleLoginMYSQL($pseudo, $motDePasse);
		while($mysql = mysql_fetch_object($sql)){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->pseudo); // 1
			array_push($array, $mysql->passe); // 2
			array_push($array, $mysql->date_inscription); // 3
			array_push($array, $mysql->email); // 4
			array_push($array, $mysql->ip); // 5
			array_push($array, $mysql->compte_actif); // 6
			array_push($array, $mysql->type_annonce); // 7
			array_push($array, $mysql->id_annonce); // 8
			array_push($array, $mysql->en_ligne); // 9
		}
		return $array;
	}
	
	function ouvrirConnexion($identifiant, 
							$pseudo,
							$passe, 
							$connexion, 
							$deconnexion, 
							$email, 
							$type_annonce,
							$id_annonce,
							$en_ligne){
		$req = new CompBDD();
		$req->ouvrirConnexionMYSQL($identifiant, 
								$pseudo,
								$passe,
								$connexion, 
								$deconnexion, 
								$email, 
								$type_annonce,
								$id_annonce,
								$en_ligne);
	}
	
	function controleExistenceConnexion($champs, $valeur, $table){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->controleExistenceMYSQL($champs, $valeur, $table);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function controleLoginAdmin($pseudo, $motDePasse){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->controleLoginAdminMYSQL($pseudo, $motDePasse);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, $sql->pseudo); // 0
			array_push($array, $sql->passe); // 1
			array_push($array, $sql->date_last_visite); // 2
		}
		
		return $array;
	}
	
	function majderniereConnexionAdmin($login, $heure){
		$req = new CompBDD();
		//PASSER LE MEMBRE EN CONNECTER
		$req->majderniereConnexionAdminMYSQL($login, $heure);
	}
}
?>
