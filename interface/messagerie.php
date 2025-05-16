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
includeLanguage(RACINE, LANGUAGE, FILENAME_MESSAGERIE);
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
	if($_GET['action'] == "ecrire-message-video" OR $_GET['action'] == "message-video"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['action'] == "ecrire-message-audio" OR $_GET['action'] == "message-audio"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'audio/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ON FAIT RIEN...
	}
	?>
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
				//VERIFIER CONNEXION
				if($_GET['acces'] == "on"){
					//MEMBRE ONLINE
					echo H1_ONLINE;
				}
				else{
					//MEMBRE OFFLINE
					echo H1_OFFLINE;
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
							//VERIFIER CONNEXION
							if($_GET['acces'] == "on"){
								//MEMBRE ONLINE
								echo H1_ONLINE;
							}
							else{
								//MEMBRE OFFLINE
								echo H1_OFFLINE;
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
						 		$paiement = activerPaiement($_SESSION['pseudo_client']);
						 		if($paiement == 0){
						 			//AUTORISATION REFUSEE
						 			echo afficherErreur(ACCES_PAGE_REFUSEE);
						 		}
						 		else{
								 	//TRAITEMENT DE LA MESSAGERIE ET MESSENGER
									if($_GET['acces'] == "on"){
										//-----------------------------------------------------------------------------
										//                 MEMBRE ONLINE -> ESPACE MESSENGER
										//-----------------------------------------------------------------------------
										$info_membre_connecte = $metier->getOnlineMembre($_GET['id']);
										
										//VERIFIER SI CE MEMBRE EST PAS BLACKLISTE
										$membre_blackliste = $membre->verifierMembreBlacklister($_GET['id'], $_SESSION['id_client']);
										
										//CAS : MEMBRE BLACKLISTE...
										if($membre_blackliste > 0){
											echo '<p class="message_erreur">'.$membre->getErreur('7').'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_ESPACE_MEMBRE);
										}
										elseif($_GET['m'] == $_SESSION['pseudo_client']){
											echo '<p class="message_erreur">'.MESSAGE_ALERTE_SE_CONTACTER.'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_ESPACE_MEMBRE);
										}
										else{
											if($_GET['action'] == "message-texte"){
												echo formulaireMessengerTexte(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on', 
																			'post', 
																			$info_membre_connecte->pseudo, 
																			grandIconeConnexion($info_membre_connecte->identifiant), 
																			'messenger', 
																			$_GET['action'], 
																			TITRE_MESSAGE_TEXTE, 
																			PHRASE_MESSAGE_TEXTE, 
																			'bt_mess_texte_fr.jpg',
																			$info_membre_connecte->identifiant);
											}
											elseif($_GET['action'] == "message-audio"){
												//MESSAGE AUDIO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
												
												echo formulaireMessengerAudio(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on',
																			'post',
																			$info_membre_connecte->pseudo,
																			grandIconeConnexion($info_membre_connecte->identifiant),
																			'messenger',
																			$_GET['action'],
																			'bt_mess_audio_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre_connecte->identifiant,
																			$chaine);
											}
											elseif($_GET['action'] == "message-video"){
												//MESSAGE VIDEO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
												
												echo formulaireMessengerVideo(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on',
																			'post',
																			$info_membre_connecte->pseudo,
																			grandIconeConnexion($info_membre_connecte->identifiant),
																			'messenger',
																			$_GET['action'],
																			'bt_mess_video_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre_connecte->identifiant,
																			$chaine);
											}
											elseif($_GET['action'] == "ecrire-message-texte"){
												//CAS : MESSAGE TEXTE
											 	?>
											 	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on'; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
											 		<div id="form_messenger">
											 			<div class="col_1">
											 				<table>
												 				<tr>
												 					<td><?php echo PSEUDO_A_CONTACTER; ?></td>
												 					<td><input type="text" name="requiredpseudo_membre" class="input"/></td>
												 				</tr>
												 				<tr>
												 					<td><?php echo LIBELLE_MESSAGE; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
												 					<td><textarea name="requiredCommentaire" rows="24" cols="52"><?php echo COMMENTAIRE_TEXTAREA; ?></textarea></td>
												 				</tr>
												 			</table>
												 		</div>
											 			<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_texte.png" alt="icone"/></div>
											 			<p style="text-align:center;margin-top:27px;clear:left;"><br /><input type="image" src="<?php echo HTTP_IMAGE.'bt_mess_texte_fr.jpg'; ?>" /></p>
											 		</div>
											 	</form>
											 	<?php
												
											}
											elseif($_GET['action'] == "ecrire-message-audio"){
												//ECRIRE MESSAGE AUDIO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
																	
											 	?>
											 	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on'; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
											 		<div id="form_messenger">
											 			<div class="col_1">
											 				<table>
												 				<tr>
												 					<td><?php echo PSEUDO_A_CONTACTER; ?></td>
												 					<td><input type="text" name="requiredpseudo_membre" class="input"/></td>
												 				</tr>
												 				<tr>
												 					<td><?php echo LIBELLE_MESSAGE; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
												 					<td><textarea name="requiredCommentaire" rows="10" cols="52"><?php echo COMMENTAIRE_TEXTAREA; ?></textarea></td>
												 				</tr>
												 			</table>
												 		</div>
											 			<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></div>
											 			<div class="col_3">
											 				<?php echo scriptJsMessageAudio($chaine); ?>
															<br />
															<?php echo scriptFlashMessageAudio($chaine); ?>
											 			</div>
											 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.'bt_mess_audio_fr.jpg'; ?>" /></p>
											 		</div>
											 	</form>
											 	<?php
											}
											elseif($_GET['action'] == "ecrire-message-video"){
												//ECRIRE MESSAGE VIDEO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
												
											 	?>
											 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_MESSAGERIE_2.'?acces=on'; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
											 		<div id="form_messenger">
											 			<div class="col_1">
											 				<table>
												 				<tr>
												 					<td><?php echo PSEUDO_A_CONTACTER; ?></td>
												 					<td><input type="text" name="requiredpseudo_membre" class="input"/></td>
												 				</tr>
												 				<tr>
												 					<td><?php echo LIBELLE_MESSAGE; ?> <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
												 					<td><textarea name="requiredCommentaire" rows="10" cols="52"><?php echo COMMENTAIRE_TEXTAREA; ?></textarea></td>
												 				</tr>
												 			</table>
												 		</div>
											 			<div class="col_2"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></div>
											 			<div class="col_4">
											 				<?php echo scriptJsMessageVideo($chaine); ?>
															<br />
															<?php echo scriptFlashMessageVideo($chaine); ?>
											 			</div>
											 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.'bt_mess_video_fr.jpg'; ?>" /></p>
											 		</div>
											 	</form>
											 	<?php
											}
											else{
												redirection('0', HTTP_ESPACE_MEMBRE);
											}
										}
									}
									else{
										//-----------------------------------------------------------------------------
										//               MEMBRE OFFLINE -> BOITE DE MESSAGERIE
										//-----------------------------------------------------------------------------
										$info_membre = $membre->getInscription($_GET['id']);
										//VERIFIER SI CE MEMBRE EST PAS BLACKLISTE
										$membre_blackliste_messagerie = $membre->verifierMembreBlacklister($_GET['id'], $_SESSION['id_client']);
										
										//CAS : MEMBRE BLACKLISTE...
										if($membre_blackliste_messagerie > 0){
											echo '<p class="message_erreur">'.$membre->getErreur('7').'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_ESPACE_MEMBRE);
										}
										elseif($_GET['m'] == $_SESSION['pseudo_client']){
											echo '<p class="message_erreur">'.MESSAGE_ALERTE_SE_CONTACTER.'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_ESPACE_MEMBRE);
										}
										else{
											if($_GET['action'] == "message-texte"){
												//CAS 1 : MESSAGE TEXTE
												if($_GET['action'] == "message-texte"){
													echo formulaireMessengerTexte(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=off', 
																			'post', 
																			$info_membre->pseudo, 
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)), 
																			'courrier', 
																			$_GET['action'], 
																			TITRE_MESSAGE_TEXTE, 
																			PHRASE_MESSAGE_TEXTE, 
																			'bt_mess_texte_fr.jpg',
																			$info_membre->id);
												}
												else{
													redirection('0', HTTP_ESPACE_MEMBRE);
												}
											}
											elseif($_GET['action'] == "message-audio"){
												//MESSAGE AUDIO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
												echo formulaireMessengerAudio(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=off',
																			'post',
																			$info_membre->pseudo,
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)),
																			'courrier',
																			$_GET['action'],
																			'bt_mess_audio_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre->id,
																			$chaine);
											}
											elseif($_GET['action'] == "message-video"){
												//MESSAGE VIDEO
												creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
											 	$temps = time();
												$fichier_flash = $_SESSION['pseudo_client'].$temps;
												$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
												//-------------------------------------------------------------
												//         CREATION IDENTIFIANT FICHIER MEDIA
												//-------------------------------------------------------------
												$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
												echo formulaireMessengerVideo(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=off',
																			'post',
																			$info_membre->pseudo,
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)),
																			'courrier',
																			$_GET['action'],
																			'bt_mess_video_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre->id,
																			$chaine);
											}
											else{
												redirection('0', HTTP_ESPACE_MEMBRE);
											}
										}
									}
									echo '<p id="alerte_msg_equipe">'.ALERTE_MESSAGE_CONTROLE_EQUIPE.'</p>';
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
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_B); ?></div>
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