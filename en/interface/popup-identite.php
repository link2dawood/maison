<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_ESPACE_MEMBRE_INDEX);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
    	<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 28;
// -----------------------------------------------------------------------------
// -->
</script>
	<?php
	if($_GET['atn'] == 9 AND $_GET['action'] == "aj" AND $_POST['crtl'] != 1){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['atn'] == 10 AND $_GET['action'] == "aj" AND $_POST['crtl'] != 1){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'audio/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['atn'] == 9 AND $_GET['action'] == "rg"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['atn'] == 10 AND $_GET['action'] == "ec"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-audio/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ON FAIT RIEN...
	}
	?>
</head>
<body style="background-color:#00327C;" onBeforeUnload="fermerMaPage()">
<div id="popup">
	<?php
	if(empty($_SESSION['pseudo_client']) AND empty($_GET['ad'])){
		//ESPACE RESTREINT....
	}
	else{
		if(!is_numeric($_GET['atn'])){
			//ESPACE RESTREINT...
		}
		else{
			if($_GET['atn'] == 1){
				//Nom et prénom
				if(empty($_POST['requiredNom']) OR empty($_POST['requiredPrenom'])){
					echo '<div class="el">' .
							'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<table>' .
							'<tr>' .
							'<td colspan="2">' .
							'<div class="bord_gauche"></div>' .
							'<div class="corps_top_tchat">'.FORMULAIRE_MODIFIER_IDENTITE.'</div>' .
							'<div class="bord_droit"></div>' .
							'</td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_NOM.'</p></td>' .
							'<td><input type="text" name="requiredNom" value="'.$membre->getChamps("nom",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_PRENOM.'</p></td>' .
							'<td><input type="text" name="requiredPrenom" value="'.$membre->getChamps("prenom",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td colspan="2" style="text-align:center;"><input type="submit" value="'.MON_ANNONCE_VALIDER.'"/></td>' .
							'</tr>' .
							'</table>' .
							'</form>' .
							'</div>';
				}
				else{
					$nom = textFormater($_POST['requiredNom']);
					$prenom = textFormater($_POST['requiredPrenom']);
					//UPDATE
					$membre->updateElement(TABLE_IDENTITE, "nom", $nom, "identifiant", $_SESSION['id_client']);
					$membre->updateElement(TABLE_IDENTITE, "prenom", $prenom, "identifiant", $_SESSION['id_client']);
					//FERMETURE DE LA FENETRE ET RELOAD...
					//-----------------------------------------------------
					$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
					if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
						$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
					}
					$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
					$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
					//-----------------------------------------------------
					echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_SUCCES.'</h3>';
				}
			}
			elseif($_GET['atn'] == 2){
				//Adresse et code postal
				if(empty($_POST['requiredAdresse']) OR empty($_POST['requiredCodePostal'])){
					echo '<div class="el">' .
							'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<table>' .
							'<tr>' .
							'<td colspan="2">' .
							'<div class="bord_gauche"></div>' .
							'<div class="corps_top_tchat">'.FORMULAIRE_MODIFIER_IDENTITE.'</div>' .
							'<div class="bord_droit"></div>' .
							'</td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_ADRESSE.'</p></td>' .
							'<td><input type="text" name="requiredAdresse" value="'.$membre->getChamps("adresse",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_CODE_POSTAL.'</p></td>' .
							'<td><input type="text" name="requiredCodePostal" value="'.$membre->getChamps("code_postal",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td colspan="2" style="text-align:center;"><input type="submit" value="'.MON_ANNONCE_VALIDER.'"/></td>' .
							'</tr>' .
							'</table>' .
							'</form>' .
							'</div>';
				}
				else{
					$adresse = textFormater($_POST['requiredAdresse']);
					$code_postal = textFormater($_POST['requiredCodePostal']);
					//UPDATE
					$membre->updateElement(TABLE_IDENTITE, "adresse", $adresse, "identifiant", $_SESSION['id_client']);
					$membre->updateElement(TABLE_IDENTITE, "code_postal", $code_postal, "identifiant", $_SESSION['id_client']);
					//FERMETURE DE LA FENETRE ET RELOAD...
					echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_SUCCES.'</h3>';
					//-----------------------------------------------------
					$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
					if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
						$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
					}
					$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
					$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
					//-----------------------------------------------------
				}
			}
			elseif($_GET['atn'] == 3){
				//Ville et pays
				if(empty($_POST['requiredVille']) OR empty($_POST['select_pays'])){
					echo '<div class="el">' .
							'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<table>' .
							'<tr>' .
							'<td colspan="2">' .
							'<div class="bord_gauche"></div>' .
							'<div class="corps_top_tchat">'.FORMULAIRE_MODIFIER_IDENTITE.'</div>' .
							'<div class="bord_droit"></div>' .
							'</td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_VILLE.'</p></td>' .
							'<td><input type="text" name="requiredVille" value="'.$membre->getChamps("ville",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_PAYS.'</p></td>' .
							'<td>';
						//AFFICHER LES OPTIONS DE PAYS
						$tab_pays = $metier->getPays('select_pays', LANGUAGE, $membre->getChamps("pays",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']));
						foreach($tab_pays as $cle_pays){
							echo $cle_pays;
						}
						echo '</td>' .
							'</tr>' .
							'<tr>' .
							'<td colspan="2" style="text-align:center;"><input type="submit" value="'.MON_ANNONCE_VALIDER.'"/></td>' .
							'</tr>' .
							'</table>' .
							'</form>' .
							'</div>';
				}
				else{
					$ville = textFormater($_POST['requiredVille']);
					$pays = textFormater($_POST['select_pays']);
					//UPDATE
					$membre->updateElement(TABLE_IDENTITE, "ville", $ville, "identifiant", $_SESSION['id_client']);
					$membre->updateElement(TABLE_IDENTITE, "pays", $pays, "identifiant", $_SESSION['id_client']);
					//FERMETURE DE LA FENETRE ET RELOAD...
					echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_SUCCES.'</h3>';
					//-----------------------------------------------------
					$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
					if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
						$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
					}
					$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
					$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
					//-----------------------------------------------------
				}
			}
			elseif($_GET['atn'] == 4){
				//Email et profession
				if(empty($_POST['requiredEmail'])){
					echo '<div class="el">' .
							'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'&tpe='.$_GET['tpe'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
							'<table>' .
							'<tr>' .
							'<td colspan="2">' .
							'<div class="bord_gauche"></div>' .
							'<div class="corps_top_tchat">'.FORMULAIRE_MODIFIER_IDENTITE.'</div>' .
							'<div class="bord_droit"></div>' .
							'</td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_EMAIL.'</p></td>' .
							'<td><input type="text" name="requiredEmail" value="'.$membre->getChamps("email",TABLE_ONLINE, "identifiant", $_SESSION['id_client']).'" size="32"/></td>' .
							'</tr>' .
							'<tr>' .
							'<td class="libelle"><p>'.IDENTITE_PROFESSION.'</p></td>' .
							'<td>';
						
							//AFFICHER LES OPTIONS DE PAYS
							$selection = $metier->afficherEchange($_GET['tpe'],$membre->getChamps("type_echange",TABLE_IDENTITE, "identifiant", $_SESSION['id_client']));
							foreach($selection as $cle){
								echo $cle;
							}
						
						echo	'</td>' .
							'</tr>' .
							'<tr>' .
							'<td colspan="2" style="text-align:center;"><input type="submit" value="'.MON_ANNONCE_VALIDER.'"/></td>' .
							'</tr>' .
							'</table>' .
							'</form>' .
							'</div>';
				}
				else{
					$email = minuscule($_POST['requiredEmail']);
					if($_POST['echange']){
						$type = minuscule($_POST['echange']);
					}
					else{
						$type = minuscule($_POST['couchsurfing']);
					}
					
					$syntaxeEmail = conformEmail($email);
					if($syntaxeEmail == 0){
						echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_ERREUR_EMAIL.'</h3>';
						redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'&tpe='.$_GET['tpe']);
					}
					elseif(empty($type)){
						echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_ERREUR_TYPE_ECHANGE.'</h3>';
						redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'&tpe='.$_GET['tpe']);
					}
					else{
						//UPDATE
						$membre->updateElement(TABLE_ONLINE, "email", $email, "identifiant", $_SESSION['id_client']);
						$membre->updateElement(TABLE_INSCRIPTION, "email", $email, "id", $_SESSION['id_client']);
						$membre->updateElement(TABLE_IDENTITE, "type_echange", $type, "identifiant", $_SESSION['id_client']);
						//FERMETURE DE LA FENETRE ET RELOAD...
						echo '<h3>'.FORMULAIRE_MODIFIER_IDENTITE_SUCCES.'</h3>';
						//-----------------------------------------------------
						$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
						if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
							$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
						}
						$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
						$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
						//-----------------------------------------------------
					}
				}
			}
			elseif($_GET['atn'] == 5 OR $_GET['atn'] == 6 OR $_GET['atn'] == 7 OR $_GET['atn'] == 8){
				if(is_numeric($_GET['ad'])){
					$image_existante1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);
					$image_existante2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);
					$image_existante3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);
					$image_existante4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);
				}
				else{
					$image_existante1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
					$image_existante2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
					$image_existante3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
					$image_existante4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
				}
				
				//AJOUTER IMAGE 1 
				if($_GET['atn'] == 5){
					if($_GET['action'] == "aj"){
						$titre_image = FORMULAIRE_AJOUTER_IMAGE_1;
					}
					else{
						$titre_image = FORMULAIRE_MODIFIER_IMAGE_1;
					}
				}
				elseif($_GET['atn'] == 6){
					if($_GET['action'] == "aj"){
						$titre_image = FORMULAIRE_AJOUTER_IMAGE_2;
					}
					else{
						$titre_image = FORMULAIRE_MODIFIER_IMAGE_2;
					}
				}
				elseif($_GET['atn'] == 7){
					if($_GET['action'] == "aj"){
						$titre_image = FORMULAIRE_AJOUTER_IMAGE_3;
					}
					else{
						$titre_image = FORMULAIRE_MODIFIER_IMAGE_3;
					}
				}
				else{
					if($_GET['action'] == "aj"){
						$titre_image = FORMULAIRE_AJOUTER_IMAGE_4;
					}
					else{
						$titre_image = FORMULAIRE_MODIFIER_IMAGE_4;
					}
				}
				if($_GET['action'] == "aj"){
					
					if(empty($image_existante1)){
						$num = 1;
					}
					else{
						if(empty($image_existante2)){
							$num = 2;
						}
						else{
							if(empty($image_existante3)){
								$num = 3;
							}
							else{
								$num = 4;
							}
						}
					}
				}
				else{
					if($_GET['atn'] == 5){
						$num = 1;
					}
					elseif($_GET['atn'] == 6){
						$num = 2;
					}
					elseif($_GET['atn'] == 7){
						$num = 3;
					}
					else{
						$num = 4;
					}
				}
				
				if($_GET['action'] == "aj" OR $_GET['action'] == "md"){
					if(empty($_FILES['photo'])){
						echo '<div class="el">' .
								'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn='.$_GET['atn'].'&action='.$_GET['action'].'" method="post" onSubmit="return checkrequired(this)" name="formulaire" enctype="multipart/form-data">' .
								'<table>' .
								'<tr>' .
								'<td colspan="2">' .
								'<div class="bord_gauche"></div>' .
								'<div class="corps_top_tchat">'.$titre_image.'</div>' .
								'<div class="bord_droit"></div>' .
								'</td>' .
								'</tr>' .
								'<tr>' .
								'<td style="text-align:center;"><input type="file" name="photo"/></td>' .
								'</tr>' .
								'<tr>' .
								'<td style="text-align:center;">'.FORMULAIRE_IMAGE_FORMATS_ACCEPTES.'</td>' .
								'</tr>' .
								'<tr>' .
								'<td colspan="2" style="text-align:center;"><input type="submit" value="'.MON_ANNONCE_VALIDER.'"/></td>' .
								'</tr>' .
								'</table>' .
								'</form>' .
								'</div>';
					}
					else{
						$photo_size = $_FILES['photo']['size'];
						$photo_name = $_FILES['photo']['name'];
						$photo_tmp_name = $_FILES['photo']['tmp_name'];
						
						if(empty($photo_name)){
							//ON NE FAIT RIEN...
							echo '<h3>'.FORMULAIRE_ERREUR_IMAGE.'</h3>';
						}
						else{
							//CREATION STOCKAGE REPERTOIRE PAR ID
							creationRepertoireStockage(nommageRepertoire($_SESSION['id_client']));
							
							$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']), libelleImage($_SESSION['pseudo_client'],$num), nommageRepertoire($_SESSION['id_client']));
							
							if(is_numeric($tab_photo)){
								//ON NE FAIT RIEN...
								echo '<h3>'.FORMULAIRE_ERREUR_IMAGE.'</h3>';
							}
							else{
								if($_GET['action'] == "aj"){
									//Contrôle niveau
									if(empty($image_existante1)){
										if(empty($image_existante2) AND empty($image_existante3) AND empty($image_existante4)){
											//Insertion de la photo 1
											$metier->insertPhotos($_SESSION['id_client'] ,$tab_photo);
										}
										else{
											//update de la photo
											$metier->updatePhotos("img1",$tab_photo,"identifiant", $_SESSION['id_client']);
										}
									}
									else{
										//update sur la table correspondante IMAGE 2
										if(empty($image_existante2)){
											//update de la photo
											$metier->updatePhotos("img2",$tab_photo,"identifiant", $_SESSION['id_client']);	
										}
										else{
											//update sur la table correspondante IMAGE 3
											if(empty($image_existante3)){
												//update de la photo
												$metier->updatePhotos("img3",$tab_photo,"identifiant", $_SESSION['id_client']);	
											}
											else{
												//update sur la table correspondante IMAGE 4
												$metier->updatePhotos("img4",$tab_photo,"identifiant", $_SESSION['id_client']);
											}
										}
									}
								}
								else{
									//UPDATE de la photo
									if($_GET['atn'] == 5){
										$metier->updatePhotos("img1",$tab_photo,"identifiant", $_SESSION['id_client']);
									}
									elseif($_GET['atn'] == 6){
										$metier->updatePhotos("img2",$tab_photo,"identifiant", $_SESSION['id_client']);
									}
									elseif($_GET['atn'] == 7){
										$metier->updatePhotos("img3",$tab_photo,"identifiant", $_SESSION['id_client']);
									}
									else{
										$metier->updatePhotos("img4",$tab_photo,"identifiant", $_SESSION['id_client']);
									}
								}
								echo '<h3>'.FORMULAIRE_SUCCES_IMAGE.'</h3>';
								//Renseigner la modification pour contrôle 
								//Définir la table ANNONCE
								if($_GET['tpe'] == "echange"){
									$matable = TABLE_LISTING_ECHANGE_MAISON;
								}
								else{
									$matable = TABLE_LISTING_COUCHSURFING;
								}
								$annonce_existante = $membre->getChamps("date1", $matable, "identifiant", $_SESSION['id_client']);
								if($annonce_existante){
									$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
									if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
										$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
									}
								}
								else{
									//Pas d'annonce actuelle donc en attente de publication sinon.... effacer !
									$membre->updateElement(TABLE_ALBUM_PHOTO, "controle", 1, "identifiant", $_SESSION['id_client']);
								}	
								//-----------------------------------------------------
								$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
								$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
								//-----------------------------------------------------	
							}	
						}
					}
				}
				else{
					//------- SUPPRESSION ANNONCE -------------
					if($_GET['atn'] == 5){
						$mon_image = "img1";
						$numero = 1;
					}
					elseif($_GET['atn'] == 6){
						$mon_image = "img2";
						$numero = 2;
					}
					elseif($_GET['atn'] == 7){
						$mon_image = "img3";
						$numero = 3;
					}
					else{
						$mon_image = "img4";
						$numero = 4;
					}
					if(is_numeric($_GET['ad'])){
						$extension = $membre->getChamps($mon_image, TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);				
					}
					else{
						$extension = $membre->getChamps($mon_image, TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);		
					}
					
					//Mise à jour sur la table des ALBUM PHOTOS
					if($_GET['atn'] == 5 AND empty($image_existante2) AND empty($image_existante3) AND empty($image_existante4)){
						if(is_numeric($_GET['ad'])){
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);				
						}
						else{
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);		
						}
					}
					elseif($_GET['atn'] == 6 AND empty($image_existante1) AND empty($image_existante3) AND empty($image_existante4)){
						if(is_numeric($_GET['ad'])){
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);				
						}
						else{
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);		
						}
					}
					elseif($_GET['atn'] == 7 AND empty($image_existante1) AND empty($image_existante2) AND empty($image_existante4)){
						if(is_numeric($_GET['ad'])){
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);				
						}
						else{
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);		
						}
					}
					elseif($_GET['atn'] == 8 AND empty($image_existante1) AND empty($image_existante2) AND empty($image_existante3)){
						if(is_numeric($_GET['ad'])){
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_GET['ad']);				
						}
						else{
							$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);		
						}
					}
					else{
						if(is_numeric($_GET['ad'])){
							$membre->updateElement(TABLE_ALBUM_PHOTO, $mon_image, "", "identifiant", $_GET['ad']);				
						}
						else{
							$membre->updateElement(TABLE_ALBUM_PHOTO, $mon_image, "", "identifiant", $_SESSION['id_client']);		
						}
					}
					
					if(is_numeric($_GET['ad'])){
						$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
						supprimerImage($_GET['ad'],libelleImage($ps,$numero),$extension);				
					}
					else{
						supprimerImage($_SESSION['id_client'],libelleImage($_SESSION['pseudo_client'],$numero),$extension);		
					}
					echo '<h3>'.FORMULAIRE_SUPRESSION_IMAGE.'</h3>'; 
				}
			}
			elseif($_GET['atn'] == 9){
				//Traitement de la partie VIDEO
				if($_GET['action'] == "aj"){
					//AJOUTER UNE VIDEO
					if($_POST['crtl'] != 1){
						//FORMULAIRE AJOUT MON MESSAGE VIDEO...
						creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
						$temps = time();
						$fichier_flash = $_SESSION['pseudo_client'].$temps;
						$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
								
						?>
						 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_POPUP_IDENTITE; ?>?atn=<?php echo $_GET['atn']; ?>&action=<?php echo $_GET['action']; ?>&tpe=<?php echo $_GET['tpe']; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
						 		<input type="hidden" name="crtl" value="1" />
						 		<div id="multimedia">
						 			<div class="flash">
						 				<?php echo scriptJsMessageVideo($chaine); ?>
										<br />
										<?php echo scriptFlashMessageVideo($chaine); ?>
						 			</div>
						 			<br />
						 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BT_SUBMIT_MULTIMEDIA; ?>" /></p>
						 		</div>
						 	</form>
						<?php
						//-------------------------------------------------------------
						//         CREATION IDENTIFIANT FICHIER MEDIA
						//-------------------------------------------------------------
						$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
					}
					else{
						//FORMULAIRE AJOUT MON MESSAGE VIDEO...
						$media = $membre->getMedia($_SESSION['pseudo_client']);
						$identifiant = $media[1].$media[2];
						$flv_red5 = REPERTOIRE_WEBAPPS_RED5.nommageRepertoire($_SESSION['id_client']).$identifiant.'.flv';
						
						//Vérifier existence du fichier enregistré
						if(file_exists($flv_red5)){
							//OK ENREGISTRE...
							$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
							if(empty($video_existant)){
								//PAS DE FICHIER DEJA CONNU
								$membre->insertNouveauMedia(TABLE_FICHIER_VIDEO, $_SESSION['pseudo_client'], $identifiant);
							}
							else{
								//SUPPRESSION ANCIEN FICHIER VIDEO...
								$membre->ajouterFichierFLV($video_existant, time(), nommageRepertoire($_SESSION['id_client']));
								//UPDATE NOUVEAU
								$membre->updateElement(TABLE_FICHIER_VIDEO, "fichier", $identifiant, "pseudo", $_SESSION['pseudo_client']);
							}
							echo '<h3>'.FORMULAIRE_MULTIMEDIA_VIDEO_OK.'</h3>'; 
						}
						else{
							//ERREUR....
							echo '<h3>'.FORMULAIRE_MULTIMEDIA_VIDEO_ERREUR.'</h3>';
						}
						//SUPPRIMER IDENTIFIANT COURANT TABLE MEDIA
						$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
						//Renseigner la modification pour contrôle 
						//Définir la table ANNONCE
						if($_GET['tpe'] == "echange"){
							$matable = TABLE_LISTING_ECHANGE_MAISON;
						}
						else{
							$matable = TABLE_LISTING_COUCHSURFING;
						}
						$annonce_existante = $membre->getChamps("date1", $matable, "identifiant", $_SESSION['id_client']);
						if($annonce_existante){
							$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
							if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
								$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
							}
							//-----------------------------------------------------
							$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
							$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
							//-----------------------------------------------------
						}
						else{
							//Pas d'annonce actuelle donc en attente de publication sinon.... effacer !
							$membre->updateElement(TABLE_FICHIER_VIDEO, "controle", 1, "pseudo", $_SESSION['pseudo_client']);
						}
					}
				}
				elseif($_GET['action'] == "rg"){
					//REGARDER LA VIDEO
					if(is_numeric($_GET['ad'])){
						$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
						$fichier_video = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $ps);
						$fichier = 'monFichier='.$fichier_video.'&repertoire='.nommageRepertoire($_GET['ad']);				
					}
					else{
						$fichier_video = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
						$fichier = 'monFichier='.$fichier_video.'&repertoire='.nommageRepertoire($_SESSION['id_client']);	
					}
					
					?>
					<div id="multimedia">
						<div class="flash">
							<?php echo scriptJsLireVideo($fichier); ?>
							<br />
							<?php echo scriptFlashLireVideo($fichier); ?>
					 	</div>
				 	</div>
					<?php
				}
				else{
					//SUPPRIMER LA VIDEO
					if(is_numeric($_GET['ad'])){
						$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
						$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $ps);				
					}
					else{
						$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);		
					}
					
					if(empty($video_existant)){
						//PAS DE FICHIER DEJA CONNU... RAS
					}
					else{
						//SUPPRESSION ANCIEN FICHIER VIDEO...
						if(is_numeric($_GET['ad'])){
							$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
							$membre->ajouterFichierFLV($video_existant, time(), nommageRepertoire($_GET['ad']));
							$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $ps);					
						}
						else{
							$membre->ajouterFichierFLV($video_existant, time(), nommageRepertoire($_SESSION['id_client']));
							$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);	
						}
					}
					echo '<h3>'.FORMULAIRE_MULTIMEDIA_SUPPRESSION_FICHIER.'</h3>';
				}
			}
			elseif($_GET['atn'] == 10){
				//Traitement de la partie VIDEO
				if($_GET['action'] == "aj"){
					//AJOUTER UNE VIDEO
					if($_POST['crtl'] != 1){
						//FORMULAIRE AJOUT MON MESSAGE VIDEO...
						creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
						$temps = time();
						$fichier_flash = $_SESSION['pseudo_client'].$temps;
						$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
								
						?>
						 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_POPUP_IDENTITE; ?>?atn=<?php echo $_GET['atn']; ?>&action=<?php echo $_GET['action']; ?>&tpe=<?php echo $_GET['tpe']; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
						 		<input type="hidden" name="crtl" value="1" />
						 		<div id="multimedia">
						 			<div class="flash">
						 				<?php echo scriptJsMessageAudio($chaine); ?>
										<br />
										<?php echo scriptFlashMessageAudio($chaine); ?>
						 			</div>
						 			<br />
						 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BT_SUBMIT_MULTIMEDIA; ?>" /></p>
						 		</div>
						 	</form>
						<?php
						//-------------------------------------------------------------
						//         CREATION IDENTIFIANT FICHIER MEDIA
						//-------------------------------------------------------------
						$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
					}
					else{
						//FORMULAIRE AJOUT MON MESSAGE VIDEO...
						$media = $membre->getMedia($_SESSION['pseudo_client']);
						$identifiant = $media[1].$media[2];
						$flv_red5 = REPERTOIRE_WEBAPPS_RED5.nommageRepertoire($_SESSION['id_client']).$identifiant.'.flv';
						
						//Vérifier existence du fichier enregistré
						if(file_exists($flv_red5)){
							//OK ENREGISTRE...
							$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
							if(empty($audio_existant)){
								//PAS DE FICHIER DEJA CONNU
								$membre->insertNouveauMedia(TABLE_FICHIER_AUDIO, $_SESSION['pseudo_client'], $identifiant);
							}
							else{
								//SUPPRESSION ANCIEN FICHIER VIDEO...
								$membre->ajouterFichierFLV($audio_existant, time(), nommageRepertoire($_SESSION['id_client']));
								//UPDATE NOUVEAU
								$membre->updateElement(TABLE_FICHIER_AUDIO, "fichier", $identifiant, "pseudo", $_SESSION['pseudo_client']);
							}
							echo '<h3>'.FORMULAIRE_MULTIMEDIA_AUDIO_OK.'</h3>'; 
						}
						else{
							//ERREUR....
							echo '<h3>'.FORMULAIRE_MULTIMEDIA_AUDIO_ERREUR.'</h3>';
						}
						//SUPPRIMER IDENTIFIANT COURANT TABLE MEDIA
						$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
						//Renseigner la modification pour contrôle 
						//Définir la table ANNONCE
						if($_GET['tpe'] == "echange"){
							$matable = TABLE_LISTING_ECHANGE_MAISON;
						}
						else{
							$matable = TABLE_LISTING_COUCHSURFING;
						}
						$annonce_existante = $membre->getChamps("date1", $matable, "identifiant", $_SESSION['id_client']);
						if($annonce_existante){
							$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
							if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
								$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
							}
							//-----------------------------------------------------
							$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
							$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
							//-----------------------------------------------------
						}
						else{
							//Pas d'annonce actuelle donc en attente de publication sinon.... effacer !
							$membre->updateElement(TABLE_FICHIER_AUDIO, "controle", 1, "pseudo", $_SESSION['pseudo_client']);
						}
					}
				}
				elseif($_GET['action'] == "ec"){
					//ECOUTER LE FICHIER AUDIO
					if(is_numeric($_GET['ad'])){
						$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
						$fichier_audio = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo",$ps);
						$fichier = 'monFichier='.$fichier_audio.'&repertoire='.nommageRepertoire($_GET['ad']);				
					}
					else{
						$fichier_audio = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
						$fichier = 'monFichier='.$fichier_audio.'&repertoire='.nommageRepertoire($_SESSION['id_client']);		
					}
					
					?>
					<div id="multimedia">
						<div class="flash">
							<?php echo scriptJsLireAudio($fichier); ?>
							<br />
							<?php echo scriptFlashLireAudio($fichier); ?>
					 	</div>
				 	</div>
					<?php
				}
				else{
					//SUPPRIMER LE FICHIER AUDIO
					if(is_numeric($_GET['ad'])){
						$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
						$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $ps);				
					}
					else{
						$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);		
					}
					
					if(empty($audio_existant)){
						//PAS DE FICHIER DEJA CONNU... RAS
					}
					else{
						//SUPPRESSION ANCIEN FICHIER VIDEO...
						if(is_numeric($_GET['ad'])){
							$ps = $membre->getChamps("pseudo",TABLE_INSCRIPTION,"id",$_GET['ad']);
							$membre->ajouterFichierFLV($audio_existant, time(), nommageRepertoire($_GET['ad']));
							$membre->supprimerUnElement(TABLE_FICHIER_AUDIO, "pseudo", $ps);				
						}
						else{
							$membre->ajouterFichierFLV($audio_existant, time(), nommageRepertoire($_SESSION['id_client']));
							$membre->supprimerUnElement(TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);		
						}
					}
					echo '<h3>'.FORMULAIRE_MULTIMEDIA_SUPPRESSION_FICHIER.'</h3>';
				}
			}
			else{
				//ESPACE RESTREINT...
			}
		}
	}
	?>
</div>
</body>
</html>