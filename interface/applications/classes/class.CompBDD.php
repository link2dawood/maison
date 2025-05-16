<?php
//*************************************************************
//      EXTENSION DE LA CLASS POUR GERER LES REQUETES SQL
//*************************************************************
include_once("class.BDD.php");

class CompBDD extends BDD{
	
	//Constructeur
	function CompBDD(){
		
	}
	
	function getIDAnnonceAccueilMYSQL($genre, $min, $max){
		$REQ = "SELECT `id` FROM ".TABLE_INSCRIPTION." WHERE `en_ligne`='ok' AND `compte_actif`='0' AND ".$genre." AND `id` IN (SELECT `identifiant` FROM `".TABLE_ALBUM_PHOTO."` WHERE `img1`!='' AND `controle`='1') ORDER BY `id` DESC LIMIT ".$min.",".$max."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherDerniersInscritsMYSQL($cle){
		$REQ = "SELECT `i`.`id`, `i`.`pseudo`, `a`.`img1`, `a`.`controle` FROM `".TABLE_INSCRIPTION."` i,`".TABLE_ALBUM_PHOTO."` a WHERE `i`.`id`='".$cle."' AND `a`.`identifiant`=`i`.`id`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleLoginMYSQL($pseudo, $motDePasse){
		$REQ = "SELECT * FROM ".TABLE_INSCRIPTION." WHERE `pseudo`='".$pseudo."' AND `passe`='".$motDePasse."' AND `compte_actif`='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherDerniersInscritsEspaceMembreMYSQL($correspondance_je_suis, $correspondance_je_recherche, $maxi){
		$REQ = "SELECT `id`, `pseudo`, `photo`, `statut` FROM ".TABLE_INSCRIPTION." WHERE photo!='' AND statut='ok' AND type_membre='".$correspondance_je_suis."' AND type_recherche='".$correspondance_je_recherche."' AND compte_actif='0' ORDER by id DESC LIMIT 0,".$maxi."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherOptionsMYSQL($language){
		$REQ = "SELECT `nature`, `genre` FROM ".TABLE_OPTIONS." WHERE `langue`='".$language."' ORDER by `nature`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherPaysMYSQL($language){
		$REQ = "SELECT `id`, `pays` FROM pays_$language ORDER by `pays`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getListingMYSQL($table){
		$REQ = "SELECT * FROM `".$table."` ORDER by `element`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMoisMYSQL($table){
		$REQ = "SELECT * FROM `".$table."` ORDER by `id`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getDepartementMYSQL($table){
		$REQ = "SELECT `numdept`, `nomdept` FROM ".$table." ORDER BY `nomdept`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleExistenceMYSQL($champs, $valeur, $table){
		$REQ = "SELECT COUNT(*) AS compter FROM `$table` WHERE `$champs`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertNouveauCompteMYSQL($pseudo, $mot_de_passe, $temps, $email, $ip){
		$REQ = "INSERT INTO `".TABLE_INSCRIPTION."`(`pseudo`,`passe`,`date_inscription`,`email`,`ip`) VALUES('".$pseudo."','".$mot_de_passe."','".$temps."','".$email."','".$ip."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherDepartementMYSQL($table){
		$REQ = "SELECT `numdept`, `nomdept` FROM ".$table;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getIdPseudoMYSQL($pseudo, $mot_de_passe){
		$REQ = "SELECT id FROM ".TABLE_INSCRIPTION." WHERE `pseudo`='".$pseudo."' AND `passe`='".$mot_de_passe."' AND compte_actif='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterConnexionMYSQL($id_pseudo, $pseudo, $mot_de_passe, $heure_connexion, $heure_deconnexion, $email){
		$REQ = "INSERT INTO ".TABLE_ONLINE."(" .
				"`identifiant`, " .
				"`pseudo`, " .
				"`passe`, " .
				"`connexion`, " .
				"`deconnexion`, " .
				"`email`)" .
				" VALUES('".$id_pseudo."', " .
						"'".$pseudo."', " .
						"'".$mot_de_passe."', " .
						"'".$heure_connexion."', " .
						"'".$heure_deconnexion."', " .
						"'".$email."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertPhotosMYSQL($identifiant,$extension){
		$REQ = "INSERT INTO `".TABLE_ALBUM_PHOTO."`(`identifiant`,`img1`) VALUES('".$identifiant."','".$extension."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updatePhotosMYSQL($champ,$valeur,$champ1,$valeur1){
		$REQ = "UPDATE `".TABLE_ALBUM_PHOTO."` SET `".$champ."`='".$valeur."' WHERE `".$champ1."`='".$valeur1."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getChampsMYSQL($retour, $table, $champs, $valeur){
		$REQ = "SELECT `".$retour."` FROM `".$table."` WHERE `".$champs."`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getDerniereEntreeMYSQL($retour, $table, $champs, $valeur){
		$REQ = "SELECT $retour FROM $table WHERE $champs='".$valeur."' LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getChampsLangueMYSQL($retour, $table, $champs, $valeur){
		$REQ = "SELECT $retour FROM $table WHERE $champs='".$valeur."' AND `langue`='".LANGUAGE."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getElementTablePartenaireIdealMYSQL($table, $langue){
		$REQ = "SELECT element, numero FROM $table WHERE `langue`='".$langue."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getInscriptionMYSQL($id_client){
		$REQ = "SELECT * FROM ".TABLE_INSCRIPTION." WHERE `id`='".$id_client."' AND `compte_actif`='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ouvrirConnexionMYSQL($identifiant, $pseudo,$passe, $connexion, $deconnexion, $email, $type_annonce,$id_annonce,$en_ligne){
		$REQ = "INSERT INTO ".TABLE_ONLINE."(" .
				"`identifiant`, " .
				"`pseudo`, " .
				"`passe`, " .
				"`connexion`, " .
				"`deconnexion`, " .
				"`email`, " .
				"`type_annonce`," .
				"`id_annonce`," .
				"`en_ligne`" .
				") VALUES(" .
				"'".$identifiant."', " .
				"'".$pseudo."', " .
				"'".$passe."', " .
				"'".$connexion."', " .
				"'".$deconnexion."', " .
				"'".$email."', " .
				"'".$type_annonce."'," .
				"'".$id_annonce."'," .
				"'".$en_ligne."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getConnexionMYSQL($id_client, $pseudo_client){
		$REQ = "SELECT `date_creation`, `date_cloture` FROM ".TABLE_CONNEXION." WHERE `id_client`='".$id_client."' AND `pseudo_client`='".$pseudo_client."' ORDER by id DESC LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateConnexionMYSQL($nouvelle_periode, $id_client, $pseudo_client){
		$REQ = "UPDATE ".TABLE_ONLINE." SET `deconnexion`='".$nouvelle_periode."' WHERE `identifiant`='".$id_client."' AND `pseudo`='".$pseudo_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function deleteConnexionMYSQL($id_client, $pseudo_client){
		$REQ = "DELETE FROM ".TABLE_CONNEXION." WHERE `id_client`='".$id_client."' AND `pseudo_client`='".$pseudo_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function activerConnexionMYSQL($id_client, $pseudo_client, $etat){
		$REQ = "UPDATE ".TABLE_INSCRIPTION." SET `etat_connecter`='".$etat."' WHERE `id`='".$id_client."' AND `pseudo`='".$pseudo_client."' AND compte_actif='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherExtraitAnnoncesMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete){
		$REQ = "SELECT `id`,`id_annonce`,`pseudo` FROM `".TABLE_INSCRIPTION."` ".$requete." ORDER by `id` DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionMessengerMYSQL($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, $msg_texte, $msg_audio, $msg_video, $msg_duo, $etat, $genre){
		$REQ = "INSERT INTO ".TABLE_MESSENGER."(`id_expediteur`, `pseudo_expediteur`, `id_destinataire`, `pseudo_destinataire`, `date_creation`, `msg_texte`, `msg_audio`, `msg_video`, `duo`, `lu`, `genre`) VALUES('".$id_client."', '".$pseudo_client."', '".$id_destinataire."', '".$pseudo_destinataire."', '".$dt_creation."', '".$msg_texte."', '".$msg_audio."', '".$msg_video."', '".$msg_duo."', '".$etat."', '".$genre."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterIdMessageParentMYSQL($msg_parent, $id_incrementation, $table, $champs, $id_insert_message){
		$REQ = "UPDATE ".$table." SET `".$msg_parent."`='".$id_incrementation."' WHERE `".$champs."`='".$id_insert_message."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherToutesLesDemandesMessengerMYSQL($id_client,$pseudo_client){
		$REQ = "SELECT * FROM ".TABLE_MESSENGER." WHERE `id_destinataire`='".$id_client."' AND `pseudo_destinataire`='".$pseudo_client."' AND `lu`='non' GROUP by `msg_parent` ORDER by `id` DESC";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function deleteMessengerMYSQL($id_client, $pseudo_client, $champ_1, $champ_2){
		$REQ = "DELETE FROM ".TABLE_MESSENGER." WHERE `".$champ_1."`='".$id_client."' AND `".$champ_2."`='".$pseudo_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMessengerMYSQL($id_messenger){
		$REQ = "SELECT * FROM ".TABLE_MESSENGER." WHERE `id`='".$id_messenger."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMessengerParMsgParentMYSQL($id_messenger){
		$REQ = "SELECT * FROM ".TABLE_MESSENGER." WHERE `msg_parent`='".$id_messenger."' ORDER BY id ASC";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMessagerieMYSQL($id_messenger){
		$REQ = "SELECT * FROM ".TABLE_MESSAGERIE." WHERE `id`='".$id_messenger."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateMessengerLuMYSQL($id_messenger){
		$REQ = "UPDATE ".TABLE_MESSENGER." SET `lu`='oui' WHERE `msg_parent`='".$id_messenger."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function supprimerUnElementMYSQL($table, $champs, $valeur){
		$REQ = "DELETE FROM `".$table."` WHERE `".$champs."`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function supprimerFavoriMYSQL($id_profil,$id_visiteur){
		$REQ = "DELETE FROM `".TABLE_COMPTEUR_PROFIL."` WHERE `id_profil`='".$id_profil."' AND `id_visiteur`='".$id_visiteur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function verifierMessageEnvoyerMYSQL($id_pseudo, $pseudo, $id_client, $pseudo_client, $action){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSENGER." WHERE `id_expediteur`='".$id_client."' AND `pseudo_expediteur`='".$pseudo_client."' AND `id_destinataire`='".$id_pseudo."' AND `pseudo_destinataire`='".$pseudo."' AND `genre`='".$action."' AND `lu`='non'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function verifierMembreBlacklisterMYSQL($id_pseudo, $id_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_BLACKLISTER." WHERE `id_pseudo`='".$id_pseudo."' AND `id_pseudo_blacklister`='".$id_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getErreurMYSQL($numero){
		$REQ = "SELECT `element` FROM ".TABLE_MESSAGES_ALERTE." WHERE `id`='".$numero."' AND `langue`='".LANGUAGE."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterMessageInformationsDirectMYSQL($message, $id_client, $pseudo_client, $date_ajout){
		$REQ = "INSERT INTO ".TABLE_INFORMATIONS_DIRECT."(`id_client`, `pseudo_client`, `element`, `langue`, `date_creation`) VALUES('".$id_client."', '".$pseudo_client."', '".$message."', '".LANGUAGE."', '".$date_ajout."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherDerniereInfoMYSQL($id_client, $pseudo_client){
		$REQ = "SELECT `element` FROM ".TABLE_INFORMATIONS_DIRECT." WHERE `id_client`='".$id_client."' AND `pseudo_client`='".$pseudo_client."' AND `langue`='".LANGUAGE."' ORDER by id DESC LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function verifierMembreDuoWebcamMYSQL($id_client, $pseudo_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_WEBCAM_DUO." WHERE (`id_demande`='".$id_client."' AND `pseudo_demande`='".$pseudo_client."') OR (`id_client_accepter`='".$id_client."' AND `pseudo_client_accepter`='".$pseudo_client."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function verifierSiMembreAvoirFaitAutresDemandesMYSQL($id_expediteur, $pseudo_expediteur, $id_destinataire, $genre){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSENGER." WHERE `id_expediteur`='".$id_expediteur."' AND `pseudo_expediteur`='".$pseudo_expediteur."' AND `lu`='non' AND `genre`='".$genre."' AND `id_destinataire`!='".$id_destinataire."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesMYSQL($table, $id_expediteur, $pseudo_expediteur, $genre, $lu){
		$REQ = "SELECT COUNT(*) AS compter FROM ".$table." WHERE `id_expediteur`='".$id_expediteur."' AND `pseudo_expediteur`='".$pseudo_expediteur."' AND `genre`='".$genre."' AND `lu`='".$lu."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesDuMembreCommeExpediteurMYSQL($table, $id_expediteur, $pseudo_expediteur, $lu){
		$REQ = "SELECT COUNT(*) AS compter FROM ".$table." WHERE `id_expediteur`='".$id_expediteur."' AND `pseudo_expediteur`='".$pseudo_expediteur."' AND `lu`='".$lu."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesDuMembreCommeDestinataireMYSQL($table, $id_expediteur, $pseudo_expediteur, $lu){
		$REQ = "SELECT COUNT(*) AS compter FROM ".$table." WHERE `id_destinataire`='".$id_expediteur."' AND `pseudo_destinataire`='".$pseudo_expediteur."' AND `lu`='".$lu."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesDestinataireMYSQL($table, $id_expediteur, $pseudo_expediteur, $genre, $lu){
		$REQ = "SELECT COUNT(*) AS compter FROM ".$table." WHERE `id_destinataire`='".$id_expediteur."' AND `pseudo_destinataire`='".$pseudo_expediteur."' AND `genre`='".$genre."' AND `lu`='".$lu."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function verifierMessageEnvoyerMessagerieMYSQL($id_pseudo, $pseudo, $id_client, $pseudo_client, $action){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSAGERIE." WHERE `id_expediteur`='".$id_client."' AND `pseudo_expediteur`='".$pseudo_client."' AND `id_destinataire`='".$id_pseudo."' AND `pseudo_destinataire`='".$pseudo."' AND `genre`='".$action."' AND `lu`='non'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionMessagerieMYSQL($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, $msg_texte, $msg_audio, $msg_video, $msg_duo, $etat, $genre){
		$REQ = "INSERT INTO ".TABLE_MESSAGERIE."(`id_expediteur`, `pseudo_expediteur`, `id_destinataire`, `pseudo_destinataire`, `date_creation`, `msg_texte`, `msg_audio`, `msg_video`, `suppression`, `lu`, `genre`) VALUES('".$id_client."', '".$pseudo_client."', '".$id_destinataire."', '".$pseudo_destinataire."', '".$dt_creation."', '".$msg_texte."', '".$msg_audio."', '".$msg_video."', '".$msg_duo."', '".$etat."', '".$genre."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesReceptionMYSQL($id_client,$pseudo_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSAGERIE." WHERE `id_destinataire`='".$id_client."' AND `pseudo_destinataire`='".$pseudo_client."' AND `suppression`=''";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesNonLusMYSQL($id_client,$pseudo_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSAGERIE." WHERE `id_destinataire`='".$id_client."' AND `pseudo_destinataire`='".$pseudo_client."' AND `lu`='non'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherTousLesMessagesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client){
		$REQ = "SELECT id FROM ".TABLE_MESSAGERIE." WHERE `id_destinataire`='".$id_client."' AND `pseudo_destinataire`='".$pseudo_client."' AND `suppression`='' ORDER by id DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateMessagerieParIdMYSQL($champ, $valeur, $id_messenger){
		$REQ = "UPDATE ".TABLE_MESSAGERIE." SET `$champ`='".$valeur."' WHERE `id`='".$id_messenger."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesEnvoyerMYSQL($id_client,$pseudo_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSAGERIE." WHERE `id_expediteur`='".$id_client."' AND `pseudo_expediteur`='".$pseudo_client."' AND `suppression`=''";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherTousLesMessagesEnvoyesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client){
		$REQ = "SELECT id FROM ".TABLE_MESSAGERIE." WHERE `id_expediteur`='".$id_client."' AND `pseudo_expediteur`='".$pseudo_client."' AND `suppression`='' ORDER by id DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMessagesSupprimesMYSQL($id_client,$pseudo_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_MESSAGERIE." WHERE `id_expediteur`='".$id_client."' AND `pseudo_expediteur`='".$pseudo_client."' AND `suppression`='oui'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function tousLesConnectesMYSQL($heure){
		$REQ = "SELECT `identifiant`, `pseudo` FROM ".TABLE_ONLINE." WHERE `deconnexion`<'".$heure."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresBlacklistesMYSQL($id_membre){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_BLACKLISTER." WHERE `id_pseudo`='".$id_membre."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherMembresBlacklistesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client){
		$REQ = "SELECT * FROM ".TABLE_BLACKLISTER." WHERE `id_pseudo`='".$id_client."' ORDER by id DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouveauMembreBlacklistMYSQL($id_client,$id_blacklist,$heure){
		$REQ = "INSERT INTO ".TABLE_BLACKLISTER."(`id_pseudo`, `id_pseudo_blacklister`, `date_blacklist`) VALUES('".$id_client."', '".$id_blacklist."', '".$heure."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleSiMembreBlacklistParAutreMembreMYSQL($id_client,$id_blacklister){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_BLACKLISTER." WHERE `id_pseudo`='".$id_client."' AND `id_pseudo_blacklister`='".$id_blacklister."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function listerMessagesDuoWebcamMYSQL($id_client, $pseudo_client, $id_expediteur, $pseudo_expediteur){
		$REQ = "SELECT * FROM ".TABLE_WEBCAM_DUO." WHERE " .
				"(`id_demande`='".$id_client."' AND `pseudo_demande`='".$pseudo_client."' AND `id_client_accepter`='".$id_expediteur."' AND `pseudo_client_accepter`='".$pseudo_expediteur."')" .
				" OR " .
				"(`id_demande`='".$id_expediteur."' AND `pseudo_demande`='".$pseudo_expediteur."' AND `id_client_accepter`='".$id_client."' AND `pseudo_client_accepter`='".$pseudo_client."')" .
				" ORDER by id ASC LIMIT 0,".NOMBRE_MESSAGES_DUO_WEBCAM."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function envoyerConfirmationDuoMYSQL($id_expediteur, $pseudo_expediteur, $id_destinataire, $pseudo_destinataire, $duo, $lu, $id_msg){
		$REQ = "UPDATE ".TABLE_MESSENGER." SET `id_expediteur`='".$id_expediteur."'," .
												"`pseudo_expediteur`='".$pseudo_expediteur."', " .
												"`id_destinataire`='".$id_destinataire."', " .
												"`pseudo_destinataire`='".$pseudo_destinataire."', " .
												"`duo`='".$duo."', " .
												"`lu`='".$lu."' WHERE `id`='".$id_msg."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function deleteMessengerParIDMYSQL($id_msg){
		$REQ = "DELETE FROM ".TABLE_MESSENGER." WHERE `id`='".$id_msg."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function connecterMembreDuoMYSQL($id_client){
		$REQ = "INSERT INTO ".TABLE_LISTE_MEMBRES_CONNECTER_DUO."(`id_membre`) VALUES('".$id_client."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterCompteurProfilMYSQL($id_client,$id_profil){
		$REQ = "INSERT INTO ".TABLE_COMPTEUR_PROFIL."(`id_profil`, `id_visiteur`) VALUES('".$id_profil."', '".$id_client."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterVisitesMYSQL($id_client){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_COMPTEUR_PROFIL." WHERE `id_profil`='".$id_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterVisitesParIdClientMYSQL($id_client){
		$REQ = "SELECT DISTINCT COUNT(*) AS compter FROM ".TABLE_COMPTEUR_PROFIL." WHERE `id_profil`='".$id_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterListingVisitesMYSQL($id_client,$id_visiteur){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_COMPTEUR_PROFIL." WHERE `id_profil`='".$id_client."' AND `id_visiteur`='".$id_visiteur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherListingVisitesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client){
		$REQ = "SELECT * FROM ".TABLE_COMPTEUR_PROFIL." WHERE `id_profil`='".$id_client."' GROUP BY `id_profil` ORDER by id DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getComptePaiementMYSQL($pseudo_client){
		$REQ = "SELECT * FROM ".BDD_BASE_DE_DONNEES_PAIEMENTS.".".TABLE_PAIEMENTS." WHERE `pseudo`='".$pseudo_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function dernierMessageMessengerMYSQL($pseudo_client){
		$REQ = "SELECT id FROM ".TABLE_MESSENGER." WHERE `pseudo_expediteur`='".$pseudo_client."' OR `pseudo_destinataire`='".$pseudo_client."' ORDER by id DESC LIMIT 0, 1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMediaMYSQL($pseudo_client){
		$REQ = "SELECT * FROM ".TABLE_CONTROLEUR_MEDIA." WHERE `pseudo_membre`='".$pseudo_client."' ORDER by `id` DESC LIMIT 0, 1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleLoginAdminMYSQL($pseudo, $motDePasse){
		$REQ = "SELECT `pseudo`, `passe`, `date_last_visite` FROM ".TABLE_ADMINISTRATION." WHERE `pseudo`='".$pseudo."' AND `passe`='".$motDePasse."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function majderniereConnexionAdminMYSQL($login, $heure){
		$REQ = "UPDATE ".TABLE_ADMINISTRATION." SET `date_last_visite`='".$heure."' WHERE `pseudo`='".$login."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateIdentifiantsAdminMYSQL($login, $passe, $passe_non_crypte){
		$REQ = "UPDATE ".TABLE_ADMINISTRATION." SET `pseudo`='".$login."', `passe`='".$passe."', `passe_non_crypte`='".$passe_non_crypte."' WHERE `id`='1'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresMYSQL($tri_compter){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_INSCRIPTION." ".$tri_compter;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherTousLesMembresMYSQL($premierMembresAafficher, $nombreMembresParPage, $tri){
		$REQ = "SELECT * FROM ".TABLE_INSCRIPTION." ".$tri." LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertNouvelleInscriptionMYSQL($id_pseudo, $heure){
		$REQ = "INSERT INTO ".TABLE_NOUVEAUX_INSCRITS."(`identifiant`, `date_creation`) VALUES('".$id_pseudo."', '".$heure."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getDerniersInscritsMYSQL(){
		$REQ = "SELECT * FROM ".TABLE_NOUVEAUX_INSCRITS." LIMIT 0, 1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterDerniersInscritsMYSQL(){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_NOUVEAUX_INSCRITS."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getConfigurationMYSQL(){
		$REQ = "SELECT `parametrage` FROM ".TABLE_CONFIGURATION;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateConfigurationMYSQL($config, $id_config){
		$REQ = "UPDATE ".TABLE_CONFIGURATION." SET `parametrage`='".$config."' WHERE `id`='".$id_config."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getOptionsMYSQL($table){
		$REQ = "SELECT * FROM `".$table."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getRelationMYSQL(){
		$REQ = "SELECT * FROM `".TABLE_RELATION."` ORDER BY `je_suis`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getOptionParRefMYSQL($id){
		$REQ = "SELECT `genre` FROM `".TABLE_OPTIONS."` WHERE `nature`='".$id."' AND `langue`='fr'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateTableAdminMYSQL($table, $champs, $valeur, $where_champs, $where_valeur){
		$REQ = "UPDATE ".$table." SET `".$champs."`='".$valeur."' WHERE `".$where_champs."`='".$where_valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getTableIdMYSQL($table){
		$REQ = "SELECT `id` FROM ".$table;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterDonneesEnAttenteMYSQL($lien,$texte,$email,$anchor,$nb_aleatoire, $formule){
		$REQ = "INSERT INTO ".TABLE_PAIEMENT_ATTENTE_CONFIRMATION."(`email`, `lien`, `texte`, `anchor`, `identifiant`, `formule`)" .
				" VALUES('".$email."', '".$lien."', '".$texte."', '".$anchor."', '".$nb_aleatoire."', '".$formule."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getPaiementPaypalMYSQL($identifiant){
		$REQ = "SELECT * FROM ".TABLE_PAIEMENT_ATTENTE_CONFIRMATION." WHERE `identifiant`='".$identifiant."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterNouvellePubliciteMYSQL($email,$lien,$texte,$anchor, $formule, $heure, $partie){
		$REQ = "INSERT INTO ".TABLE_AFFICHAGE."(`email`, `lien`, `texte`, `anchor`, `formule`, `date_creation`, `compteur`)" .
				" VALUES('".$email."', '".$lien."', '".$texte."', '".$anchor."', '".$formule."', '".$heure."', '".$partie."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getUneAnnoncePubMYSQL(){
		$REQ = "SELECT * FROM ".TABLE_AFFICHAGE." ORDER BY RAND() LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateCompteurAffichageMYSQL($compteur, $id){
		$REQ = "UPDATE ".TABLE_AFFICHAGE." SET `compteur`='".$compteur."' WHERE `id`='".$id."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleValiditePubMYSQL($heure){
		$REQ = "SELECT `id` FROM `".TABLE_AFFICHAGE."` WHERE `anchor`<'".$heure."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getAnnoncePubMYSQL($formulaire_email){
		$REQ = "SELECT * FROM ".TABLE_AFFICHAGE." WHERE `email`='".$formulaire_email."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getAbonnementMYSQL($duree, $table, $langue){
		$REQ = "SELECT * FROM ".$table." WHERE `duree`='".$duree."' AND `langue`='".$langue."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterPaiementMYSQL($pseudo_membre,$cloture){
		$REQ = "INSERT INTO ".TABLE_PAIEMENTS."(`pseudo`, `date_fin`)" .
				" VALUES('".$pseudo_membre."', '".$cloture."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateElementMYSQL($table, $set_champ, $set_valeur, $champ, $valeur){
		$REQ = "UPDATE `".$table."` SET `$set_champ`='".$set_valeur."' WHERE `".$champ."`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertNouveauMediaMYSQL($table, $pseudo, $chemin){
		$REQ = "INSERT INTO `".$table."`(`pseudo`, `fichier`)" .
				" VALUES('".$pseudo."', '".$chemin."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouvelleRelationMYSQL($je_suis, $je_recherche, $correspondance_je_suis, $correspondance_je_recherche){
		$REQ = "INSERT INTO ".TABLE_RELATION."(`je_suis`, `je_recherche`, `correspondance_je_suis`, `correspondance_je_recherche`)" .
				" VALUES('".$je_suis."', '".$je_recherche."', '".$correspondance_je_suis."', '".$correspondance_je_recherche."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function controleRelationExistanteMYSQL($je_suis, $je_recherche, $correspondance_je_suis, $correspondance_je_recherche){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_RELATION." " .
				"WHERE `je_suis`='".$je_suis."' " .
				"AND `je_recherche`='".$je_recherche."' " .
				"AND `correspondance_je_suis`='".$correspondance_je_suis."' " .
				"AND `correspondance_je_recherche`='".$correspondance_je_recherche."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function initialiserTableMYSQL($table){
		$REQ = "TRUNCATE TABLE `".$table."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getEmailMYSQL(){
		$REQ = "SELECT `email` FROM ".TABLE_INSCRIPTION."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function enregisterNewsletterMYSQL($description, $date_enregist){
		$REQ = "INSERT INTO ".TABLE_ECRIRE_NEWSLETTER."(`contenu`, `date_enregist`) VALUES('".$description."', '".$date_enregist."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateNewsletterMYSQL($description, $traitement){
		$REQ = "UPDATE ".TABLE_ECRIRE_NEWSLETTER." SET `contenu`='".$description."' WHERE `id`='".$traitement."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresOnlineMYSQL($requete){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_ONLINE."` ".$requete."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresOfflineMYSQL($requete){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_INSCRIPTION."` ".$requete."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getOnlineMembreMYSQL($id_client){
		$REQ = "SELECT * FROM `".TABLE_ONLINE."` WHERE `identifiant`='".$id_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherExtraitAnnoncesOnlineMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete){
		$REQ = "SELECT `identifiant`,`id_annonce`,`pseudo` FROM `".TABLE_ONLINE."` ".$requete." ORDER by `identifiant` DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateIdentiteMYSQL($nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange,$identifiant){
		$REQ = "UPDATE `".TABLE_IDENTITE."` SET `nom`='".$nom."', `prenom`='".$prenom."', `adresse`='".$adresse."', `code_postal`='".$code_postal."', `ville`='".$ville."', `pays`='".$pays."', `type_echange`='".$type_echange."' WHERE `identifiant`='".$identifiant."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getCorrespondanceMYSQL($id_exp, $id_dest){
		$REQ = "SELECT DISTINCT `id` FROM ".TABLE_CONVERSATION_ONLINE." WHERE (`id_exp`='".$id_exp."' AND `id_dest`='".$id_dest."') OR (`id_exp`='".$id_dest."' AND `id_dest`='".$id_exp."') LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionCorrespondanceMYSQL($id_exp, $id_dest){
		$REQ = "INSERT INTO ".TABLE_CONVERSATION_ONLINE."(`id_exp`, `id_dest`) VALUES('".$id_exp."', '".$id_dest."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getExpediteurConversationMYSQL($id_exp, $id_msg_parent){
		$REQ = "SELECT DISTINCT `id_expediteur` FROM ".TABLE_MESSENGER." WHERE `msg_parent`='".$id_msg_parent."' AND `id_destinataire`='".$id_exp."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getTableauTarifMYSQL($ref){
		$REQ = "SELECT * FROM ".TABLE_GRILLE_TARIFAIRE." WHERE `partie`='".$ref."' ORDER by id ASC";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getTableMYSQL($table, $champ, $valeur){
		$REQ = "SELECT * FROM `".$table."` WHERE `".$champ."`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getAllTableConditionMYSQL(){
		$REQ = "SELECT * FROM `".TABLE_CONDITION."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getAffichageAleatoireMYSQL($partie){
		$REQ = "SELECT * FROM ".TABLE_AFFICHAGE." WHERE `compteur`='".$partie."' ORDER BY RAND() LIMIT 0, 1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertIdentifiantsMYSQL($pseudo_client,$timeur){
		$REQ = "INSERT INTO ".TABLE_CONTROLEUR_MEDIA."(`pseudo_membre`, `identifiant`) VALUES('".$pseudo_client."', '".$timeur."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterFichierFLVMYSQL($flv, $heure, $repertoireFLV){
		$REQ = "INSERT INTO ".TABLE_ARCHIVE_FLV."(`libelle`, `date_creation`, `repertoire`) VALUES('".$flv."', '".$heure."', '".$repertoireFLV."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function effacerFLVMYSQL($table, $id_client, $pseudo_client, $champ_1, $champ_2){
		$REQ = "SELECT `msg_audio`, `msg_video` FROM ".$table." WHERE `".$champ_1."`='".$id_client."' AND `".$champ_2."`='".$pseudo_client."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function garbageFLVMYSQL(){
		$REQ = "SELECT `libelle`, `repertoire` FROM ".TABLE_ARCHIVE_FLV;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableClassiqueMYSQL(){
		$REQ = "INSERT INTO `".TABLE_RELATION."` (`id`, `je_suis`, `je_recherche`, `correspondance_je_suis`, `correspondance_je_recherche`) VALUES 
				(1, 1, 2, 2, 1),
				(2, 1, 1, 1, 1),
				(3, 2, 1, 1, 2),
				(4, 2, 2, 2, 2)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableOptionClassiqueMYSQL(){
		$REQ = "INSERT INTO `".TABLE_OPTIONS."` (`id`, `genre`, `langue`, `nature`) VALUES 
				(1, 'homme', 'fr', 1),
				(2, 'femme', 'fr', 2),
				(3, 'man', 'en', 1),
				(4, 'woman', 'en', 2),
				(5, 'mann', 'de', 1),
				(8, 'frau', 'de', 2)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableConditionMYSQL(){
		$REQ = "INSERT INTO `".TABLE_CONDITION."` ( `id` , `je_suis` , `je_recherche` ) VALUES ('1', '2', '1')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableLibertinMYSQL(){
		$REQ = "INSERT INTO `".TABLE_RELATION."` (`id`, `je_suis`, `je_recherche`, `correspondance_je_suis`, `correspondance_je_recherche`) VALUES 
				(1, 1, 2, 2, 1),
				(2, 1, 1, 1, 1),
				(3, 2, 1, 1, 2),
				(4, 2, 2, 2, 2)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableOptionLibertinMYSQL(){
		$REQ = "INSERT INTO `".TABLE_OPTIONS."` (`id`, `genre`, `langue`, `nature`) VALUES 
				(1, 'libertin', 'fr', 1),
				(2, 'libertine', 'fr', 2),
				(3, 'man', 'en', 1),
				(4, 'woman', 'en', 2),
				(5, 'mann', 'de', 1),
				(8, 'frau', 'de', 2)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableMixteMYSQL(){
		$REQ = "INSERT INTO `".TABLE_RELATION."` (`id`, `je_suis`, `je_recherche`, `correspondance_je_suis`, `correspondance_je_recherche`) VALUES 
				(1, 1, 1, 1, 1),
				(2, 1, 2, 2, 1),
				(3, 1, 3, 3, 1),
				(4, 1, 4, 4, 1),
				(5, 2, 2, 2, 2),
				(6, 2, 1, 1, 2),
				(7, 2, 3, 3, 2),
				(8, 2, 4, 4, 2),
				(9, 3, 1, 1, 3),
				(10, 3, 2, 2, 3),
				(11, 3, 3, 3, 3),
				(12, 3, 4, 4, 3),
				(13, 4, 1, 1, 4),
				(14, 4, 2, 2, 4),
				(15, 4, 3, 3, 4),
				(16, 4, 4, 4, 4)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function chargerTableOptionMixteMYSQL(){
		$REQ = "INSERT INTO `".TABLE_OPTIONS."` (`id`, `genre`, `langue`, `nature`) VALUES 
				(1, 'homme', 'fr', 1),
				(2, 'femme', 'fr', 2),
				(3, 'libertin', 'fr', 3),
				(4, 'man', 'en', 1),
				(5, 'woman', 'en', 2),
				(6, 'libertin', 'en', 3),
				(7, 'mann', 'de', 1),
				(8, 'frau', 'de', 2),
				(9, 'libertin', 'de', 3),
				(10, 'libertine', 'fr', 4),
				(11, 'libertine', 'en', 4),
				(12, 'libertine', 'de', 4)";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionConditionMYSQL($except){
		$REQ = "INSERT INTO `".TABLE_CONDITION."`(`except`) VALUES ('".$except."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterConditionMYSQL(){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_CONDITION."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getConditionGratuiteMYSQL($type){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_CONDITION."` WHERE `except`='".$type."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterConditionTypeMYSQL($type){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_CONDITION."` WHERE `je_suis`='".$type."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function listerLienProfilMYSQL(){
		$REQ = "SELECT `id` FROM ".TABLE_INSCRIPTION." WHERE `compte_actif`='0' AND `id_annonce`!= '' AND `en_ligne` = 'ok' ORDER BY `id` DESC";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherTousLesPaysMYSQL($langue,$min,$max){
		$REQ = "SELECT `id`, `pays` FROM `pays_$langue` ORDER by `pays` LIMIT ".$min.",".$max."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	function afficherTousLesDepartementsMYSQL($langue,$min,$max){
		$REQ = "SELECT `numdept`, `nomdept` FROM `departement_$langue` ORDER by `nomdept` LIMIT ".$min.",".$max."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterTousLesMembresParPaysDeptMYSQL($id_pays, $id_depart){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_INSCRIPTION." WHERE `domiciliation`='".$id_pays."' AND `departement`='".$id_depart."' AND `compte_actif`='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterTousLesMembresParPaysMYSQL($id_pays){
		$REQ = "SELECT COUNT(*) AS compter FROM ".TABLE_INSCRIPTION." WHERE `domiciliation`='".$id_pays."' AND `compte_actif`='0'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getUrlListArticleBlogMYSQL($table){
		$REQ = "SELECT `id_article`,`id_cat` FROM `".$table."` ORDER by `id_article`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertMailingMYSQL($newsletter){
		$REQ = "INSERT INTO `".TABLE_CRON_MAILINGLIST."`(`lettre`) VALUES('".$newsletter."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getLastMailinglistMYSQL(){
		$REQ = "SELECT `lettre` FROM `".TABLE_CRON_MAILINGLIST."` ORDER BY `id` DESC LIMIT 0,1;";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterTousLesMessagesMYSQL($table){
		$REQ = "SELECT COUNT(*) AS compter FROM `".$table."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherAllMessagesMYSQL($premierMembresAafficher, $nombreMembresParPage, $table){
		$REQ = "SELECT `id` FROM `".$table."` ORDER by `id` DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterElement($table,$champ,$valeur){
		$REQ = "SELECT COUNT(*) AS compter FROM `".$table."` WHERE `".$champ."`='".$valeur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherAllMessagesParIdMYSQL($premierMembresAafficher, $nombreMembresParPage, $table,$id_compte){
		$REQ = "SELECT `id` FROM `".$table."` WHERE `id_expediteur`='".$id_compte."' ORDER by `id` DESC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherEchangeMYSQL($ma_req){
		$REQ = "SELECT * FROM `".TABLE_RUBRIQUES_ECHANGE.LANGUAGE."` ".$ma_req;
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function lesDerniersArticlesBlogMYSQL(){
		$REQ = "SELECT `id_article`, `titre_article`, `id_cat` FROM `".TABLE_BLOG.LANGUAGE."` ORDER BY `id_article` DESC LIMIT 3";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouvelleIdentiteMYSQL($identifiant,$nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange){
		$REQ = "INSERT INTO `".TABLE_IDENTITE."`(`identifiant`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `pays`, `type_echange`)" .
				" VALUES('".$identifiant."', '".$nom."', '".$prenom."', '".$adresse."', '".$code_postal."', '".$ville."', '".$pays."', '".$type_echange."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouvelleAnnonceMYSQL($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,
	$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,
	$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,
	$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech){
		$REQ = "INSERT INTO `".$table."`" .
				"(`identifiant`, `date1`, `date2`, `situation`, `type_logement`, `niveau`, `capacite`, `ch_adulte`, `ch_enfant`," .
				" `canape`, `sdb`, `cuisine`, `terrasse`, `barbecue`, `jardin`, `piscine`, `velo`," .
				" `garage`, `animaux`, `voiture`, `handicape`, `fumeur`, `commentaire1`, `commentaire2`, `date3`," .
				" `date4`, `destination1`, `destination2`, `destination3`, `destination4`, `type_rech1`, `type_rech2`, `type_rech3`," .
				" `type_rech4`, `capac_rech`, `fumeur_rech`, `velo_rech`, `voiture_rech`)" .
				" VALUES('".$identifiant."', '".$date1."', '".$date2."', '".$situation."', '".$type."', '".$niveau."', '".$capacite."'," .
				" '".$ch_adulte."', '".$ch_enfant."', '".$canape."', '".$sdb."', '".$cuisine."', '".$terrasse."', '".$barbecue."', '".$jardin."', '".$piscine."'," .
				"'".$velo."', '".$garage."', '".$animaux."', '".$voiture."', '".$handicape."', '".$fumeur."', '".$commentaire1."', '".$commentaire2."', '".$date3."', '".$date4."'" .
				", '".$destination1."', '".$destination2."', '".$destination3."', '".$destination4."', '".$type_rech_1."', '".$type_rech_2."', '".$type_rech_3."', '".$type_rech_4."', '".$capac_rech."'," .
				" '".$fumeur_rech."', '".$velo_rech."', '".$voiture_rech."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateAnnonceMYSQL($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,
	$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,
	$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,
	$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech){
		$REQ = "UPDATE `".$table."` SET " .
				"`date1`='".$date1."', `date2`='".$date2."', `situation`='".$situation."', `type_logement`='".$type."', `niveau`='".$niveau."', `capacite`='".$capacite."', `ch_adulte`='".$ch_adulte."', `ch_enfant`='".$ch_enfant."'," .
				" `canape`='".$canape."', `sdb`='".$sdb."', `cuisine`='".$cuisine."', `terrasse`='".$terrasse."', `barbecue`='".$barbecue."', `jardin`='".$jardin."', `piscine`='".$piscine."', `velo`='".$velo."'," .
				" `garage`='".$garage."', `animaux`='".$animaux."', `voiture`='".$voiture."', `handicape`='".$handicape."', `fumeur`='".$fumeur."', `commentaire1`='".$commentaire1."', `commentaire2`='".$commentaire2."', `date3`='".$date3."'," .
				" `date4`='".$date4."', `destination1`='".$destination1."', `destination2`='".$destination2."', `destination3`='".$destination3."', `destination4`='".$destination4."', `type_rech1`='".$type_rech_1."', `type_rech2`='".$type_rech_2."', `type_rech3`='".$type_rech_3."'," .
				" `type_rech4`='".$type_rech_4."', `capac_rech`='".$capac_rech."', `fumeur_rech`='".$fumeur_rech."', `velo_rech`='".$velo_rech."', `voiture_rech`='".$voiture_rech."' WHERE `identifiant`='".$identifiant."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getFavoriMYSQL($id_client,$mini,$maxi){
		$REQ = "SELECT `id_visiteur` FROM `".TABLE_COMPTEUR_PROFIL."` WHERE `id_profil`='".$id_client."' GROUP BY `id_visiteur` ORDER BY `id` DESC LIMIT ".$mini.",".$maxi."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMisEnFavoriMYSQL($id_profil,$id_visiteur){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_COMPTEUR_PROFIL."` WHERE `id_profil`='".$id_profil."' AND `id_visiteur`='".$id_visiteur."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajouterFavoriMYSQL($id_profil,$id_visiteur){
		$REQ = "INSERT INTO `".TABLE_COMPTEUR_PROFIL."`(`id_profil`,`id_visiteur`) VALUES('".$id_profil."','".$id_visiteur."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function ajoutHistoriquePaiementMYSQL($pseudo, $date_ouverture,$cloture,$type_abonnement,$abonnement){
		$REQ = "INSERT INTO `".TABLE_HISTORIQUE_PAIEMENT."`(`pseudo`,`date_debut`,`date_fin`,`type_abonnement`,`abonnement`) VALUES('".$pseudo."','".$date_ouverture."','".$cloture."','".$type_abonnement."','".$abonnement."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherHistoriquePaiementMYSQL($premierMembresAafficher, $nombreMembresParPage, $pseudo_client){
		$REQ = "SELECT * FROM ".TABLE_HISTORIQUE_PAIEMENT." WHERE `pseudo`='".$pseudo_client."' ORDER by `id` ASC LIMIT ".$premierMembresAafficher.", ".$nombreMembresParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertMotCleEnBaseMYSQL($motCle, $motCleEncoder, $dateEnregistrement){
		$REQ = "INSERT INTO `".TABLE_MOTS_CLES."` VALUES('', '".$motCle."', '".$motCleEncoder."', '".$dateEnregistrement."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterAnnonceEnBaseAvecMotCleMYSQL($mot_cle){
		$REQ = "SELECT COUNT( * ) AS nb_Annonces FROM `".TABLE_INSCRIPTION."` WHERE (`id_annonce` != '' AND `en_ligne` = 'ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_LISTING_ECHANGE_MAISON."` WHERE `commentaire1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `commentaire2` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `destination1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci )) OR (`id_annonce` != '' AND `en_ligne` = 'ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_LISTING_COUCHSURFING."` WHERE `commentaire1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `commentaire2` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `destination1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci))";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterTotalMotsClesMYSQL(){
		$REQ = "SELECT COUNT(*) AS nb_mots FROM `".TABLE_MOTS_CLES."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getListingParMotsClesMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$REQ = "SELECT * FROM `".TABLE_MOTS_CLES."` ORDER BY `id_mots` ASC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function extraireDepartementPaysMYSQL($select_echange, $select_pays){
		$REQ = "SELECT `code_postal` FROM `".TABLE_IDENTITE."` WHERE `pays`='".$select_pays."' AND `type_echange`='".$select_echange."' AND `identifiant` IN (SELECT `id` FROM `".TABLE_INSCRIPTION."` WHERE `id_annonce` != '' AND `en_ligne` = 'ok')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getCommentairesLivreDorMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$REQ = "SELECT `commentaire_livre_dor`, `pseudo_livre_dor`, `date_livre_dor` FROM `".TABLE_LIVRE_DOR."` WHERE `accepter_message`='ok' ORDER BY `id_livre_dor` DESC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouveauLivreDorMYSQL($pseudo,$heure,$commentaire){
		$REQ = "INSERT INTO `".TABLE_LIVRE_DOR."`(`pseudo_livre_dor`, `date_livre_dor`, `commentaire_livre_dor`) VALUES('".$pseudo."', '".$heure."', '".$commentaire."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getCategoriesBlogMYSQL(){
		$REQ = "SELECT * FROM `".TABLE_BLOG_CATEGORIES.LANGUAGE."` ORDER BY `cat`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getUnArticleMYSQL($id_article, $id_categorie){
		$REQ = "SELECT `titre_article`, `texte_article` FROM `".TABLE_BLOG.LANGUAGE."` WHERE `id_article`='".$id_article."' AND `id_cat`='".$id_categorie."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getDernierArticleBlogMYSQL($numeroCategorie){
		$REQ = "SELECT `titre_article`, `texte_article` FROM `".TABLE_BLOG.LANGUAGE."` WHERE `id_cat`='".$numeroCategorie."' ORDER BY `id_article` DESC LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function listerTitresArticlesBlogMYSQL($numeroCategorie){
		$REQ = "SELECT `id_article`, `titre_article` FROM `".TABLE_BLOG.LANGUAGE."` WHERE `id_cat`='".$numeroCategorie."' ORDER BY `id_article` DESC";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getUrlListMotsClesMYSQL(){
		$REQ = "SELECT `id_mots` FROM `".TABLE_MOTS_CLES."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionNouvelleCategorieMYSQL($nouvelle_categorie,$lang){
		$REQ = "INSERT INTO `".TABLE_BLOG_CATEGORIES.$lang."`(`cat`) VALUES('".$nouvelle_categorie."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getTableElementMYSQL($table,$element){
		$REQ = "SELECT `".$element."` FROM `".$table."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function updateCategorieMYSQL($ma_categorie, $key,$table){
		$REQ = "UPDATE `".$table."` SET `cat`='".$ma_categorie."' WHERE `id_cat`='".$key."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getMenuDeroulantMYSQL($table,$requete){
		$REQ = "SELECT * FROM `".$table."` ".$requete."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertionArticleBlogMYSQL($titre, $texte,$id_cat,$heure,$lang){
		$REQ = "INSERT INTO `".TABLE_BLOG.$lang."`(`titre_article`,`texte_article`,`id_cat`,`date_creation`) VALUES('".$titre."','".$texte."','".$id_cat."','".$heure."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertLivreDorMYSQL($message,$pseudo,$confirmation,$heure){
		$REQ = "INSERT INTO `".TABLE_LIVRE_DOR."`(`pseudo_livre_dor`,`date_livre_dor`,`commentaire_livre_dor`,`accepter_message`) VALUES('".$pseudo."','".$heure."','".$message."','".$confirmation."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getCommentairesLivreDorADMINMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage,$accepter_message){
		$REQ = "SELECT `id_livre_dor`,`commentaire_livre_dor`, `pseudo_livre_dor`, `date_livre_dor` FROM `".TABLE_LIVRE_DOR."` WHERE `accepter_message`='".$accepter_message."' ORDER BY `id_livre_dor` DESC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterBibliothequeMYSQL(){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_BIBLIOTHEQUE."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getIncrementationMYSQL(){
		$REQ = "SELECT `id` FROM `".TABLE_BIBLIOTHEQUE."` ORDER BY `id` DESC LIMIT 0,1";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertPhotosBibliothequeMYSQL($extension){
		$REQ = "INSERT INTO `".TABLE_BIBLIOTHEQUE."`(`extension`) VALUES('".$extension."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function getListingBibliothequeMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$REQ = "SELECT * FROM `".TABLE_BIBLIOTHEQUE."` ORDER BY `id` DESC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function idPseudoMYSQL(){
		$REQ = "SELECT `IdClient`,`PseudoClient`,`Photo` FROM `Formulaire` WHERE `Miniature`!=''";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	/*function majMYSQL($table,$id){
		$REQ = "UPDATE `".TABLE_INSCRIPTION."` SET `type_annonce`='".$table."',`id_annonce`='".$id."' WHERE `id`='".$id."'";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}*/
	
	function majMYSQL($identifiant,$date1,$date2,$situation,$type_logement,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech1,$type_rech2,$type_rech3,$type_rech4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech){
		$REQ = "INSERT INTO `".TABLE_LISTING_COUCHSURFING."` VALUES('".$identifiant."','".$date1."','".$date2."','".$situation."','".$type_logement."','".$niveau."','".$capacite."','".$ch_adulte."','".$ch_enfant."','".$canape."','".$sdb."','".$cuisine."','".$terrasse."','".$barbecue."','".$jardin."','".$piscine."','".$velo."','".$garage."','".$animaux."','".$voiture."','".$handicape."','".$fumeur."','".$commentaire1."','".$commentaire2."','".$date3."','".$date4."','".$destination1."','".$destination2."','".$destination3."','".$destination4."','".$type_rech1."','".$type_rech2."','".$type_rech3."','".$type_rech4."','".$capac_rech."','".$fumeur_rech."','".$velo_rech."','".$voiture_rech."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresSalonMYSQL(){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_TCHAT_LISTE_CONNECTES."`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function compterMembresParPaysSalonMYSQL(){
		$REQ = "SELECT COUNT(*) AS compter FROM `".TABLE_TCHAT_LISTE_CONNECTES."` GROUP BY `id_pays`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertNouveauMembreSalonMYSQL($identifiant,$id_pays,$heure_entree){
		$REQ = "INSERT INTO ".TABLE_TCHAT_LISTE_CONNECTES."(`identifiant`, `id_pays`, `heure_entree`) VALUES('".$identifiant."', '".$id_pays."', '".$heure_entree."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertImagesGalerieMYSQL($identifiant,$extension){
		$REQ = "INSERT INTO `".TABLE_GALERIE_PHOTOS."`(`identifiant`,`img`) VALUES('".$identifiant."','".$extension."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function insertNouveauCarnetVoyageMYSQL($id_client,$intitule,$mon_commentaire){
		$REQ = "INSERT INTO `".TABLE_CARNET_DE_VOYAGE."`(`identifiant`,`intitule`,`commentaire`) VALUES('".$id_client."','".$intitule."','".$mon_commentaire."')";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherExtraitCarnetDeVoyageMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$REQ = "SELECT `identifiant`,`intitule` FROM `".TABLE_CARNET_DE_VOYAGE."` WHERE `controle`='ok' ORDER BY `identifiant` DESC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function listerUrlListCarnetDeVoyageMYSQL(){
		$REQ = "SELECT `identifiant` FROM `".TABLE_CARNET_DE_VOYAGE."` WHERE `controle`='ok' ORDER BY `identifiant`";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
	
	function afficherExtraitCarnetDeVoyageAdminMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$REQ = "SELECT `identifiant`,`intitule`,`controle` FROM `".TABLE_CARNET_DE_VOYAGE."` ORDER BY `identifiant` DESC LIMIT ".$premierAnnoncesAafficher.", ".$nombreAnnoncesParPage."";
		//Mise en place de la requête
		if(!empty($REQ)){
			$resultat = $this->executerRequete($REQ);
			return $resultat;
		}
		else{
			echo "Erreur MYSQL N°";
		}
	}
}

?>
