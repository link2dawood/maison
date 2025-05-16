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
includeLanguage(RACINE, LANGUAGE, FILENAME_CONSEILS);
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
    <?php echo CONFIGURATION_ACCORDEON_JS; ?>
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
			<h1><?php echo H1_DE_LA_PAGE; ?></h1>
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
						<div class="corps_top_developpement"><?php echo H2_DE_LA_PAGE; ?></div>
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
						 	<p><?php echo TEXTE_1; ?></p>
						 	<div id="test-accordion" class="accordion">
						 		<!-- ONGLET 1 -->
								<div class="accordion-toggle"><?php echo TEXTE_2; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_3; ?></p>
									<p><?php echo TEXTE_4; ?></p>
									<p><?php echo TEXTE_6; ?></p>
									<p class="titre"><?php echo TEXTE_7; ?></p>
									<p><?php echo TEXTE_8; ?></p>
									<p class="titre"><?php echo TEXTE_9; ?></p>
									<p><?php echo TEXTE_10; ?></p>
									<p class="titre"><?php echo TEXTE_11; ?></p>
									<p><?php echo TEXTE_12; ?></p>
									<p><?php echo TEXTE_13; ?></p>
									<p><?php echo TEXTE_14; ?></p>
									<p class="titre"><?php echo TEXTE_15; ?></p>
									<p><?php echo TEXTE_16; ?></p>
									<p class="titre"><?php echo TEXTE_17; ?></p>
									<p><?php echo TEXTE_18; ?></p>
									<p class="titre"><?php echo TEXTE_19; ?></p>
									<p><?php echo TEXTE_20; ?></p>
									<p class="titre"><?php echo TEXTE_21; ?></p>
									<p><?php echo TEXTE_22; ?></p>
									<p class="titre"><?php echo TEXTE_23; ?></p>
									<p><?php echo TEXTE_24; ?></p>
								</div>
								<!-- ONGLET 2 -->
								<div class="accordion-toggle"><?php echo TEXTE_25; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_26; ?></p>
									<p><?php echo TEXTE_27; ?></p>
									<p><?php echo TEXTE_28; ?></p>
									<p><?php echo TEXTE_29; ?></p>
									<p class="titre"><?php echo TEXTE_30; ?></p>
									<p><?php echo TEXTE_31; ?></p>
									<p class="titre"><?php echo TEXTE_32; ?></p>
									<p><?php echo TEXTE_33; ?></p>
									<p class="titre"><?php echo TEXTE_34; ?></p>
									<p><?php echo TEXTE_35; ?></p>
									<p class="titre"><?php echo TEXTE_36; ?></p>
									<p><?php echo TEXTE_37; ?></p>
									<p class="titre"><?php echo TEXTE_38; ?></p>
									<p><?php echo TEXTE_39; ?></p>
									<p class="titre"><?php echo TEXTE_40; ?></p>
									<p><?php echo TEXTE_41; ?></p>
									<p class="titre"><?php echo TEXTE_42; ?></p>
									<p><?php echo TEXTE_43; ?></p>
									<p class="titre"><?php echo TEXTE_44; ?></p>
									<p><?php echo TEXTE_45; ?></p>
									<p><?php echo TEXTE_46; ?></p>
								</div>
								<!-- ONGLET 3 -->
								<div class="accordion-toggle"><?php echo TEXTE_47; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_48; ?></p>
									<p><?php echo TEXTE_49; ?></p>
									<p><?php echo TEXTE_50; ?></p>
									<p class="titre"><?php echo TEXTE_51; ?></p>
									<p><?php echo TEXTE_52; ?></p>
									<p class="titre"><?php echo TEXTE_53; ?></p>
									<p><?php echo TEXTE_54; ?></p>
									<p><?php echo TEXTE_55; ?></p>
									<p class="titre"><?php echo TEXTE_56; ?></p>
									<p><?php echo TEXTE_57; ?></p>
									<p><?php echo TEXTE_58; ?></p>
									<p class="titre"><?php echo TEXTE_59; ?></p>
									<p><?php echo TEXTE_60; ?></p>
									<p class="titre"><?php echo TEXTE_61; ?></p>
									<p><?php echo TEXTE_62; ?></p>
									<p class="titre"><?php echo TEXTE_63; ?></p>
									<p><?php echo TEXTE_64; ?></p>
									<p><?php echo TEXTE_65; ?></p>
									<p class="titre"><?php echo TEXTE_66; ?></p>
									<p><?php echo TEXTE_67; ?></p>
									<p><?php echo TEXTE_68; ?></p>
									<p><?php echo TEXTE_69; ?></p>
									<p class="titre"><?php echo TEXTE_70; ?></p>
									<p><?php echo TEXTE_71; ?></p>
									<p class="titre"><?php echo TEXTE_72; ?></p>
									<p><?php echo TEXTE_73; ?></p>
								</div>
								<!-- ONGLET 4 -->
								<div class="accordion-toggle"><?php echo TEXTE_74; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_75; ?></p>
									<p><?php echo TEXTE_76; ?></p>
									<p class="titre"><?php echo TEXTE_77; ?></p>
									<p><?php echo TEXTE_78; ?></p>
									<p class="titre"><?php echo TEXTE_79; ?></p>
									<p><?php echo TEXTE_80; ?></p>
									<p class="titre"><?php echo TEXTE_81; ?></p>
									<p><?php echo TEXTE_82; ?></p>
									<p class="titre"><?php echo TEXTE_83; ?></p>
									<p><?php echo TEXTE_84; ?></p>
									<p class="titre"><?php echo TEXTE_85; ?></p>
									<p><?php echo TEXTE_86; ?></p>
									<p class="titre"><?php echo TEXTE_87; ?></p>
									<p><?php echo TEXTE_88; ?></p>
									<p class="titre"><?php echo TEXTE_89; ?></p>
									<p><?php echo TEXTE_90; ?></p>
									<p class="titre"><?php echo TEXTE_91; ?></p>
									<p><?php echo TEXTE_92; ?></p>
									<p class="titre"><?php echo TEXTE_93; ?></p>
									<p><?php echo TEXTE_94; ?></p>
								</div>
								<!-- ONGLET 5 -->
								<div class="accordion-toggle"><?php echo TEXTE_95; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_96; ?></p>
									<?php
									if($_SESSION['pseudo_client']){
										?>
										<p class="lien"><a href="<?php echo CONTRAT_ECHANGE_MAISON; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo CONTRAT_ECHANGE_MAISON_PDF; ?>" target="_blank"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_99; ?></p>
										<p class="lien"><a href="<?php echo CONTRAT_ECHANGE_VEHICULE; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo CONTRAT_ECHANGE_VEHICULE_PDF; ?>" target="_blank"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_100; ?></p>
										<p class="lien"><a href="<?php echo CONSTAT_ETAT_LIEUX; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo CONSTAT_ETAT_LIEUX_PDF; ?>" target="_blank"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_101; ?></p>
										<p class="lien"><a href=""><?php echo TEXTE_97; ?></a> | <a href="" target="_blank"><?php echo TEXTE_98; ?></a></p>
										<?php
									}
									else{
										?>
										<p class="lien"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_99; ?></p>
										<p class="lien"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_100; ?></p>
										<p class="lien"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_98; ?></a></p>
										<p class="titre"><?php echo TEXTE_101; ?></p>
										<p class="lien"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_97; ?></a> | <a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_98; ?></a></p>
										<p><?php echo TEXTE_101_1; ?></p>
										<?php
									}
									?>
								</div>
								<!-- ONGLET 6 -->
								<div class="accordion-toggle"><?php echo TEXTE_102; ?></div>
								<div class="accordion-content">
									<p class="titre"><?php echo TEXTE_103; ?></p>
									<p><?php echo TEXTE_104; ?></p>
									<p><?php echo TEXTE_105; ?></p>
									<p><?php echo TEXTE_106; ?></p>
									<p class="titre"><?php echo TEXTE_107; ?></p>
									<p><?php echo TEXTE_108; ?></p>
									<p class="titre"><?php echo TEXTE_109; ?></p>
									<p><?php echo TEXTE_110; ?></p>
									<p class="titre"><?php echo TEXTE_111; ?></p>
									<p><?php echo TEXTE_112; ?></p>
								</div>
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