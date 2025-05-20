<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('./interface/applications/commun/fct-utile.php');
include('./config.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
include('./interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('./interface/applications/classes/class.Metier.php');


require_once('./interface/applications/commun/configuration.php');
$metier = new Metier();

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_PLAN_SITE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo TEXTE_8; ?></title>
	<meta name="description" content="<?php echo TEXTE_8; ?>"/>
	<meta name="keywords" content="<?php echo TEXTE_8; ?>, <?php echo HEADER_KEYWORDS; ?>"/>

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
			
			<h1><?php echo TEXTE_8; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client'] ?? ''); ?></div>
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
						<div class="corps_top_developpement"><?php echo TEXTE_8; ?></div>
						<div class="bord_droit"></div>
					</td>
					<!-- PARTIE TCHAT -->
					<td class="titre_tchat">
						<div class="bord_gauche"></div>
						<div class="corps_top_tchat">
</div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
						 	<?php
						 	echo '<table id="tabListMoteur">' .
						 					'<tr>' .
						 					'<td>';
						 			$listing_pays = $metier->afficherTousLesPays(LANGUAGE,0,50,8);
						 			foreach($listing_pays as $cle){
						 				echo $cle;
						 			}
						 			echo '</td>' .
						 					'<td>';
						 			$listing_pays_1 = $metier->afficherTousLesPays(LANGUAGE,50,50,8);
						 			foreach($listing_pays_1 as $cle){
						 				echo $cle;
						 			}
						 			echo '</td>' .
						 					'<td>';
						 			$listing_pays_2 = $metier->afficherTousLesPays(LANGUAGE,100,50,8);
						 			foreach($listing_pays_2 as $cle){
						 				echo $cle;
						 			}	
						 			echo '</td>' .
						 					'<td>';
						 			$listing_pays_3 = $metier->afficherTousLesPays(LANGUAGE,150,50,8);
						 			foreach($listing_pays_3 as $cle){
						 				echo $cle;
						 			}
						 			echo '</td>' .
						 					'<td>';
						 			$listing_pays_4 = $metier->afficherTousLesPays(LANGUAGE,200,50,8);
						 			foreach($listing_pays_4 as $cle){
						 				echo $cle;
						 			}		
						 			echo '</td>' .
						 					'</tr>' .
						 					'</table>';
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