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
includeLanguage(RACINE, LANGUAGE, FILENAME_DEPOT_ANNONCE);
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
					echo H1_DE_LA_PAGE_2;
				}
				elseif($_GET['tpe'] == "couchsurfing"){
					echo H1_DE_LA_PAGE_3;
				}
				else{
					echo H1_DE_LA_PAGE_1;
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
								echo H1_DE_LA_PAGE_2;
							}
							elseif($_GET['tpe'] == "couchsurfing"){
								echo H1_DE_LA_PAGE_3;
							}
							else{
								echo H1_DE_LA_PAGE_1;
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
						 		if($_GET['tpe'] == "echange"){
									$table_annonce = TABLE_LISTING_ECHANGE_MAISON;
									$type_echange= textFormater($_POST['echange']);
								}
								elseif($_GET['tpe'] == "couchsurfing"){
									$table_annonce = TABLE_LISTING_COUCHSURFING;
									$type_echange= textFormater($_POST['couchsurfing']);
								}
								else{
									$table_annonce = "";
								}
									
						 		if($type_echange == "0" OR $type_echange == ""){
						 			messageErreur(TEXTE_94);
						 			redirection(4,$_SERVER['HTTP_REFERER']);
						 		}
						 		else{
									if($_GET['tpe'] == "echange" OR $_GET['tpe'] == "couchsurfing"){
										//Traitement de la page...
										$nom = textFormater($_POST['requiredNom']);
										$prenom = textFormater($_POST['requiredPrenom']);
										$adresse = textFormater($_POST['requiredAdresse']);
										$code_postal = textFormater($_POST['requiredCodepostal']);
										$ville = textFormater($_POST['requiredVille']);
										$pays = textFormater($_POST['select_pays']);
										$date1 = textFormater($_POST['requiredDate1']);
										$date2 = textFormater($_POST['requiredDate2']);
										$situation = textFormater($_POST['select_situation']);
										$type = textFormater($_POST['select_type']);
										$niveau = textFormater($_POST['select_niveau']);
										$capacite = textFormater($_POST['select_capacite']);
										$ch_adulte = textFormater($_POST['select_ch_adulte']);
										$ch_enfant = textFormater($_POST['select_ch_enfant']);
										$canape = textFormater($_POST['select_canape']);
										$sdb = textFormater($_POST['select_sdb']);
										$cuisine = textFormater($_POST['select_cuisine']);
										$terrasse = textFormater($_POST['select_terrasse']);
										$barbecue = textFormater($_POST['select_barbecue']);
										$jardin = textFormater($_POST['select_jardin']);
										$piscine = textFormater($_POST['select_piscine']);
										$velo = textFormater($_POST['select_velo']);
										$garage = textFormater($_POST['select_garage']);
										$animaux = textFormater($_POST['select_animaux']);
										$voiture = textFormater($_POST['select_voiture']);
										$handicape = textFormater($_POST['select_handicape']);
										$fumeur = textFormater($_POST['select_fumeur']);
										$commentaire1 = filtrageMessage($_POST['requiredCommentaire1']);
										$commentaire2 = filtrageMessage($_POST['requiredCommentaire2']);
										$date3 = textFormater($_POST['requiredDate3']);
										$date4 = textFormater($_POST['requiredDate4']);
										$destination1 = textFormater($_POST['requiredDestination1']);
										$destination2 = textFormater($_POST['destination2']);
										$destination3 = textFormater($_POST['destination3']);
										$destination4 = textFormater($_POST['destination4']);
										$type_rech_1 = textFormater($_POST['select_type_rech_1']);
										$type_rech_2 = textFormater($_POST['select_type_rech_2']);
										$type_rech_3 = textFormater($_POST['select_type_rech_3']);
										$type_rech_4 = textFormater($_POST['select_type_rech_4']);
										$capac_rech = textFormater($_POST['select_capac_rech']);
										$fumeur_rech = textFormater($_POST['select_fumeur_rech']);
										$velo_rech = textFormater($_POST['select_velo_rech']);
										$voiture_rech = textFormater($_POST['select_voiture_rech']);
										
										if($_GET['action'] == "aj"){
											if(empty($nom) OR empty($prenom) OR empty($adresse) OR empty($code_postal) OR empty($ville) OR empty($pays) OR empty($date1)
											 OR empty($date2) OR empty($commentaire1) OR empty($commentaire2) OR empty($date3) OR empty($date4) OR empty($destination1)){
												messageErreur(TEXTE_62);
												redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE.'?tpe='.$_GET['tpe'].'&action='.$_GET['action']);
											}
											elseif($pays == "0"){
												messageErreur(TEXTE_63);
												redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE.'?tpe='.$_GET['tpe'].'&action='.$_GET['action']);
											}
											else{
												//INSERTION IDENTITE
												$membre->insertionNouvelleIdentite($_SESSION['id_client'],$nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange);
												//INSERTION ANNONCE
												$membre->insertionNouvelleAnnonce($table_annonce,$_SESSION['id_client'],$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech);
												// --------------------- UPDATE TABLE INSCRIPTION -----------------------
												$membre->updateElement(TABLE_INSCRIPTION, "id_annonce", $_SESSION['id_client'], "id", $_SESSION['id_client']);
												$membre->updateElement(TABLE_INSCRIPTION, "type_annonce", $table_annonce, "id", $_SESSION['id_client']);
												$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
												// --------------------- UPDATE TABLE MEMBRES ONLINE -----------------------
												$membre->updateElement(TABLE_ONLINE, "id_annonce", $_SESSION['id_client'], "identifiant", $_SESSION['id_client']);
												$membre->updateElement(TABLE_ONLINE, "type_annonce", $table_annonce, "identifiant", $_SESSION['id_client']);
												$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
												// --------------------- INSERTION NOUVEAUX INSCRITS -----------------------
												$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
												if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
													$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
												}
												//----------------- ACCEPTER ALBUM PHOTOS -----------------------------
												$image_existante1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												if(empty($image_existante1) AND empty($image_existante2) AND empty($image_existante3) AND empty($image_existante4)){
													//RAS, on ne fait rien...
												}
												else{
													$membre->updateElement(TABLE_ALBUM_PHOTO, "controle", 0, "identifiant", $_SESSION['id_client']);
												}
												//----------------- ACCEPTER VIDEO -----------------------------
												$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
												if(empty($video_existant)){
													//PAS DE FICHIER DEJA CONNU... RAS
												}
												else{
													//ACCEPTATION...
													$membre->updateElement(TABLE_FICHIER_VIDEO, "controle", 0, "pseudo", $_SESSION['pseudo_client']);
												}
												//----------------- ACCEPTER AUDIO -----------------------------
												$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
												if(empty($audio_existant)){
													//PAS DE FICHIER DEJA CONNU... RAS
												}
												else{
													//ACCEPTATION...
													$membre->updateElement(TABLE_FICHIER_AUDIO, "controle", 0, "pseudo", $_SESSION['pseudo_client']);
												}
												
												//MESSAGE
												messageErreur(TEXTE_64);
												redirection(3, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
											}
										}
										elseif($_GET['action'] == "md"){
											if(empty($nom) OR empty($prenom) OR empty($adresse) OR empty($code_postal) OR empty($ville) OR empty($pays) OR empty($date1)
											 OR empty($date2) OR empty($commentaire1) OR empty($commentaire2) OR empty($date3) OR empty($date4) OR empty($destination1)){
												messageErreur(TEXTE_62);
												redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE.'?tpe='.$_GET['tpe'].'&action='.$_GET['action']);
											}
											elseif($pays == "0"){
												messageErreur(TEXTE_63);
												redirection(3, HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE.'?tpe='.$_GET['tpe'].'&action='.$_GET['action']);
											}
											else{
												//UPDATE IDENTITE
												$metier->updateIdentite($nom,$prenom,$adresse,$code_postal,$ville,$pays,$type_echange,$_SESSION['id_client']);
												//UPDATE ANNONCE
												$membre->updateAnnonce($table_annonce,$_SESSION['id_client'],$date1,$date2,$situation,$type,$niveau,$capacite,$ch_adulte,$ch_enfant,$canape,$sdb,$cuisine,$terrasse,$barbecue,$jardin,$piscine,$velo,$garage,$animaux,$voiture,$handicape,$fumeur,$commentaire1,$commentaire2,$date3,$date4,$destination1,$destination2,$destination3,$destination4,$type_rech_1,$type_rech_2,$type_rech_3,$type_rech_4,$capac_rech,$fumeur_rech,$velo_rech,$voiture_rech);
												// --------------------- UPDATE TABLE INSCRIPTION -----------------------
												$membre->updateElement(TABLE_INSCRIPTION, "en_ligne", "", "id", $_SESSION['id_client']);
												// --------------------- UPDATE TABLE MEMBRES ONLINE -----------------------
												$membre->updateElement(TABLE_ONLINE, "en_ligne", "", "identifiant", $_SESSION['id_client']);
												// --------------------- INSERTION NOUVEAUX INSCRITS -----------------------
												$modif_existante = $metier->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
												if(empty($modif_existante) AND $_SESSION['id_client'] != "" AND $_SESSION['id_client'] > 0){
													$metier->insertNouvelleInscription($_SESSION['id_client'], time()); 
												}
												//----------------- ACCEPTER ALBUM PHOTOS -----------------------------
												$image_existante1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												$image_existante4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
												if(empty($image_existante1) AND empty($image_existante2) AND empty($image_existante3) AND empty($image_existante4)){
													//RAS, on ne fait rien...
												}
												else{
													$membre->updateElement(TABLE_ALBUM_PHOTO, "controle", 0, "identifiant", $_SESSION['id_client']);
												}
												//----------------- ACCEPTER VIDEO -----------------------------
												$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
												if(empty($video_existant)){
													//PAS DE FICHIER DEJA CONNU... RAS
												}
												else{
													//ACCEPTATION...
													$membre->updateElement(TABLE_FICHIER_VIDEO, "controle", 0, "pseudo", $_SESSION['pseudo_client']);
												}
												//----------------- ACCEPTER AUDIO -----------------------------
												$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
												if(empty($audio_existant)){
													//PAS DE FICHIER DEJA CONNU... RAS
												}
												else{
													//ACCEPTATION...
													$membre->updateElement(TABLE_FICHIER_AUDIO, "controle", 0, "pseudo", $_SESSION['pseudo_client']);
												}
												//MESSAGE
												messageErreur(TEXTE_69);
												redirection(3, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
											}
										}
										else{
											redirection(0, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										}
									}
									else{
										redirection(0,$_SERVER['HTTP_REFERRER']);
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