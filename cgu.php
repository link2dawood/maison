<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('./interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();
include(INCLUDE_CLASS_METIER);
$metier = new Metier();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_CGU);
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
						 	<div id="cgu">
						 		<div class="sommaire">
									<p style="text-align:right;"><a name="haut">[<?php echo HAUT; ?>]</a></p>
									<ul>
										<li class="titre"><?php echo SOMMAIRE; ?></li>
										<li>1. : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_1"><?php echo LIEN_SOMMAIRE_1; ?></a></li>
										<li class="sous">1.1 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_2"><?php echo LIEN_SOMMAIRE_2; ?></a></li>
										<li class="sous">1.2 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_3"><?php echo LIEN_SOMMAIRE_3; ?></a></li>
										<li class="sous">1.3 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_4"><?php echo LIEN_SOMMAIRE_4; ?></a></li>
										<li>2 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_5"><?php echo LIEN_SOMMAIRE_5; ?></a></li>
										<li class="sous">2.1 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_6"><?php echo LIEN_SOMMAIRE_6; ?></a></li>
										<li class="sous">2.2 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_7"><?php echo LIEN_SOMMAIRE_7; ?></a></li>
										<li class="sous">2.3 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_8"><?php echo LIEN_SOMMAIRE_8; ?></a></li>
										<li>3. : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_9"><?php echo LIEN_SOMMAIRE_9; ?></a></li>
										<li class="sous">3.1 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_10"><?php echo LIEN_SOMMAIRE_10; ?></a></li>
										<li class="sous">3.2 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_11"><?php echo LIEN_SOMMAIRE_11; ?></a></li>
										<li class="sous">3.3 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_12"><?php echo LIEN_SOMMAIRE_12; ?></a></li>
										<li class="sous">3.4 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_13"><?php echo LIEN_SOMMAIRE_13; ?></a></li>
										<li class="sous">3.5 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_14"><?php echo LIEN_SOMMAIRE_14; ?></a></li>
										<li class="sous">3.6 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_15"><?php echo LIEN_SOMMAIRE_15; ?></a></li>
										<li class="sous">3.7 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_16"><?php echo LIEN_SOMMAIRE_16; ?></a></li>
										<li class="sous">3.8 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_17"><?php echo LIEN_SOMMAIRE_17; ?></a></li>
										<li class="sous">3.9 : <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#lien_18"><?php echo LIEN_SOMMAIRE_18; ?></a></li>
									</ul>
								</div>
								<ul id="cgu_contenu">
									<li class="chapitre">1. : <a name="lien_1" class="lien"><?php echo LIEN_SOMMAIRE_1; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li class="sous-chapitre">1.1 : <a name="lien_2" class="lien"><?php echo LIEN_SOMMAIRE_2; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_1; ?></li>
									<li><?php echo TEXTE_2; ?></li>
									<li class="sous-chapitre">1.2 : <a name="lien_3" class="lien"><?php echo LIEN_SOMMAIRE_3; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_3; ?></li>
									<li><?php echo TEXTE_4; ?></li>
									<li class="sous-chapitre">1.3 : <a name="lien_4" class="lien"><?php echo LIEN_SOMMAIRE_4; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_5; ?></li>
									<li class="chapitre">2. : <a name="lien_5" class="lien"><?php echo LIEN_SOMMAIRE_5; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li class="sous-chapitre">2.1 : <a name="lien_6" class="lien"><?php echo LIEN_SOMMAIRE_6; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_6; ?></li>
									<li><?php echo TEXTE_7; ?></li>
									<li><?php echo TEXTE_8; ?></li>
									<li class="point">¤ <?php echo TEXTE_9; ?></li>
									<li class="point">¤ <?php echo TEXTE_10; ?></li>
									<li class="point">¤ <?php echo TEXTE_11; ?></li>
									<li class="point">¤ <?php echo TEXTE_12; ?></li>
									<li class="point">¤ <?php echo TEXTE_13; ?></li>
									<li class="point">¤ <?php echo TEXTE_14; ?></li>
									<li class="sous-chapitre">2.2 : <a name="lien_7" class="lien"><?php echo LIEN_SOMMAIRE_7; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_15; ?></li>
									<li style="text-align:center;"><img src="<?php echo HTTP_IMAGE; ?>screen1.jpg" alt="<?php echo ATTRIBUT_ALT; ?>"/></li>
									<li><span style="color:red;font-weight:bolder;">1.</span> <?php echo TEXTE_16; ?></li>
									<li><span style="color:red;font-weight:bolder;">2.</span> <?php echo TEXTE_17; ?></li>
									<li><span style="color:red;font-weight:bolder;">3.</span> <?php echo TEXTE_18; ?></li>
									<li><span style="color:red;font-weight:bolder;">4.</span> <?php echo TEXTE_19; ?></li>
									<li><span style="color:red;font-weight:bolder;">5.</span> <?php echo TEXTE_20; ?></li>
									<li><span style="color:red;font-weight:bolder;">6.</span> <?php echo TEXTE_21; ?></li>
									<li><span style="color:red;font-weight:bolder;">7.</span> <?php echo TEXTE_22; ?></li>
									<li><span style="color:red;font-weight:bolder;">8.</span> <?php echo TEXTE_23; ?></li>
									<li><span style="color:red;font-weight:bolder;">9.</span> <?php echo TEXTE_23_1; ?></li>
									<li><span style="color:red;font-weight:bolder;">10.</span> <?php echo TEXTE_23_2; ?></li>
									<li><span style="color:red;font-weight:bolder;">11.</span> <?php echo TEXTE_23_3; ?></li>
									<li><span style="color:red;font-weight:bolder;">12.</span> <?php echo TEXTE_23_4; ?></li>
									<li><span style="color:red;font-weight:bolder;">13.</span> <?php echo TEXTE_23_5; ?></li>
									<li><span style="color:red;font-weight:bolder;">14.</span> <?php echo TEXTE_23_6; ?></li>
									<li class="sous-chapitre">2.3 : <a name="lien_8" class="lien"><?php echo LIEN_SOMMAIRE_8; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_24; ?></li>
									<li><?php echo TEXTE_25; ?></li>
									<li><?php echo TEXTE_26; ?></li>
									<li style="text-align:center;"><img src="<?php echo HTTP_IMAGE; ?>screen2.jpg" alt="<?php echo ATTRIBUT_ALT; ?>"/></li>
									<li class="chapitre">3. : <a name="lien_9" class="lien"><?php echo LIEN_SOMMAIRE_9; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li class="sous-chapitre">3.1 : <a name="lien_10" class="lien"><?php echo LIEN_SOMMAIRE_10; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_27; ?></li>
									<li><?php echo TEXTE_28; ?></li>
									<li><?php echo TEXTE_29; ?></li>
									<li><?php echo TEXTE_30; ?></li>
									<li><?php echo TEXTE_31; ?></li>
									<li><?php echo TEXTE_32; ?></li>
									<li><?php echo TEXTE_33; ?></li>
									<li class="sous-chapitre">3.2 : <a name="lien_11" class="lien"><?php echo LIEN_SOMMAIRE_11; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_34; ?></li>
									<li class="sous-chapitre">3.3 : <a name="lien_12" class="lien"><?php echo LIEN_SOMMAIRE_12; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_35; ?></li>
									<li><?php echo TEXTE_36; ?></li>
									<li><?php echo TEXTE_37; ?></li>
									<li><?php echo TEXTE_38; ?></li>
									<li><?php echo TEXTE_39; ?></li>
									<li><?php echo TEXTE_40; ?></li>
									<li><?php echo TEXTE_41; ?></li>
									<li><?php echo TEXTE_42; ?></li>
									<li><?php echo TEXTE_43; ?></li>
									<li class="sous-chapitre">3.4 : <a name="lien_13" class="lien"><?php echo LIEN_SOMMAIRE_13; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_44; ?></li>
									<li class="point">¤ <?php echo TEXTE_45; ?></li>
									<li class="point">¤ <?php echo TEXTE_46; ?></li>
									<li class="point">¤ <?php echo TEXTE_47; ?></li>
									<li class="point">¤ <?php echo TEXTE_48; ?></li>
									<li class="point">¤ <?php echo TEXTE_49; ?></li>
									<li class="point">¤ <?php echo TEXTE_50; ?></li>
									<li class="point">¤ <?php echo TEXTE_51; ?></li>
									<li class="point">¤ <?php echo TEXTE_52; ?></li>
									<li class="point">¤ <?php echo TEXTE_53; ?></li>
									<li class="point">¤ <?php echo TEXTE_54; ?></li>
									<li class="point">¤ <?php echo TEXTE_55; ?></li>
									<li class="point">¤ <?php echo TEXTE_56; ?></li>
									<li class="point">¤ <?php echo TEXTE_57; ?></li>
									<li class="point">¤ <?php echo TEXTE_58; ?></li>
									<li class="point">¤ <?php echo TEXTE_59; ?></li>
									<li class="point">¤ <?php echo TEXTE_60; ?></li>
									<li class="point">¤ <?php echo TEXTE_61; ?></li>
									<li class="point">¤ <?php echo TEXTE_62; ?></li>
									<li class="point">¤ <?php echo TEXTE_63; ?></li>
									<li><?php echo TEXTE_64; ?></li>
									<li class="sous-chapitre">3.5 : <a name="lien_14" class="lien"><?php echo LIEN_SOMMAIRE_14; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_65; ?></li>
									<li><?php echo TEXTE_66; ?></li>
									<li><?php echo TEXTE_67; ?></li>
									<li><?php echo TEXTE_68; ?></li>
									<li><?php echo TEXTE_69; ?></li>
									<li class="sous-chapitre">3.6 : <a name="lien_15" class="lien"><?php echo LIEN_SOMMAIRE_15; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_70; ?></li>
									<li><?php echo TEXTE_71; ?></li>
									<li><?php echo TEXTE_72; ?></li>
									<li><?php echo TEXTE_73; ?></li>
									<li class="sous-chapitre">3.7 : <a name="lien_16" class="lien"><?php echo LIEN_SOMMAIRE_16; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_74; ?></li>
									<li><?php echo TEXTE_76; ?></li>
									<li><?php echo TEXTE_77; ?></li>
									<li><?php echo TEXTE_78; ?></li>
									<li><?php echo TEXTE_79; ?></li>
									<li><?php echo TEXTE_80; ?></li>
									<li><?php echo TEXTE_81; ?></li>
									<li><?php echo TEXTE_82; ?></li>
									<li class="sous-chapitre">3.8 : <a name="lien_17" class="lien"><?php echo LIEN_SOMMAIRE_17; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_83; ?></li>
									<li><?php echo TEXTE_84; ?></li>
									<li><?php echo TEXTE_85; ?></li>
									<li><?php echo TEXTE_86; ?></li>
									<li><?php echo TEXTE_87; ?></li>
									<li class="sous-chapitre">3.9 : <a name="lien_18" class="lien"><?php echo LIEN_SOMMAIRE_18; ?></a> - <a href="<?php echo HTTP_SERVEUR.FILENAME_CGU; ?>#haut">[<?php echo HAUT; ?>]</a></li>
									<li><?php echo TEXTE_88; ?></li>
								</ul>
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