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

//--------------------------------CONTROLE PAGE DE PAIEMENT ------------------------------------
$mon_compte = $metier->getInscriptionMembre($_SESSION['id_client']);
echo activerPaiement($mon_compte[4], $mon_compte[5], $mon_compte[6], $mon_compte[8], $mon_compte[1], $mon_compte[3]);
//----------------------------------------------------------------------------------------------

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//COMPTEUR ONT VISITE MON PROFIL
if($_GET['id'] != $_SESSION['id_client'] AND $_GET['m'] != "" AND $_SESSION['id_client'] != ""){
	//ON COMPTABILISE...
	$membre->ajouterCompteurProfil($_SESSION['id_client'], $_GET['id']);
}

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
			<h1><?php
				if(isset($_GET['id'])){
					echo H1_PROFIL;
				}
				else{
					echo H1_BIS_PROFIL;
				}
				?>
			</h1>
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
						<div class="corps_top_developpement">
						<?php
						if(isset($_GET['id'])){
							echo H1_PROFIL;
						}
						else{
							echo H1_BIS_PROFIL;
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
							 <div id="tab_profil">
							 <?php
							 if(is_numeric($_GET['id']) AND !empty($_GET['m'])){
							 	//*******************************************************************
							 	//                   ANNONCE EN DETAIL DU MEMBRE
							 	//*******************************************************************
							 	//RECUPERER LES ELEMENTS DU MEMBRE SELECTIONNE
							 	$profil = $membre->getInscription($_GET['id']);
								$identifiant = $membre->getChamps("identifiant", TABLE_ONLINE, "pseudo", $profil[1]);
								$fichier_audio = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $profil[1]);
								$fichier_video = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $profil[1]);
								$naissance = dateNaissance($profil[10]);
								
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
							 						<td class="donnee"><?php echo date("d/m/Y", $profil[3]); ?></td>
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
							 						<td class="donnee"><?php echo $metier->getChamps('nomdept', 'departement_'.LANGUAGE, 'numdept', $profil[9]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_PAYS; ?></td>
							 						<td class="donnee"><?php echo $metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $profil[8]); ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MA_DATE_DE_NAISSANCE; ?></td>
							 						<td class="donnee"><?php echo formaterChiffre($naissance[0]).'/'.formaterChiffre($naissance[1]).'/'.$naissance[2]; ?></td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_STATUT; ?></td>
							 						<td class="donnee">
								 						<?php
								 						if($identifiant){
								 							echo '<span style="color:green;font-weight:bolder;">ONLINE</span>';	
								 						}
								 						else{
								 							echo '<span style="color:red;font-weight:bolder;">OFFLINE</span>';
								 						} 
								 						?>
							 						</td>
							 					</tr>
							 					<tr>
							 						<td class="libelle"><?php echo MON_COMMENTAIRE; ?></td>
							 						<td><p class="commentaire"><?php echo $profil[14]; ?></p></td>
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
							 									<td style="height:100px;width:100px;"><?php echo afficherMiniature($profil[0], $profil[1], $profil[11], $profil[12]); ?></td>
							 									<td style="padding-top:20px;">
							 										<?php
							 										if(empty($profil[12])){
							 											//pas de photo dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_AGRANDIR.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											?>
							 											<a href="<?php echo HTTP_IMAGE_REDIMENSIONNEE.nommageRepertoire($profil[0]).$profil[1].'.'.$profil[11];?>" rel="lightbox" style="font-size:10px;"><img src="<?php echo HTTP_IMAGE.BT_AGRANDIR; ?>" alt="rencontre" class="img_1"/></a>
							 											<?php
							 										}
							 										?>
							 									</td>
							 								</tr>
							 							</table>
							 						</li>
							 						<li id="lib_2">
							 							<table style="width:100%;">
							 								<tr>
							 									<td><img src="<?php echo HTTP_IMAGE; ?>message_webcam_b.png" alt="rencontre"/></td>
							 									<td style="padding-top:20px;">
							 										<?php
							 										if(empty($fichier_video)){
							 											//pas de fichier dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_VOIR.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											//fichier OK
							 											echo '<a href=\'javascript:popUp("'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_PROFIL_FLV.'?f=1&pid='.$profil[0].'",260,260,"menubar=no,scrollbars=no,statusbar=no")\'><img src="'.HTTP_IMAGE.BT_VOIR.'" alt="rencontre" class="img_1"/></a>';
							 										}
							 										?>
							 									</td>
							 								</tr>
							 							</table>
							 						</li>
							 						<li id="lib_3">
							 							<table style="width:100%;">
							 								<tr>
							 									<td><img src="<?php echo HTTP_IMAGE; ?>message_audio_b.png" alt="rencontre"/></td>
							 									<td style="padding-top:20px;">
							 										<?php
							 										if(empty($fichier_audio)){
							 											//pas de fichier dispo
							 											echo '<img src="'.HTTP_IMAGE.BT_ECOUTER.'" alt="rencontre" class="img_1"/>';
							 										}
							 										else{
							 											//fichier OK
							 											echo '<a href=\'javascript:popUp("'.HTTP_SERVEUR.'interface/'.FILENAME_POPUP_PROFIL_FLV.'?f=2&pid='.$profil[0].'",260,260,"menubar=no,scrollbars=no,statusbar=no")\'><img src="'.HTTP_IMAGE.BT_ECOUTER.'" alt="rencontre" class="img_1"/></a>';
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
							 			<td colspan="2">
							 				<!-- PARTIE MESSAGE -->
							 				<p id="nota"><?php echo MESSAGE_NOTA; ?></p>
							 			</td>
							 		</tr>
							 		<tr>
							 			<td colspan="2" style="text-align:center;">
							 				<!-- PARTIE FONCTION DE CONTACT -->
							 				<table id="option_profil">
							 					<tr>
							 						<td class="tchat_profil">
							 							<?php
							 							if($identifiant){
							 								?>
							 								<table class="tab_tchat">
								 								<tr>
								 									<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_1; ?>" alt="rencontre"/></a></td>
								 									<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_2; ?>" alt="rencontre"/></a></td>
								 									<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_3; ?>" alt="rencontre"/></a></td>
								 								</tr>
								 							</table>
							 								<?php
							 							}
							 							else{
							 								?>
							 								<table class="tab_tchat">
								 								<tr>
								 									<td class="ico_1"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_1; ?>" alt="rencontre"/></td>
								 									<td class="ico_2"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_2; ?>" alt="rencontre"/></td>
								 									<td class="ico_3"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_3; ?>" alt="rencontre"/></td>
								 								</tr>
								 							</table>
							 								<?php
							 							}
							 							?>
							 						</td>
							 						<td class="courrier_profil">
							 							<table class="tab_courrier">
							 								<tr>
							 									<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-video&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_4; ?>" alt="rencontre"/></a></td>
							 									<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-audio&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_5; ?>" alt="rencontre"/></a></td>
							 									<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$profil[0].'&m='.$profil[1]; ?>"><img src="<?php echo HTTP_IMAGE.BT_PROFIL_DETAIL_6; ?>" alt="rencontre"/></a></td>
							 								</tr>
							 							</table>
							 						</td>
							 					</tr>
							 				</table>
							 			</td>
							 		</tr>
							 		<tr>
							 			<td colspan="2">
							 				<!-- PARTIE DEUXIEME PARTIE -->
							 				<div class="avertissement">
							 					<ul>
							 						<li class="titre"><?php echo AVERTISSEMENT; ?></li>
							 						<li class="txt"><?php echo TEXT_AVERTISSEMENT_4; ?></li>
							 						<li class="txt"><?php echo TEXT_AVERTISSEMENT_5; ?></li>
							 						<li class="bt_acces"><a href="<?php echo HTTP_SERVEUR.FILENAME_CONTACT; ?>"><?php echo FOOTER_CONTACT; ?></a></li>
							 					</ul>
							 				</div>
							 			</td>
							 		</tr>
							 	</table>
							 	<?php
							 }
							 else{
							 	//*******************************************************************
							 	//  LISTING DES MEMBRES AYANT VISITE LE PROFIL DU MEMBRE CONNECTE
							 	//*******************************************************************
							 	
							 	
							 	
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