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
includeLanguage(RACINE, LANGUAGE, FILENAME_PROFIL_MEMBRE);
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
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>

</head>
<body>
<!-- DEBUT EXTERIEUR -->
<?php
	if(empty($_SESSION['pseudo_client'])){
		//RENVOI ACCUEIL
		echo redirection('0', HTTP_SERVEUR);
	}
	else{
		//DEVELOPPEMENT ESPACE MEMBRE
		?>
<div id="exterieur">
	<div id="grey_back">
		<!-- PARTIE ENTETE -->
		<div id="entete">
			<div id="logo">
				<ul>
					<li><a href="<?php echo HTTP_SERVEUR; ?>"><?php echo LOGO; ?></a></li>
					<li><?php echo PHRASE_LOGO; ?></li>
				</ul>
			</div>
			<?php echo afficherLogin($_SESSION['pseudo_client'], HTTP_SERVEUR); ?>
			<h1><?php echo H1; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		<!-- RECHERCHE PAR CONNEXION -->
		<div id="module_recherche"><?php include(INCLUDE_MODULE_RECHERCHE_CONNEXION); ?></div>
		<!-- BLOC REFERENCE -->
		<div id="contenu">
			<table id="tiers">
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td class="titre_developpement">
						<div class="bord_gauche"></div>
						<div class="corps_top_developpement"><?php echo TITRE_PROFIL; ?></div>
						<div class="bord_droit"></div>
					</td>
					<!-- PARTIE TCHAT -->
					<td class="titre_tchat">
						<div class="bord_gauche"></div>
						<div class="corps_top_tchat">
						<?php
						if(empty($_SESSION['pseudo_client'])){
							//ON NE FAIT RIEN...
						}
						else{
							$msg_envoyes = $membre->compterMessagesDuMembreCommeExpediteur(TABLE_MESSENGER, $_SESSION['id_client'], $_SESSION['pseudo_client'], "non");
							$recus = $membre->compterMessagesDuMembreCommeDestinataire(TABLE_MESSENGER, $_SESSION['id_client'], $_SESSION['pseudo_client'], "non");
						}
						echo afficherCompteurMessages($_SESSION['pseudo_client'], $recus, $msg_envoyes);
						?></div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
							 <div id="tab_profil">
							 <?php
							 
							 if($_POST['action'] == 1){
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
									afficherAlerte(FORMULAIRE_VIDEO_OK);
								}
								else{
									//ERREUR....
									afficherAlerte(FORMULAIRE_VIDEO_ERREUR);
								}
								//SUPPRIMER IDENTIFIANT COURANT TABLE MEDIA
								$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
								//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS POUR CONTROLE SUR MODIFICATION
								$modif_existante = $membre->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
								if(empty($modif_existante) AND !empty($_SESSION['id_client'])){
									$metier->insertNouvelleInscription($_SESSION['id_client'], time());
								}
								redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE);
							 }
							 elseif($_POST['action'] == 2){
							 	//FORMULAIRE AJOUT MON MESSAGE AUDIO...
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
									afficherAlerte(FORMULAIRE_AUDIO_OK);
								}
								else{
									//ERREUR....
									afficherAlerte(FORMULAIRE_AUDIO_ERREUR);
								}
								//SUPPRIMER IDENTIFIANT COURANT TABLE MEDIA
								$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
								//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS POUR CONTROLE SUR MODIFICATION
								$modif_existante = $membre->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
								if(empty($modif_existante) AND !empty($_SESSION['id_client'])){
									$metier->insertNouvelleInscription($_SESSION['id_client'], time());
								}
								redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE);
							 	
							 }
							 elseif($_POST['action'] == 5){
							 	//MA PHOTO...
							 	if(empty($_FILES['photo']['name'])){
							 		redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE);
							 	}
							 	else{
							 		$photo_size = $_FILES['photo']['size'];
									$photo_name = $_FILES['photo']['name'];
									$photo_tmp_name = $_FILES['photo']['tmp_name'];
									
									//CREATION STOCKAGE REPERTOIRE PAR ID
									creationRepertoireStockage(nommageRepertoire($_SESSION['id_client']));
									
									$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']), $_SESSION['pseudo_client'], nommageRepertoire($_SESSION['id_client']));
									if(is_numeric($tab_photo)){
										//ON NE FAIT RIEN...
										afficherAlerte(FORMULAIRE_PHOTO_ERREUR);
										redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE);
									}
									else{
										//MISE A JOUR SUR LES TABLES INSCRIPTION ET CONNECTES
										$metier->updatePhotos(TABLE_INSCRIPTION ,$tab_photo, "id", $_SESSION['id_client']);
										$metier->updatePhotos(TABLE_ONLINE ,$tab_photo, "identifiant", $_SESSION['id_client']);
										
										//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS POUR CONTROLE SUR MODIFICATION
										$modif_existante = $membre->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
										if(empty($modif_existante) AND !empty($_SESSION['id_client'])){
											$metier->insertNouvelleInscription($_SESSION['id_client'], time());
										}
										afficherAlerte(FORMULAIRE_PHOTO_OK);
										redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE);
									}	
							 	}
							 }
							 else{
							 	//ERREUR...
							 	redirection('0', HTTP_SERVEUR);
							 }
							 ?>
							 </div>
						 </div>
					</td>
					<!-- PARTIE TCHAT -->
					<td>
						<div class="tchat">
							<!-- TCHAT -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo TOP_TITRE_TCHAT; ?></div>
							<div class="bord_d"></div>
							<div class="monTchat">
								<?php
								if(empty($_SESSION['pseudo_client'])){
									//BOUTON RENVOI INSCRIPTION
									echo '<p class="text_invitation_hors_connexion">'.MESSAGE_INVITATION_INSCRIPTION.'</p>';
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION.'"><img src="'.HTTP_IMAGE.BT_INSCRIPTION_GRATUITE.'" alt="'.ATTRIBUT_ALT.'"/></a></div>';
								}
								else{
									//DEVELOPPEMENT DU TCHAT
									include(INCLUDE_MESSENGER);
								}
								?> 
							</div>
							<!-- ESPACEMENT -->
							<p class="espacement"></p>
							<!-- PUBLICITE -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_PUBLICITAIRE; ?></div>
							<div class="bord_d"></div>
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_D); ?></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div id="derniers_inscrits"><?php include(INCLUDE_DERNIERS_INSCRITS_HORS_CONNEXION); ?></div>
		<?php echo connexionON(); ?>
	</div>
</div>
<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>		
		<?php
	}
?>
<!-- FIN EXTERIEUR -->
</body>
</html>