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

//------------ Récupération des infos --------------------
$inscription = $membre->getTable(TABLE_INSCRIPTION, "id", $_GET['id']);
if($inscription->type_annonce == TABLE_LISTING_COUCHSURFING){
	$maTable = TABLE_LISTING_COUCHSURFING;
	$title = TEXTE_75;
	$partie1 = TEXTE_12;
	$presentation = 'info_couch';
	$area = 'area_couch';
	$velo = TEXTE_22;
	$voiture = TEXTE_34;
	$velo_rechercher = TEXTE_22;
	$voiture_rechercher = TEXTE_34;
	$titre_album = 'titre_album_couch';
	$titre_album_video = 'titre_album_couch_video';
	$titre_album_audio = 'titre_album_couch_audio';
	$type_echange = TEXTE_93;
}
else{
	$maTable = TABLE_LISTING_ECHANGE_MAISON;
	$title = TEXTE_74;
	$partie1 = TEXTE_61;
	$presentation = 'info_ech';
	$area = 'area_ech';
	$velo = TEXTE_67;
	$voiture = TEXTE_68;
	$velo_rechercher = TEXTE_67;
	$voiture_rechercher = TEXTE_68;
	$titre_album = 'titre_album_ech';
	$titre_album_video = 'titre_album_ech_video';
	$titre_album_audio = 'titre_album_ech_audio';
	$type_echange = TEXTE_92;
}
$annonce = $membre->getTable($maTable, "identifiant", $inscription->id_annonce);
$identite = $membre->getTable(TABLE_IDENTITE, "identifiant", $_GET['id']);
$monPays = $metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $identite->pays);
$carnet = $membre->getTable(TABLE_CARNET_DE_VOYAGE,"identifiant",$_GET['id']);

$img1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_GET['id']);
$img2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_GET['id']);
$img3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_GET['id']);
$img4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_GET['id']);
//Récupération de mon fichier audio et vidéo
$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $inscription->pseudo);
$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $inscription->pseudo);
//******
$identifiant = $membre->getChamps("connexion", TABLE_ONLINE, "pseudo", $inscription->pseudo);
//------ SALON DE DISCUSSION --------
$tchat = $membre->getTable(TABLE_TCHAT_LISTE_CONNECTES, "identifiant", $inscription->id);
$pays_salon = $membre->getChamps('pays', 'pays_'.LANGUAGE, 'id', $tchat->id_pays);

//<table style="margin-top:3px;width:100%;">
//<tr>
//<td class="top_1">TEXTE_87</td>
//<td><a href="javascript:void(AjouterFavoris('HTTP_SERVEUR','LIBELLE_FAVORI'));">TEXTE_90</a></td>
//</tr>
//</table>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $title.' '.$monPays.' '.$identite->ville; ?></title>
	<meta name="description" content="<?php echo TEXTE_77; ?> <?php echo $title.' '.$monPays.' '.$identite->ville; ?> <?php echo TEXTE_78; ?>"/>
	<meta name="keywords" content="<?php echo $title; ?>,<?php echo $monPays; ?>,<?php echo $identite->ville; ?>,<?php echo HEADER_KEYWORDS; ?>"/>
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
			<h1><?php echo $title.' '.$monPays.' '.$identite->ville; ?></h1>
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
						<div class="corps_top_developpement"><?php echo '[<span style="font-size:12px;"><span style="text-decoration:underline;">'.TEXTE_79.'</span>: '.$inscription->pseudo.'</span>] '.$title.' '.$monPays.' '.$identite->ville; ?></div>
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
						 	<?php include(INCLUDE_FICHE_DETAIL); ?>
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
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_A); ?></div>
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