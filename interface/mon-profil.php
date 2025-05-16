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
	if($_GET['action'] == 1){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['action'] == 2){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'audio/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['action'] == 3){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['action'] == 4){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-audio/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ON FAIT RIEN...
	}
	?>	
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
							 $profil = $metier->getOnlineMembre($_SESSION['id_client']);
							 $dateNaissance = dateNaissance($profil[9]);
							 $fichier_audio = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
							 $fichier_video = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
							 
							 if($_GET['action'] == 1){
							 	//FORMULAIRE AJOUT MON MESSAGE VIDEO...
							 	creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
							 	$temps = time();
								$fichier_flash = $_SESSION['pseudo_client'].$temps;
								$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
								
								?>
								 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_MES_FICHIERS; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
								 		<div id="form_messenger">
								 			<div class="col_1">
								 				<table id="ajout_mon_fichier">
									 				<tr>
									 					<td class="titre"><?php echo TITRE_FORMULAIRE_AJOUT_VIDEO; ?></td>
									 				</tr>
									 				<tr>
									 					<td class="message"><?php echo MESSAGE_FORMULAIRE_AJOUT_VIDEO; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
									 				</tr>
									 			</table>
									 		</div>
								 			<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></div>
								 			<div class="flash">
								 				<?php echo scriptJsMessageVideo($chaine); ?>
												<br />
												<?php echo scriptFlashMessageVideo($chaine); ?>
								 			</div>
								 			<br />
								 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BT_SUBMIT_FORMULAIRE; ?>" /></p>
								 		</div>
								 	</form>
								 	<?php
								 	//-------------------------------------------------------------
									//         CREATION IDENTIFIANT FICHIER MEDIA
									//-------------------------------------------------------------
									$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
							 }
							 elseif($_GET['action'] == 2){
							 	//FORMULAIRE AJOUT MON MESSAGE AUDIO...
							 	creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
							 	$temps = time();
								$fichier_flash = $_SESSION['pseudo_client'].$temps;
								$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
								
								?>
								 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_MES_FICHIERS; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
								 		<div id="form_messenger">
								 			<div class="col_1">
								 				<table id="ajout_mon_fichier">
									 				<tr>
									 					<td class="titre"><?php echo TITRE_FORMULAIRE_AJOUT_AUDIO ; ?></td>
									 				</tr>
									 				<tr>
									 					<td class="message"><?php echo MESSAGE_FORMULAIRE_AJOUT_AUDIO; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
									 				</tr>
									 			</table>
									 		</div>
								 			<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></div>
								 			
								 			<div class="flash">
								 				<?php echo scriptJsMessageAudio($chaine); ?>
												<br />
												<?php echo scriptFlashMessageAudio($chaine); ?>
								 			</div>
								 			<br />
								 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BT_SUBMIT_FORMULAIRE; ?>" /></p>
								 		</div>
								 	</form>
								 	<?php
								 	//-------------------------------------------------------------
									//         CREATION IDENTIFIANT FICHIER MEDIA
									//-------------------------------------------------------------
									$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
							 }
							 elseif($_GET['action'] == 3){
							 	//REGARDER MON MESSAGE VIDEO...
							 	$fichier = 'monFichier='.$fichier_video.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
							 	?><div id="form_messenger">
								 	<div class="col_1">
								 		<table id="ajout_mon_fichier">
											<tr>
												<td class="titre"><?php echo TITRE_VISIONNER_VIDEO; ?></td>
											</tr>
											<tr>
												<td class="message"><?php echo MESSAGE_VISIONNER_VIDEO; ?></td>
									 		</tr>
									 	</table>
									 </div>
								 	<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></div>
								 	<div class="flash">
								 		<?php echo scriptJsLireVideo($fichier); ?>
										<br />
										<?php echo scriptFlashLireVideo($fichier); ?>
								 	</div>
								 </div>
							 <?php
							 }
							 elseif($_GET['action'] == 4){
							 	//ECOUTER MON MESSAGE AUDIO...
							 	$fichier = 'monFichier='.$fichier_audio.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
							 	?><div id="form_messenger">
								 	<div class="col_1">
								 		<table id="ajout_mon_fichier">
											<tr>
												<td class="titre"><?php echo TITRE_ECOUTER_AUDIO; ?></td>
											</tr>
											<tr>
												<td class="message"><?php echo MESSAGE_ECOUTER_AUDIO; ?></td>
									 		</tr>
									 	</table>
									 </div>
								 	<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></div>
								 	<div class="flash">
								 		<?php echo scriptJsLireAudio($fichier); ?>
										<br />
										<?php echo scriptFlashLireAudio($fichier); ?>
								 	</div>
								 </div>
							 <?php
							 }
							 elseif($_GET['action'] == 5){
							 	//ENREGISTRER MA PHOTO...
							 	?>
								 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_MES_FICHIERS; ?>" method="post" enctype="multipart/form-data">
								 		<div id="form_messenger">
								 			<div class="col_1">
								 				<table id="ajout_mon_fichier">
									 				<tr>
									 					<td class="titre"><?php echo TITRE_FORMULAIRE_AJOUT_PHOTO ; ?></td>
									 				</tr>
									 				<tr>
									 					<td class="message"><?php echo MESSAGE_FORMULAIRE_AJOUT_PHOTO; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
									 				</tr>
									 			</table>
									 		</div>
								 			<div class="col_2"><?php echo afficherMiniature($profil[0], $profil[1], $profil[10], $profil[11]); ?></div>
								 			
								 			<div class="charger_img">
								 				<ul>
								 					<li><?php echo LIBELLE_PHOTO; ?> <input type="file" name="photo"/></li>
								 					<li><em><?php echo FORMATS_PHOTO; ?></em></li>
								 				</ul>
								 			</div>
								 			
								 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BT_SUBMIT_FORMULAIRE; ?>" /></p>
								 		</div>
								 	</form>
								 	<?php
							 }
							 else{
							 	//PAGE MON PROFIL SANS OPTION ACTIVEE...
							 	?>
							 	<table style="width:100%;">
							 		<tr>
							 			<td class="part1">
							 				<!-- PARTIE PROFIL -->
							 				<table class="left">
							 					<tr>
							 						<td class="libelle"><?php echo MON_PSEUDO; ?></td>
							 						<td class="donnee"><?php echo strtoupper($profil[1]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo DATE_INSCRIPTION; ?></td>
							 						<td class="donnee"><?php echo date("d/m/Y", $profil[12]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo JE_SUIS; ?></td>
							 						<td class="donnee"><?php echo $metier->getChampsLangue('genre', TABLE_OPTIONS, 'nature', $profil[4]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo JE_RECHERCHE; ?></td>
							 						<td class="donnee"><?php echo $metier->getChampsLangue('genre', TABLE_OPTIONS, 'nature', $profil[5]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_DEPARTEMENT; ?></td>
							 						<td class="donnee"><?php echo $metier->getChamps('nomdept', 'departement_'.LANGUAGE, 'numdept', $profil[8]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_PAYS; ?></td>
							 						<td class="donnee"><?php echo $metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $profil[7]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MA_DATE_DE_NAISSANCE; ?></td>
							 						<td class="donnee"><?php echo formaterChiffre($dateNaissance[0]).'/'.formaterChiffre($dateNaissance[1]).'/'.$dateNaissance[2]; ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_EMAIL; ?></td>
							 						<td class="donnee"><?php echo $profil[6]; ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_COMMENTAIRE; ?></td>
							 						<td><p class="commentaire"><?php echo $profil[13]; ?></p></td>
							 					</tr>
							 				</table>
							 			</td>
							 			<td class="part2">
							 				<!-- PARTIE MULTIMEDIA -->
							 				<div class="col_libelle">
							 					<ul>
							 						<li id="lib_1"><?php echo MA_PHOTO; ?></li>
							 						<li id="lib_2"><?php echo MON_MESSAGE_VIDEO; ?></li>
							 						<li id="lib_3"><?php echo MON_MESSAGE_AUDIO; ?></li>
							 					</ul>
							 				</div>
							 				<div class="col_info">
							 					<ul>
							 						<li id="lib_1">
							 							<table style="width:100%;">
							 								<tr>
							 									<td style="height:100px;width:100px;"><?php echo afficherMiniature($profil[0], $profil[1], $profil[10], $profil[11]); ?></td>
							 									<td>
							 										<?php
							 										if(empty($profil[10]) OR empty($profil[11])){
							 											//pas de photo dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_AGRANDIR.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											?>
							 											<a href="<?php echo HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($profil[0]).$profil[1].'.'.$profil[10];?>" rel="lightbox" style="font-size:10px;"><img src="<?php echo HTTP_IMAGE.BT_AGRANDIR; ?>" alt="rencontre" class="img_1"/></a>
							 											<?php
							 										}
							 										?>
							 										<br />
							 										<a href="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_PROFIL_MEMBRE; ?>?action=5"><img src="<?php echo HTTP_IMAGE.BT_ENREGISTRER_REMPLACER; ?>" alt="rencontre" class="img_2"/></a>
							 									</td>
							 								</tr>
							 							</table>
							 						</li>
							 						<li id="lib_2">
							 							<table style="width:100%;">
							 								<tr>
							 									<td><img src="<?php echo HTTP_IMAGE; ?>message_webcam_b.png" alt="rencontre"/></td>
							 									<td>
							 										<?php
							 										if(empty($fichier_video)){
							 											//pas de fichier dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_VOIR.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											//fichier OK
							 											echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE.'?action=3"><img src="'.HTTP_IMAGE.BT_VOIR.'" alt="rencontre" class="img_1"/></a>';
							 										}
							 										?>
							 										<br />
							 										<a href="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_PROFIL_MEMBRE; ?>?action=1"><img src="<?php echo HTTP_IMAGE.BT_ENREGISTRER_REMPLACER; ?>" alt="rencontre" class="img_2"/></a>
							 									</td>
							 								</tr>
							 							</table>
							 						</li>
							 						<li id="lib_3">
							 							<table style="width:100%;">
							 								<tr>
							 									<td><img src="<?php echo HTTP_IMAGE; ?>message_audio_b.png" alt="rencontre"/></td>
							 									<td>
							 										<?php
							 										if(empty($fichier_audio)){
							 											//pas de fichier dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_ECOUTER.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											//fichier OK
							 											echo '<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_PROFIL_MEMBRE.'?action=4"><img src="'.HTTP_IMAGE.BT_ECOUTER.'" alt="rencontre" class="img_1"/></a>';
							 										}
							 										?>
							 										<br />
							 										<a href="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_PROFIL_MEMBRE; ?>?action=2"><img src="<?php echo HTTP_IMAGE.BT_ENREGISTRER_REMPLACER; ?>" alt="rencontre" class="img_2"/></a>
							 									</td>
							 								</tr>
							 							</table>
							 						</li>
							 					</ul>
							 				</div>
							 			</td>
							 		</tr>
							 		<tr>
							 			<td colspan="2">
							 				<!-- PARTIE MESSAGE -->
							 				<p id="nota"><?php echo MESSAGE_NOTA; ?></p>
							 			</td>
							 		</tr>
							 		<tr>
							 			<td colspan="2" style="text-align:center;">
							 				<!-- PARTIE BARRE -->
							 				<div class="bord_gauche"></div>
											<div class="corps_barre"><?php echo SOUS_TITRE; ?></div>
											<div class="bord_droit"></div>
											<div style="clear:left;"> </div>
							 			</td>
							 		</tr>
							 		<tr>
							 			<td colspan="2">
							 				<!-- PARTIE DEUXIEME PARTIE -->
							 				<div class="avertissement">
							 					<ul>
							 						<li class="titre"><?php echo AVERTISSEMENT; ?></li>
							 						<li class="txt"><?php echo TEXT_AVERTISSEMENT; ?></li>
							 						<li class="txt_1"><?php echo TEXT_AVERTISSEMENT_1; ?></li>
							 						<li class="txt_1"><?php echo TEXT_AVERTISSEMENT_2; ?></li>
							 						<li class="txt_1"><?php echo TEXT_AVERTISSEMENT_3; ?></li>
							 						<li class="bt_acces"><a href="<?php echo HTTP_INTERFACE.FILENAME_PROFIL_MODIFIER; ?>"><img src="<?php echo HTTP_IMAGE.BT_MODIFIER_PROFIL; ?>" alt="rencontre"/></a></li>
							 					</ul>
							 				</div>
							 			</td>
							 		</tr>
							 	</table>
							 	<?php
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
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.'"><img src="'.HTTP_IMAGE.'bt_inscription.jpg" alt="rencontre"/></a></div>';
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