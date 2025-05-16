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

$msg_stockes = $membre->compterTousLesMessages(TABLE_MESSAGERIE,$_SESSION['id_client']);

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
	if($_GET['action'] == "ecrire-message-video"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['action'] == "ecrire-message-audio"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'audio/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ON FAIT RIEN...
	}
	
	if(empty($_GET['action']) OR $_GET['action'] == "messages-envoyes"){
		echo afficherLimiteStockage($msg_stockes);
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
								 	if(empty($_GET['action']) OR $_GET['action'] == "messages-envoyes"){
								 	//************ BOITE RECEPTION / ENVOYES / SUPPRIMES ***************
								 	?>
								 	<table id="bloc_boite_messagerie">
								 		<tr>
								 			<td class="info">
								 				<!-- BLOC INFORMATION -->
								 				<div class="info_messagerie">
								 					<ul>
								 						<li class="titre"><?php echo TITRE_COL_GAUCHE_INFO; ?></li>
								 						<li class="texte"><?php echo TEXTE_COL_GAUCHE_INFO; ?></li>
								 					</ul>
								 				</div>
								 			</td>
								 			<td class="bloc_selection">
								 				<!-- BLOC SELECTION DU TYPE DE MESSAGE REDACTION -->
								 				<div class="selection_messagerie">
								 					<ul>
								 						<li class="titre"><?php echo TITRE_SELECTION_MESSAGE; ?></li>
								 						<li>
								 							<table class="tab1">
								 								<tr>
								 									<td class="gris"><?php echo SELECTION_MESSAGE_TEXTE; ?></td>
								 									<td class="icone">
								 									<?php
									 									if($msg_stockes <= 100){
									 										?>
									 										<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER; ?>?action=ecrire-message-texte"><img src="<?php echo HTTP_IMAGE.'crayon.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
									 										<?php
									 									}
									 									else{
									 										?>
									 										<img src="<?php echo HTTP_IMAGE.'crayon.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/>
									 										<?php
									 									}
								 									?>
								 									</td>
								 								</tr>
								 							</table>
								 						</li>
								 						<li>
								 							<table class="tab2">
								 								<tr>
								 									<td class="gris"><?php echo SELECTION_MESSAGE_AUDIO; ?></td>
								 									<td class="icone">
								 									<?php
									 									if($msg_stockes <= 100){
									 										?>
									 										<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER; ?>?action=ecrire-message-audio"><img src="<?php echo HTTP_IMAGE.'note_audio.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
									 										<?php
									 									}
									 									else{
									 										?>
									 										<img src="<?php echo HTTP_IMAGE.'note_audio.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/>
									 										<?php
									 									}
								 									?>
								 									</td>
								 								</tr>
								 							</table>
								 						</li>
								 						<li>
								 							<table class="tab3">
								 								<tr>
								 									<td class="gris"><?php echo SELECTION_MESSAGE_VIDEO; ?></td>
								 									<td class="icone">
								 									<?php
									 									if($msg_stockes <= 100){
									 										?>
									 										<a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER; ?>?action=ecrire-message-video"><img src="<?php echo HTTP_IMAGE.'pellicule_video.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a>
									 										<?php
									 									}
									 									else{
									 										?>
									 										<img src="<?php echo HTTP_IMAGE.'pellicule_video.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/>
									 										<?php
									 									}
								 									?>
								 									</td>
								 								</tr>
								 							</table>
								 						</li>
								 					</ul>
								 				</div>
								 			</td>
								 		</tr>
								 		<tr>
								 			<td class="bloc_menu">
								 				<!-- BLOC MENU BOITE DE MESSAGERIE -->
								 				<div class="menu_messagerie">
								 					<ul>
								 						<li class="titre"><?php echo COL_GAUCHE_MENU_TITRE; ?></li>
								 						<li>
								 							<table class="tab4">
								 								<tr>
								 									<td class="icone"><img src="<?php echo HTTP_IMAGE.'retour_maison.png'; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
								 									<td style="padding-top:5px;padding-left:5px;"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER; ?>"><?php echo COL_GAUCHE_MENU_RECEPTION; ?></a></td>
								 									<td class="compteur_messages"><?php echo $membre->compterMessagesDuMembreCommeDestinataire(TABLE_MESSAGERIE, $_SESSION['id_client'], $_SESSION['pseudo_client'], "non"); ?></td>
								 								</tr>
								 								<tr>
								 									<td class="icone"><img src="<?php echo HTTP_IMAGE.'messages_envoyes.png'; ?>" alt="rencontre"/></td>
								 									<td style="padding-top:5px;padding-left:5px;"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER; ?>?action=messages-envoyes"><?php echo COL_GAUCHE_MENU_ENVOYES; ?></a></td>
								 									<td class="compteur_messages"><?php echo $membre->compterMessagesEnvoyer($_SESSION['id_client'], $_SESSION['pseudo_client']); ?></td>
								 								</tr>
								 							</table>
								 						</li>
								 					</ul>
								 				</div>
								 				<!-- BLOC MENU LEGENDE -->
								 				<div class="legende">
								 					<ul>
								 						<li class="titre"><?php echo TITRE_LEGENDE; ?></li>
								 						<li style="font-style:italic;text-align:justify;padding:5px;"><?php echo TEXTE_LEGENDE; ?></li>
								 					</ul>
								 				</div>
								 				<!-- BLOC PAGINATION -->
								 				<div class="pagination">
								 					<ul>
								 						<li class="titre"><?php echo TITRE_PAGINATION; ?></li>
								 						<li>
								 							<table>
								 								<tr>
								 									<td><?php
								 									if(empty($_GET['action'])){
								 										$nombreMembresParPage = NOMBRE_MESSAGES_PAR_PAGE;
																	 	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
																		$TotalMembres = $membre->compterMessagesReception($_SESSION['id_client'], $_SESSION['pseudo_client']);
																		// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
																		$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
																		$page = defautPage($_GET['page']);
								 									}
								 									
								 									if($_GET['action'] == "messages-envoyes"){
								 										$nombreMembresParPage = NOMBRE_MESSAGES_PAR_PAGE;
																	 	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
																		$TotalMembres = $membre->compterMessagesEnvoyer($_SESSION['id_client'], $_SESSION['pseudo_client']);
																		// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
																		$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
																		$page = defautPage($_GET['page']);
								 									}
								 									
								 									 echo NOMBRE_RESULTAT.$TotalMembres; ?></td>
								 									<td><?php echo PAGE.defautPage($_GET['page']).'/'.$nombreDePages; ?></td>
								 								</tr>
								 								<tr>
								 									<td><?php 
																		//---- PAGINATION RETOUR --------------
																		if(is_null(defautPage($_GET['page'])) OR defautPage($_GET['page']) <= 1){
																			$num = 0;
																			$disabled = "disabled";
																		}
																		else{
																			$num = defautPage($_GET['page'])-1;
																			$disabled = "";
																		}
																		//-------- BOUTON PAGINATION RETOUR --------------
																		echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_COURRIER.'" method="get">' .
																			'<input type="hidden" name="page" value="'.$num.'"/>' .
																			'<input type="hidden" name="action" value="'.$_GET['action'].'"/>' .
																			'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
																			'</form>';
																		?>
																	</td>
								 									<td>
								 									<?php 
																		//-------- BOUTON PAGINATION AVANCER --------------
																		if(is_null(defautPage($_GET['page'])) OR defautPage($_GET['page']) == 0){
																			$num = 1;
																		}
																		else{
																			$num = defautPage($_GET['page'])+1;
																		}
																		echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_COURRIER.'" method="get">' .
																			'<input type="hidden" name="page" value="'.$num.'"/>' .
																			'<input type="hidden" name="action" value="'.$_GET['action'].'"/>' .
																			'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'"/>' .
																			'</form>';
																		 ?>
								 									</td>
								 								</tr>
								 							</table>
								 						</li>
								 					</ul>
								 				</div>
								 				<!-- BLOC ESPACE DE STOCKAGE -->
								 				<div class="espace_stockage">
								 					<p class="titre"><?php echo TITRE_STOCKAGE; ?></p>
								 					<div id="wrapper">
														<div id="progress-bar">
															<div id="progress-level"></div>
														</div>
													</div>
													<p style="text-align:center;font-size:10px;font-style:italic;"><?php echo TEXT_STOCKAGE; ?></p>
								 				</div>
								 			</td>
								 			<td class="bloc_dev_boite">
								 				<!-- BLOC DEVELOPPEMENT -->
								 				<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_COURRIER.'?action=del_msg'; ?>" method="post">
								 				<table class="dev_boite_messagerie">
								 					<tr>
								 						<td colspan="6" class="titre"><?php echo $top; ?></td>
								 					</tr>
								 					<tr>
								 						<td style="text-align:center;"><input type="image" src="<?php echo HTTP_IMAGE.'corbeille.png'; ?>"/></td>
								 						<td style="text-align:center;background-color: #EBEBEB;padding-top:5px;"><?php echo TYPE_DEV_MESSAGERIE; ?></td>
								 						<td style="text-align:left;background-color: #EBEBEB;padding-top:5px;"><?php echo EXP_DEV_MESSAGERIE; ?></td>
								 						<td style="text-align:center;background-color: #EBEBEB;padding-top:5px;"><?php echo ETAT_DEV_MESSAGERIE; ?></td>
								 						<td style="text-align:left;background-color: #EBEBEB;padding-top:5px;"><?php echo OBJET_DEV_MESSAGERIE; ?></td>
								 						<td style="text-align:left;background-color: #EBEBEB;padding-top:5px;"><?php echo DATE_DEV_MESSAGERIE; ?></td>
								 					</tr>
								 					<?php
								 					if(empty($_GET['action'])){
													 	//BOITE DE RECEPTION DES NOUVEAUX MESSAGES
													 	// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
														$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
														$NombreMembresMaxi = $page + 20;
														$NombreMembresMini = pageMini($page);
													 	
													 	//**********************************************************************************
														//                      RECUPERATION DU LISTING ANNONCES
														//**********************************************************************************
														if($TotalMembres > 0){
															echo $membre->afficherTousLesMessages($premierMembresAafficher, $nombreMembresParPage, $_SESSION['id_client'], $_SESSION['pseudo_client']);
														}
														else{
															echo '<tr><td style="padding-top:60px;text-align:center;font-size:16px;" colspan="6">'.PAS_DE_RESULTAT.'</td></tr>';
														}
														
														//-----DEFINIR LE NOMBRE DE PAGES--------------------
														if (isset($page)){
															if ($page<=$nombreDePages OR $_GET['page'] == 0){
																//ON NE FAIT RIEN...
															}
															else{
																echo "<meta http-equiv=\"refresh\" content=\"0; URL=".HTTP_SERVEUR.'interface/'.FILENAME_COURRIER."?page=".$nombreDePages."&action=".$_GET['action']."\">";
															}
														}	
													 }
													 elseif($_GET['action'] == "messages-envoyes"){
													 	//TOUS LES MESSAGES ENVOYES
														// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
														$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
														$NombreMembresMaxi = $page + 20;
														$NombreMembresMini = pageMini($page);
													 	
													 	//**********************************************************************************
														//                      RECUPERATION DU LISTING ANNONCES
														//**********************************************************************************
														if($TotalMembres > 0){
															echo $membre->afficherTousLesMessagesEnvoyes($premierMembresAafficher, $nombreMembresParPage, $_SESSION['id_client'], $_SESSION['pseudo_client']);
														}
														else{
															echo '<tr><td style="padding-top:60px;text-align:center;font-size:16px;" colspan="6">'.PAS_DE_RESULTAT.'</td></tr>';
														}
														
														//-----DEFINIR LE NOMBRE DE PAGES--------------------
														if (isset($page)){
															if ($page<=$nombreDePages OR $_GET['page'] == 0){
																//ON NE FAIT RIEN...
															}
															else{
																echo "<meta http-equiv=\"refresh\" content=\"0; URL=".HTTP_SERVEUR.'interface/'.FILENAME_COURRIER."?page=".$nombreDePages."&action=".$_GET['action']."\">";
															}
														}	
													 }
													 else{
													 	//ERREUR...
													 	redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
													 }
								 					?>
								 				</table>
								 				</form>
								 			</td>
								 		</tr>
								 	</table>	
								 	<?php
								 	}
								 	else{
								 		//************** LECTURE MESSAGE + REDACTION MESSAGGES TEXTE, AUDIO ET VIDEO ****************
								 		if($_GET['action'] == "ecrire-message-texte"){
										 	//FORMULAIRE MESSAGE TEXTE
										 	//CAS : MESSAGE TEXTE
										 	?>
										 	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER_3; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
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
										 			<p style="text-align:center;margin-top:27px;clear:left;"><br /><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_SUBMIT_TEXTE; ?>" /></p>
										 		</div>
										 	</form>
										 	<?php
										 }
										 elseif($_GET['action'] == "ecrire-message-audio"){
										 	//FORMULAIRE MESSAGE AUDIO
										 	creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
										 	$temps = time();
											$fichier_flash = $_SESSION['pseudo_client'].$temps;
											$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
																
										 	?>
										 	<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_GESTION_COURRIER_3; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
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
										 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_SUBMIT_AUDIO; ?>" /></p>
										 		</div>
										 	</form>
										 	<?php
										 	//-------------------------------------------------------------
											//         CREATION IDENTIFIANT FICHIER MEDIA
											//-------------------------------------------------------------
											$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
											
										 }
										 elseif($_GET['action'] == "ecrire-message-video"){
										 	//FORMULAIRE MESSAGE VIDEO
										 	creationRepertoireStockageRED5(nommageRepertoire($_SESSION['id_client']));
										 	$temps = time();
											$fichier_flash = $_SESSION['pseudo_client'].$temps;
											$chaine = 'monFichier='.$fichier_flash.'&repertoire='.nommageRepertoire($_SESSION['id_client']);
											
										 	?>
										 	<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_GESTION_COURRIER_3; ?>" method="post" onSubmit="return checkrequired(this)" name="formulaire">
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
										 			<p class="bt_send_message_audio"><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_SUBMIT_VIDEO; ?>" /></p>
										 		</div>
										 	</form>
										 	<?php
										 	//-------------------------------------------------------------
											//         CREATION IDENTIFIANT FICHIER MEDIA
											//-------------------------------------------------------------
											$membre->insertIdentifiants($_SESSION['pseudo_client'], $temps);
											
										 }
										 elseif($_GET['action'] == "del_msg"){
										 	for($i=1;$i<NOMBRE_MESSAGES_PAR_PAGE;$i++){
										 		if(minuscule($_POST['check'.$i]) == ""){
										 			//ON NE FAIT RIEN...
										 		}
										 		else{
										 			//AJOUTER FICHIER DANS LA CORBEILLE
										 			$controle_genre = $membre->getChamps("genre", TABLE_MESSAGERIE, "id", minuscule($_POST['check'.$i]));
										 			$mon_expediteur = $membre->getChamps("id_expediteur", TABLE_MESSAGERIE, "id", minuscule($_POST['check'.$i]));
										 			
										 			if($controle_genre == "message-audio"){
										 				$mon_audio = $membre->getChamps("msg_audio", TABLE_MESSAGERIE, "id", minuscule($_POST['check'.$i]));
										 				$flv_existanr = controleExistanceFLV(REPERTOIRE_WEBAPPS_RED5.nommageRepertoire($mon_expediteur).$mon_audio.'.flv');
										 				//FICHIER AJOUTE DANS TACHE CRON CORBEILLE
														if($mon_audio != "" AND $flv_existanr == 1){
															$membre->ajouterFichierFLV($mon_audio, time(), nommageRepertoire($mon_expediteur));
														}
										 			}
										 			if($controle_genre == "message-video"){
										 				$ma_video = $membre->getChamps("msg_video", TABLE_MESSAGERIE, "id", minuscule($_POST['check'.$i]));
										 				$flv_existanr = controleExistanceFLV(REPERTOIRE_WEBAPPS_RED5.nommageRepertoire($mon_expediteur).$ma_video.'.flv');
										 				//FICHIER AJOUTE DANS TACHE CRON CORBEILLE
														if($ma_video != "" AND $flv_existanr == 1){
															$membre->ajouterFichierFLV($ma_video, time(), nommageRepertoire($mon_expediteur));
														}
										 			}
										 			//SUPPRESSION DU MESSAGE
							 						$membre->supprimerUnElement(TABLE_MESSAGERIE, "id", minuscule($_POST['check'.$i]));
										 		}
										 	}
										 	echo '<p class="message_erreur">'.MESSENGER_SUPPRESSION_MESSAGE_OFF.'</p>';
							 				redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
										 }
										 else{
										 	//ERREUR...
										 	redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_COURRIER);
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