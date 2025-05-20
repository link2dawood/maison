<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/fct-utile.php');
include('../config.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
include('../interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('../interface/applications/classes/class.Metier.php');


require_once('../interface/applications/commun/configuration.php');

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ADMINISTRATION</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_CSS_CALENDRIER; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
	<?php

	?>	
</head>
<body>
<div id="ext_ad">
<!-- DEBUT EXTERIEUR -->
<?php
	if(empty($_SESSION['admin'])){
		//RENVOI ACCUEIL
		echo afficherLoginAdmin();
	}
	else{
		//DEVELOPPEMENT ESPACE MEMBRE
		include('menu.php');
		include('info.php');
		
		echo '<h1>Administration</h1>';
		echo '<h4>[Espace compte]</h4>';
		
		if(empty($_GET['action']) OR $_GET['action'] == "moteur-tri"){
			//RECHERCHE DU LISTING
			$nombreMembresParPage = 8;
			//----------- FONCTION TRIAGE -----------------------
			$maintenant = time();
			$hier = $maintenant - (60*60*24);// 1 jour
			$array_tri_compter = array("",//NULL
										 "",//Ordre alphabétique
										 "WHERE `type_annonce`='".TABLE_LISTING_ECHANGE_MAISON."'",//Que les ECHANGE MAISON
										 "WHERE `type_annonce`='".TABLE_LISTING_COUCHSURFING."'",//Que les COUCHSURFING
										 "WHERE `id` NOT IN (SELECT `identifiant` FROM ".TABLE_ONLINE.")",//OFFLINE
										 "WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_ONLINE.")",//ONLINE
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='1')",//COMPTE GRATUIT
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='0' AND `online`='0' AND `date_fin` < NOW())",//COMPTE PAYANT
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='0' AND `online`='0' AND `date_fin` > NOW())",//COMPTE AVEC ABONNEMENT
										 "WHERE `date_inscription` BETWEEN '".$hier."' AND '".$maintenant."'",//INSCRIPTION DU JOUR
										 "WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_ALBUM_PHOTO."` WHERE (`img1`!='' AND `controle`='1') OR (`img2`!='' AND `controle`='1') OR (`img3`!='' AND `controle`='1') OR (`img4`!='' AND `controle`='1'))",//COMPTE AVEC PHOTO
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_AUDIO." WHERE `fichier`!='')",//COMPTE AVEC AUDIO
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO." WHERE `fichier`!='')",//COMPTE AVEC VIDEO
										 "WHERE `compte_actif`='1'",//COMPTE DESACTIVE
										 "WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_ALBUM_PHOTO."` WHERE (`img1`!='' AND `controle`='0') OR (`img2`!='' AND `controle`='0') OR (`img3`!='' AND `controle`='0') OR (`img4`!='' AND `controle`='0'))",//PHOTO NON PUBLIEE
										 "WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`=''",//ANNONCE EN ATTENTE
										 "WHERE `type_annonce`='' AND `id_annonce`='' AND `en_ligne`=''",//COMPTE SANS ANNONCE
										 "WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_CARNET_DE_VOYAGE." WHERE `controle`='ok')",//CARNET DE VOYAGE EN LIGNE
										 "WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_CARNET_DE_VOYAGE." WHERE `controle`='')",//CARNET DE VOYAGE EN ATTENTE
										 "WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_GALERIE_PHOTOS.")",//CARNET DE VOYAGE AVEC GALERIE PHOTOS
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO.")",//CARNET DE VOYAGE AVEC VIDEO
										 "WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_GALERIE_PHOTOS." WHERE `controle`=0)",//CARNET DE VOYAGE AVEC GALERIE PHOTOS EN ATTENTE
										 "WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO." WHERE `controle`=0)");//CARNET DE VOYAGE AVEC VIDEO EN ATTENTE
			$array_tri = array("",//NULL
								"ORDER BY `pseudo`",//Ordre alphabétique
								"WHERE `type_annonce`='".TABLE_LISTING_ECHANGE_MAISON."' ORDER BY `id` DESC",//Que les ECHANGE MAISON
								"WHERE `type_annonce`='".TABLE_LISTING_COUCHSURFING."' ORDER BY `id` DESC",//Que les COUCHSURFING
								"WHERE `id` NOT IN (SELECT `identifiant` FROM ".TABLE_ONLINE.") ORDER BY `id` DESC",//ONLINE
								"WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_ONLINE.") ORDER BY `id` DESC",//ONLINE
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='1') ORDER BY `id` DESC",//COMPTE GRATUIT
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='0' AND `online`='0' AND `date_fin` < NOW()) ORDER BY `id` DESC",//COMPTE PAYANT
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_PAIEMENTS." WHERE `gratuit`='0' AND `online`='0' AND `date_fin` > NOW()) ORDER BY `id` DESC",//COMPTE AVEC ABONNEMENT
								"WHERE `date_inscription` BETWEEN '".$hier."' AND '".$maintenant."' ORDER BY `id` DESC",//INSCRIPTION DU JOUR
								"WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_ALBUM_PHOTO."` WHERE (`img1`!='' AND `controle`='1') OR (`img2`!='' AND `controle`='1') OR (`img3`!='' AND `controle`='1') OR (`img4`!='' AND `controle`='1')) ORDER BY `id` DESC",//COMPTE AVEC PHOTO
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_AUDIO." WHERE `fichier`!='') ORDER BY `id` DESC",//COMPTE AVEC AUDIO
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO." WHERE `fichier`!='') ORDER BY `id` DESC",//COMPTE AVEC VIDEO
								"WHERE `compte_actif`='1' ORDER BY `id` DESC",//COMPTE DESACTIVE
								"WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`='ok' AND `id` IN (SELECT `identifiant` FROM `".TABLE_ALBUM_PHOTO."` WHERE (`img1`!='' AND `controle`='0') OR (`img2`!='' AND `controle`='0') OR (`img3`!='' AND `controle`='0') OR (`img4`!='' AND `controle`='0')) ORDER BY `id` DESC",//PHOTO NON PUBLIEE
								"WHERE `type_annonce`!='' AND `id_annonce`!='' AND `en_ligne`='' ORDER BY `id` DESC",//ANNONCE EN ATTENTE
								"WHERE `type_annonce`='' AND `id_annonce`='' AND `en_ligne`=''",//COMPTE SANS ANNONCE
								"WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_CARNET_DE_VOYAGE." WHERE `controle`='ok') ORDER BY `id` DESC",//CARNET DE VOYAGE EN LIGNE
								"WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_CARNET_DE_VOYAGE." WHERE `controle`='') ORDER BY `id` DESC",//CARNET DE VOYAGE EN ATTENTE
								"WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_GALERIE_PHOTOS.") ORDER BY `id` DESC",//CARNET DE VOYAGE AVEC GALERIE PHOTOS
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO.") ORDER BY `id` DESC",//CARNET DE VOYAGE AVEC VIDEO
								"WHERE `id` IN (SELECT `identifiant` FROM ".TABLE_GALERIE_PHOTOS." WHERE `controle`=0) ORDER BY `id` DESC",//CARNET DE VOYAGE AVEC GALERIE PHOTOS EN ATTENTE
								"WHERE `pseudo` IN (SELECT `pseudo` FROM ".TABLE_FICHIER_VIDEO." WHERE `controle`=0) ORDER BY `id` DESC");//CARNET DE VOYAGE AVEC VIDEO EN ATTENTE
			if(empty($_GET['tri'])){
				$tri_compter = "";
				$tri = " ORDER BY `id` DESC";
			}
			else{
				$tri_compter = $array_tri_compter[minuscule($_GET['tri'])];
				$tri = $array_tri[minuscule($_GET['tri'])];
			}
			//---------------------------------------------------
			//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
			$TotalMembres = $membre->compterMembres($tri_compter);
						
			// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
			$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
									
			$page = defautPage($_GET['page'] ?? '');
							 
			// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
			$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
										
			$NombreMembresMaxi = $page + 20;
										
			$NombreMembresMini = pageMini($page);
			
			echo '<table id="search_compte">' ."\n".
					'<tr>' ."\n".
						'<td style="width:25%;">' ."\n".
							'<form action="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'" method="get">' ."\n".
								'<table style="width:100%;">' ."\n".
									'<tr>' ."\n".
										'<td>Tri: </td>' ."\n".
										'<td><select name="tri">' .
										'<option value="1" '.selectGestionAdmin(1, minuscule($_GET['tri'] ?? '')).'>Ordre alphabétique</option>' .
										'<option value="2" '.selectGestionAdmin(2, minuscule($_GET['tri'] ?? '')).'>Echange logement</option>' .
										'<option value="3" '.selectGestionAdmin(3, minuscule($_GET['tri'] ?? '')).'>Couchsurfing</option>' .
										'<option value="3" '.selectGestionAdmin(3, minuscule($_GET['tri'] ?? '')).'>Couchsurfing</option>' .
										'<option value="4" '.selectGestionAdmin(4, minuscule($_GET['tri'] ?? '')).'>Offline</option>' .
										'<option value="5" '.selectGestionAdmin(5, minuscule($_GET['tri'] ?? '')).'>Online</option>' .
										'<option value="6" '.selectGestionAdmin(6, minuscule($_GET['tri'] ?? '')).'>Compte gratuit</option>' .
										'<option value="7" '.selectGestionAdmin(7, minuscule($_GET['tri'] ?? '')).'>Compte payant</option>' .
										'<option value="8" '.selectGestionAdmin(8, minuscule($_GET['tri'] ?? '')).'>Compte abonnement</option>' .
										'<option value="9" '.selectGestionAdmin(9, minuscule($_GET['tri'] ?? '')).'>Inscription : '.date("D d", time()).'</option>' .
										'<option value="10" '.selectGestionAdmin(10, minuscule($_GET['tri'] ?? '')).'>Compte avec photo</option>' .
										'<option value="11" '.selectGestionAdmin(11, minuscule($_GET['tri'] ?? '')).'>Compte avec audio</option>' .
										'<option value="12" '.selectGestionAdmin(12, minuscule($_GET['tri'] ?? '')).'>Compte avec vidéo</option>' .
										'<option value="13" '.selectGestionAdmin(13, minuscule($_GET['tri'] ?? '')).'>Compte désactivé</option>' .
										'<option value="14" '.selectGestionAdmin(14, minuscule($_GET['tri'] ?? '')).'>Photo non publiée</option' .
										'<option value="15" '.selectGestionAdmin(15, minuscule($_GET['tri'] ?? '')).'>Annonce en attente</option>' .
										'<option value="16" '.selectGestionAdmin(16, minuscule($_GET['tri'] ?? '')).'>Compte sans annonce</option>' .
										'<option value="17" '.selectGestionAdmin(17, minuscule($_GET['tri'] ?? '')).'>Carnet de voyage (en ligne)</option>' .
										'<option value="18" '.selectGestionAdmin(18, minuscule($_GET['tri'] ?? '')).'>Carnet de voyage (off)</option>' .
										'<option value="19" '.selectGestionAdmin(19, minuscule($_GET['tri'] ?? '')).'>Carnet avec galerie</option>' .
										'<option value="20" '.selectGestionAdmin(20, minuscule($_GET['tri'] ?? '')).'>Carnet avec vidéo</option>' .
										'<option value="21" '.selectGestionAdmin(21, minuscule($_GET['tri'] ?? '')).'>Carnet avec galerie (off)</option>' .
										'<option value="22" '.selectGestionAdmin(22, minuscule($_GET['tri'] ?? '')).'>Carnet avec vidéo (off)</option>' .
										'</select>' .
										' <input type="hidden" name="action" value="moteur-tri"/>' .
										'</td>' ."\n".
										'<td><input type="submit" value="envoyer"/></td>' ."\n".
									'</tr>' ."\n".
								'</table>' ."\n".
							'</form>' ."\n".
						'</td>' ."\n".
						'<td style="width:25%;">' ."\n".
							'<form action="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=moteur-pseudo" method="post">' ."\n".
								'<table style="width:100%;">' ."\n".
									'<tr>' ."\n".
										'<td>Pseudo:</td>' ."\n".
										'<td><input type="text" name="search_pseudo" size="11"/></td>' ."\n".
										'<td><input type="submit" value="envoyer"/></td>' ."\n".
									'</tr>' ."\n".
								'</table>' ."\n".
							'</form>' ."\n".
						'</td>' ."\n".
						'<td style="width:25%;">' ."\n".
							'<form action="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'" method="get">' ."\n".
								'<table style="width:100%;">' ."\n".
									'<tr>' ."\n".
										'<td>N° de page:</td>' ."\n".
										'<td><input type="text" name="page" value="'.defautPage($_GET['page'] ?? '').'" size="11"/> <input type="hidden" name="action" value=""/> <input type="hidden" name="tri" value=""/></td>' ."\n".
										'<td><input type="submit" value="envoyer"/></td>' ."\n".
									'</tr>' ."\n".
								'</table>' ."\n".
							'</form>' ."\n".
						'</td>' ."\n".
						'<td style="width:25%;">' ."\n".
							'<form action="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=moteur-identifiant" method="post">' ."\n".
								'<table style="width:100%;">' ."\n".
									'<tr>' ."\n".
										'<td>Référence:</td>' ."\n".
										'<td><input type="text" name="search_id" size="11"/></td>' ."\n".
										'<td><input type="submit" value="envoyer"/></td>' ."\n".
									'</tr>' ."\n".
								'</table>' ."\n".
							'</form>' ."\n".
						'</td>' ."\n".
					'</tr>' ."\n".
					'</table>'."\n";
			
			echo '<table style="width:100%;margin-bottom:5px;">' ."\n".
					'<tr>' ."\n".
					'<td style="text-align:left;font-weight:bolder;">Total membres : '.$TotalMembres.'</td>' ."\n".
					'<td style="text-align:right;font-weight:bolder;">Page : '.$page.'/'.$nombreDePages.'</td>' ."\n".
					'</tr>' ."\n".
					'</table>'."\n";
			
			echo '<div id="tab_listing_compte">' ."\n".
				'<table style="width:100%;">' ."\n".
				'<tr>' ."\n".
				'<th>REF</th>' ."\n".
				'<th>MINIATURE</th>' ."\n".
				'<th>INFORMATIONS</th>' ."\n".
				'<th>STATUT</th>' ."\n".
				'<th>ACTIF</th>' ."\n".
				'<th>CONSULTER</th>' ."\n".
				'<th>MODIFIER</th>' ."\n".
				'<th>SUPPRIMER</th>' ."\n".
				'</tr>'."\n";
			//**********************************************************************************
			//                      RECUPERATION DU LISTING
			//**********************************************************************************
			if($TotalMembres > 0){
				echo $membre->afficherTousLesMembres($premierMembresAafficher, $nombreMembresParPage, $tri);
			}
			else{
				echo '<tr><td colspan="8" style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">Pas de résultat...</td></tr>';
			}
						
			echo '</table>' .
					'</div>';
								
			echo '<p style="text-align:center;padding-top:7px;"><a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?page='.$NombreMembresMini.'&action=&tri="><img src="'.HTTP_IMAGE.'fleche_droite.png" alt="fleche"/></a>';
			//-----DEFINIR LE NOMBRE DE PAGES--------------------
			if (isset($page)){
				if ($page<=$nombreDePages OR $page == 1){
					$MaxiPagesAffichees = $page + 9;
						for ($a = $page ; $a <= $MaxiPagesAffichees ; $a++)	{
							echo ' <a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?page='.$a.'&action=&tri=">'.$a.'</a> |';
						}
					}
				else{
					echo '<meta http-equiv="refresh" content="0; URL='.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?page='.$nombreDePages.'&action=&tri=">';
				}
			}
			echo '<a href="'.HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?page='.$NombreMembresMaxi.'&action=&tri="><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="fleche"/></a></p>';
		}
		elseif($_GET['action'] == "moteur-pseudo"){
			$controle_id = $membre->getChamps("id", TABLE_INSCRIPTION, "pseudo", minuscule($_POST['search_pseudo']));
			if($controle_id == ""){
				messageErreur("Une erreur s'est produite... assurez-vous que le pseudo soit bien orthographié !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
			}
			else{
				messageErreur("Vous allez être redirigé vers ce membre !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=detail&id_compte='.$controle_id);
			}
		}
		elseif($_GET['action'] == "moteur-identifiant"){
			$controle_pseudo = $membre->getChamps("pseudo", TABLE_INSCRIPTION, "id", minuscule($_POST['search_id']));
			if($controle_pseudo == ""){
				messageErreur("Une erreur s'est produite... assurez-vous que cet identifiant soit correct !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
			}
			else{
				messageErreur("Vous allez être redirigé vers ce membre !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=detail&id_compte='.minuscule($_POST['search_id']));
			}
		}
		elseif($_GET['action'] == "detail"){
			include(INCLUDE_ADMIN_DETAIL_ANNONCE);
		}
		elseif($_GET['action'] == "modifier" OR $_GET['action'] == "modifier-derniers-inscrits"){
			include(FILENAME_ADMIN_FORMULAIRE_COMPTE);
		}
		elseif($_GET['action'] == "confirmer-modification"){
			//Récupérer les infos du membre concerné
			$inscription = $membre->getTable(TABLE_INSCRIPTION,"id",$_POST['id_compte']);
			
			if($inscription->id_annonce){
				$email = minuscule($_POST['email']);
				$statut = minuscule($_POST['statut']);
				$actif = minuscule($_POST['actif']);
				//------------
				$nom = textFormater($_POST['requiredNom']);
				$prenom = textFormater($_POST['requiredPrenom']);
				$adresse = textFormater($_POST['requiredAdresse']);
				$code_postal = textFormater($_POST['requiredCodepostal']);
				$ville = textFormater($_POST['requiredVille']);
				$pays = textFormater($_POST['select_pays']);
				$date1 = textFormater($_POST['requiredDate1']);
				$date2 = textFormater($_POST['requiredDate2']);
				$situation = textFormater($_POST['select_situation']);
				$type = textFormater($_POST['select_type']);
				$niveau = textFormater($_POST['select_niveau']);
				$capacite = textFormater($_POST['select_capacite']);
				$ch_adulte = textFormater($_POST['select_ch_adulte']);
				$ch_enfant = textFormater($_POST['select_ch_enfant']);
				$canape = textFormater($_POST['select_canape']);
				$sdb = textFormater($_POST['select_sdb']);
				$cuisine = textFormater($_POST['select_cuisine']);
				$terrasse = textFormater($_POST['select_terrasse']);
				$barbecue = textFormater($_POST['select_barbecue']);
				$jardin = textFormater($_POST['select_jardin']);
				$piscine = textFormater($_POST['select_piscine']);
				$velo = textFormater($_POST['select_velo']);
				$garage = textFormater($_POST['select_garage']);
				$animaux = textFormater($_POST['select_animaux']);
				$voiture = textFormater($_POST['select_voiture']);
				$handicape = textFormater($_POST['select_handicape']);
				$fumeur = textFormater($_POST['select_fumeur']);
				$commentaire1 = filtrageMessage($_POST['requiredCommentaire1']);
				$commentaire2 = filtrageMessage($_POST['requiredCommentaire2']);
				$date3 = textFormater($_POST['requiredDate3']);
				$date4 = textFormater($_POST['requiredDate4']);
				$destination1 = textFormater($_POST['requiredDestination1']);
				$destination2 = textFormater($_POST['destination2']);
				$destination3 = textFormater($_POST['destination3']);
				$destination4 = textFormater($_POST['destination4']);
				$type_rech_1 = textFormater($_POST['select_type_rech_1']);
				$type_rech_2 = textFormater($_POST['select_type_rech_2']);
				$type_rech_3 = textFormater($_POST['select_type_rech_3']);
				$type_rech_4 = textFormater($_POST['select_type_rech_4']);
				$capac_rech = textFormater($_POST['select_capac_rech']);
				$fumeur_rech = textFormater($_POST['select_fumeur_rech']);
				$velo_rech = textFormater($_POST['select_velo_rech']);
				$voiture_rech = textFormater($_POST['select_voiture_rech']);
				
				if($_POST['echange']){
					$type_echange = minuscule($_POST['echange']);
				}
				else{
					$type_echange = minuscule($_POST['couchsurfing']);
				}
				
				$syntaxeEmail = conformEmail($email);
				
				if(empty($nom) OR empty($prenom) OR empty($adresse) OR empty($code_postal) OR empty($ville) OR empty($pays) OR empty($date1)
				 OR empty($date2) OR empty($commentaire1) OR empty($commentaire2) OR empty($date3) OR empty($date4) OR empty($destination1)){
					messageErreur("Nous sommes désolés mais vous avez omis de renseigner les champs obligatoires !");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				elseif($syntaxeEmail == 0){
					messageErreur("Attention cet email n'est pas valide!");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				elseif(empty($type_echange) OR $type_echange == 0){
					messageErreur("Attention vous avez omis de renseigner le type d'échange !");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				elseif($pays == "0"){
					messageErreur("Attention le pays n'a pas été sélectionné !");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				else{
					//UPDATE IDENTITE
					$metier->updateIdentite($nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange,$inscription->id);
					//UPDATE ANNONCE
					$membre->updateAnnonce($inscription->type_annonce,$inscription->id,$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech);
					// --------------------- UPDATE TABLE INSCRIPTION -----------------------
					$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "ok", "id", $inscription->id);
					// --------------------- UPDATE TABLE MEMBRES ONLINE -----------------------
					$membre->updateElement(TABLE_ONLINE, "en_ligne", "ok", "identifiant", $inscription->id);
					//----------------- ACCEPTER ALBUM PHOTOS -----------------------------
					if($statut == "ok"){
						$membre->updateElement(TABLE_ALBUM_PHOTO, "controle", 1, "identifiant", $inscription->id);
					}
					else{
						$membre->updateElement(TABLE_ALBUM_PHOTO, "controle", 0, "identifiant", $inscription->id);
					}
					if($actif == "ok"){
						$membre->updateElement(TABLE_INSCRIPTION, "compte_actif", 0, "id", $inscription->id);
					}
					else{
						$membre->updateElement(TABLE_INSCRIPTION, "compte_actif", 1, "id", $inscription->id);
					}
					//SUPPRESSION DU COMPTE EN ATTENTE DES DERNIERS INSCRITS
					$membre->supprimerUnElement(TABLE_NOUVEAUX_INSCRITS, "identifiant", $_POST['id_compte']);
					//MESSAGE
					messageErreur("Modification effectuée !");
					redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
				}
			}
			else{
				//SANS ANNONCE
				$email = minuscule($_POST['email']);
				$actif = minuscule($_POST['actif']);
				
				$syntaxeEmail = conformEmail($email);
				
				if(empty($email) OR empty($actif)){
					messageErreur("Nous sommes désolés mais vous avez omis de renseigner les champs obligatoires !");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				elseif($syntaxeEmail == 0){
					messageErreur("Attention cet email n'est pas valide!");
					if($_GET['type'] == "derniers-inscrits"){
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier-derniers-inscrits&id_compte='.$_POST['id_compte']);
					}
					else{
						redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_POST['id_compte']);
					}
				}
				else{
					//MAJ EMAIL
					$membre->updateElement(TABLE_INSCRIPTION, "email", $email, "id", $inscription->id);
					
					if($actif == "ok"){
						$membre->updateElement(TABLE_INSCRIPTION, "compte_actif", 0, "id", $inscription->id);
					}
					else{
						$membre->updateElement(TABLE_INSCRIPTION, "compte_actif", 1, "id", $inscription->id);
					}
					//SUPPRESSION DU COMPTE EN ATTENTE DES DERNIERS INSCRITS
					$membre->supprimerUnElement(TABLE_NOUVEAUX_INSCRITS, "identifiant", $_POST['id_compte']);
					//MESSAGE
					messageErreur("Modification effectuée !");
					redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
				}
			}
		}
		elseif($_GET['action'] == "supprimer"){
			//TRAITEMENT...
			$membre->supprimerCompte($_GET['id_compte']);
		
			if($_GET['type'] == "derniers-inscrits"){
				redirection(0, HTTP_ADMIN.FILENAME_ADMIN_NOUVEAUX_INSCRITS);
			}
			else{
				messageErreur("Félicitation... le compte a été mise à jour avec succès !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
			}
		}
		elseif($_GET['action'] == "supprimer-audio"){
			//TRAITEMENT...
			$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_GET['pseudo']);
			if(!empty($audio_existant)){
				$membre->ajouterFichierFLV($audio_existant, time(), nommageRepertoire($_GET['id_compte']));
				$membre->supprimerUnElement(TABLE_FICHIER_AUDIO, "pseudo", $_GET['pseudo']);
			}
			messageErreur("Félicitation... le fichier AUDIO a été supprimé !");
			redirection('3', HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_GET['id_compte']);
		}
		elseif($_GET['action'] == "supprimer-video"){
			//TRAITEMENT...
			$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_GET['pseudo']);
			if(!empty($video_existant)){
				$membre->ajouterFichierFLV($video_existant, time(), nommageRepertoire($_GET['id_compte']));
				$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $_GET['pseudo']);
			}
			messageErreur("Félicitation... le fichier VIDEO a été supprimé !");
			redirection('3', HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action=modifier&id_compte='.$_GET['id_compte']);
		}
		elseif($_GET['action'] == "paiement"){
			//MAJ DE LA TABLE DES PAIEMENTS
			$membre->updateElement(TABLE_PAIEMENTS, "gratuit", $_GET['action_paiement'], "pseudo", $_GET['pseudo']);
			messageErreur("Félicitation... le compte PAIEMENT a été mis à jour !");
			redirection('3', HTTP_ADMIN.FILENAME_ADMIN_COMPTES.'?action='.$_GET['ref'].'&id_compte='.$_GET['id_compte']);
		}
		else{
			if($_GET['type'] == "derniers-inscrits"){
				redirection(0, HTTP_ADMIN.FILENAME_ADMIN_NOUVEAUX_INSCRITS);
			}
			else{
				redirection(0, HTTP_ADMIN.FILENAME_ADMIN_COMPTES);
			}
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>
