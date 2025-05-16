<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/configuration.php');
include(INCLUDE_FCTS_UTILE);
include(INCLUDE_CLASS_METIER);
$metier = new Metier();
include(INCLUDE_CLASS_ESPACE_MEMBRE);
$membre = new EspaceMembre();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_INDEX);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta name="verify-v1" content="W1Lx+T5A6ZWJFQCwN6xBECvxiaB/KtAqP/sidK7TgvI=" >
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo HTTP_SERVEUR; ?>echange-maison.xml" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
</head>
<body>
<!-- DEBUT EXTERIEUR -->
<div id="exterieur">
	<div id="back">
		<!-- PARTIE ENTETE -->
		<div id="entete">
			<div id="logo">
				<ul>
					<li><a href="<?php echo HTTP_SERVEUR; ?>"><?php echo LOGO; ?></a></li>
					<li><?php echo PHRASE_LOGO; ?></li>
				</ul>
			</div>
			<?php echo afficherLogin($_SESSION['pseudo_client'], HTTP_SERVEUR); ?>
			<h1><?php echo BALISE_H1; ?></h1>
		</div>
		<!-- PARTIE BANNIERE -->
		<div id="banniere">
			<div id="texte"><?php echo TEXTE_BANNIERE_ACCUEIL; ?></div>
		</div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		
		<!-- Echange de maison avec webcam -->
		<div id="bloc_central">
			<table class="conteneur">
				<tr>
					<td class="info">
						<!-- Bloc Informations -->
						<h2 class="h2_0"><?php echo COL_CENTRALE_TITRE; ?></h2>
						<h2 class="h2_1"><?php echo COL_CENTRALE_H2_MAISON; ?></h2>
						<p class="texte"><?php echo COL_CENTRALE_TXT_MAISON; ?></p>
						<h2 class="h2_2"><?php echo COL_CENTRALE_H2_COUCH; ?></h2>
						<p class="texte"><?php echo COL_CENTRALE_TXT_COUCH; ?></p>
						<h2 class="h2_3"><?php echo COL_CENTRALE_H2_WEBCAM; ?></h2>
						<p class="texte"><?php echo COL_CENTRALE_TXT_WEBCAM; ?></p>
					</td>
					<td class="rubriques">
						<!-- Bloc Rubriques échange de maison et couch surfing -->
						<h2 class="h2_0"><?php echo COLONNE_DROITE_TITRE; ?></h2>
						<!-- Bloc Onglets échange de maison et couch surfing -->
						<div id="tabbed_box_1" class="tabbed_box">
						    <div class="tabbed_area">   
						        <ul class="tabs">
								    <li><a href="javascript:ChangeOnglet('tab_1', 'content_1');" id="tab_1" class="active"><?php echo ANCHOR_1; ?></a></li>
								    <li><a href="javascript:ChangeOnglet('tab_2', 'content_2');" id="tab_2"><?php echo ANCHOR_2; ?></a></li>
								    <li><a href="javascript:ChangeOnglet('tab_3', 'content_3');" id="tab_3"><?php echo ANCHOR_3; ?></a></li>
								</ul>
								<!-- Bloc Onglets échange de maison -->
						        <div id="content_1" class="content">
						        	<div id="img_1"><img src="<?php echo HTTP_IMAGE; ?>accueil_1_fr.jpg" alt="<?php echo ATTRIBUT_ALT; ?>"/></div>
						        	<p class="text"><?php echo ACCROCHE; ?></p>
						        	<p style="clear:left;"></p>
									<h3><?php echo MODULE_ECHANGE_MAISON_H3; ?></h3>
									<?php include(INCLUDE_MODULE_ECHANGE_MAISON); ?>
									<h3><?php echo ONGLET_MOTEUR_RECHERCHE_H3; ?></h3>
									<div id="moteur">
										<form action="<?php echo HTTP_SERVEUR.FILENAME_MOTEUR_MAISON; ?>" method="get">
											<table>
												<tr>
													<td><input type="text" name="Rechercher" value="" style="margin-left:137px;"/></td>
													<td><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_RECHERCHER; ?>" class="bt_envoyer" style="margin-left:25px;"/></td>
												</tr>
											</table>
										</form>
									</div>
									<h4><?php echo MODULE_ECHANGE_MAISON_H4; ?></h4>
									<?php include(INCLUDE_MODULE_ECHANGE_MAISON_DERNIERS_INSCRITS); ?>
						        </div>
						        <!-- Bloc Onglets couch surfing -->
						        <div id="content_2" class="content">
						        	<div id="img_2"><img src="<?php echo HTTP_IMAGE; ?>accueil_3_fr.jpg" alt="<?php echo ATTRIBUT_ALT; ?>"/></div>
									<p class="text"><?php echo TEXTE_COUCHSURFING; ?></p>
									<p style="clear:left;"></p>
									<h3><?php echo MODULE_COUCHSURFING_H3; ?></h3>
									<?php include(INCLUDE_MODULE_COUCHSURFING); ?>
									<h3><?php echo ONGLET_MOTEUR_RECHERCHE_H3; ?></h3>
									<div id="moteur">
										<form action="<?php echo HTTP_SERVEUR.FILENAME_MOTEUR_MAISON; ?>" method="get">
											<table>
												<tr>
													<td><input type="text" name="Rechercher" value="" style="margin-left:137px;"/></td>
													<td><input type="image" src="<?php echo HTTP_IMAGE.BOUTON_RECHERCHER; ?>" class="bt_envoyer" style="margin-left:25px;"/></td>
												</tr>
											</table>
										</form>
									</div>
									<h4><?php echo MODULE_COUCHSURFING_H4; ?></h4>
									<?php include(INCLUDE_MODULE_COUCHSURFING_DERNIERS_INSCRITS); ?>
						        </div>
						        <!-- Bloc Onglets moteur de recherche -->
						        <div id="content_3" class="content">
						        	<div id="img_3"><img src="<?php echo HTTP_IMAGE; ?>accueil_2_fr.jpg" alt="<?php echo ATTRIBUT_ALT; ?>"/></div>
									<p class="text"><?php echo ONGLET_MOTEUR_RECHERCHE; ?></p>
									<p style="clear:left;"></p>
									<p style="font-size:14px;text-decoration:underline;padding-top:7px;"><?php echo ESPACE_COMMUNICATION_4; ?></p>
									<p style="padding-top:2px;"><?php echo ESPACE_COMMUNICATION_1; ?></p>
									<p style="padding-top:2px;"><?php echo ESPACE_COMMUNICATION_2; ?></p>
									<p style="font-size:14px;text-decoration:underline;padding-top:7px;"><?php echo ESPACE_COMMUNICATION_5; ?></p>
									<p style="padding-top:2px;"><?php echo ESPACE_COMMUNICATION_3; ?></p>
									<p style="padding-top:2px;"><a href="<?php echo HTTP_SERVEUR.FILENAME_CONSEILS; ?>"><?php echo HYPERLIEN_CONSEILS_ASTUCES; ?></a></p>
									<p style="font-size:14px;text-decoration:underline;padding-top:7px;"><?php echo ESPACE_COMMUNICATION_6; ?></p>
									<p style="padding-top:2px;"><a href="<?php echo HTTP_COMMENTAIRES; ?>"><?php echo HYPERLIEN_COMMENTAIRES; ?></a></p>
									<p style="padding-top:2px;"><a href="<?php echo HTTP_SERVEUR.FILENAME_CONTACT; ?>"><?php echo FOOTER_CONTACT; ?></a></p>
									<!-- Recommander ce site échange de maison et couch surfing -->
									<div id="recommanderSite">
										<h3><?php echo ONGLET_MOTEUR_RECHERCHE_H3_3; ?></h3>
										<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_CONSEILLER_SITE_AMI; ?>" method="post">
											<table>
												<tr>
													<td><?php echo ONGLET_MOTEUR_RECHERCHE_RECOMMANDER_LIBELLE; ?></td>
													<td><input type="text" name="email_form" value="........@........"/></td>
													<td><input type="image" src="<?php echo HTTP_IMAGE; ?>bt_rechercher_fr.gif" class="bt_envoyer"/></td>
												</tr>
											</table>
										</form>
									</div>
						        </div>   
						    </div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<!-- Blog échange de maison + couchsurfing -->
		<?php include(INCLUDE_MODULE_DERNIERS_ARTICLES_BLOG); ?>
		<!-- Liens échange de maison + couchsurfing -->
		<?php include(INCLUDE_FOOTER_LIENS); ?>
		<!-- Liens partenaires échange de maison + couchsurfing -->
		<?php include(INCLUDE_FOOTER_PARTENAIRES); ?>
		<!-- Bas de page -->
		<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
		<?php echo connexionON(); ?>
	</div>
</div>
<!-- FIN EXTERIEUR -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7146913-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>