<?php
//********************************************************************
//                   CLASS ESPACE MEMBRE
//********************************************************************
include_once("class.CompBDD.php");

class EspaceMembre{
	
	//Constructeur
	function EspaceMembre(){
		
	}
	
	function afficherPaysEspaceMembre($name, $language){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'"><option value="x">'.PAYS_TOP.'</option><option value="'.PAYS_FRANCE_ID.'">'.PAYS_FRANCE.'</option><option value="'.PAYS_BELGIQUE_ID.'">'.PAYS_BELGIQUE.'</option><option value="'.PAYS_SUISSE_ID.'">'.PAYS_SUISSE.'</option><option value="0" disabled>***********</option>');
		
		$result = $req->afficherPaysMYSQL($language);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, '<option value="'.$mysql->id.'">'.$mysql->pays.'</option>');
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function afficherDepartement($name, $language, $id_pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		if($id_pays == 5 AND $language == "fr"){
			$table = TABLE_DEPARTEMENT_FR;
			$controle = 1;
		}
		elseif($id_pays == 5 AND $language == "en"){
			$table = TABLE_DEPARTEMENT_EN;
			$controle = 1;
		}
		elseif($id_pays == 5 AND $language == "de"){
			$table = TABLE_DEPARTEMENT_DE;
			$controle = 1;
		}
		else{
			$table = "";
			$controle = 0;
		}
		
		array_push($array, '<select name="'.$name.'"><option value="x">'.PAYS_DEPARTEMENTS_TOP.'</option>');
		
		if($controle == 1){
			$result = $req->afficherDepartementMYSQL($table);
			while ($mysql = mysql_fetch_object($result)){
				array_push($array, '<option value="'.$mysql->numdept.'">'.$mysql->nomdept.'</option>');
			}
		}
		else{
			array_push($array, '<option value="0" disabled>----------</option>');
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function insertNouveauProfil($id_client,$pseudo_client,$silhouette,$taille,$fumeur, $allure, $caractere, $enfant, $localite, $age, $son_pays, $son_departement, $son_annee_naissance, $correspondance_je_suis, $correspondance_je_recherche){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertNouveauProfilMYSQL($id_client,$pseudo_client,$silhouette,$taille,$fumeur, $allure, $caractere, $enfant, $localite, $age, $son_pays, $son_departement, $son_annee_naissance, $correspondance_je_suis, $correspondance_je_recherche);
	}
	
	function getInscription($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getInscriptionMYSQL($id_client);
		$mysql = mysql_fetch_object($result);
		return $mysql;
	}
	
	function getChamps($retour, $table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getChampsMYSQL($retour, $table, $champs, $valeur);
		while ($mysql = mysql_fetch_object($result)){
			$var = $mysql->$retour;
		}
		return $var;
	}
	
	function getConnexion($id_client, $pseudo_client){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getConnexionMYSQL($id_client, $pseudo_client);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, $sql->date_creation); // 0
			array_push($array, $sql->date_cloture); // 1
		}
		
		return $array;
	}
	
	function controleSiMembreBlacklistParAutreMembre($id_client,$id_blacklister){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->controleSiMembreBlacklistParAutreMembreMYSQL($id_client,$id_blacklister);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function insertionMessenger($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, $msg_texte, $msg_audio, $msg_video, $msg_duo, $etat, $genre){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionMessengerMYSQL($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, effacerEmail($msg_texte), $msg_audio, $msg_video, $msg_duo, $etat, $genre);
	}
	
	function ajouterIdMessageParent($msg_parent, $id_incrementation, $table, $champs, $id_insert_message){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajouterIdMessageParentMYSQL($msg_parent, $id_incrementation, $table, $champs, $id_insert_message);
	}
	
	function afficherToutesLesDemandesMessenger($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$metier = new Metier();
		$modulo = 1;
		
		$mon_compte = $metier->getOnlineMembre($id_client);
		
		$result = $req->afficherToutesLesDemandesMessengerMYSQL($id_client,$pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			if($mysql->genre == "message-texte"){
				$libelle = LIBELLE_1_TCHAT;
				$section = 'mt';
			}
			elseif($mysql->genre == "message-audio"){
				$libelle = LIBELLE_2_TCHAT;
				$section = 'ma';
			}
			elseif($mysql->genre == "message-video"){
				$libelle = LIBELLE_3_TCHAT;
				$section = 'mv';
			}
			else{
				$libelle = '';
			}
			if($modulo % 2 != 0){
				//CLASS IMPAIR
				$maClass = 'id="annonce_messenger_2"';
			}
			else{
				//PAIR
				$maClass = 'id="annonce_messenger_1"';
			}
			
			$url = autoriserAction($mon_compte->pseudo, HTTP_SERVEUR.'interface/'.FILENAME_GESTION_MESSAGERIE.'?genre=messenger&id='.$mysql->msg_parent.'&action=lire&s='.$section.'" class="bt_messenger" target="_top', MESSENGER_LIRE_MESSAGE);
			$url_suppression = autoriserAction($mon_compte->pseudo, HTTP_SERVEUR.'interface/'.FILENAME_GESTION_MESSAGERIE.'?genre=messenger&id='.$mysql->msg_parent.'&action=supprimer" class="lien_supprimer" target="_top', MESSENGER_SUPPRIMER_MESSAGE);
			echo '<li style="padding-top:7px;">' .
				'<table '.$maClass.'>' .
				'<tr>' .
				'<td class="icone">'.afficherIconeMessenger($mysql->genre).'</td>' .
				'<td class="libelle">'.$libelle.'</td>' .
				'<td class="pseudo">'.$mysql->pseudo_expediteur.'</td>' .
				'<td class="url_ok">'.$url.'/</td>' .
				'<td class="url_sup">'.$url_suppression.'</td>' .
				'</tr>' .
				'</table>' .
				'</li>';
				
			$modulo++;
		}
	}
	
	function getMessenger($id_messenger){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getMessengerMYSQL($id_messenger);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, $sql->id); // 0
			array_push($array, $sql->msg_parent); // 1
			array_push($array, $sql->id_expediteur); // 2
			array_push($array, $sql->pseudo_expediteur); // 3
			array_push($array, $sql->id_destinataire); // 4
			array_push($array, $sql->pseudo_destinataire); // 5
			array_push($array, $sql->date_creation); // 6
			array_push($array, $sql->msg_texte); // 7
			array_push($array, $sql->msg_audio); // 8
			array_push($array, $sql->msg_video); // 9
			array_push($array, $sql->duo); // 10
			array_push($array, $sql->lu); // 11
			array_push($array, $sql->genre); // 12
		}
		return $array;
	}
	
	function getMessengerParMsgParent($id_messenger){
		$req = new CompBDD();
		$array = array();
		array_push($array, '<tr><td colspan="3"><div id="fenetre_conversation_messenger"><ul>');
		
		$mysql = $req->getMessengerParMsgParentMYSQL($id_messenger);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, '<li><span class="heure">['.date("H:i:s", $sql->date_creation).'] :</span> <span class="pseudo">'.$sql->pseudo_expediteur.'</span> : '.retrecirMessageTropLong($sql->msg_texte).'</li>');
		}
		array_push($array, '</ul></div></td></tr>');
		
		return $array;
	}
	
	function getOnlineEspaceMembre($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getOnlineMembreMYSQL($id_client);
		$mysql = mysql_fetch_object($result);
		return $mysql;
	}
	
	function getMessagerie($id_messenger){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getMessagerieMYSQL($id_messenger);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, $sql->id); // 0
			array_push($array, $sql->msg_parent); // 1
			array_push($array, $sql->id_expediteur); // 2
			array_push($array, $sql->pseudo_expediteur); // 3
			array_push($array, $sql->id_destinataire); // 4
			array_push($array, $sql->pseudo_destinataire); // 5
			array_push($array, $sql->date_creation); // 6
			array_push($array, $sql->msg_texte); // 7
			array_push($array, $sql->msg_audio); // 8
			array_push($array, $sql->msg_video); // 9
			array_push($array, $sql->suppression); // 10
			array_push($array, $sql->lu); // 11
			array_push($array, $sql->genre); // 12
			array_push($array, $sql->type); // 13
		}
		return $array;
	}
	
	function updateMessengerLu($id_messenger){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateMessengerLuMYSQL($id_messenger);
	}
	
	function supprimerUnElement($table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->supprimerUnElementMYSQL($table, $champs, $valeur);
	}
	
	function supprimerFavori($id_profil,$id_visiteur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->supprimerFavoriMYSQL($id_profil,$id_visiteur);
	}
	
	function verifierMessageEnvoyer($id_pseudo, $pseudo, $id_client, $pseudo_client, $action){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->verifierMessageEnvoyerMYSQL($id_pseudo, $pseudo, $id_client, $pseudo_client, $action);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function verifierMembreBlacklister($id_pseudo, $id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->verifierMembreBlacklisterMYSQL($id_pseudo, $id_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function getErreur($numero){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getErreurMYSQL($numero);
		while ($mysql = mysql_fetch_object($result)){
			$element = $mysql->element;
		}
		return $element;
	}
	
	function ajouterMessageInformationsDirect($message, $id_client, $pseudo_client, $date_ajout){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$limite = $date_ajout + LIMITE_AFFICHAGE_INFORMATIONS;
		
		$req->ajouterMessageInformationsDirectMYSQL($message, $id_client, $pseudo_client, $date_ajout);
	}
	
	function afficherDerniereInfo($id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherDerniereInfoMYSQL($id_client, $pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$message = $mysql->element;
		}
		return $message;
	}
	
	function verifierMembreDuoWebcam($id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->verifierMembreDuoWebcamMYSQL($id_client, $pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function verifierSiMembreAvoirFaitAutresDemandes($id_expediteur, $pseudo_expediteur, $id_destinataire, $genre){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->verifierSiMembreAvoirFaitAutresDemandesMYSQL($id_expediteur, $pseudo_expediteur, $id_destinataire, $genre);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMessages($table, $id_expediteur, $pseudo_expediteur, $genre, $lu){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesMYSQL($table, $id_expediteur, $pseudo_expediteur, $genre, $lu);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMessagesDestinataire($table, $id_expediteur, $pseudo_expediteur, $genre, $lu){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesDestinataireMYSQL($table, $id_expediteur, $pseudo_expediteur, $genre, $lu);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMessagesDuMembreCommeExpediteur($table, $id_expediteur, $pseudo_expediteur, $lu){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesDuMembreCommeExpediteurMYSQL($table, $id_expediteur, $pseudo_expediteur, $lu);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMessagesDuMembreCommeDestinataire($table, $id_expediteur, $pseudo_expediteur, $lu){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesDuMembreCommeDestinataireMYSQL($table, $id_expediteur, $pseudo_expediteur, $lu);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function deleteMessenger($id_client, $pseudo_client, $champ_1, $champ_2){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->deleteMessengerMYSQL($id_client, $pseudo_client, $champ_1, $champ_2);
	}
	
	function verifierMessageEnvoyerMessagerie($id_pseudo, $pseudo, $id_client, $pseudo_client, $action){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->verifierMessageEnvoyerMessagerieMYSQL($id_pseudo, $pseudo, $id_client, $pseudo_client, $action);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function insertionMessagerie($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, $msg_texte, $msg_audio, $msg_video, $msg_duo, $etat, $genre){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionMessagerieMYSQL($id_client,$pseudo_client,$id_destinataire,$pseudo_destinataire,$dt_creation, effacerEmail($msg_texte), $msg_audio, $msg_video, $msg_duo, $etat, $genre);
	}
	
	function compterMessagesReception($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesReceptionMYSQL($id_client,$pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMessagesNonLus($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesNonLusMYSQL($id_client,$pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function afficherTousLesMessages($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherTousLesMessagesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client);
		$numero = 1;
		while ($mysql = mysql_fetch_object($result)){
			$message = $this->getMessagerie($mysql->id);
			$membre = $this->getInscription($message[2]);
			
			if($message[12] == "message-texte"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_texte.png" alt="icone"/>';
			}
			elseif($message[12] == "message-audio"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_audio.png" alt="icone"/>';
			}
			elseif($message[12] == "message-video"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_video.png" alt="icone"/>';
			}
			else{
				$icone = "";
				$commentaire = "";
			}
			$ident_dest = $this->getChamps("identifiant", TABLE_ONLINE, "pseudo", $membre->pseudo);
			
			echo '<tr>' .
					'<td style="text-align:center;"><input type="checkbox" class="checkbox" name="check'.$numero.'" value="'.$mysql->id.'" /></td>' .
					'<td style="text-align:center;">'.$icone.'</td>' .
					'<td><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$mysql->id.'&action=lire">'.$membre->pseudo.'</a></td>' .
					'<td style="text-align:center;">'.iconeConnexion($ident_dest).'</td>' .
					'<td class="extrait_messages">'.afficherExtraitDescription($message[7]).'</td>' .
					'<td class="date_messages">'.date("d/m/y", $message[6]).'</td>' .
					'</tr>';
			$numero++;
		}
	}
	
	function updateMessagerieParId($champ, $valeur, $id_messenger){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateMessagerieParIdMYSQL($champ, $valeur, $id_messenger);
	}
	
	function compterMessagesEnvoyer($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesEnvoyerMYSQL($id_client,$pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function afficherTousLesMessagesEnvoyes($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherTousLesMessagesEnvoyesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client, $pseudo_client);
		$numero = 1;
		while ($mysql = mysql_fetch_object($result)){
			$message = $this->getMessagerie($mysql->id);
			//$membre = $this->getInscription($message[2]);
			//DESTINATAIRE
			$destinataire = $this->getInscription($message[4]);
			
			if($message[12] == "message-texte"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_texte.png" alt="icone"/>';
			}
			elseif($message[12] == "message-audio"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_audio.png" alt="icone"/>';
			}
			elseif($message[12] == "message-video"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_video.png" alt="icone"/>';
			}
			else{
				$icone = "";
				$commentaire = "";
			}
			$ident_dest = $this->getChamps("identifiant", TABLE_ONLINE, "pseudo", $destinataire->pseudo);
			
			echo '<tr>' .
					'<td style="text-align:center;"><input type="checkbox" class="checkbox" name="check'.$numero.'" value="'.$mysql->id.'" /></td>' .
					'<td style="text-align:center;">'.$icone.'</td>' .
					'<td><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$mysql->id.'&action=messages-envoyes">'.$destinataire->pseudo.'</a></td>' .
					'<td style="text-align:center;">'.iconeConnexion($ident_dest).'</td>' .
					'<td class="extrait_messages">'.afficherExtraitDescription($message[7]).'</td>' .
					'<td class="date_messages">'.date("d/m/y", $message[6]).'</td>' .
					'</tr>';
			$numero++;
		}
	}
	
	function compterMessagesSupprimes($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMessagesSupprimesMYSQL($id_client,$pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterMembresBlacklistes($id_membre){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterMembresBlacklistesMYSQL($id_membre);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function afficherMembresBlacklistes($premierMembresAafficher, $nombreMembresParPage, $id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherMembresBlacklistesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client);
		while ($mysql = mysql_fetch_object($result)){
			$membre = $this->getInscription($mysql->id_pseudo_blacklister);
			
			if($membre->en_ligne == "ok"){
				$profil = '<a href="'.HTTP_SERVEUR.'profil-'.$membre->id.'.php">'.PROFIL.'</a>';
			}
			else{
				$profil = PROFIL;
			}
			
			echo '<tr>' .
					'<td style="font-weight:bolder;color:#00327C;text-transform:uppercase;text-align:center;padding-bottom: 3px;background-color: white;">'.$membre->pseudo.'</td>' .
					'<td style="text-align:center;padding-bottom: 3px;background-color: white;">'.date("d/m/y", $mysql->date_blacklist).'</td>' .
					'<td style="text-align:center;padding-bottom: 3px;">'.$profil.'</td>' .
					'<td style="text-align:center;padding-bottom: 3px;"><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_BLACKLIST.'?id='.$mysql->id.'&action=supprimer">'.BLACKLISTER.'</a></td>' .
					'</tr>';
		}
	}
	
	function insertionNouveauMembreBlacklist($id_client,$id_blacklist,$heure){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionNouveauMembreBlacklistMYSQL($id_client,$id_blacklist,$heure);
	}
	
	function controleSiMembreDejaBlacklister($id_client, $id_blacklist){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->controleSiMembreBlacklistParAutreMembreMYSQL($id_client,$id_blacklist);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function listerMessagesDuoWebcam($id_client, $pseudo_client, $id_expediteur, $pseudo_expediteur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->listerMessagesDuoWebcamMYSQL($id_client, $pseudo_client, $id_expediteur, $pseudo_expediteur);
		while ($mysql = mysql_fetch_object($result)){
			echo '<li><span style="color:rgb(180, 180, 180);">'.date("H:i:s", $mysql->date_creation_message).' ['.$mysql->pseudo_demande.']:</span> '.stripslashes(utf8_encode($mysql->commentaire)).'</li>';
		}
	}
	
	function envoyerConfirmationDuo($id_expediteur, $pseudo_expediteur, $id_destinataire, $pseudo_destinataire, $duo, $lu, $id_msg){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->envoyerConfirmationDuoMYSQL($id_expediteur, $pseudo_expediteur, $id_destinataire, $pseudo_destinataire, $duo, $lu, $id_msg);
	}
	
	function deleteMessengerParID($id_msg){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->deleteMessengerParIDMYSQL($id_msg);
	}
	
	function connecterMembreDuo($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->connecterMembreDuoMYSQL($id_client);
	}
	
	function remiseAZeroDuoWebcams($id_msg){
		$identifiant = $this->getMessenger($id_msg);
		//supprimer MESSENGER
		$this->deleteMessengerParID($id_msg);
		//supprimer les 2 interlocuteurs DUO WEBCAMS...
		$this->supprimerUnElement(TABLE_LISTE_MEMBRES_CONNECTER_DUO, "id_membre", $identifiant[2]);
		$this->supprimerUnElement(TABLE_LISTE_MEMBRES_CONNECTER_DUO, "id_membre", $identifiant[4]);
		//supprimer les messages en duo...
		$this->supprimerUnElement(TABLE_WEBCAM_DUO, "id_demande", $identifiant[2]);
		$this->supprimerUnElement(TABLE_WEBCAM_DUO, "id_demande", $identifiant[4]);
	}
	
	function updateConnexion($nouvelle_periode, $id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateConnexionMYSQL($nouvelle_periode, $id_client, $pseudo_client);
	}
	
	function ajouterCompteurProfil($id_client,$id_profil){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajouterCompteurProfilMYSQL($id_client,$id_profil);
	}
	
	function compterVisites($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterVisitesMYSQL($id_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterVisitesParIdClient($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->compterVisitesParIdClientMYSQL($id_client);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		
		return $compter;
	}
	
	function compterListingVisites($id_client,$id_visiteur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterListingVisitesMYSQL($id_client,$id_visiteur);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function afficherListingVisites($premierMembresAafficher, $nombreMembresParPage, $id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherListingVisitesMYSQL($premierMembresAafficher, $nombreMembresParPage, $id_client);
		while ($mysql = mysql_fetch_object($result)){
			$membre = $this->getInscription($mysql->id_visiteur);
			echo '<tr>' .
					'<td style="font-weight:bolder;color:#EE7126;text-transform:uppercase;text-align:center;padding-bottom: 3px;">'.$membre[1].'</td>' .
					'<td style="text-align:center;padding-bottom: 3px;font-weight:bolder;font-size:16px;">'.$this->compterListingVisites($id_client,$mysql->id_visiteur).'</td>' .
					'<td style="text-align:center;padding-bottom: 3px;"><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PROFIL.'?id='.$membre[0].'&m='.$membre[1].'" id="bt_confirmation_messenger_5">'.PROFIL_A_VISITER.'</a></td>' .
					'</tr>';
		}
	}
	
	function dernierMessageMessenger($pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->dernierMessageMessengerMYSQL($pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			$id = $mysql->id;
		}
		
		return $id;
	}
	
	function getMedia($pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getMediaMYSQL($pseudo_client);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->pseudo_membre); // 1
			array_push($array, $mysql->identifiant); // 2
		}
		
		return $array;
	}
	
	function compterMembres($tri_compter){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterMembresMYSQL($tri_compter);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function afficherTousLesMembres($premierMembresAafficher, $nombreMembresParPage, $tri){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$metier = new Metier();
		
		$result = $req->afficherTousLesMembresMYSQL($premierMembresAafficher, $nombreMembresParPage, $tri);
		while ($mysql = mysql_fetch_object($result)){
			$controle_connexion = $metier->getChamps("identifiant", TABLE_ONLINE, "pseudo", $mysql->pseudo);
			$album = $this->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->id);
			$pays = $this->getChamps('pays', TABLE_IDENTITE, 'identifiant', $mysql->id);
			$echange = $this->getChamps('type_echange', TABLE_IDENTITE, 'identifiant', $mysql->id);
			$carnet = $this->getChamps('intitule', TABLE_CARNET_DE_VOYAGE, 'identifiant', $mysql->id);
			
			if($mysql->compte_actif == 0){
				$actif = '<span style="font-weight:bolder;color:green;">OK</span>';
			}
			else{
				$actif = '<span style="font-weight:bolder;color:red;">désactivé</span>';
			}
			
			if($echange){
				$type_echange = '<strong>'.$this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.'fr', 'id', $echange).'</strong>';
			}
			else{
				$type_echange = '<em>[sans]</em>';
			}
			
			if($carnet != ""){
				$mon_carnet = '<a href="./inc-carnet.php?id_carnet='.$mysql->id.'">[consulter]</a>';
			}
			else{
				$mon_carnet = '<em>[sans]</em>';
			}
			
			echo '<tr>' ."\n".
					'<td class="ref">'.$mysql->id.'</td>' ."\n".
					'<td class="miniature_ad">'.afficherMiniature($mysql->id, $mysql->pseudo, $album->img1, $album->controle).'</td>' ."\n".
					'<td class="info_ad">' .
					'<span style="font-weight:bolder;font-size:14px;color:#F5772A;">'.strtoupper($mysql->pseudo).'</span>' .
					'<br />'.$this->getChamps('ville', TABLE_IDENTITE, 'identifiant', $mysql->id).'' .
					'<br />'.$this->getChamps('pays', TABLE_PAYS_FR, 'id', $pays).'' .
					'<br /><span style="color:#AFAFAF;">Type annonce :</span> '.$type_echange.'' .
					'<br /><span style="color:#AFAFAF;">Carnet de voyage :</span> '.$mon_carnet.'' .
					'</td>' ."\n".
					'<td class="ref">'.iconeConnexion($controle_connexion).'</td>' ."\n".
					'<td class="ref">'.$actif.'</td>' ."\n".
					'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=detail&id_compte='.$mysql->id.'" title="Consulter ce compte"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' ."\n".
					'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$mysql->id.'" title="Modifier ce compte"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' ."\n".
					'<td class="action"><a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=supprimer&id_compte='.$mysql->id.'" title="Supprimer ce compte"><img src="'.HTTP_IMAGE.'supprimer.png" alt="supprimer"/></a></td>'."\n".
					'</tr>'."\n" .
					'<tr>'."\n" .
					'<td colspan="8"><hr /></td>'."\n" .
					'</tr>'."\n";
		}
	}
	
	/*function getUnCompte($id_compte){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getUnCompteMYSQL($id_compte);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->pseudo); // 1
			array_push($array, $mysql->passe); // 2
			array_push($array, $mysql->date_inscription); // 3
			array_push($array, $mysql->type_membre); // 4
			array_push($array, $mysql->type_recherche); // 5
			array_push($array, $mysql->email); // 6
			array_push($array, $mysql->ip); // 7
			array_push($array, $mysql->domiciliation); // 8
			array_push($array, $mysql->departement); // 9
			array_push($array, $mysql->naissance); // 10
			array_push($array, $mysql->photo); // 11
			array_push($array, $mysql->statut); // 12
			array_push($array, $mysql->compte_actif); // 13
			array_push($array, $mysql->commentaire); // 14
		}
		return $array;
	}*/
	
	function getDerniersInscrits(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getDerniersInscritsMYSQL();
		$mysql = mysql_fetch_object($result);
		return $mysql;
	}
	
	function compterDerniersInscrits(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterDerniersInscritsMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function getConfiguration(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$result = $req->getConfigurationMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->parametrage); // 0
		}
		return $array;
	}
	
	function updateConfiguration($config, $id_config){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateConfigurationMYSQL($config, $id_config);
	}
	
	function getOptionParRef($id){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getOptionParRefMYSQL($id);
		while ($mysql = mysql_fetch_object($result)){
			$genre = $mysql->genre;
		}
		return $genre;
	}
	
	function getOptions($action,$table,$lang){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getOptionsMYSQL($table.$lang);
		while ($mysql = mysql_fetch_object($result)){
			if($action == "consulter"){
				echo '<tr>' .
						'<td class="td_relation">Réf. <span style="font-weight:bolder;font-size:18px;color:#FF781E;">'.$mysql->id.'</span>' .
							' - Version : '.afficherIconeDrapeau($lang).'</td>' .
						'<td class="donnees">'.$mysql->element.'</td>' .
						'</tr>';
			}
			else{
				echo '<tr>' .
						'<td class="td_relation">Réf. <span style="font-weight:bolder;font-size:18px;color:#FF781E;">'.$mysql->id.'</span>' .
							' - Version : '.afficherIconeDrapeau($lang).'</td>' .
						'<td class="donnees"><input type="text" name="options'.$mysql->id.'" value="'.$mysql->element.'"/></td>' .
						'</tr>';
			}
		}
	}
	
	function getTableId($table){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$result = $req->getTableIdMYSQL($table);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->id);
		}	
		return $array;
	}
	
	function updateTableAdmin($table, $champs, $valeur, $where_champs, $where_valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateTableAdminMYSQL($table, $champs, $valeur, $where_champs, $where_valeur);
	}
	
	function getAbonnement($duree, $table, $langue){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getAbonnementMYSQL($duree, $table, $langue);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->duree); // 1
			array_push($array, $mysql->formule); // 2
			array_push($array, $mysql->langue); // 3
		}
		return $array;
	}
	
	function updateElement($table, $set_champ, $set_valeur, $champ, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateElementMYSQL($table, $set_champ, $set_valeur, $champ, $valeur);
	}
	
	function insertNouveauMedia($table, $pseudo, $chemin){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertNouveauMediaMYSQL($table, $pseudo, $chemin);
	}
	
	function initialiserTable($table){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->initialiserTableMYSQL($table);
	}
	
	function compterMembresOnline($table,$type,$pays,$cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `identifiant` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."')";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok'";
		}
		$result = $req->compterMembresOnlineMYSQL($requete);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function compterMembresOffline($table,$type,$pays,$cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."') AND `id` NOT IN (SELECT `identifiant` FROM `".TABLE_ONLINE."`)";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` NOT IN (SELECT `identifiant` FROM `".TABLE_ONLINE."`)";
		}
		$result = $req->compterMembresOfflineMYSQL($requete);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function getCorrespondance($id_exp, $id_dest){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getCorrespondanceMYSQL($id_exp, $id_dest);
		while ($mysql = mysql_fetch_object($result)){
			$id = $mysql->id;
		}
		return $id;
	}
	
	function insertionCorrespondance($id_exp, $id_dest){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionCorrespondanceMYSQL($id_exp, $id_dest);
	}
	
	function getExpediteurConversation($id_exp, $id_msg_parent){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getExpediteurConversationMYSQL($id_exp, $id_msg_parent);
		while ($mysql = mysql_fetch_object($result)){
			$id_expediteur = $mysql->id_expediteur;
		}
		return $id_expediteur;
	}
	
	function getTableauTarif($ref){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getTableauTarifMYSQL($ref);
		while($sql = mysql_fetch_object($mysql)){
			array_push($array, '<td><a href="'.HTTP_SERVEUR.FILENAME_PUBLICITE.'?action='.$sql->id.'&step=1">'.$sql->montant.' &euro;</a></td>');
		}
		
		return $array;
	}
	
	function getTable($table, $champ, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getTableMYSQL($table, $champ, $valeur);
		$mysql = mysql_fetch_object($result);
		
		return $mysql;
	}
	
	function getAllTableCondition($action){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$metier = new Metier();
		$array = array();
		
		$result = $req->getAllTableConditionMYSQL();
		$cp = 1;
		while($sql = mysql_fetch_object($result)){
			if($action == "consulter"){
				echo '<tr>' .
						'<td>'.$sql->id.'</td>' .
						'<td>'.$this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.'fr', 'id', $sql->except).'</td>' . 
						'</tr>' .
						'<tr>' .
						'<td colspan="2"><hr /></td>' .
						'</tr>';
			}
			else{
				echo '<tr>' .
						'<td>'.$sql->id.' <input type="hidden" name="id_cond" value="'.$sql->id.'"/> [<a href="'.HTTP_ADMIN.FILENAME_PARAMETRES.'?action=modifier&type=condition&section=supprimer&id_cond='.$sql->id.'" title="suppression">supprimer</a>]</td>' .
						'<td>';
						//AFFICHER LES OPTIONS DE RECHERCHE
						$tab_options_1 = $metier->afficherEchange('except'.$cp, $sql->except);
						foreach($tab_options_1 as $cle_1){
							echo $cle_1;
						}
				echo	'</td>';
						
				echo   '</tr>' .
						'<tr>' .
						'<td colspan="2"><hr /></td>' .
						'</tr>';
				$cp++;
			}
		}
		return $array;
	}
	
	function getAffichageAleatoire($partie){
		$req = new CompBDD();
		
		$mysql = $req->getAffichageAleatoireMYSQL($partie);
		$sql = mysql_fetch_object($mysql);
		return $sql;
	}
	
	function insertIdentifiants($pseudo_client,$timeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertIdentifiantsMYSQL($pseudo_client,$timeur);
	}
	
	function ajouterFichierFLV($flv, $heure, $repertoireFLV){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajouterFichierFLVMYSQL($flv, $heure, $repertoireFLV);
	}
	
	function effacerFLV($table, $id_client, $pseudo_client, $champ_1, $champ_2){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$mysql = $req->effacerFLVMYSQL($table, $id_client, $pseudo_client, $champ_1, $champ_2);
		while($sql = mysql_fetch_object($mysql)){
			if($sql->msg_audio != ""){
				$this->ajouterFichierFLV($sql->msg_audio, time(), nommageRepertoire($id_client));
			}
			if($sql->msg_video != ""){
				$this->ajouterFichierFLV($sql->msg_video, time(), nommageRepertoire($id_client));
			}
		}
	}
	
	function supprimerCompte($id_client){
		$profil = $this->getInscription($id_client);
		$album = $this->getTable(TABLE_ALBUM_PHOTO,"identifiant",$id_client);
		$galerie = $this->getTable(TABLE_GALERIE_PHOTOS,"identifiant",$id_client);
		$compteur = 1;
														
		//---------------------- SUPPRESSION EN MASSE DES PHOTOS --------------------------------------------
		if($album->img1){
			unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleImage($profil->pseudo,1).'.'.$album->img1);
			unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleImage($profil->pseudo,1).'.'.$album->img1);
			unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleImage($profil->pseudo,1).'.'.$album->img1);
		}
		if($album->img2){
			unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleImage($profil->pseudo,2).'.'.$album->img2);
			unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleImage($profil->pseudo,2).'.'.$album->img2);
			unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleImage($profil->pseudo,2).'.'.$album->img2);
		}
		if($album->img3){
			unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleImage($profil->pseudo,3).'.'.$album->img3);
			unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleImage($profil->pseudo,3).'.'.$album->img3);
			unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleImage($profil->pseudo,3).'.'.$album->img3);
		}
		if($album->img4){
			unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleImage($profil->pseudo,4).'.'.$album->img4);
			unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleImage($profil->pseudo,4).'.'.$album->img4);
			unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleImage($profil->pseudo,4).'.'.$album->img4);
		}
		
		//------- galerie photos -------
		if($galerie->img){
			$pos = strpos($galerie->img, "|");
			if($pos === false){
				//Unique photo
				unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,1).'.'.$galerie->img);
				unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,1).'.'.$galerie->img);
				unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,1).'.'.$galerie->img);
			}
			else{
				$extension = explode("|",$galerie->img);
				foreach($extension as $cle){
					if($cle){
						unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,$compteur).'.'.$cle);
						unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,$compteur).'.'.$cle);
						unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($id_client).libelleGalerie($profil->pseudo,$compteur).'.'.$cle);
					}
					$compteur++;
				}
			}
		}
		
		//-----------------------------
		//SUPPRESSION IMAGES ALBUM + GALERIE
		$this->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $id_client);
		$this->supprimerUnElement(TABLE_GALERIE_PHOTOS, "identifiant", $id_client);
		//----------------------------------------------------------------------------------------------------
		//SUPPRESSION INSCRIPTION			
		$this->supprimerUnElement(TABLE_INSCRIPTION, "id", $id_client);
		//SUPPRESSION PAIEMENT
		$this->supprimerUnElement(TABLE_PAIEMENTS, "pseudo", $profil->pseudo);
		//SUPPRESSION HISTORIQUE PAIEMENT
		$this->supprimerUnElement(TABLE_HISTORIQUE_PAIEMENT, "pseudo", $profil->pseudo);
		//SUPPRESSION MEMBRE CONNECTE
		$this->supprimerUnElement(TABLE_ONLINE, "identifiant", $id_client);
		//SUPPRESSION IDENTITE
		$this->supprimerUnElement(TABLE_IDENTITE, "identifiant", $id_client);
		//SUPPRESSION CONVERSATION TCHAT
		$this->supprimerUnElement(TABLE_CONVERSATION_ONLINE, "id_exp", $id_client);
		$this->supprimerUnElement(TABLE_CONVERSATION_ONLINE, "id_dest", $id_client);
		//SUPPRESSION NOUVEAU INSCRIT
		$this->supprimerUnElement(TABLE_NOUVEAUX_INSCRITS, "identifiant", $id_client);
		//Supprimer compteur profil
		$this->supprimerUnElement(TABLE_COMPTEUR_PROFIL, "id_profil", $id_client);
		$this->supprimerUnElement(TABLE_COMPTEUR_PROFIL, "id_visiteur", $id_client);
		//Supprimer son commentaire
		$this->supprimerUnElement(TABLE_LIVRE_DOR, "pseudo_livre_dor", $profil->pseudo);
		//Supprimer TCHAT
		$this->supprimerUnElement(TABLE_TCHAT_DISCUSSION,"identifiant",$id_client);
		$this->supprimerUnElement(TABLE_TCHAT_LISTE_CONNECTES,"identifiant",$id_client);
		//Supprimer CARNET DE VOYAGE
		$this->supprimerUnElement(TABLE_CARNET_DE_VOYAGE,"identifiant",$id_client);
		//**********************************************************************
		//                      PARTIE TCHAT ONLINE
		//**********************************************************************
		$this->effacerFLV(TABLE_MESSENGER, $id_client, $profil->pseudo, 'id_expediteur', 'pseudo_expediteur');
		$this->effacerFLV(TABLE_MESSENGER, $id_client, $profil->pseudo, 'id_destinataire', 'pseudo_destinataire');
		//Comme expéditeur...
		$this->deleteMessenger($id_client, $profil->pseudo, 'id_expediteur', 'pseudo_expediteur');
		//Comme destinataire...
		$this->deleteMessenger($id_client, $profil->pseudo, 'id_destinataire', 'pseudo_destinataire');
		//**********************************************************************
		//**********************************************************************
		//                      PARTIE MESSAGERIE
		//**********************************************************************
		$this->effacerFLV(TABLE_MESSAGERIE, $id_client, $profil->pseudo, 'id_expediteur', 'pseudo_expediteur');
		$this->effacerFLV(TABLE_MESSAGERIE, $id_client, $profil->pseudo, 'id_destinataire', 'pseudo_destinataire');
		//Comme expéditeur...
		$this->supprimerUnElement(TABLE_MESSAGERIE, "id_expediteur", $id_client);
		//Comme destinataire...
		$this->supprimerUnElement(TABLE_MESSAGERIE, "id_destinataire", $id_client);
		//**********************************************************************
		//Supprimer les infos en direct...
		$this->supprimerUnElement(TABLE_INFORMATIONS_DIRECT, 'id_client', $id_client);
		//SUPPRESSION CONTROLEUR MEDIA
		$this->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $id_client);
		//SUPPRESSION DE SES FICHIERS AUDIO ET VIDEO DU PROFIL UTILISATEUR
		$fichier_audio = $this->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $profil->pseudo);
		$fichier_video = $this->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $profil->pseudo);
		if($fichier_audio != ""){
			unlink(REPERTOIRE_AUDIO.nommageRepertoire($_SESSION['id_client']).$fichier_audio);
			$this->supprimerUnElement(TABLE_FICHIER_AUDIO, "pseudo", $profil->pseudo);
		}
		if($fichier_video != ""){
			unlink(REPERTOIRE_VIDEO.nommageRepertoire($_SESSION['id_client']).$fichier_video);
			$this->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $profil->pseudo);
		}
	}
	
	function garbageFLV(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->garbageFLVMYSQL();
		$total = 1;
		while($sql = mysql_fetch_object($result)){
			//SUPPRESSION FLV
			unlink(REPERTOIRE_WEBAPPS_RED5.$sql->repertoire.$sql->libelle.'.flv');
			//SUPPRESSION EXTENSION COMPLEMENTAIRE
			unlink(REPERTOIRE_WEBAPPS_RED5.$sql->repertoire.$sql->libelle.'.flv.meta');
			//compteur
			$total++;
		}
		return $total;
	}
	
	function getConditionGratuite($type){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getConditionGratuiteMYSQL($type);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function insertionCondition($except){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionConditionMYSQL($except);
	}
	
	function compterCondition(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterConditionMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	function compterConditionType($type){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterConditionTypeMYSQL($type);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function compterTousLesMessages($table,$id_compte){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		if($id_compte){
			$result = $req->compterElement($table,"id_expediteur",$id_compte);
		}
		else{
			$result = $req->compterTousLesMessagesMYSQL($table);
		}
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function afficherAllMessages($premierMembresAafficher, $nombreMembresParPage, $table,$page,$type,$id_compte){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		if($id_compte){
			$result = $req->afficherAllMessagesParIdMYSQL($premierMembresAafficher, $nombreMembresParPage, $table,$id_compte);
		}
		else{
			$result = $req->afficherAllMessagesMYSQL($premierMembresAafficher, $nombreMembresParPage, $table);
		}
		while ($mysql = mysql_fetch_object($result)){
			if($table == TABLE_MESSAGERIE){
				$message = $this->getMessagerie($mysql->id);
			}
			else{
				$message = $this->getMessenger($mysql->id);
			}
			
			$membre = $this->getInscription($message[2]);
			$album = $this->getTable(TABLE_ALBUM_PHOTO,"identifiant",$id_compte);
			
			if($message[12] == "message-texte"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_texte.png" alt="icone"/>';
			}
			elseif($message[12] == "message-audio"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_audio.png" alt="icone"/>';
			}
			elseif($message[12] == "message-video"){
				$icone = '<img src="'.HTTP_IMAGE.'icone_messagerie_video.png" alt="icone"/>';
			}
			else{
				$icone = "";
				$commentaire = "";
			}
			
			$ident_dest = $this->getChamps("identifiant", TABLE_ONLINE, "pseudo", $membre->pseudo);
			$consulter = "<a href='javascript:popUp(\"".HTTP_HOST."/interface/message-controle.php?id=".$mysql->id."\",700,510,\"menubar=no,scrollbars=no,statusbar=no\")'><img src=\"".HTTP_IMAGE."consulter.png\" alt=\"consulter\"/></a>";
			$modifier = '<a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$page.'&action=modifier_message&type='.$type.'&id='.$mysql->id.'&genre='.$message[12].'&id_compte='.$id_compte.'"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a>';
			$supprimer = '<a href="'.HTTP_ADMIN.FILENAME_MESSAGERIE.'?page='.$page.'&action=supprimer_message&type='.$type.'&id='.$mysql->id.'&genre='.$message[12].'&id_exp='.$message[2].'&id_compte='.$id_compte.'"><img src="'.HTTP_IMAGE.'supprimer.png" alt="supprimer"/></a>';
			
			echo '<tr>' .
					'<td style="text-align:center;">'.$mysql->id.'</td>' .
					'<td style="text-align:center;">'.afficherMiniature($membre->id, $membre->pseudo, $album->img1, $album->controle).'</td>' .
					'<td style="text-align:center;">'.$membre->pseudo.'</td>' .
					'<td style="text-align:center;">'.$icone.'</td>' .
					'<td style="text-align:center;">'.iconeConnexion($ident_dest).'</td>' .
					'<td style="text-align:justify;">'.afficherExtraitDescription($message[7]).'</td>' .
					'<td>'.$consulter.'</td>' .
					'<td>'.$modifier.'</td>' .
					'<td>'.$supprimer.'</td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="9"><hr /></td>' .
					'</tr>';
		}
	}
	
	function insertionNouvelleIdentite($identifiant,$nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionNouvelleIdentiteMYSQL($identifiant,$nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange);
	}
	
	function insertionNouvelleAnnonce($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionNouvelleAnnonceMYSQL($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech);
	}
	
	function updateAnnonce($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateAnnonceMYSQL($table,$identifiant,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech);
	}
	
	function getFavori($id_client,$type,$mini,$maxi){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$array_key = array();
		array_push($array_key,'x');
		
		if($type == "supprimer"){
			array_push($array,'<div id="supp_favori">' ."\n".
								'<table>'."\n");
		}
		else{
			//AFFICHER LES FAVORIS EN MODE CONSULTER
			array_push($array,'<div id="consult_favori">' ."\n".
								'<table>'."\n");
		}
		
		$result = $req->getFavoriMYSQL($id_client,$mini,$maxi);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array_key,$mysql->id_visiteur);
		}
		// ------- REMPLIR CONTAINER --------------
		for($i=1;$i<=$maxi;$i++){
			if($type == "supprimer"){
				if($i == 1 OR $i == 6){
					array_push($array,'<tr>');
				}
				if(empty($array_key[$i])){
					array_push($array,'<td class="favori_ko"><div>favori</div></td>');
				}
				else{
					array_push($array,'<td class="favori_ok"><div><input type="checkbox" name="favori[]" value="'.$array_key[$i].'"/> <a href="'.HTTP_SERVEUR.'profil-'.$array_key[$i].'.php">'.$this->getChamps("pseudo", TABLE_INSCRIPTION,"id", $array_key[$i]).'</a></div></td>');
				}
				
				if($i == 5 OR $i == 10){
					array_push($array,'</tr>');
				}
			}
			else{
				//AFFICHER LES FAVORIS EN MODE CONSULTER
				if($i == 1 OR $i == 6){
					array_push($array,'<tr>');
				}
				if(empty($array_key[$i])){
					array_push($array,'<td class="favori_ko"><div>favori</div></td>');
				}
				else{
					array_push($array,'<td class="favori_ok"><div><a href="'.HTTP_SERVEUR.'profil-'.$array_key[$i].'.php">'.$this->getChamps("pseudo", TABLE_INSCRIPTION,"id", $array_key[$i]).'</a></div></td>');
				}
				
				if($i == 5 OR $i == 10){
					array_push($array,'</tr>');
				}
			}
		}
		//-----------------------------------------
		array_push($array,'</table>' ."\n".
								'</div>'."\n");
		return $array;
	}
	
	function getMisEnFavori($id_profil,$id_visiteur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getMisEnFavoriMYSQL($id_profil,$id_visiteur);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function ajouterFavori($id_profil,$id_visiteur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajouterFavoriMYSQL($id_profil,$id_visiteur);
	}
	
	function ajoutHistoriquePaiement($pseudo, $date_ouverture,$cloture,$type_abonnement,$abonnement){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajoutHistoriquePaiementMYSQL($pseudo, $date_ouverture,$cloture,$type_abonnement,$abonnement);
	}
	
	function compterUnElement($table,$champ,$valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterElement($table,$champ,$valeur);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	// Retourne le nombre de ligne de donnée retournées par la requête
	function getNbRows($res){				
		$nbLignes = mysql_num_rows($res);		
		return $nbLignes;		
	}
	
	function afficherHistoriquePaiement($premierMembresAafficher, $nombreMembresParPage, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->afficherHistoriquePaiementMYSQL($premierMembresAafficher, $nombreMembresParPage, $pseudo_client);
		$nb = $this->getNbRows($result);
		$compteur = 1;
		while ($mysql = mysql_fetch_object($result)){
			if($mysql->type_abonnement == MENSUEL){
				$type_abonnement = MENSUEL;
			}
			else{
				$type_abonnement = '';
			}
			
			if(is_numeric($mysql->abonnement)){
				$abonnement = $mysql->abonnement.' '.MOIS;
			}
			else{
				$abonnement = '';
			}
			
			if($compteur == $nb){
				$date_fin = '<span style="color:red;font-weight:bolder;">(*) '.$mysql->date_fin.'</span>';
			}
			else{
				$date_fin = $mysql->date_fin;
			}
			
			echo '<tr>' .
					'<td style="text-align:center;">'.$mysql->id.'</td>' .
					'<td style="text-align:center;">'.$mysql->date_debut.'</td>' .
					'<td style="text-align:center;">'.$date_fin.'</td>' .
					'<td style="text-align:center;">'.$type_abonnement.'</td>' .
					'<td style="text-align:center;">'.$abonnement.'</td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="5"><hr /></td>' .
					'</tr>';
			$compteur++;
		}
	}
	
	function afficherListingCompletFavoris($id_client,$mini,$maxi){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getFavoriMYSQL($id_client,$mini,$maxi);
		while ($mysql = mysql_fetch_object($result)){
			
			echo '<tr>' .
					'<td style="text-align:center;"><input type="checkbox" name="favori[]" value="'.$mysql->id_visiteur.'"/></td>' .
					'<td style="text-align:center;">'.$this->getChamps("pseudo", TABLE_INSCRIPTION,"id", $mysql->id_visiteur).'</td>' .
					'<td style="text-align:center;"><a href="'.HTTP_SERVEUR.'profil-'.$mysql->id_visiteur.'.php">'.LIEN_PROFIL.'</a></td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="3"><hr /></td>' .
					'</tr>';
		}
	}
	
	function insertionNouveauLivreDor($pseudo,$heure,$commentaire){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionNouveauLivreDorMYSQL($pseudo,$heure,$commentaire);
	}
	
	function getTableElement($table,$element){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$result = $req->getTableElementMYSQL($table,$element);
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->$element);
		}	
		return $array;
	}
	
	function compterBibliotheque(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterBibliothequeMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function getListingBibliotheque($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$req = new CompBDD();
		echo '<ul style="margin-top:5px;">';
		$mysql = $req->getListingBibliothequeMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		
		while($sql = mysql_fetch_object($mysql)){
			echo '<li>' .
					'<table class="list_bibliotheque">' .
					'<tr>' .
					'<td class="miniature"><img src="'.HTTP_IMAGE_MINIATURE.nommageRepertoire($sql->id).$sql->id.'.'.$sql->extension.'" alt="image"/></td>' .
					'<td class="code">'.HTTP_IMAGE_ORIGINAL.nommageRepertoire($sql->id).$sql->id.'.'.$sql->extension.'</td>' .
					'<td class="zoom"><a href="'.HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($sql->id).$sql->id.'.'.$sql->extension.'" rel="lightbox" style="font-size:10px;">+ zoom</a></td>' .
					'<td class="lien"><a href="./bibliotheque.php?up=sup&id_img='.$sql->id.'&action=suppression" style="font-size:10px;">[supprimer]</a></td>' .
					'</tr>' .
					'</table>' .
					'</li>';
		}
		echo '</ul>';
	}
	
	function getIncrementation(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getIncrementationMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$var = $mysql->id;
		}
		return $var;
	}
	
	function insertPhotosBibliotheque($extension){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertPhotosBibliothequeMYSQL($extension);
	}
	
	function idPseudo(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$result = $req->idPseudoMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			array_push($array, $mysql->IdClient."_".$mysql->PseudoClient."_".$mysql->Photo);
		}
		return $array;
	}
	
	function maj(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$metier = new Metier();
		$tab = $this->idPseudo();
		
		foreach($tab as $cle){
			$ident = explode("_",$cle);
			creationRepertoireStockage(nommageRepertoire($ident[0]));
			$photo_size = 1000;
			$photo_name = $ident[2];
			$photo_tmp_name = REPERTOIRE_IMAGE."copy/".$ident[2];
			
			if(file_exists($photo_tmp_name)){
				$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($ident[0]), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($ident[0]), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($ident[0]), libelleImage($ident[1],1), nommageRepertoire($ident[0]));
				if(is_numeric($tab_photo)){
					//RAS...
				}
				else{
					$metier->insertPhotos($ident[0] ,$tab_photo);
					$metier->updatePhotos("controle",1,"identifiant", $ident[0]);
				}
			}
		}
	}
	
	function majImages(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$tab = $this->getTableElement(TABLE_ALBUM_PHOTO,"identifiant");
		foreach($tab as $cle){
			$album = $this->getTable(TABLE_ALBUM_PHOTO,"identifiant",$cle);
			$mon_pseudo = $this->getChamps("pseudo",TABLE_INSCRIPTION,"id",$cle);
			if($album->controle == 0){
				if($album->img1 != ""){
					supprimerImage($cle,libelleImage($mon_pseudo,1),$album->img1);
				}
				if($album->img2 != ""){
					supprimerImage($cle,libelleImage($mon_pseudo,2),$album->img2);
				}
				if($album->img3 != ""){
					supprimerImage($cle,libelleImage($mon_pseudo,3),$album->img3);
				}
				if($album->img4 != ""){
					supprimerImage($cle,libelleImage($mon_pseudo,4),$album->img4);
				}
				$this->supprimerUnElement(TABLE_ALBUM_PHOTO,"identifiant",$cle);
			}
		}
	}
	
	function listerMessagesSalon($id_pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$requete = "WHERE `id_pays`='".$id_pays."' ORDER BY `id` DESC LIMIT 0,25";
		$result = $req->getMenuDeroulantMYSQL(TABLE_TCHAT_DISCUSSION,$requete);
		while ($mysql = mysql_fetch_object($result)){
			echo '<li><span style="color:rgb(180, 180, 180);">'.date("H:i:s", $mysql->heure_creation).' ['.$this->getChamps("pseudo",TABLE_ONLINE,"identifiant",$mysql->identifiant).']:</span> '.stripslashes($mysql->commentaire).'</li>';
		}
	}
	
	function compterMembresSalon(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterMembresSalonMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function compterMembresParPaysSalon(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterMembresParPaysSalonMYSQL();
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function insertNouveauMembreSalon($identifiant,$id_pays,$heure_entree){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertNouveauMembreSalonMYSQL($identifiant,$id_pays,$heure_entree);
	}
	
	function listerImagesGalerie($id_client,$pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$compteur = 1;
		$requete = "WHERE `identifiant`='".$id_client."'";
		$result = $req->getMenuDeroulantMYSQL(TABLE_GALERIE_PHOTOS,$requete);
		while ($mysql = mysql_fetch_object($result)){
			$extension = explode("|",$mysql->img);
			foreach($extension as $cle){
				$http = HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($id_client).libelleGalerie($pseudo_client,$compteur).'.'.$cle;
				
				echo '<a href="'.$http.'" rel="lightbox">'.afficherMiniatureGalerie($id_client, $pseudo_client, $cle, $mysql->controle,$compteur).'</a>';
				$compteur++;
			}
		}
	}
	
	function getListingImagesGalerie($id_client,$name){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$compteur = 1;
		
		$select = '<select name="'.$name.'" id="'.$name.'">'."\n";
		$requete = "WHERE `identifiant`='".$id_client."'";
		$result = $req->getMenuDeroulantMYSQL(TABLE_GALERIE_PHOTOS,$requete);
		while ($mysql = mysql_fetch_object($result)){
			$extension = explode("|",$mysql->img);
			foreach($extension as $cle){
				$select .= '<option value="'.$cle.'_'.$compteur.'">image '.$compteur.'</option>'."\n";
				$compteur++;
			}
		}
		$select .= '</select>'."\n";
		return $select;
	}
	
	function insertImagesGalerie($identifiant,$extension){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertImagesGalerieMYSQL($identifiant,$extension);
	}
	
	function insertNouveauCarnetVoyage($id_client,$intitule,$mon_commentaire){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertNouveauCarnetVoyageMYSQL($id_client,$intitule,$mon_commentaire);
	}
	
	function compterCarnetVoyage(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->compterTousLesMessagesMYSQL(TABLE_CARNET_DE_VOYAGE);
		while ($mysql = mysql_fetch_object($result)){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function majGaleriePhotos(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$tab = $this->getTableElement(TABLE_GALERIE_PHOTOS,"identifiant");
		foreach($tab as $cle){
			$galerie = $this->getTable(TABLE_GALERIE_PHOTOS,"identifiant",$cle);
			$mon_pseudo = $this->getChamps("pseudo",TABLE_INSCRIPTION,"id",$cle);
			if($galerie->controle == 0){
				if($galerie->img != ""){
					//boucle pour chaque image
					$compteur = 1;
					$pos = strpos($galerie->img, "|");
					if($pos === false){
						//Unique photo
						unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($cle).libelleGalerie($mon_pseudo,1).'.'.$galerie->img);
						unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($cle).libelleGalerie($mon_pseudo,1).'.'.$galerie->img);
						unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($cle).libelleGalerie($mon_pseudo,1).'.'.$galerie->img);
					}
					else{
						$extension = explode("|",$galerie->img);
						foreach($extension as $ext){
							if($ext){
								unlink(REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($cle).libelleGalerie($mon_pseudo,$compteur).'.'.$ext);
								unlink(REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($cle).libelleGalerie($mon_pseudo,$compteur).'.'.$ext);
								unlink(REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($cle).libelleGalerie($mon_pseudo,$compteur).'.'.$ext);
							}
							$compteur++;
						}
					}
				}
				$this->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$cle);
			}
		}
	}
}
?>
