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
includeLanguage(RACINE, LANGUAGE, FILENAME_GESTION_MESSAGERIE);

//RECUPERER LES ELEMENTS DU MEMBRE SELECTIONNE
$messenger = $membre->getMessenger($_GET['id']);

//RENSEIGNER LE FICHIER XML/FLASH
if($messenger[12] == "message-video" AND !empty($messenger[9])){
	//Lecture du message VIDEO
	$fichier = 'monFichier='.$messenger[9].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[9];
	$sonRep = nommageRepertoire($messenger[2]);
}
elseif($messenger[12] == "message-audio" AND !empty($messenger[8])){
	//Lecture du message AUDIO
	$fichier = 'monFichier='.$messenger[8].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[8];
	$sonRep = nommageRepertoire($messenger[2]);
}
else{
	//ON FAIT RIEN MESSAGE TEXTE OU DUO...PAS DE CHARGEMENT XML
}
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
			<h1>
				<?php 
				//VERIFIER CONNEXION
				if($_GET['genre'] == "messenger"){
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
								 	//LA DEMANDE EST PAS VALIDE
									if($_GET['id'] == "" OR !is_numeric($_GET['id']) OR $_GET['genre'] == "" OR $_GET['action'] == ""){
										echo redirection('0', HTTP_ESPACE_MEMBRE);
									}
									else{
										//TRAITEMENT 
										if($_GET['genre'] == "messenger"){
											//-------------------------------------------------------------------
											//                           MESSENGER
											//-------------------------------------------------------------------
											//RECUPERER LES ELEMENTS DU MEMBRE SELECTIONNE
											$conversation = $membre->getMessengerParMsgParent($_GET['id']);
											$monDestinataire = $membre->getExpediteurConversation($_SESSION['id_client'], $_GET['id']);
											//PASSER LE MESSAGE EN ETAT = LU
											$membre->updateMessengerLu($_GET['id']);
											
											//RECUPERER LES ELEMENTS DU MEMBRE SELECTIONNE
											$info_membre = $membre->getOnlineEspaceMembre($monDestinataire);
											
											//VERIFIER SI MEMBRE ONLINE
											$exp_connecter = grandIconeConnexion($info_membre->identifiant);
											
											//CAS : LIRE UN MESSAGE TEXTE
											if($_GET['action'] == "lire"){
												if($_GET['s'] == "mt"){
													//MESSAGE TEXTE
														echo '<div id="form_messenger">' ."\n".
															'<table style="width:100%;">' ."\n".
															'<tr>' ."\n".
															'<td class="img_form">'.$exp_connecter.'</td>' ."\n".
															'<td class="text_top_form"><strong>'.$info_membre->pseudo.'</strong></td>' ."\n".
															'<td class="icone_form"><img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/></td>' ."\n".
															'</tr>'."\n" .
															'<tr>'."\n" .
															'<td colspan="3" style="text-align:right;">' .
															'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_BLACKLIST_2.'?action=ajouter" method="post">' .
															'<input type="hidden" name="requiredPseudo" value="'.$info_membre->pseudo.'"/>' .
															'<input type="image" src="'.HTTP_IMAGE.BT_AJOUT_BLACKLIST.'" />' .
															'</form>' .
															'</td>'."\n" .
															'</tr>' ."\n";
															
														foreach($conversation as $cle){
															echo $cle;
														}
															
														echo'<tr>' ."\n".
															'<td style="text-align:center;" colspan="3">' ."\n".
															'<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2.'?acces=on&action=message-texte" method="post" onSubmit="return checkrequired(this)" name="formulaire">' ."\n".
															'<div class="form_messenger">' ."\n".
															'<table>' ."\n".
															'<tr>' ."\n".
															'<td style="color:white;">'.TCHAT_COMMENTAIRE.' <input type="hidden" name="id_pseudo" value="'.$info_membre->identifiant.'" /> <input type="hidden" name="genre" value="'.$_GET['genre'].'" /> <input type="hidden" name="action" value="message-texte" /></td>' ."\n".
															'<td style="text-align:right;"><textarea name="requiredCommentaire" rows="3" cols="65" id="message"></textarea></td>' ."\n".
															'</tr>' ."\n".
															'<tr>' ."\n".
															'<td colspan="2" style="text-align:center;padding-top:5px;"><input type="image" src="'.HTTP_IMAGE.BT_TCHAT_TXT.'" style="margin-right:10px;"/> <a href="'.HTTP_SERVEUR.'interface/'.FILENAME_GESTION_MESSAGERIE.'?genre='.$_GET['genre'].'&id='.$_GET['id'].'&action=supprimer" class="bt_soumission"><img src="'.HTTP_IMAGE.BT_TCHAT_IGNORER.'" alt="'.ATTRIBUT_ALT.'"/></a></td>' ."\n".
															'</tr>' ."\n".
															'</table>' ."\n".
															'</div>' ."\n".
															'</form>' ."\n".
															'</td>' ."\n".
															'</tr>' ."\n".
															'</table>' ."\n".
															'</div>' ."\n";
												}
												elseif($_GET['s'] == "ma"){
													//MESSAGE AUDIO
													?>
													<div id="form_messenger">
														<table>
															<tr>
																<td class="img_form"><?php echo $exp_connecter; ?></td>
																<td class="text_top_form">
																	<strong><?php echo $info_membre->pseudo; ?></strong>
																</td>
																<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></td>
															</tr>
															<tr>
																<td colspan="3" style="text-align:right;">
																	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_BLACKLIST_2; ?>?action=ajouter" method="post">
																		<input type="hidden" name="requiredPseudo" value="<?php echo $info_membre->pseudo; ?>"/>
																		<input type="image" src="<?php echo HTTP_IMAGE.BT_AJOUT_BLACKLIST; ?>" />
																	</form>
																</td>
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
																	<p class="explicatif_audio_tchat"><?php echo MESSAGE_EXPLICATIF_BOUTON_REPONSE; ?></p>
																	<table style="width:100%;">
																		<tr>
																			<td style="text-align:left;">
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-texte&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_TEXTE; ?>" alt="texte"/></a>
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-audio&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_AUDIO; ?>" alt="audio"/></a>
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-video&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_VIDEO; ?>" alt="video"/></a>
																			</td>
																			<td style="text-align:right;">
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_MESSAGERIE.'?genre='.$_GET['genre'].'&id='.$_GET['id'].'&action=supprimer"><img src="'.HTTP_IMAGE.BOUTON_SUPPRIMER_MESSAGE; ?>" alt="echange de maison"/></a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</div>
													<?php
												}
												elseif($_GET['s'] == "mv"){
													//MESSAGE VIDEO
													?>
													<div id="form_messenger">
														<table>
															<tr>
																<td class="img_form"><?php echo $exp_connecter; ?></td>
																<td class="text_top_form">
																	<strong><?php echo $info_membre->pseudo; ?></strong>
																</td>
																<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></td>
															</tr>
															<tr>
																<td colspan="3" style="text-align:right;">
																	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_BLACKLIST_2; ?>?action=ajouter" method="post">
																		<input type="hidden" name="requiredPseudo" value="<?php echo $info_membre->pseudo; ?>"/>
																		<input type="image" src="<?php echo HTTP_IMAGE.BT_AJOUT_BLACKLIST; ?>" />
																	</form>
																</td>
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
																	<p class="explicatif_audio_tchat"><?php echo MESSAGE_EXPLICATIF_BOUTON_REPONSE; ?></p>
																	<table>
																		<tr>
																			<td style="text-align:left;">
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-texte&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_TEXTE; ?>" alt="texte"/></a>
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-audio&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_AUDIO; ?>" alt="audio"/></a>
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE; ?>?acces=on&action=message-video&id=<?php echo $info_membre->identifiant; ?>&m=<?php echo $info_membre->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.BOUTON_REPONSE_VIDEO; ?>" alt="video"/></a>
																			</td>
																			<td style="text-align:right;">
																				<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_MESSAGERIE.'?genre='.$_GET['genre'].'&id='.$_GET['id'].'&action=supprimer"><img src="'.HTTP_IMAGE.BOUTON_SUPPRIMER_MESSAGE; ?>" alt="echange de maison"/></a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</div>
													<?php
												}
												else{
													echo redirection('0', HTTP_ESPACE_MEMBRE);
												}
											}
											//CAS : SUPPRIMER LE MESSAGE
											elseif($_GET['action'] == "supprimer"){
												//SUPPRESSION DU MESSAGE
												$membre->supprimerUnElement(TABLE_MESSENGER, 'msg_parent', $_GET['id']);
												$membre->supprimerUnElement(TABLE_CONVERSATION_ONLINE, 'id', $_GET['id']);
												echo '<p class="message_erreur">'.MESSENGER_SUPPRESSION_MESSAGE.'</p>';
												echo redirection('4', HTTP_ESPACE_MEMBRE);
											}
											//CAS : ERREUR...
											else{
												echo redirection('0', HTTP_ESPACE_MEMBRE);
											}
										}
										else{
											//CAS 3 : ERREUR...
											echo redirection('0', HTTP_ESPACE_MEMBRE);
										}
										echo '<p id="alerte_msg_equipe">'.ALERTE_MESSAGE_CONTROLE_EQUIPE.'</p>';
									}
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