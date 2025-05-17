<?php
//*****************************************************
//   CLASS METIER POUR GERER LES APPLICATIONS METIER
//*****************************************************
include_once("class.CompBDD.php");

class Metier{
	//Création d'un construteur
	function Metier(){
		
	}
	
	//Méthodes
	
	function getIDAnnonceAccueil($genre, $min, $max){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$result = $req->getIDAnnonceAccueilMYSQL($genre, $min, $max);
		while ($mysql = $result->fetch_object()){
			array_push($array, $mysql->id);
		}
		return $array;
	}
	
	function afficherDerniersInscrits($type, $maxi){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array_id = array();
		$array = array();
		$array_assemblage = array();
		
		if($type == "echange"){
			$condition = "`type_annonce`='".TABLE_LISTING_ECHANGE_MAISON."'";
		}
		elseif($type == "couchsurfing"){
			$condition = "`type_annonce`='".TABLE_LISTING_COUCHSURFING."'";
		}
		else{
			$condition = "`type_annonce`IS NOT NULL";
		}
		
		$array_id = $this->getIDAnnonceAccueil($condition, 0, $maxi);
		for($i=0;$i<$maxi;$i++){
			if(empty($array_id[$i])){
				array_push($array_assemblage, "");
			}
			else{
				array_push($array_assemblage, $array_id[$i]);
			}
		}
		
		//Déploiement du tableau
		foreach($array_assemblage as $key){
			array_push($array, '<td>' .
					'<div class="annonce">' .
					'<ul>');
			$result = $req->afficherDerniersInscritsMYSQL($key);
			while ($mysql = $result->fetch_object()){
				$id = $mysql->id;
				$pseudo = $mysql->pseudo;
				$miniature = $mysql->img1;
				$statut = $mysql->controle;
			}
			
			if(empty($key)){
				array_push($array, '<li class="img"></li>');
			}
			else{
				array_push($array, '<li class="img"><a href="'.HTTP_SERVEUR.'profil-'.$id.'.php">'.afficherMiniature($id, $pseudo, $miniature, $statut).'</a></li>');
			}
			array_push($array, '</ul></div></td>');
		}
		return $array;
	}
	
	function afficherOptions($name, $language, $en_session){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'">');
		
		$result = $req->afficherOptionsMYSQL($language);
		while ($mysql = $result->fetch_object()){
			if($en_session == $mysql->nature){
				//UNE VALEUR A DEJA ETE SAISIE
				array_push($array, '<option value="'.$mysql->nature.'" selected>'.$mysql->genre.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->nature.'">'.$mysql->genre.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function afficherPays($name, $language){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'"><option value="0">'.PAYS_TOP.'</option><option value="'.PAYS_FRANCE_ID.'">'.PAYS_FRANCE.'</option><option value="'.PAYS_BELGIQUE_ID.'">'.PAYS_BELGIQUE.'</option><option value="'.PAYS_SUISSE_ID.'">'.PAYS_SUISSE.'</option><option value="0" disabled>***********</option>');
		
		$result = $req->afficherPaysMYSQL($language);
		while ($mysql = $result->fetch_object()){
			array_push($array, '<option value="'.$mysql->id.'">'.$mysql->pays.'</option>');
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function getPays($name, $language, $id_pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'"><option value="0">'.PAYS_TOP.'</option><option value="'.PAYS_FRANCE_ID.'">'.PAYS_FRANCE.'</option><option value="'.PAYS_BELGIQUE_ID.'">'.PAYS_BELGIQUE.'</option><option value="'.PAYS_SUISSE_ID.'">'.PAYS_SUISSE.'</option><option value="0" disabled>***********</option>');
		
		$result = $req->afficherPaysMYSQL($language);
		while ($mysql = $result->fetch_object()){
			if($mysql->id == $id_pays){
				//PAYS DU MEMBRE
				array_push($array, '<option value="'.$mysql->id.'" selected>'.$mysql->pays.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->id.'">'.$mysql->pays.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function getListing($name, $language, $id_pays, $table){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'"><option value="x">'.PAYS_DEPARTEMENTS_TOP.'</option>');
		
		$result = $req->getListingMYSQL($table.$language);
		while ($mysql = $result->fetch_object()){
			if($mysql->id == $id_pays){
				//PAYS DU MEMBRE
				array_push($array, '<option value="'.$mysql->id.'" selected>'.$mysql->element.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->id.'">'.$mysql->element.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function getMois($name, $language, $id_pays, $table, $style){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'" '.$style.'><option value="x">'.PAYS_DEPARTEMENTS_TOP.'</option>');
		
		$result = $req->getMoisMYSQL($table.$language);
		while ($mysql = $result->fetch_object()){
			if($mysql->id == $id_pays){
				//PAYS DU MEMBRE
				array_push($array, '<option value="'.$mysql->id.'" selected>'.$mysql->element.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->id.'">'.$mysql->element.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function getDepartement($name, $table, $id_departement){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		array_push($array, '<div id="'.$name.'" style="display:inline;"><select name="'.$name.'"><option value="x">'.PAYS_DEPARTEMENTS_TOP.'</option>');
		
		$result = $req->getDepartementMYSQL($table);
		while ($mysql = $result->fetch_object()){
			if($mysql->numdept == $id_departement){
				//PAYS DU MEMBRE
				array_push($array, '<option value="'.$mysql->numdept.'" selected>'.$mysql->nomdept.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->numdept.'">'.$mysql->nomdept.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function controleExistence($champs, $valeur, $table){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->controleExistenceMYSQL($champs, $valeur, $table);
		while ($mysql = $result->fetch_object()){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function insertNouveauCompte($pseudo, $mot_de_passe, $temps, $email, $ip){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertNouveauCompteMYSQL($pseudo, $mot_de_passe, $temps, $email, $ip);
	}
	
	//extraction de n caractères d'une chaine en partant de la droite
	function extraireDroite($str,$nbr){ 
		return substr($str,-$nbr); 
	}
	
	//extraction de n caractères d'une chaine en partant de la gauche
	function extraireGauche($str,$nbr){ 
		return substr($str,0,$nbr); 
	}
	
	function chargementPhoto($upfile, $upfile_size, $upfile_name, $rep_original, $rep_redimens, $rep_miniature, $pseudo, $nommage){
		$req = new CompBDD();
		$confirm = "";
		$maxsize=20000*1024; //Taille maximale des fichiers qui seront uploadés (en octet)
		$ex1 = ".jpg";
		$ex2 = ".jpeg";
		$ex3 = ".gif";
		$ex4 = ".png";
															
		if (!empty($upfile)){
			$extension = "";
			//vérifie que le fichier est non vide
				if ($upfile_size > 0){	
				//vérifie si la taille du fichier ne dépasse pas la limite
					if ($upfile_size > $maxsize){
					//fichier trop grand
						$extension = 0;
					}
					else{
						//taille correcte, vérification du type de fichier
						$type = strtolower($this->extraireDroite($upfile_name,4));
						
						if ($type == $ex1 OR $type == $ex2 OR $type == $ex3 OR $type == $ex4){
							//sauvegarde du fichier uploadé
							$savefile = $pseudo.".".$type;
							$filename = $rep_original.$savefile;
							if(file_exists($filename)){
								unlink($rep_original.$savefile);
								unlink($rep_redimens.$savefile);
								unlink($rep_miniature.$savefile);
							}
							rename($upfile, $rep_original.$savefile);
							
							//----------CREATION IMAGE REDIMENSIONNEE------------------	
							$image_redimensionnee = creationImage(600, 600, $type, $savefile, 'redimensionnee', $nommage);
							//----------CREATION IMAGE MINIATURE------------------	
							$image_miniature = creationImage(100, 100, $type, $savefile, 'miniature', $nommage);
							
							//ASSURER QUE CHAQUE VALEUR SOIT CORRECTE
							if(is_numeric($savefile) OR is_numeric($image_redimensionnee) OR is_numeric($image_miniature)){
								$extension = 0;
							}
							else{
								$extension = $type;
							}
						}
						else{
							$extension = 0;
						}
					}
				}
				else{
					$extension = 0;
				}
		}
		else{
			$extension = 0;
		}
	return $extension;
	}
	
	function getIdPseudo($pseudo, $mot_de_passe){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getIdPseudoMYSQL($pseudo, $mot_de_passe);
		while ($mysql = $result->fetch_object()){
			$id = $mysql->id;
		}
		return $id;
	}
	
	function insertPhotos($identifiant,$extension){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertPhotosMYSQL($identifiant,$extension);
	}
	
	function updatePhotos($champ,$valeur,$champ1,$valeur1){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updatePhotosMYSQL($champ,$valeur,$champ1,$valeur1);
	}
	
	function ajouterConnexion($id_pseudo, $pseudo, $mot_de_passe,$heure_connexion, $heure_deconnexion, $email){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->ajouterConnexionMYSQL($id_pseudo, $pseudo, $mot_de_passe, $heure_connexion, $heure_deconnexion, $email);
	}
	
	function getChamps($retour, $table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getChampsMYSQL($retour, $table, $champs, $valeur);
		while ($mysql = $result->fetch_object()){
			$var = $mysql->$retour;
		}
		return $var;
	}
	
	function getChampsLangue($retour, $table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getChampsLangueMYSQL($retour, $table, $champs, $valeur);
		while ($mysql = $result->fetch_object()){
			$var = $mysql->$retour;
		}
		return $var;
	}
	
	function getConnexionMetier($id_client, $pseudo_client){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getConnexionMYSQL($id_client, $pseudo_client);
		while($sql = $mysql->fetch_object()){
			array_push($array, $sql->date_creation); // 0
			array_push($array, $sql->date_cloture); // 1
		}
		
		return $array;
	}
	
	function deleteConnexionMetier($id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		//Supprimer le membre de la table des connexion
		$req->supprimerUnElementMYSQL(TABLE_ONLINE, "identifiant", $id_client);
		
		//Supprimer le membre de la table des relation CONVERSATION
		$req->supprimerUnElementMYSQL(TABLE_CONVERSATION_ONLINE, "id_exp", $id_client);
		$req->supprimerUnElementMYSQL(TABLE_CONVERSATION_ONLINE, "id_dest", $id_client);
		
		//SUPPRIMER LES MESSAGES SUR LE MESSENGER
		//Comme expéditeur...
		$req->deleteMessengerMYSQL($id_client, $pseudo_client, 'id_expediteur', 'pseudo_expediteur');
		//Comme destinataire...
		$req->deleteMessengerMYSQL($id_client, $pseudo_client, 'id_destinataire', 'pseudo_destinataire');
		
		//Supprimer les infos en direct...
		$req->supprimerUnElementMYSQL(TABLE_INFORMATIONS_DIRECT, 'id_client', $id_client);
		
		//Supprimer le membre sur la partie TCHAT
		$req->supprimerUnElementMYSQL(TABLE_TCHAT_DISCUSSION,"identifiant",$id_client);
		$req->supprimerUnElementMYSQL(TABLE_TCHAT_LISTE_CONNECTES,"identifiant",$id_client);
	}
	
	function getDerniereEntree($retour, $table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->getDerniereEntreeMYSQL($retour, $table, $champs, $valeur);
		while ($mysql = $result->fetch_object()){
			$var = $mysql->$retour;
		}if (!isset($var)) $var = ""; // ou une valeur par défaut
		return $var;
	}
	
	function tousLesConnectes($heure){
		$req = new CompBDD();
		
		$mysql = $req->tousLesConnectesMYSQL($heure);
		while($sql = $mysql->fetch_object()){
			//SUPPRESSION DE LA CONNEXION EN COURS...
			$this->deleteConnexionMetier($sql->identifiant, $sql->pseudo);
		}
	}
	
	function getMessengerMetier($id_messenger){
		$req = new CompBDD();
		$array = array();
		
		$mysql = $req->getMessengerMYSQL($id_messenger);
		while($sql = $mysql->fetch_object()){
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
	
	function deleteUnElement($table, $champs, $valeur){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->supprimerUnElementMYSQL($table, $champs, $valeur);
	}
	
	function controleValiditePub($heure){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$result = $req->controleValiditePubMYSQL($heure);
		while ($mysql = $result->fetch_object()){
			if($mysql->id){
				$this->deleteUnElement(TABLE_AFFICHAGE, "id", $mysql->id);
			}
		}
	}
	
	function controleConnexionMetier($temps, $id_client, $pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		//-------MAJ INFOS DIRECTES----------------------
		$info_en_direct = $this->getDerniereEntree('date_creation', TABLE_INFORMATIONS_DIRECT, 'id_client', $id_client);
		$temps_limite = $temps - LIMITE_AFFICHAGE_INFORMATIONS;
		if($info_en_direct < $temps_limite){
			//Supprimer les infos en direct...
			$req->supprimerUnElementMYSQL(TABLE_INFORMATIONS_DIRECT, 'id_client', $id_client);
		}
		//------------------------------------------------
		
		//--------------- TRAITEMENT SUR ETAT DE LA CONNEXION ----------------------------------------
		if(empty($id_client) AND empty($pseudo_client)){
			//METTRE A JOUR TOUS LES CONNECTES
			//$this->tousLesConnectes(time());
		}
		else{
			//SECURISER LA DECONNEXION
			$deconnexion = $this->getChamps("identifiant", TABLE_ONLINE, "pseudo", $pseudo_client);
			if(!empty($pseudo_client) AND empty($deconnexion)){
				detruireSession();
			}
		}
		//--------------------------------------------------------------------------------------------
	}
	
	function getInscriptionMembre($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getInscriptionMYSQL($id_client);
		$mysql = $result->fetch_object();
		return $mysql;
	}
	
	function afficherExtraitAnnonces($premierMembresAafficher, $nombreMembresParPage, $table, $type, $pays, $cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$espace_membre = new EspaceMembre();
		
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."') AND `id` NOT IN (SELECT `identifiant` FROM `".TABLE_ONLINE."`)";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` NOT IN (SELECT `identifiant` FROM `".TABLE_ONLINE."`)";
		}
		
		//DEBUT DU LISTING
		echo '<table id="tableau_listing_annonces">' ."\n";
				
		$cpt = 0; // compteur d'éléments 
		$nbCols = NOMBRE_COLONNE_LISTING; // nombre de colonnes du tableau 
		if($type > 0 AND $type <= 6){
			$top_bandeau = 'top_center';
			$mon_annonce = 'annonce';
			$style = 'text-align:center;border-top:1px solid #FE6500;';
		}
		else{
			$top_bandeau = 'top_center_couch';
			$mon_annonce = 'annonce_couch';
			$style = 'text-align:center;border-top:1px solid #FFCC00;';
		}
		
		$result = $req->afficherExtraitAnnoncesMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete);
		while ($mysql = $result->fetch_object()){
			$album_photo = $espace_membre->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->id);
			$identite = $espace_membre->getTable(TABLE_IDENTITE, "identifiant", $mysql->id);
			$tchat = $espace_membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $mysql->id);
			$pays_salon = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			
			//AJOUTER UNE NOUVELLE SEPARATION TOUTES LES 3 COLONNES
			if ($cpt%$nbCols == 0){
				echo '<tr>' ."\n";
			}
			
			//LISTING
			?>
			<td class="tableau_listing_annonces_td">
				<!-- ANNONCE -->
				<div class="center_annonce">
					<div class="<?php echo $top_bandeau; ?>"><?php echo strtoupper($mysql->pseudo);?></div>
				</div>
				<table class="<?php echo $mon_annonce; ?>">
					<tr>
						<td class="img_annonce"><?php echo afficherMiniature($mysql->id, $mysql->pseudo, $album_photo->img1, $album_photo->controle); ?></td>
						<td style="width:112px;">
							<div>
								<ul>
									<li><?php echo iconeConnexion($this->getChamps('connexion', TABLE_ONLINE, 'identifiant',$mysql->id)); ?></li>
									<li><?php echo afficherExtrait($pays);?></li>
									<li><?php echo afficherExtrait($identite->ville); ?></li>
									<li><?php echo afficherLienMiniature($mysql->id, $mysql->pseudo, 1,$album_photo->img1, $album_photo->controle,"font-size:12px;"); ?></li>
									<li><?php echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_GOOGLE_MAPS.'?pays='.$pays.'&ville='.$identite->ville,410,310,'<img src="'.HTTP_IMAGE.'gg_map.jpg" alt="'.ATTRIBUT_ALT.'"/>'); ?></li>
									<li style="font-size:10px;">
									<?php
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.ANCHOR_LISTING_FAVORI.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo ANCHOR_LISTING_FAVORI;
										 		}
										 		else{
										 			$deja_favori = $espace_membre->getMisEnFavori($_SESSION['id_client'],$mysql->id);
													if($deja_favori > 0){
														echo ANCHOR_LISTING_FAVORI_DEJA_AJOUTE;
													}
													else{
														echo '<a href="'.HTTP_SERVEUR.'profil-'.$mysql->id.'-1.php">'.ANCHOR_LISTING_FAVORI.'</a>';
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo ANCHOR_LISTING_FAVORI; ?></a>
											<?php 
										}
										?>
									</li>
									<!-- SALON TCHAT -->
									<li style="font-size:10px;">
									<?php
									//Définir si membre présent salon de discussion...
									if($tchat->id){
										$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
									}
									else{
										$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
									}
									
									
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo $libelle_tchat;
										 		}
										 		else{
										 			if($tchat->id){
														echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
													}
													else{
														echo $libelle_tchat;
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
											<?php 
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bolder;text-align:center;font-size:11px;"><?php echo $this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;font-size:11px;"><?php echo DU.' '.$this->getChamps('date1', $table, 'identifiant', $mysql->id).' '.AU.' '.$this->getChamps('date2', $table, 'identifiant', $mysql->id); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.'profil-'.$mysql->id.'.php';?>"><img src="<?php echo HTTP_IMAGE.BT_VOIR_PROFIL; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="choix_icone">
								<?php
								if(empty($_SESSION['pseudo_client'])){
									?>
									<ul style="<?php echo $style; ?>">
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_tchat_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_video_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_audio_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
									</ul>
									<?php
								}
								else{
									?>
									<ul style="<?php echo $style; ?>">
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_tchat_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_video_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><?php echo '<img src="'.HTTP_IMAGE.'icone_audio_off.jpg" alt="'.ATTRIBUT_ALT.'"/>'; ?></li>
										<li><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
									</ul>
									<?php
								}
								?>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<?php
			if ($cpt%$nbCols==($nbCols-1)){
				echo '</tr>' ."\n";
			}
			
			$cpt++; // on incrémente le compteur pour savoir où on en est 
		}
		// Au cas où ...
		if ($cpt!=0 && $cpt%$nbCols!=0) { // S'il n'y a pas eu assez de cellules dans la boucle pour finir la ligne ...
		    if($cpt == 1){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    if($cpt == 2){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    
		    //echo '<td colspan="'.($nbCols - ($cpt%$nbCols) ).'" class="tableau_listing_annonces_td">&nbsp;</td>'; // ... on complète avec une cellule vide de la bonne taille...
		    //echo '</tr>'; // ... et on ferme la ligne
		} 
		//FIN
		echo '</table>';
	}
	
	function compterMembresSuivantOptions($table,$type,$pays,$cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."')";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok'";
		}
		$result = $req->compterMembresOfflineMYSQL($requete);
		while ($mysql = $result->fetch_object()){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function compterAnnoncesParDept($table,$type,$pays,$dept){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		
		$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."' AND code_postal LIKE '".$dept."%')";
		$result = $req->compterMembresOfflineMYSQL($requete);
		while ($mysql = $result->fetch_object()){
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function afficherExtraitOFFLINEetONLINEAnnoncesAvecOptions($premierMembresAafficher, $nombreMembresParPage, $table, $type, $pays, $cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$espace_membre = new EspaceMembre();
		
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."')";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok'";
		}
		
		//DEBUT DU LISTING
		echo '<table id="tableau_listing_annonces">' ."\n";
				
		$cpt = 0; // compteur d'éléments 
		$nbCols = NOMBRE_COLONNE_LISTING; // nombre de colonnes du tableau 
		
		if($type > 0 AND $type <= 6){
			$top_bandeau = 'top_center';
			$mon_annonce = 'annonce';
			$style = 'text-align:center;border-top:1px solid #FE6500;';
		}
		else{
			$top_bandeau = 'top_center_couch';
			$mon_annonce = 'annonce_couch';
			$style = 'text-align:center;border-top:1px solid #FFCC00;';
		}
		
		$result = $req->afficherExtraitAnnoncesMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete);
		while ($mysql = $result->fetch_object()){
			$album_photo = $espace_membre->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->id);
			$identite = $espace_membre->getTable(TABLE_IDENTITE, "identifiant", $mysql->id);
			$tchat = $espace_membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $mysql->id);
			$connecte = $this->getChamps('connexion', TABLE_ONLINE, 'identifiant',$mysql->id);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			$pays_salon = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);
			
			//AJOUTER UNE NOUVELLE SEPARATION TOUTES LES 3 COLONNES
			if ($cpt%$nbCols == 0){
				echo '<tr>' ."\n";
			}
			
			//LISTING
			?>
			<td class="tableau_listing_annonces_td">
				<!-- ANNONCE -->
				<div class="center_annonce">
					<div class="<?php echo $top_bandeau; ?>"><?php echo strtoupper($mysql->pseudo);?></div>
				</div>
				<table class="<?php echo $mon_annonce; ?>">
					<tr>
						<td class="img_annonce"><?php echo afficherMiniature($mysql->id, $mysql->pseudo, $album_photo->img1, $album_photo->controle); ?></td>
						<td style="width:112px;">
							<div>
								<ul>
									<li><?php echo iconeConnexion($connecte); ?></li>
									<li><?php echo afficherExtrait($pays);?></li>
									<li><?php echo afficherExtrait($identite->ville); ?></li>
									<li><?php echo afficherLienMiniature($mysql->id, $mysql->pseudo, 1,$album_photo->img1, $album_photo->controle,"font-size:12px;"); ?></li>
									<li><?php echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_GOOGLE_MAPS.'?pays='.$pays.'&ville='.$identite->ville,410,310,'<img src="'.HTTP_IMAGE.'gg_map.jpg" alt="'.ATTRIBUT_ALT.'"/>'); ?></li>
									<li style="font-size:10px;">
									<?php
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.ANCHOR_LISTING_FAVORI.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo ANCHOR_LISTING_FAVORI;
										 		}
										 		else{
										 			$deja_favori = $espace_membre->getMisEnFavori($_SESSION['id_client'],$mysql->id);
													if($deja_favori > 0){
														echo ANCHOR_LISTING_FAVORI_DEJA_AJOUTE;
													}
													else{
														echo '<a href="'.HTTP_SERVEUR.'profil-'.$mysql->id.'-1.php">'.ANCHOR_LISTING_FAVORI.'</a>';
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo ANCHOR_LISTING_FAVORI; ?></a>
											<?php 
										}
										?>
									</li>
									<!-- SALON TCHAT -->
									<li style="font-size:10px;">
									<?php
									//Définir si membre présent salon de discussion...
									if($tchat->id){
										$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
									}
									else{
										$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
									}
									
									
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo $libelle_tchat;
										 		}
										 		else{
										 			if($tchat->id){
														echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
													}
													else{
														echo $libelle_tchat;
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
											<?php 
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bolder;text-align:center;font-size:11px;"><?php echo $this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;font-size:11px;"><?php echo DU.' '.$this->getChamps('date1', $table, 'identifiant', $mysql->id).' '.AU.' '.$this->getChamps('date2', $table, 'identifiant', $mysql->id); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.'profil-'.$mysql->id.'.php';?>"><img src="<?php echo HTTP_IMAGE.BT_VOIR_PROFIL; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="choix_icone">
								<ul style="<?php echo $style; ?>">
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_tchat_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_video_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_audio_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if(empty($_SESSION['pseudo_client'])){
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<?php
			if ($cpt%$nbCols==($nbCols-1)){
				echo '</tr>' ."\n";
			}
			
			$cpt++; // on incrémente le compteur pour savoir où on en est 
		}
		// Au cas où ...
		if ($cpt!=0 && $cpt%$nbCols!=0) { // S'il n'y a pas eu assez de cellules dans la boucle pour finir la ligne ...
		    if($cpt == 1){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    if($cpt == 2){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    
		    //echo '<td colspan="'.($nbCols - ($cpt%$nbCols) ).'" class="tableau_listing_annonces_td">&nbsp;</td>'; // ... on complète avec une cellule vide de la bonne taille...
		    //echo '</tr>'; // ... et on ferme la ligne
		} 
		//FIN
		echo '</table>';
	}
	
	function ouvrirConnexionMetier($id_client, $pseudo_client, $creation, $date_de_cloture){
		$req = new CompBDD();
		
		$req->ouvrirConnexionMYSQL($id_client, $pseudo_client, $creation, $date_de_cloture);
		
		//PASSER LE MEMBRE EN CONNECTER
		$req->activerConnexionMYSQL($id_client, $pseudo_client, 'on');
	}
	
	function getComptePaiement($pseudo_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getComptePaiementMYSQL($pseudo_client);
		while ($mysql = $result->fetch_object()){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->pseudo); // 1
			array_push($array, $mysql->date_fin); // 2
			array_push($array, $mysql->gratuit); // 3
			array_push($array, $mysql->online); // 4
		}
		return $array;
	}
	
	function updateIdentifiantsAdmin($login, $passe, $passe_non_crypte){
		$req = new CompBDD();
		$req->updateIdentifiantsAdminMYSQL($login, $passe, $passe_non_crypte);
	}
	
	function insertNouvelleInscription($id_pseudo, $heure){
		$req = new CompBDD();
		$req->insertNouvelleInscriptionMYSQL($id_pseudo, $heure);
	}
	
	function ajouterDonneesEnAttente($lien,$texte,$email,$anchor,$nb_aleatoire, $formule){
		$req = new CompBDD();
		$req->ajouterDonneesEnAttenteMYSQL($lien,$texte,$email,$anchor,$nb_aleatoire, $formule);
	}
	
	function getPaiementPaypal($identifiant){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getPaiementPaypalMYSQL($identifiant);
		while ($mysql = $result->fetch_object()){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->email); // 1
			array_push($array, $mysql->lien); // 2
			array_push($array, $mysql->texte); // 3
			array_push($array, $mysql->anchor); // 4
			array_push($array, $mysql->identifiant); //5
			array_push($array, $mysql->formule); // 6
		}
		return $array;
	}
	
	function ajouterNouvellePublicite($email,$lien,$texte,$anchor, $formule, $heure, $partie){
		$req = new CompBDD();
		$req->ajouterNouvellePubliciteMYSQL($email,$lien,$texte,$anchor, $formule, $heure, $partie);
	}
	
	function getUneAnnoncePub(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getUneAnnoncePubMYSQL();
		while ($mysql = $result->fetch_object()){
			array_push($array, $mysql->id); // 0
			array_push($array, $mysql->email); // 1
			array_push($array, $mysql->lien); // 2
			array_push($array, $mysql->texte); // 3
			array_push($array, $mysql->anchor); // 4
			array_push($array, $mysql->formule); //5
			array_push($array, $mysql->date_creation); // 6
			array_push($array, $mysql->compteur); // 7
		}
		return $array;
	}
	
	function updateCompteurAffichage($compteur, $id){
		$req = new CompBDD();
		$req->updateCompteurAffichageMYSQL($compteur, $id);
	}
	
	function getAnnoncePub($formulaire_email){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$membre = new EspaceMembre();
		
		$result = $req->getAnnoncePubMYSQL($formulaire_email);
		while ($mysql = $result->fetch_object()){
			$mesValeurs = $membre->getTable(TABLE_GRILLE_TARIFAIRE, "id", $mysql->formule);
			
			echo '<tr>' .
					'<td class="td_element">'.$mysql->id.'</td>' .
					'<td class="td_element">'.date("d/m/Y", $mysql->date_creation).'</td>' .
					'<td class="td_element">'.date("d/m/Y", $mysql->anchor).'</td>' .
					'<td class="td_element">'.$mysql->formule.'</td>' .
					'<td class="td_element">'.PAGE_2.':'.$mesValeurs->partie.'/'.$mesValeurs->jour.JOUR.'/'.$mesValeurs->montant.'?</td>' .
					'<td class="td_element">';
					?>
					<a href="<?php echo $mysql->lien;?>" rel="lightbox" style="font-size:10px;"><?php echo LIEN_IMAGE;?></a>
					<?php
			echo '</td>' .
					'</tr>';
		}
	}
	
	function ajouterPaiement($pseudo_membre,$cloture){
		$req = new CompBDD();
		$req->ajouterPaiementMYSQL($pseudo_membre,$cloture);
	}
	
	function chargementAudio($upfile, $upfile_size, $upfile_name, $rep_original, $tmp){
		$req = new CompBDD();
		$confirm = "";
		$maxsize=20000*1024; //Taille maximale des fichiers qui seront uploadés (en octet)
		$ex1 = ".mp3";
		$ex2 = ".wma";
		$ex3 = ".wav";
															
		if (!empty($upfile)){
			$array = array();
			//vérifie que le fichier est non vide
				if ($upfile_size > 0){	
				//vérifie si la taille du fichier ne dépasse pas la limite
					if ($upfile_size > $maxsize){
					//fichier trop grand
						array_push($array, '0');
					}
					else{
						//taille correcte, vérification du type de fichier
						$type = strtolower($this->extraireDroite($upfile_name,4));
						
						if ($type == $ex1 OR $type == $ex2 OR $type == $ex3){
							//on va chercher la date de la journée sous la forme annéemoisjourheureminuteseconde (ex : 200361015159)
							$jour = $tmp['mday'];
							$mois = $tmp['mon'];
							$annee = $tmp['year'];
							$h = $tmp['hours'];
							$m = $tmp['minutes'];
							$s = $tmp['seconds'];
							$tout = $annee.$mois.$jour.$h.$m.$s; 
							//on calcule le nombre de lettres avant le premier point
							$res = strpos("$upfile_name",".");
							//on extrait le nombre de lettre avant le point
							$type2 = $this->extraireGauche($upfile_name,$res);
							
							//sauvegarde du fichier uploadé
							$savefile = $type2.".".$tout.".".$type;
							move_uploaded_file($upfile, $rep_original.$savefile);
							
							//ASSURER QUE CHAQUE VALEUR SOIT CORRECTE
							if(is_numeric($savefile)){
								array_push($array, '0');
							}
							else{
								array_push($array, $savefile);
							}
						}
						else{
							array_push($array, '0');
						}
					}
				}
				else{
					array_push($array, '0');//pas de chargement de photo
				}
		}
		else{
			array_push($array, '0');//pas de chargement de photo
		}
	return $array;
	}
	
	function chargementVideo($upfile, $upfile_size, $upfile_name, $rep_original,$pseudo){
		$req = new CompBDD();
		$confirm = "";
		$maxsize=20000*1024; //Taille maximale des fichiers qui seront uploadés (en octet)
		$ex1 = ".flv";
		$ex2 = ".wmv";
		$ex3 = ".avi";
		$ex4 = ".mov";
		$ex5 = ".mpg";
															
		if (!empty($upfile)){
			$array = array();
			//vérifie que le fichier est non vide
				if ($upfile_size > 0){	
				//vérifie si la taille du fichier ne dépasse pas la limite
					if ($upfile_size > $maxsize){
					//fichier trop grand
						array_push($array, '0');
					}
					else{
						//taille correcte, vérification du type de fichier
						$type = strtolower($this->extraireDroite($upfile_name,4));
						
						if ($type == $ex1 OR $type == $ex2 OR $type == $ex3 OR $type == $ex4 OR $type == $ex5){
							//sauvegarde du fichier uploadé
							$video_existante = $this->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $pseudo);
							$filename = $rep_original.$video_existante;
							if(file_exists($filename) AND $video_existante != ""){
								unlink($filename);
							}
							$savefile = $pseudo.'.'.$type;
							move_uploaded_file($upfile, $rep_original.$savefile);
							
							//ASSURER QUE CHAQUE VALEUR SOIT CORRECTE
							if(is_numeric($savefile)){
								array_push($array, '0');
							}
							else{
								array_push($array, $savefile);
							}
						}
						else{
							array_push($array, '0');
						}
					}
				}
				else{
					array_push($array, '0');//pas de chargement de photo
				}
		}
		else{
			array_push($array, '0');//pas de chargement de photo
		}
	return $array;
	}
	
	function getEmail(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$result = $req->getEmailMYSQL();
		while ($mysql = $result->fetch_object()){
			array_push($array, $mysql->email);
		}
		return $array;
	}
	
	function enregisterNewsletter($description){
		$bdd = new CompBDD();
		$bdd->enregisterNewsletterMYSQL($description, time());
	}
	
	function updateNewsletter($description, $traitement){
		$bdd = new CompBDD();
		$bdd->updateNewsletterMYSQL($description, $traitement);
	}
	
	function getOnlineMembre($id_client){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getOnlineMembreMYSQL($id_client);
		$mysql = $result->fetch_object();
		return $mysql;
	}
	
	function afficherExtraitAnnoncesOnline($premierMembresAafficher, $nombreMembresParPage, $table, $type, $pays, $cible){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$espace_membre = new EspaceMembre();
		
		if($cible == "liste"){
			//Listing ciblée par type
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `identifiant` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."')";
		}
		else{
			//listing générique
			$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok'";
		}
		
		//DEBUT DU LISTING
		echo '<table id="tableau_listing_annonces">' ."\n";
				
		$cpt = 0; // compteur d'éléments 
		$nbCols = NOMBRE_COLONNE_LISTING; // nombre de colonnes du tableau 
		if($type > 0 AND $type <= 6){
			$top_bandeau = 'top_center';
			$mon_annonce = 'annonce';
			$style = 'text-align:center;border-top:1px solid #FE6500;';
		}
		else{
			$top_bandeau = 'top_center_couch';
			$mon_annonce = 'annonce_couch';
			$style = 'text-align:center;border-top:1px solid #FFCC00;';
		}
		
		$result = $req->afficherExtraitAnnoncesOnlineMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete);
		while ($mysql = $result->fetch_object()){
			//AJOUTER UNE NOUVELLE SEPARATION TOUTES LES 3 COLONNES
			if ($cpt%$nbCols == 0){
				echo '<tr>' ."\n";
			}
			
			$album_photo = $espace_membre->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->identifiant);
			$identite = $espace_membre->getTable(TABLE_IDENTITE, "identifiant", $mysql->identifiant);
			$tchat = $espace_membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $mysql->identifiant);
			$pays_salon = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			//LISTING
			?>
			<td class="tableau_listing_annonces_td">
				<!-- ANNONCE -->
				<div class="center_annonce">
					<div class="<?php echo $top_bandeau; ?>"><?php echo strtoupper($mysql->pseudo);?></div>
				</div>
				<table class="<?php echo $mon_annonce; ?>">
					<tr>
						<td class="img_annonce"><?php echo afficherMiniature($mysql->identifiant, $mysql->pseudo, $album_photo->img1, $album_photo->controle); ?></td>
						<td style="width:112px;">
							<div>
								<ul>
									<li><?php echo iconeConnexion($mysql->identifiant); ?></li>
									<li><?php echo afficherExtrait($pays);?></li>
									<li><?php echo afficherExtrait($identite->ville); ?></li>
									<li><?php echo afficherLienMiniature($mysql->identifiant, $mysql->pseudo, 1,$album_photo->img1, $album_photo->controle,"font-size:12px;"); ?></li>
									<li><?php echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_GOOGLE_MAPS.'?pays='.$pays.'&ville='.$identite->ville,410,310,'<img src="'.HTTP_IMAGE.'gg_map.jpg" alt="'.ATTRIBUT_ALT.'"/>'); ?></li>
									<li style="font-size:10px;">
									<?php
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.ANCHOR_LISTING_FAVORI.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->identifiant){
										 			echo ANCHOR_LISTING_FAVORI;
										 		}
										 		else{
										 			$deja_favori = $espace_membre->getMisEnFavori($_SESSION['id_client'],$mysql->identifiant);
													if($deja_favori > 0){
														echo ANCHOR_LISTING_FAVORI_DEJA_AJOUTE;
													}
													else{
														echo '<a href="'.HTTP_SERVEUR.'profil-'.$mysql->identifiant.'-1.php">'.ANCHOR_LISTING_FAVORI.'</a>';
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo ANCHOR_LISTING_FAVORI; ?></a>
											<?php 
										}
										?>
									</li>
									<!-- SALON TCHAT -->
									<li style="font-size:10px;">
									<?php
									//Définir si membre présent salon de discussion...
									if($tchat->id){
										$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
									}
									else{
										$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
									}
									
									
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo $libelle_tchat;
										 		}
										 		else{
										 			if($tchat->id){
														echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
													}
													else{
														echo $libelle_tchat;
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
											<?php 
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bolder;text-align:center;font-size:11px;"><?php echo $this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;font-size:11px;"><?php echo DU.' '.$this->getChamps('date1', $table, 'identifiant', $mysql->identifiant).' '.AU.' '.$this->getChamps('date2', $table, 'identifiant', $mysql->identifiant); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.'profil-'.$mysql->identifiant.'.php';?>"><img src="<?php echo HTTP_IMAGE.BT_VOIR_PROFIL; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="choix_icone">
								<?php
								if(empty($_SESSION['pseudo_client'])){
									?>
									<ul style="<?php echo $style; ?>">
										<li><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
									</ul>
									<?php
								}
								else{
									?>
									<ul style="<?php echo $style; ?>">
										<li><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$mysql->identifiant.'&m='.$mysql->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$mysql->identifiant.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$mysql->identifiant.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
										<li><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$mysql->identifiant.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></li>
									</ul>
									<?php
								}
								?>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<?php
			if ($cpt%$nbCols==($nbCols-1)){
				echo '</tr>' ."\n";
			}
			
			$cpt++; // on incrémente le compteur pour savoir où on en est 
		}
		// Au cas où ...
		if ($cpt!=0 && $cpt%$nbCols!=0) { // S'il n'y a pas eu assez de cellules dans la boucle pour finir la ligne ...
		    if($cpt == 1){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    if($cpt == 2){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    
		    //echo '<td colspan="'.($nbCols - ($cpt%$nbCols) ).'" class="tableau_listing_annonces_td">&nbsp;</td>'; // ... on complète avec une cellule vide de la bonne taille...
		    //echo '</tr>'; // ... et on ferme la ligne
		} 
		//FIN
		echo '</table>';
	}	
	
	function updateIdentite($nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange,$identifiant){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->updateIdentiteMYSQL($nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange,$identifiant);
	}
	
	function afficherTousLesPays($langue,$min,$max,$genre){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		array_push($array,'<div class="part1"><ul>');
		$result = $req->afficherTousLesPaysMYSQL($langue,$min,$max);
		while ($mysql = $result->fetch_object()){
			array_push($array, '<li>- <a href="'.HTTP_SERVEUR.'petites-annonces-echange-maison-1-'.$genre.'-'.$mysql->id.'.php">'.$mysql->pays.'</a></li>');
		}
		array_push($array,'</ul></div>');
		return $array;
	}
	
	function afficherTousLesDepartements($langue,$min,$max,$pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		array_push($array,'<div class="part1"><ul>');
		$result = $req->afficherTousLesDepartementsMYSQL($langue,$min,$max);
		while ($mysql = $result->fetch_object()){
			array_push($array, '<li>- <a href="'.HTTP_SERVEUR.'rencontre-'.$pays.'-2-1-'.$mysql->numdept.'.php">'.$mysql->nomdept.'</a></li>');
		}
		array_push($array,'</ul></div>');
		return $array;
	}
	
	function compterTousLesMembresParPays($id_pays, $id_depart){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		//DEFINIR LE PARAMETRE OPTIONNEL
		if($id_depart){
			//ETAT CONNECTER
			$result = $req->compterTousLesMembresParPaysDeptMYSQL($id_pays, $id_depart);
			$mysql = $result->fetch_object();
			$compter = $mysql->compter;
		}
		else{
			//TOUS SANS DISTINCTION
			$result = $req->compterTousLesMembresParPaysMYSQL($id_pays);
			$mysql = $result->fetch_object();
			$compter = $mysql->compter;
		}
		return $compter;
	}
	
	function insertMailing($newsletter){
		$bdd = new CompBDD();
		$bdd->insertMailingMYSQL($newsletter);
	}
	
	function getLastMailinglist(){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$result = $req->getLastMailinglistMYSQL();
		while ($mysql = $result->fetch_object()){
			$lettre = $mysql->lettre;
		}
		return $lettre;
	}
	
	function envoiMailinglist($mini,$maxi){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		//LA NEWSLETTER
		$codehtml = $this->getLastMailinglist();
		
		//------ LISTER LES EMAILS ET ENVOI --------------
		mysql_connect(BDD_SERVEUR, BDD_IDENTIFIANT, BDD_MOT_PASSE);
		mysql_select_db(BDD_BASE_DE_DONNEES_MAILING);
			$reponse = mysql_query("SELECT `email` FROM `".TABLE_LISTE_EMAIL."` LIMIT ".$mini.",".$maxi."") or die(mysql_error());
			while ($mysql = $reponse->fetch_object()){
				//----------- ENVOI MAIL ----------------
				$destinataire = $mysql->email;
				$entete = 'A découvrir';
				$expediteur = MAIL_CORRESPONDANCE;
				$reponse = MAIL_CORRESPONDANCE;
				//------ ENVOIE MAIL INVITATION ---------------
				mail($destinataire,$entete,$codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
				//---------------------------------------
			}
		mysql_close();
		//------------------------------------------------
	}
	
	function afficherEchange($name,$num){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		if($name == "echange"){
			$ma_req = "WHERE `id`>=1 AND `id`<=6 ORDER BY `element`";
		}
		elseif($name == "couchsurfing"){
			$ma_req = "WHERE `id`>=7 AND `id`<=8 ORDER BY `element`";
		}
		else{
			$ma_req = "ORDER BY `element`";
		}
		
		array_push($array, '<select name="'.$name.'" id="'.$name.'"><option value="0">'.MODULE_ECHANGE_MAISON_SELECT_ECHANGE.'</option>');
		$result = $req->afficherEchangeMYSQL($ma_req);
		while ($mysql = $result->fetch_object()){
			if($num == $mysql->id){
				array_push($array, '<option value="'.$mysql->id.'" selected>'.$mysql->element.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->id.'">'.$mysql->element.'</option>');
			}
		}
		array_push($array, '</select>');
		return $array;
	}
	
	function afficherExtraitMoteurDeRecherche($premierMembresAafficher, $nombreMembresParPage, $mot_cle){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$espace_membre = new EspaceMembre();
		
		//listing générique
		$requete = "WHERE (`id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_LISTING_ECHANGE_MAISON."` WHERE `commentaire1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `commentaire2` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `destination1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci )) OR (`id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_LISTING_COUCHSURFING."` WHERE `commentaire1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `commentaire2` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci OR `destination1` LIKE CONVERT( _utf8 '%$mot_cle%' USING latin1 ) COLLATE latin1_swedish_ci )) GROUP BY `id`";
		
		//DEBUT DU LISTING
		echo '<table id="tableau_listing_annonces">' ."\n";
				
		$cpt = 0; // compteur d'éléments 
		$nbCols = NOMBRE_COLONNE_LISTING; // nombre de colonnes du tableau 
		
		$result = $req->afficherExtraitAnnoncesMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete);
		while ($mysql = $result->fetch_object()){
			$album_photo = $espace_membre->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->id);
			$identite = $espace_membre->getTable(TABLE_IDENTITE, "identifiant", $mysql->id);
			$connecte = $this->getChamps('connexion', TABLE_ONLINE, 'identifiant',$mysql->id);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			$table = $this->getChamps('type_annonce', TABLE_INSCRIPTION, 'id', $mysql->id);
			$tchat = $espace_membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $mysql->id);
			$pays_salon = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);
			
			if($identite->type_echange > 0 AND $identite->type_echange <= 6){
				$top_bandeau = 'top_center';
				$mon_annonce = 'annonce';
				$style = 'text-align:center;border-top:1px solid #FE6500;';
			}
			else{
				$top_bandeau = 'top_center_couch';
				$mon_annonce = 'annonce_couch';
				$style = 'text-align:center;border-top:1px solid #FFCC00;';
			}
			
			//AJOUTER UNE NOUVELLE SEPARATION TOUTES LES 3 COLONNES
			if ($cpt%$nbCols == 0){
				echo '<tr>' ."\n";
			}
			
			//LISTING
			?>
			<td class="tableau_listing_annonces_td">
				<!-- ANNONCE -->
				<div class="center_annonce">
					<div class="<?php echo $top_bandeau; ?>"><?php echo strtoupper($mysql->pseudo);?></div>
				</div>
				<table class="<?php echo $mon_annonce; ?>">
					<tr>
						<td class="img_annonce"><?php echo afficherMiniature($mysql->id, $mysql->pseudo, $album_photo->img1, $album_photo->controle); ?></td>
						<td style="width:112px;">
							<div>
								<ul>
									<li><?php echo iconeConnexion($connecte); ?></li>
									<li><?php echo afficherExtrait($pays);?></li>
									<li><?php echo afficherExtrait($identite->ville); ?></li>
									<li><?php echo afficherLienMiniature($mysql->id, $mysql->pseudo, 1,$album_photo->img1, $album_photo->controle,"font-size:12px;"); ?></li>
									<li><?php echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_GOOGLE_MAPS.'?pays='.$pays.'&ville='.$identite->ville,410,310,'<img src="'.HTTP_IMAGE.'gg_map.jpg" alt="'.ATTRIBUT_ALT.'"/>'); ?></li>
									<li style="font-size:10px;">
									<?php
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.ANCHOR_LISTING_FAVORI.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo ANCHOR_LISTING_FAVORI;
										 		}
										 		else{
										 			$deja_favori = $espace_membre->getMisEnFavori($_SESSION['id_client'],$mysql->id);
													if($deja_favori > 0){
														echo ANCHOR_LISTING_FAVORI_DEJA_AJOUTE;
													}
													else{
														echo '<a href="'.HTTP_SERVEUR.'profil-'.$mysql->id.'-1.php">'.ANCHOR_LISTING_FAVORI.'</a>';
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo ANCHOR_LISTING_FAVORI; ?></a>
											<?php 
										}
										?>
									</li>
									<!-- SALON TCHAT -->
									<li style="font-size:10px;">
									<?php
									//Définir si membre présent salon de discussion...
									if($tchat->id){
										$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
									}
									else{
										$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
									}
									
									
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo $libelle_tchat;
										 		}
										 		else{
										 			if($tchat->id){
														echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
													}
													else{
														echo $libelle_tchat;
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
											<?php 
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bolder;text-align:center;font-size:11px;"><?php echo $this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;font-size:11px;"><?php echo DU.' '.$this->getChamps('date1', $table, 'identifiant', $mysql->id).' '.AU.' '.$this->getChamps('date2', $table, 'identifiant', $mysql->id); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.'profil-'.$mysql->id.'.php';?>"><img src="<?php echo HTTP_IMAGE.BT_VOIR_PROFIL; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="choix_icone">
								<ul style="<?php echo $style; ?>">
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_tchat_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_video_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_audio_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if(empty($_SESSION['pseudo_client'])){
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<?php
			if ($cpt%$nbCols==($nbCols-1)){
				echo '</tr>' ."\n";
			}
			
			$cpt++; // on incrémente le compteur pour savoir où on en est 
		}
		// Au cas où ...
		if ($cpt!=0 && $cpt%$nbCols!=0) { // S'il n'y a pas eu assez de cellules dans la boucle pour finir la ligne ...
		    if($cpt == 1){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    if($cpt == 2){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    
		    //echo '<td colspan="'.($nbCols - ($cpt%$nbCols) ).'" class="tableau_listing_annonces_td">&nbsp;</td>'; // ... on complète avec une cellule vide de la bonne taille...
		    //echo '</tr>'; // ... et on ferme la ligne
		} 
		//FIN
		echo '</table>';
	}
	
	function afficherExtraitParDept($premierMembresAafficher, $nombreMembresParPage, $table, $type, $pays, $dept){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		$espace_membre = new EspaceMembre();
		
		$requete = "WHERE `type_annonce`='".$table."' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_IDENTITE."` WHERE `type_echange`='".$type."' AND `pays`='".$pays."' AND code_postal LIKE '".$dept."%')";
		
		//DEBUT DU LISTING
		echo '<table id="tableau_listing_annonces">' ."\n";
				
		$cpt = 0; // compteur d'éléments 
		$nbCols = NOMBRE_COLONNE_LISTING; // nombre de colonnes du tableau 
		
		if($type > 0 AND $type <= 6){
			$top_bandeau = 'top_center';
			$mon_annonce = 'annonce';
			$style = 'text-align:center;border-top:1px solid #FE6500;';
		}
		else{
			$top_bandeau = 'top_center_couch';
			$mon_annonce = 'annonce_couch';
			$style = 'text-align:center;border-top:1px solid #FFCC00;';
		}
		
		$result = $req->afficherExtraitAnnoncesMYSQL($premierMembresAafficher, $nombreMembresParPage, $requete);
		while ($mysql = $result->fetch_object()){
			$album_photo = $espace_membre->getTable(TABLE_ALBUM_PHOTO, "identifiant", $mysql->id);
			$identite = $espace_membre->getTable(TABLE_IDENTITE, "identifiant", $mysql->id);
			$connecte = $this->getChamps('connexion', TABLE_ONLINE, 'identifiant',$mysql->id);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			$tchat = $espace_membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $mysql->id);
			$pays_salon = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);
			
			//AJOUTER UNE NOUVELLE SEPARATION TOUTES LES 3 COLONNES
			if ($cpt%$nbCols == 0){
				echo '<tr>' ."\n";
			}
			
			//LISTING
			?>
			<td class="tableau_listing_annonces_td">
				<!-- ANNONCE -->
				<div class="center_annonce">
					<div class="<?php echo $top_bandeau; ?>"><?php echo strtoupper($mysql->pseudo);?></div>
				</div>
				<table class="<?php echo $mon_annonce; ?>">
					<tr>
						<td class="img_annonce"><?php echo afficherMiniature($mysql->id, $mysql->pseudo, $album_photo->img1, $album_photo->controle); ?></td>
						<td style="width:112px;">
							<div>
								<ul>
									<li><?php echo iconeConnexion($connecte); ?></li>
									<li><?php echo afficherExtrait($pays);?></li>
									<li><?php echo afficherExtrait($identite->ville); ?></li>
									<li><?php echo afficherLienMiniature($mysql->id, $mysql->pseudo, 1,$album_photo->img1, $album_photo->controle,"font-size:12px;"); ?></li>
									<li><?php echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_GOOGLE_MAPS.'?pays='.$pays.'&ville='.$identite->ville,410,310,'<img src="'.HTTP_IMAGE.'gg_map.jpg" alt="'.ATTRIBUT_ALT.'"/>'); ?></li>
									<li style="font-size:10px;">
									<?php
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.ANCHOR_LISTING_FAVORI.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo ANCHOR_LISTING_FAVORI;
										 		}
										 		else{
										 			$deja_favori = $espace_membre->getMisEnFavori($_SESSION['id_client'],$mysql->id);
													if($deja_favori > 0){
														echo ANCHOR_LISTING_FAVORI_DEJA_AJOUTE;
													}
													else{
														echo '<a href="'.HTTP_SERVEUR.'profil-'.$mysql->id.'-1.php">'.ANCHOR_LISTING_FAVORI.'</a>';
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo ANCHOR_LISTING_FAVORI; ?></a>
											<?php 
										}
										?>
									</li>
									<!-- SALON TCHAT -->
									<li style="font-size:10px;">
									<?php
									//Définir si membre présent salon de discussion...
									if($tchat->id){
										$libelle_tchat = LIBELLE_SALON_DISCUSSION_ONLINE.' '.$pays_salon;
									}
									else{
										$libelle_tchat = '<span style="color:grey;">'.LIBELLE_SALON_DISCUSSION_OFFLINE.'</span>';
									}
									
									
										if($_SESSION['pseudo_client']){
											$paiement = activerPaiement($_SESSION['pseudo_client']);
											if($paiement == 0){
												//AUTORISATION REFUSEE
												echo '<a href="'.HTTP_PAIEMENT.'">'.$libelle_tchat.'</a>';
											}
											else{
												if($_SESSION['id_client'] == $mysql->id){
										 			echo $libelle_tchat;
										 		}
										 		else{
										 			if($tchat->id){
														echo '<a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$tchat->id_pays.'">'.$libelle_tchat.'</a>';
													}
													else{
														echo $libelle_tchat;
													}
										 		}
										 	}
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo $libelle_tchat; ?></a>
											<?php 
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bolder;text-align:center;font-size:11px;"><?php echo $this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;font-size:11px;"><?php echo DU.' '.$this->getChamps('date1', $table, 'identifiant', $mysql->id).' '.AU.' '.$this->getChamps('date2', $table, 'identifiant', $mysql->id); ?></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.'profil-'.$mysql->id.'.php';?>"><img src="<?php echo HTTP_IMAGE.BT_VOIR_PROFIL; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="choix_icone">
								<ul style="<?php echo $style; ?>">
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.'icone_tchat.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_tchat_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_video.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_video_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if($connecte){
											if(empty($_SESSION['pseudo_client'])){
												?>
												<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
											else{
												?>
												<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_audio.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
												<?php
											}
										}
										else{
											echo '<img src="'.HTTP_IMAGE.'icone_audio_off.jpg" alt="'.ATTRIBUT_ALT.'"/>';
										}
										?>
									</li>
									<li>
										<?php
										if(empty($_SESSION['pseudo_client'])){
											?>
											<a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										else{
											?>
											<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$mysql->id.'&m='.$mysql->pseudo;?>"><img src="<?php echo HTTP_IMAGE.'icone_mail.jpg'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
											<?php
										}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<?php
			if ($cpt%$nbCols==($nbCols-1)){
				echo '</tr>' ."\n";
			}
			
			$cpt++; // on incrémente le compteur pour savoir où on en est 
		}
		// Au cas où ...
		if ($cpt!=0 && $cpt%$nbCols!=0) { // S'il n'y a pas eu assez de cellules dans la boucle pour finir la ligne ...
		    if($cpt == 1){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    if($cpt == 2){
		    	echo '<td class="tableau_listing_annonces_td">&nbsp;</td>' .
		    			'</tr>';
		    }
		    
		    //echo '<td colspan="'.($nbCols - ($cpt%$nbCols) ).'" class="tableau_listing_annonces_td">&nbsp;</td>'; // ... on complète avec une cellule vide de la bonne taille...
		    //echo '</tr>'; // ... et on ferme la ligne
		} 
		//FIN
		echo '</table>';
	}
	
	function getCommentairesLivreDor($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$req = new CompBDD();
		echo '<ul style="margin-top:5px;">';
		$mysql = $req->getCommentairesLivreDorMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		while($sql = $mysql->fetch_object()){
			echo "<li style=\"border-top:1px solid grey;padding:4px;text-align:justify;\"><span style=\"color: #336699;font-weight:bolder;\">".$sql->pseudo_livre_dor."</span> ".date('d-m-Y H:i:s', $sql->date_livre_dor)."<br /><span style=\"text-decoration:underline;\">Commentaire</span>: <em>".$sql->commentaire_livre_dor."</em></li>";
		}
		echo '</ul>';
	}
	
	function getMenuDeroulant($name, $language, $id_pays, $table,$option_id,$option_element){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$array = array();
		
		$tab = explode("|",$name);
		if($tab[2]){
			$class = $tab[0];
			$requete = "WHERE `".$tab[2]."`='".$tab[1]."' ORDER BY `".$option_id."`";
		}
		else{
			$class = $name;
			$requete = "ORDER BY `".$option_id."`";
		}
		
		array_push($array, '<select name="'.$class.'" id="'.$class.'">');
		
		$result = $req->getMenuDeroulantMYSQL($table.$language,$requete);
		while ($mysql = $result->fetch_object()){
			if($mysql->$option_id == $id_pays){
				//PAYS DU MEMBRE
				array_push($array, '<option value="'.$mysql->$option_id.'" selected>'.$mysql->$option_element.'</option>');
			}
			else{
				array_push($array, '<option value="'.$mysql->$option_id.'">'.$mysql->$option_element.'</option>');
			}
		}
		array_push($array, '</select>');
		
		return $array;
	}
	
	function insertionNouvelleCategorie($nouvelle_categorie,$lang){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionNouvelleCategorieMYSQL($nouvelle_categorie,$lang);
	}
	
	function updateCategorie($ma_categorie, $key,$table){
		$req = new CompBDD();
		$req->updateCategorieMYSQL($ma_categorie, $key,$table);
	}
	
	function insertionArticleBlog($titre, $texte,$id_cat,$heure,$lang){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertionArticleBlogMYSQL($titre, $texte,$id_cat,$heure,$lang);
	}
	
	function insertLivreDor($message,$pseudo,$confirmation,$heure){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$req->insertLivreDorMYSQL($message,$pseudo,$confirmation,$heure);
	}
	
	function getCommentairesLivreDorADMIN($premierAnnoncesAafficher, $nombreAnnoncesParPage,$accepter_message,$url){
		$req = new CompBDD();
		echo '<ul style="margin-top:5px;">';
		$mysql = $req->getCommentairesLivreDorADMINMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage,$accepter_message);
		
		while($sql = $mysql->fetch_object()){
			if($accepter_message){
				$url_valider = "";
			}
			else{
				$url_valider = " | <a href=\"".$url."&action=commentaire-en-attente&id_livre_dor=".$sql->id_livre_dor."\" style=\"font-size:10px;color:green;\">[valider]</a>";
			}
			
			echo "<li style=\"border-top:1px solid grey;padding:4px;text-align:justify;\"><span style=\"color: #336699;font-weight:bolder;\">".$sql->pseudo_livre_dor."</span> ".date('d-m-Y H:i:s', $sql->date_livre_dor)." <a href=\"".$url."&action=modifier-commentaire&id_livre_dor=".$sql->id_livre_dor."\" style=\"font-size:10px;\">[modifier]</a> | <a href=\"".$url."&action=supprimer-commentaire&id_livre_dor=".$sql->id_livre_dor."\" style=\"font-size:10px;color:red;\">[supprimer]</a>".$url_valider."<br /><span style=\"text-decoration:underline;\">Commentaire</span>: <em>".$sql->commentaire_livre_dor."</em></li>";
		}
		echo '</ul>';
	}
	
	function listeCompleteTchatPays($langue,$min,$max){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$membre = new EspaceMembre();
		$array = array();
		array_push($array,'<div class="part1"><ul>');
		$result = $req->afficherTousLesPaysMYSQL($langue,$min,$max);
		while ($mysql = $result->fetch_object()){
			array_push($array, '<li><img src="'.HTTP_DRAPEAUX.$mysql->id.'.png" alt="flags"/> <a href="'.HTTP_TCHAT.FILENAME_TCHAT.'?sl='.$mysql->id.'">'.$mysql->pays.' ('.$membre->compterUnElement(TABLE_TCHAT_LISTE_CONNECTES,"id_pays",$mysql->id).')</a></li>');
		}
		array_push($array,'</ul></div>');
		return $array;
	}
	
	function getListesConnectes($pays){
		//Instanciation de la classe requete SQL
		$req = new CompBDD();
		$membre = new EspaceMembre();
		
		if(LANGUAGE == "en"){
			$au = "to";
			$pas_annonce = "No ad !";
		}
		elseif(LANGUAGE == "es"){
			$au = "hasta";
			$pas_annonce = "No anuncio !";
		}
		else{
			$au = "au";
			$pas_annonce = "Sans annonce !";
		}
		
		$requete = "WHERE `id_pays`='".$pays."'";
		$result = $req->getMenuDeroulantMYSQL(TABLE_TCHAT_LISTE_CONNECTES,$requete);
		while ($sql = $result->fetch_object()){
			$online = $membre->getTable(TABLE_ONLINE,"identifiant",$sql->identifiant);
			$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $sql->identifiant);
			$pays = $this->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
			
			if($online->type_annonce == TABLE_LISTING_COUCHSURFING){
				//COUCHSURFING
				$contenu = '<strong>'.ucfirst($this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange)).'</strong><br />' .
						''.$pays.'<br />' .
						''.$identite->ville.'<br />' .
						''.$this->getChamps('date1', $online->type_annonce, 'identifiant', $sql->identifiant).' '.$au.' '.$this->getChamps('date2', $online->type_annonce, 'identifiant', $sql->identifiant).'';
				?>
				<li><a onmouseover="mouseOver(event, '<?php echo $contenu; ?>')" onmouseout="mouseOut()" id="couleurCouch"><?php echo $online->pseudo; ?></a></li>
				<?php
			}
			elseif($online->type_annonce == TABLE_LISTING_ECHANGE_MAISON){
				//ECHANGE DE MAISON
				$contenu = '<strong>'.ucfirst($this->getChamps('element', TABLE_RUBRIQUES_ECHANGE.LANGUAGE, 'id', $identite->type_echange)).'</strong><br />' .
						''.$pays.'<br />' .
						''.$identite->ville.'<br />' .
						''.$this->getChamps('date1', $online->type_annonce, 'identifiant', $sql->identifiant).' '.$au.' '.$this->getChamps('date2', $online->type_annonce, 'identifiant', $sql->identifiant).'';
				?>
				<li><a onmouseover="mouseOver(event, '<?php echo $contenu; ?>')" onmouseout="mouseOut()" id="couleurEchange"><?php echo $online->pseudo; ?></a></li>
				<?php
			}
			else{
				//SANS ANNONCE
				?>
				<li><a onmouseover="mouseOver(event, '<?php echo $pas_annonce; ?>')" onmouseout="mouseOut()" style="font-weight:bolder;color:#00327C;text-transform:uppercase;"><?php echo $online->pseudo; ?></a></li>
				<?php
			}
		}
	}
	
	function afficherExtraitCarnetDeVoyage($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$req = new CompBDD();
		echo '<table id="list_carnet">' .
				'<tr>' .
				'<th>'.TEXTE_1.'</th>' .
				'<th>'.TEXTE_2.'</th>' .
				'<th>'.TEXTE_3.'</th>' .
				'</tr>';
		$mysql = $req->afficherExtraitCarnetDeVoyageMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		while($sql = $mysql->fetch_object()){
			echo '<tr>' .
					'<td class="pseudo">'.$this->getChamps("pseudo",TABLE_INSCRIPTION,"id",$sql->identifiant).'</td>' .
					'<td class="intitule">'.stripslashes($sql->intitule).'</td>' .
					'<td class="lien"><a href="'.HTTP_SERVEUR.'carnet-de-voyage-'.$sql->identifiant.'.php">'.TEXTE_4.'</a></td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="3"><hr /></td>' .
					'</tr>';
		}
		echo '</table>';
	}
	
	function afficherExtraitCarnetDeVoyageAdmin($premierAnnoncesAafficher, $nombreAnnoncesParPage){
		$req = new CompBDD();
		echo '<table id="list_carnet">' .
				'<tr>' .
				'<th>PSEUDO</th>' .
				'<th>ETAT</th>' .
				'<th>INTITULE DU CARNET DE VOYAGE</th>' .
				'<th>VISITER</th>' .
				'<th>MODIFIER</th>' .
				'<th>SUPPRIMER</th>' .
				'</tr>';
		$mysql = $req->afficherExtraitCarnetDeVoyageAdminMYSQL($premierAnnoncesAafficher, $nombreAnnoncesParPage);
		while($sql = $mysql->fetch_object()){
			if($sql->controle == "ok"){
				//En ligne
				$etat = '<span style="color:green;font-weight:bolder;">[en ligne]</span>';
			}
			else{
				$etat = '<span style="color:red;font-weight:bolder;">[en attente]</span>';
			}
			
			echo '<tr>' .
					'<td class="pseudo">'.$this->getChamps("pseudo",TABLE_INSCRIPTION,"id",$sql->identifiant).'</td>' .
					'<td class="etat">'.$etat.'</td>' .
					'<td class="intitule">'.stripslashes($sql->intitule).'</td>' .
					'<td class="lien"><a href="./inc-carnet.php?id_carnet='.$sql->identifiant.'"><img src="'.HTTP_IMAGE.'consulter.png" alt="consulter"/></a></td>' .
					'<td class="lien"><a href="./carnet-modifier.php?id_carnet='.$sql->identifiant.'"><img src="'.HTTP_IMAGE.'modifier.png" alt="modifier"/></a></td>' .
					'<td class="lien"><a href="./carnet-modifier.php?prw=2&id_carnet='.$sql->identifiant.'"><img src="'.HTTP_IMAGE.'supprimer.png" alt="supprimer"/></a></td>' .
					'</tr>' .
					'<tr>' .
					'<td colspan="6"><hr /></td>' .
					'</tr>';
		}
		echo '</table>';
	}
}
?>
