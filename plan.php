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
includeLanguage(RACINE, LANGUAGE, FILENAME_PLAN_SITE);
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
						 	<ul>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHATEAU; ?>" title="<?php echo TEXTE_1; ?>"><?php echo TEXTE_1; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MANOIR; ?>" title="<?php echo TEXTE_2; ?>"><?php echo TEXTE_2; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_VILLA; ?>" title="<?php echo TEXTE_3; ?>"><?php echo TEXTE_3; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_MAISON; ?>" title="<?php echo TEXTE_4; ?>"><?php echo TEXTE_4; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_APPARTEMENT; ?>" title="<?php echo TEXTE_5; ?>"><?php echo TEXTE_5; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_ECHANGE_DE_CHAMBRE; ?>" title="<?php echo TEXTE_6; ?>"><?php echo TEXTE_6; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_RECEVOIR_A_DOMICILE; ?>" title="<?php echo TEXTE_7; ?>"><?php echo TEXTE_7; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_RECHERCHE_HEBERGEMENT; ?>" title="<?php echo TEXTE_8; ?>"><?php echo TEXTE_8; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" />
								 <a href="<?php echo HTTP_MOTEUR_MAISON; ?>index.php?page=1" title="<?php echo TEXTE_9; ?>"><?php echo TEXTE_9; ?></a>
								 <?php
								 /*for($i=1;$i<=20;$i++){
								 	?>
								 	 | <a href="<?php echo HTTP_MOTEUR_MAISON; ?>index.php?page=<?php echo $i; ?>" title="<?php echo TEXTE_9; ?> (<?php echo $i; ?>)"><?php echo $i; ?></a>
								 	<?php
								 }*/
								 ?>
								  </li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_BLOG; ?>" title="<?php echo TEXTE_10; ?>"><?php echo TEXTE_10; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT; ?>" title="<?php echo TEXTE_11; ?>"><?php echo TEXTE_12; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_FRANCE; ?>" title="<?php echo TEXTE_13; ?>"><?php echo TEXTE_14; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_GUYANE_FR; ?>" title="<?php echo TEXTE_15; ?>"><?php echo TEXTE_16; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_MAROC; ?>" title="<?php echo TEXTE_17; ?>"><?php echo TEXTE_18; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_ALGERIE; ?>" title="<?php echo TEXTE_19; ?>"><?php echo TEXTE_20; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_ALLEMAGNE; ?>" title="<?php echo TEXTE_21; ?>"><?php echo TEXTE_22; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_PLAN_DEPT_GUADELOUPE; ?>" title="<?php echo TEXTE_23; ?>"><?php echo TEXTE_24; ?></a></li>
								<li style="padding-top:10px;"><img src="<?php echo HTTP_IMAGE; ?>fleche_gauche.png" alt="<?php echo ATTRIBUT_ALT; ?>" /> <a href="<?php echo HTTP_SERVEUR.FILENAME_VOYAGE; ?>" title="<?php echo TEXTE_59; ?>"><?php echo TEXTE_59; ?></a></li>
							</ul>
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