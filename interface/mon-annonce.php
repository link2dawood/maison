<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_DEPOT_ANNONCE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE_MODIFIER; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION_MODIFIER; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_CSS_CALENDRIER; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
</head>
<body>
<!-- DEBUT EXTERIEUR -->
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
			<h1>
			<?php
				if($_GET['tpe'] == "echange"){
					echo H1_DE_LA_PAGE_2_MODIFIER;
				}
				elseif($_GET['tpe'] == "couchsurfing"){
					echo H1_DE_LA_PAGE_3_MODIFIER;
				}
				else{
					echo H1_DE_LA_PAGE_1_MODIFIER;
				}
			?>
			</h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		<!-- RECHERCHE PAR CONNEXION -->
		<div id="module_recherche"><?php include(INCLUDE_MODULE_RECHERCHE); ?></div>
		<!-- BLOC REFERENCE -->
		<div id="contenu">
			<table id="tiers">
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td class="titre_developpement">
						<div class="bord_gauche"></div>
						<div class="corps_top_developpement">
						<?php
							if($_GET['tpe'] == "echange"){
								echo H1_DE_LA_PAGE_2_MODIFIER;
							}
							elseif($_GET['tpe'] == "couchsurfing"){
								echo H1_DE_LA_PAGE_3_MODIFIER;
							}
							else{
								echo H1_DE_LA_PAGE_1_MODIFIER;
							}
						?>
						</div>
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
						 	<?php
						 	if(empty($_SESSION['pseudo_client'])){
						 		include(INCLUDE_LOGIN);
						 	}
						 	else{
						 		if($_GET['tpe'] == "echange" OR $_GET['tpe'] == "couchsurfing"){
									if($_GET['action'] == "md"){
										//Formulaire dépot annonce
										include(INCLUDE_FORMULAIRE_DEPOT_ANNONCE);
									}
									elseif($_GET['action'] == "sm"){
										//SUPPRESSION ANNONCE EN COURS...
										if($_GET['tpe'] == "echange"){
											$table_annonce = TABLE_LISTING_ECHANGE_MAISON;
										}
										elseif($_GET['tpe'] == "couchsurfing"){
											$table_annonce = TABLE_LISTING_COUCHSURFING;
										}
										else{
											$table_annonce = "";
										}
										//Suppression IDENTITE
										$metier->deleteUnElement(TABLE_IDENTITE, "identifiant", $_SESSION['id_client']);
										//Suppression ANNONCE
										$metier->deleteUnElement($table_annonce, "identifiant", $_SESSION['id_client']);
										//Suppression nouveaux inscrits
										$membre->supprimerUnElement(TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
										// --------------------- UPDATE TABLE INSCRIPTION -----------------------
										$membre->updateElement(TABLE_INSCRIPTION, "id_annonce", "", "id", $_SESSION['id_client']);
										$membre->updateElement(TABLE_INSCRIPTION, "type_annonce", "", "id", $_SESSION['id_client']);
										$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
										// --------------------- UPDATE TABLE MEMBRES ONLINE -----------------------
										$membre->updateElement(TABLE_ONLINE, "id_annonce", "", "identifiant", $_SESSION['id_client']);
										$membre->updateElement(TABLE_ONLINE, "type_annonce", "", "identifiant", $_SESSION['id_client']);
										$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
										//------------------Album photos -------------------------
										$image_existante1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
										$image_existante2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
										$image_existante3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
										$image_existante4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
										if(empty($image_existante1) AND empty($image_existante2) AND empty($image_existante3) AND empty($image_existante4)){
											//RAS, on ne fait rien...
										}
										else{
											if($image_existante1){
												supprimerImage($_SESSION['id_client'],libelleImage($_SESSION['pseudo_client'],1),$image_existante1);
											}
											if($image_existante2){
												supprimerImage($_SESSION['id_client'],libelleImage($_SESSION['pseudo_client'],2),$image_existante2);
											}
											if($image_existante3){
												supprimerImage($_SESSION['id_client'],libelleImage($_SESSION['pseudo_client'],3),$image_existante3);
											}
											if($image_existante4){
												supprimerImage($_SESSION['id_client'],libelleImage($_SESSION['pseudo_client'],4),$image_existante4);
											}
											$membre->supprimerUnElement(TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
										}
										//----------------- SUPPRIMER VIDEO -----------------------------
										$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
										if(empty($video_existant)){
											//PAS DE FICHIER DEJA CONNU... RAS
										}
										else{
											//SUPPRESSION ANCIEN FICHIER VIDEO...
											$membre->ajouterFichierFLV($video_existant, time(), nommageRepertoire($_SESSION['id_client']));
											$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
										}
										//----------------- SUPPRIMER AUDIO -----------------------------
										$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
										if(empty($audio_existant)){
											//PAS DE FICHIER DEJA CONNU... RAS
										}
										else{
											//SUPPRESSION ANCIEN FICHIER VIDEO...
											$membre->ajouterFichierFLV($audio_existant, time(), nommageRepertoire($_SESSION['id_client']));
											$membre->supprimerUnElement(TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
										}
										//MESSAGE
										messageErreur(TEXTE_70);
										redirection(3, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
									}
									else{
										redirection(0, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
									}
								}
								else{
									redirection(0, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
								}
						 	}
						 	?>
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
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION.'"><img src="'.HTTP_IMAGE.'bt_inscription.jpg" alt="'.ATTRIBUT_ALT.'"/></a></div>';
								}
								else{
									//DEVELOPPEMENT DU TCHAT
									include(INCLUDE_MESSENGER);
								}
								?> 
							</div>
							<!-- PUBLICITE -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_PUBLICITAIRE; ?></div>
							<div class="bord_d"></div>
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_D); ?></div>
							<!-- NOS CONSEILS & QUESTIONS -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_CONSEILS; ?></div>
							<div class="bord_d"></div>
							<div class="mesConseils">
								<p class="text1"><?php echo CONSEILS_TEXT_1; ?></p>
								<p class="text2"><?php echo CONSEILS_TEXT_2; ?></p>
								<p class="text3"><?php echo CONSEILS_TEXT_3; ?></p>
							</div>
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
<!-- FIN EXTERIEUR -->
</body>
</html>