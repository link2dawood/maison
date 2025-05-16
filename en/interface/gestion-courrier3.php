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

//RECUPERER LES INFOS DU MEMBRE
$info_membre = $membre->getTable(TABLE_INSCRIPTION,"pseudo",minuscule($_POST['requiredpseudo_membre']));

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
						<div class="corps_top_developpement">
						<?php
							if(empty($_GET['action'])){
							 	$titre_h2 = H2_RECEPTION;
							 	$top = BOITE_DE_MESSAGERIE;
							 }
							 elseif($_GET['action'] == "messages-envoyes"){
							 	$titre_h2 = H2_MESSAGES_ENVOYES;
							 	$top = H2_MESSAGES_ENVOYES;
							 }
							 elseif($_GET['action'] == "ecrire-message-texte"){
							 	$titre_h2 = H2_ECRIRE_MESSAGE_TEXTE;
							 }
							 elseif($_GET['action'] == "ecrire-message-audio"){
							 	$titre_h2 = H2_ECRIRE_MESSAGE_AUDIO;
							 }
							 elseif($_GET['action'] == "ecrire-message-video"){
							 	$titre_h2 = H2_ECRIRE_MESSAGE_VIDEO;
							 }
							 else{
							 	$titre_h2 = "";
							 }
							 echo $titre_h2;
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
									if($_POST['requiredpseudo_membre'] == "" OR $_POST['action'] == ""){
										redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
									}
									else{
										//TRAITEMENT 
										//RECUPERER IDENTIFIANT MEDIA
										$media = $membre->getMedia($_SESSION['pseudo_client']);
										$identifiant = $media[1].$media[2];
										$flv_existanr = controleExistanceFLV(REPERTOIRE_WEBAPPS_RED5.nommageRepertoire($_SESSION['id_client']).$identifiant.'.flv');
										
										if(!is_numeric($info_membre->id)){
											//PSEUDO NON TROUVE !!
											echo '<p class="message_erreur">'.$membre->getErreur('9').'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
											//FICHIER AJOUTE DANS TACHE CRON CORBEILLE
											if($identifiant != "" AND $flv_existanr == 1){
												$membre->ajouterFichierFLV($identifiant, time(), nommageRepertoire($_SESSION['id_client']));
												//SUPPRIMER IDENTIFIANT COURANT
												$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
											}
										}
										//EXPEDITEUR DU MESSAGE = MEMBRE => ANNULE DEMANDE MESSAGE
										elseif($info_membre->pseudo == $_SESSION['pseudo_client']){
											echo '<p class="message_erreur">'.MESSAGE_EXPEDITEUR_ANNULE.'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
											//FICHIER AJOUTE DANS TACHE CRON CORBEILLE
											if($identifiant != "" AND $flv_existanr == 1){
												$membre->ajouterFichierFLV($identifiant, time(), nommageRepertoire($_SESSION['id_client']));
												//SUPPRIMER IDENTIFIANT COURANT
												$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
											}
										}
										//Le FLV n'est pas présent sur le serveur FLV
										elseif($flv_existanr == 0 AND $identifiant != ""){
											echo '<p class="message_erreur">'.MESSAGE_FLV_NON_PRESENT_SERVEUR.'</p>';
											redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
											//SUPPRIMER IDENTIFIANT COURANT
											$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
										}
										else{
											//VERIFIER SI CE MEMBRE EST PAS BLACKLISTE
											$membre_blackliste = $membre->verifierMembreBlacklister($info_membre->id, $_SESSION['id_client']);
											//CAS : MEMBRE BLACKLISTE...
											if($membre_blackliste > 0){
												echo '<p class="message_erreur">'.$membre->getErreur('7').'</p>';
												redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
												//FICHIER AJOUTE DANS TACHE CRON CORBEILLE
												if($identifiant != "" AND $flv_existanr == 1){
													$membre->ajouterFichierFLV($identifiant, time(), nommageRepertoire($_SESSION['id_client']));
													//SUPPRIMER IDENTIFIANT COURANT
													$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
												}
											}
											else{
												//OK...ON ENREGISTRE LE MESSAGE SUR LA TABLE...
												if($_POST['action'] == "ecrire-message-texte"){
													//ENREGISTREMENT EN BASE
													$membre->insertionMessagerie($_SESSION['id_client'],//ID EXPEDITEUR
																			$_SESSION['pseudo_client'],// PSEUDO EXPEDITEUR
																			$info_membre->id,//ID DESTINATAIRE
																			$info_membre->pseudo,//PSEUDO DESTINATAIRE
																			time(),// DATE DE CREATION
																			textareaLibre($_POST['requiredCommentaire']),//COMMENTAIRE
																			'',// MESSAGE AUDIO
																			'',// MESSAGE VIDEO
																			'',// SUPPRESSION
																			'non',// ETAT LU OU NON
																			"message-texte");//GENRE DU MESSAGE
													//MESSAGE ACCEPTATION
													echo '<p class="message_erreur">'.MESSAGE_ENVOYE.'</p>';
													redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
												}
												elseif($_POST['action'] == "ecrire-message-audio"){
												 	//ENREGISTREMENT EN BASE MESSAGE AUDIO
													$membre->insertionMessagerie($_SESSION['id_client'],//ID EXPEDITEUR
																			$_SESSION['pseudo_client'],// PSEUDO EXPEDITEUR
																			$info_membre->id,//ID DESTINATAIRE
																			$info_membre->pseudo,//PSEUDO DESTINATAIRE
																			time(),// DATE DE CREATION
																			textareaLibre($_POST['requiredCommentaire']),//COMMENTAIRE
																			$identifiant,// MESSAGE AUDIO
																			'',// MESSAGE VIDEO
																			'',// SUPPRESSION
																			'non',// ETAT LU OU NON
																			"message-audio");//GENRE DU MESSAGE
													//SUPPRIMER IDENTIFIANT COURANT
													$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
													//MESSAGE ACCEPTATION
													echo '<p class="message_erreur">'.MESSAGE_ENVOYE.'</p>';
													redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
												 }
												 elseif($_POST['action'] == "ecrire-message-video"){
												 	//ENREGISTREMENT EN BASE MESSAGE VIDEO
													$membre->insertionMessagerie($_SESSION['id_client'],//ID EXPEDITEUR
																			$_SESSION['pseudo_client'],// PSEUDO EXPEDITEUR
																			$info_membre->id,//ID DESTINATAIRE
																			$info_membre->pseudo,//PSEUDO DESTINATAIRE
																			time(),// DATE DE CREATION
																			textareaLibre($_POST['requiredCommentaire']),//COMMENTAIRE
																			'',// MESSAGE AUDIO
																			$identifiant,// MESSAGE VIDEO
																			'',// SUPPRESSION
																			'non',// ETAT LU OU NON
																			"message-video");//GENRE DU MESSAGE
													//SUPPRIMER IDENTIFIANT COURANT
													$membre->supprimerUnElement(TABLE_CONTROLEUR_MEDIA, "pseudo_membre", $_SESSION['pseudo_client']);
													//MESSAGE ACCEPTATION
													echo '<p class="message_erreur">'.MESSAGE_ENVOYE.'</p>';
													redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
												 }
												 else{
												 	redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
												 }
											}
											//-------------------- ENVOI MAIL DESTINATAIRE -------------------------
											$membre_online = $membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$info_membre->pseudo);
											if($_POST['action'] == "ecrire-message-texte"){
												$type_message = MAIL_OFFLINE_MSG_8;
											}
											elseif($_POST['action'] == "ecrire-message-audio"){
												$type_message = MAIL_OFFLINE_MSG_9;
											}
											elseif($_POST['action'] == "ecrire-message-video"){
												$type_message = MAIL_OFFLINE_MSG_10;
											}
											else{
												$type_message = "";
											}
											
											if($membre_online){
												//On ne fait rien le membre est connecté !
											}
											else{
												$entete = MAIL_OFFLINE_ENTETE;
												$destinataire = $info_membre->email;
												$expediteur = MAIL_CORRESPONDANCE;
												$reponse = MAIL_CORRESPONDANCE;
												
												if($info_membre->type_annonce != "" AND $info_membre->id_annonce != "" AND $info_membre->en_ligne == "ok"){
													$son_profil = ''.MAIL_OFFLINE_MSG_6.' <a href="'.HTTP_SERVEUR.'profil-'.$_SESSION['id_client'].'.php">'.MAIL_OFFLINE_MSG_15.'</a><br />';
												}
												else{
													$son_profil = '';
												}
												
												$codehtml=  '<html>' .
															'<head>' .
															'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
															'</head>' .
															'<body>' .
															''.MAIL_OFFLINE_MSG_H1.'' .
															'<br /><p>' .
															''.MAIL_OFFLINE_MSG_1.' <strong>'.$info_membre->pseudo.'</strong>,<br />' .
															''.MAIL_OFFLINE_MSG_2.' <strong>'.$_SESSION['pseudo_client'].'</strong> '.MAIL_OFFLINE_MSG_3.'<br /><br />' .
															''.MAIL_OFFLINE_MSG_4.' <strong>'.date("d/m/y H:i:s").'</strong><br />' .
															''.MAIL_OFFLINE_MSG_5.' <strong>'.$_SESSION['pseudo_client'].'</strong><br />' .
															''.$son_profil.'' .
															''.MAIL_OFFLINE_MSG_7.' <strong>'.$type_message.'</strong><br />' .
															''.MAIL_OFFLINE_MSG_11.'<br />' .
															''.MAIL_OFFLINE_MSG_12.'<br />' .
															'</p>' .
															'<br /><br />'.MAIL_OFFLINE_MSG_14.'' .
															'</body>' .
															'</html>';
												
												mail($destinataire, $entete, $codehtml,"From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");	
											}
											//----------------------------------------------------------------------
										}
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
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION.'"><img src="'.HTTP_IMAGE.BT_INSCRIPTION_GRATUITE.'" alt="'.ATTRIBUT_ALT.'"/></a></div>';
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