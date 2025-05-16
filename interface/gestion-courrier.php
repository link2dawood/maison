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

$messenger = $membre->getMessagerie($_GET['id']);
$info_membre = $membre->getInscription($messenger[2]);

//DESTINATAIRE
$destinataire = $membre->getInscription($messenger[4]);
//VERIFIER SI MEMBRE ONLINE
$ident_exp = $membre->getChamps("identifiant", TABLE_ONLINE, "pseudo", $info_membre->pseudo);
$exp_connecter = etatConnecter($ident_exp);
$ident_dest = $membre->getChamps("identifiant", TABLE_ONLINE, "pseudo", $destinataire->pseudo);
$dest_connecter = etatConnecter($ident_dest);

//RENSEIGNER LE FICHIER XML/FLASH
if($messenger[12] == "message-video" AND !empty($messenger[9])){
	//Lecture du message VIDEO
	$fichier = 'monFichier='.$messenger[9].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[9];
	$sonRep = nommageRepertoire($messenger[2]);
}
elseif($messenger[12] == "message-audio" AND !empty($messenger[8])){
	//Lecture du message VIDEO
	$fichier = 'monFichier='.$messenger[8].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[8];
	$sonRep = nommageRepertoire($messenger[2]);
}
else{
	//ON FAIT RIEN MESSAGE TEXTE OU DUO...PAS DE CHARGEMENT XML
}

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_COURRIER);
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
	if($messenger[12] == "message-video" OR $_GET['type'] == "message-video"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($messenger[12] == "message-audio" OR $_GET['type'] == "message-audio"){
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
		<div id="module_recherche"><?php include(INCLUDE_MODULE_RECHERCHE); ?></div>
		<!-- BLOC REFERENCE -->
		<div id="contenu">
			<table id="tiers">
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td class="titre_developpement">
						<div class="bord_gauche"></div>
						<div class="corps_top_developpement"><?php echo afficherH2Messagerie($_GET['action'], $_GET['type'], $messenger[12]); ?></div>
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
									//DEVELOPPEMENT DES DIFFERENTES ACTIVITES...
									if($_GET['action'] == "lire"){
									 	//--------------------------------------------------------------
									 	//                       LIRE LE MESSAGE
									 	//--------------------------------------------------------------
									 	//CAS 1 : MESSAGE TEXTE
									 	if($messenger[12] == "message-texte"){
									 		//PASSER LE MESSAGE EN TANT QUE LU
									 		$membre->updateMessagerieParId("lu", "oui", $_GET['id']);
									 		$membre->updateMessagerieParId("type", "vu", $_GET['id']);
									 		
									 		//MESSAGE TEXTE
													echo '<div id="form_messenger">' ."\n".
														'<table>' ."\n".
														'<tr>' ."\n".
														'<td class="img_form">'.grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)).'</td>' ."\n".
														'<td class="text_top_form"><strong>'.$info_membre->pseudo.'</strong></td>' ."\n".
														'<td class="icone_form"><img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/></td>' ."\n".
														'</tr>' ."\n".
														'<tr>' ."\n".
														'<td class="com_txt" colspan="3">'.retrecirMessageTropLong($messenger[7]).'</td>' ."\n".
														'</tr>' ."\n".
														'<tr>' ."\n".
														'<td class="bt_reponse" colspan="3">' .
														'<p class="explicatif_txt">'.MESSAGE_EXPLICATIF_BOUTON_REPONSE.'</p>' .
														'<table style="width:100%;margin-top:10px;">' .
														'<tr>' .
														'<td style="text-align:left;">' .
														'<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$_GET['id'].'&action=repondre&type=message-texte&id_m='.$info_membre->id.'&m='.$info_membre->pseudo.'"><img src="'.HTTP_IMAGE.BOUTON_REPONSE_TEXTE.'" alt="texte"/></a>' .
														'&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$_GET['id'].'&action=repondre&type=message-audio&id_m='.$info_membre->id.'&m='.$info_membre->pseudo.'"><img src="'.HTTP_IMAGE.BOUTON_REPONSE_AUDIO.'" alt="audio"/></a>' .
														'&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?id='.$_GET['id'].'&action=repondre&type=message-video&id_m='.$info_membre->id.'&m='.$info_membre->pseudo.'"><img src="'.HTTP_IMAGE.BOUTON_REPONSE_VIDEO.'" alt="video"/></a>' .
														'</td>' .
														'<td style="text-align:right;">' .
														''.desactiverBoutonTchat($exp_connecter, HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$info_membre->id.'&m='.$info_membre->pseudo).'' .
														'&nbsp;<a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?action=supprimer&id='.$_GET['id'].'"><img src="'.HTTP_IMAGE.BOUTON_SUPPRIMER_MESSAGE.'" alt="texte"/></a>' .
														'</td>' .
														'</tr>' .
														'</table>' .
														'</td>' ."\n".
														'</tr>' ."\n".
														'</table>' ."\n".
														'</div>' ."\n";
									 	}
									 	//CAS 2 : MESSAGE AUDIO
									 	elseif($messenger[12] == "message-audio"){
									 		//PASSER LE MESSAGE EN TANT QUE LU
									 		$membre->updateMessagerieParId("lu", "oui", $_GET['id']);
									 		$membre->updateMessagerieParId("type", "vu", $_GET['id']);
									 		
									 		//MESSAGE AUDIO
											?>
											<div id="form_messenger">
												<table>
													<tr>
														<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)); ?></td>
														<td class="text_top_form">
															<strong><?php echo $info_membre->pseudo; ?></strong>
														</td>
														<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></td>
													</tr>
													<tr>
														<td class="com_txt_lire_audio" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
													</tr>
													<tr>
														<td class="space_lire_audio" colspan="3">
															<?php echo scriptJsLireAudio($fichier); ?>
															<br />
															<?php echo scriptFlashLireAudio($fichier); ?>
														</td>
													</tr>
													<tr>
														<td class="bt_reponse" colspan="3">
															<p class="explicatif_audio"><?php echo MESSAGE_EXPLICATIF_BOUTON_REPONSE; ?></p>
															<table style="width:100%;margin-top:10px;">
																<tr>
																	<td style="text-align:left;">
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-texte&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_TEXTE; ?>" alt="texte"/></a>
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-audio&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_AUDIO; ?>" alt="audio"/></a>
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-video&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_VIDEO; ?>" alt="video"/></a>
																	</td>
																	<td style="text-align:right;">
																		<?php echo desactiverBoutonTchat($exp_connecter, HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$info_membre->id.'&m='.$info_membre->pseudo); ?>
																		&nbsp;<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?action=supprimer&id='.$_GET['id'].'"><img src="'.HTTP_IMAGE.BOUTON_SUPPRIMER_MESSAGE; ?>" alt="texte"/></a>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
											<?php		
									 	}
									 	//CAS 3 : MESSAGE VIDEO
									 	elseif($messenger[12] == "message-video"){
									 		//PASSER LE MESSAGE EN TANT QUE LU
									 		$membre->updateMessagerieParId("lu", "oui", $_GET['id']);
									 		$membre->updateMessagerieParId("type", "vu", $_GET['id']);
									 		
									 		//MESSAGE VIDEO
											?>
											<div id="form_messenger">
												<table>
													<tr>
														<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)); ?></td>
														<td class="text_top_form">
															<strong><?php echo $info_membre->pseudo; ?></strong>
														</td>
														<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></td>
													</tr>
													<tr>
														<td class="com_txt_lire_video" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
													</tr>
													<tr>
														<td class="space_lire_video" colspan="3">
															<?php echo scriptJsLireVideo($fichier); ?>
															<br />
															<?php echo scriptFlashLireVideo($fichier); ?>
														</td>
													</tr>
													<tr>
														<td class="bt_reponse" colspan="3">
															<p class="explicatif_video"><?php echo MESSAGE_EXPLICATIF_BOUTON_REPONSE; ?></p>
															<table style="width:100%;margin-top:10px;">
																<tr>
																	<td style="text-align:left;">
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-texte&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_TEXTE; ?>" alt="texte"/></a>
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-audio&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_AUDIO; ?>" alt="audio"/></a>
																		<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER; ?>?id=<?php echo $_GET['id']; ?>&action=repondre&type=message-video&id_m=<?php echo $info_membre->id; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_VIDEO; ?>" alt="video"/></a>
																	</td>
																	<td style="text-align:right;">
																		<?php echo desactiverBoutonTchat($exp_connecter, HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$info_membre->id.'&m='.$info_membre->pseudo); ?>
																		&nbsp;<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER.'?action=supprimer&id='.$_GET['id'].'"><img src="'.HTTP_IMAGE.BOUTON_SUPPRIMER_MESSAGE; ?>" alt="texte"/></a>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
											<?php
									 	}
									 	//CAS 4 : ERREUR...
									 	else{
									 		redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
									 	}	
									 }
									 elseif($_GET['action'] == "supprimer"){
									 	//--------------------------------------------------------------
									 	//            SUPPRIMER LE MESSAGE DEFINITIVEMENT
									 	//--------------------------------------------------------------
									 	//STOCKER LES FLV POUR PURGE
									 	if(($messenger[12] == "message-video" AND !empty($messenger[9])) OR ($messenger[12] == "message-audio" AND !empty($messenger[8]))){
									 		$membre->ajouterFichierFLV($libelle, time(), $sonRep);
									 	}
										
									 	//SUPPRESSION DU MESSAGE
									 	$membre->supprimerUnElement(TABLE_MESSAGERIE, "id", $_GET['id']);
									 	echo '<p class="message_erreur">'.MESSENGER_SUPPRESSION_MESSAGE_OFF.'</p>';
									 	echo redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
									 }
									 elseif($_GET['action'] == "repondre"){
									 	//--------------------------------------------------------------
									 	//                       REPONDRE AU MESSAGE
									 	//--------------------------------------------------------------
									 	//CAS : MESSAGE TEXTE
									 	if($_GET['type'] == "message-texte"){
									 		echo formulaireMessengerTexte(HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER_2.'?id='.$_GET['id'].'&model=repondre', 
																			'post', 
																			$info_membre->pseudo, 
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)), 
																			'courrier', 
																			$_GET['type'], 
																			MESSENGER_GESTION_REPONDRE_MESSAGE_TEXTE, 
																			PHRASE_MESSAGE_TEXTE, 
																			'bt_mess_texte_fr.jpg',
																			$info_membre->id);
									 	}
									 	//CAS : MESSAGE AUDIO
									 	elseif($_GET['type'] == "message-audio"){
									 		$temps = time();
											$fichier_flash = $_SESSION['pseudo_client'].$temps;
											$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
											echo formulaireMessengerAudio(HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER_2.'?id='.$_GET['id'].'&model=repondre',
																			'post',
																			$info_membre->pseudo,
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)),
																			'courrier',
																			$_GET['type'],
																			'bt_mess_audio_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre->id,
																			$chaine);
											//-------------------------------------------------------------
											//         CREATION IDENTIFIANT FICHIER MEDIA
											//-------------------------------------------------------------
											$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
											
									 	}
									 	//CAS : MESSAGE VIDEO
									 	elseif($_GET['type'] == "message-video"){
									 		$temps = time();
											$fichier_flash = $_SESSION['pseudo_client'].$temps;
											$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
											echo formulaireMessengerVideo(HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER_2.'?id='.$_GET['id'].'&model=repondre',
																			'post',
																			$info_membre->pseudo,
																			grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo)),
																			'courrier',
																			$_GET['type'],
																			'bt_mess_video_fr.jpg',
																			COMMENTAIRE_TEXTAREA,
																			$info_membre->id,
																			$chaine);
											//-------------------------------------------------------------
											//         CREATION IDENTIFIANT FICHIER MEDIA
											//-------------------------------------------------------------
											$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
											
									 	}
									 	//ERREUR...
									 	else{
									 		redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
									 	}
									 	
									 }
									 elseif($_GET['action'] == "messages-envoyes"){
									 	//--------------------------------------------------------------------------
									 	//                    LIRE UN MESSAGE ENVOYE
									 	//--------------------------------------------------------------------------
									 	//CAS 1 : MESSAGE TEXTE
									 	if($messenger[12] == "message-texte"){
									 		
									 		//MESSAGE TEXTE
									 		echo '<div id="form_messenger">' ."\n".
														'<table>' ."\n".
														'<tr>' ."\n".
														'<td class="img_form">'.grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)).'</td>' ."\n".
														'<td class="text_top_form"><strong>'.$destinataire->pseudo.'</strong></td>' ."\n".
														'<td class="icone_form"><img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/></td>' ."\n".
														'</tr>' ."\n".
														'<tr>' ."\n".
														'<td class="com_txt" colspan="3">'.retrecirMessageTropLong($messenger[7]).'</td>' ."\n".
														'</tr>' ."\n".
														'</table>' ."\n".
														'</div>' ."\n";
									 	}
									 	//CAS 2 : MESSAGE AUDIO
									 	elseif($messenger[12] == "message-audio"){
									 		
									 		//MESSAGE AUDIO
									 		?>
									 		<div id="form_messenger">
												<table>
													<tr>
														<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)); ?></td>
														<td class="text_top_form">
															<strong><?php echo $destinataire->pseudo; ?></strong>
														</td>
														<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></td>
													</tr>
													<tr>
														<td class="com_txt_lire_audio" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
													</tr>
													<tr>
														<td class="space_lire_audio" colspan="3">
															<?php echo scriptJsLireAudio($fichier); ?>
															<br />
															<?php echo scriptFlashLireAudio($fichier); ?>
														</td>
													</tr>
												</table>
											</div>
									 		<?php
									 	}
									 	//CAS 3 : MESSAGE VIDEO
									 	elseif($messenger[12] == "message-video"){
									 		
									 		//MESSAGE VIDEO
											?>
											<div id="form_messenger">
												<table>
													<tr>
														<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)); ?></td>
														<td class="text_top_form">
															<strong><?php echo $destinataire->pseudo; ?></strong>
														</td>
														<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></td>
													</tr>
													<tr>
														<td class="com_txt_lire_video" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
													</tr>
													<tr>
														<td class="space_lire_video" colspan="3">
															<?php echo scriptJsLireVideo($fichier); ?>
															<br />
															<?php echo scriptFlashLireVideo($fichier); ?>
														</td>
													</tr>
												</table>
											</div>
											<?php
									 	}
									 	//CAS 4 : ERREUR...
									 	else{
									 		redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
									 	}
									 }
									 else{
									 	//ERREUR...
									 	redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
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