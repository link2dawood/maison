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
include(INCLUDE_CLASS_RECHERCHE_AVANCEE);
$rech = new RechercheAvancee();

$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_PLAN_SITE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo TEXTE_29; ?></title>
	<meta name="description" content="<?php echo TEXTE_30; ?>"/>
	<meta name="keywords" content="<?php echo TEXTE_31; ?>"/>
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
			<h1><?php echo TEXTE_29; ?></h1>
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
						<div class="corps_top_developpement"><?php echo TEXTE_29; ?></div>
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
						 	<div>
								<ul>
								<?php
								//Traitement de la page
								$chateau = 1;
								$manoir = 2;
								$villa = 3;
								$maison = 4;
								$appartement = 5;
								$chambre = 6;
								$domicile = 7;
								$hebergement = 8;
								
								$france = 5;
								
								
								if($rech->compterTypeEnLigne($france,$appartement) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$appartement.'.php">'.TEXTE_32.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$chambre) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$chambre.'.php">'.TEXTE_33.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$maison) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$maison.'.php">'.TEXTE_34.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$villa) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$villa.'.php">'.TEXTE_35.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$chateau) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$chateau.'.php">'.TEXTE_36.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$manoir) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$manoir.'.php">'.TEXTE_37.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$hebergement) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$hebergement.'.php">'.TEXTE_38.'</a></li>';
								}
								
								if($rech->compterTypeEnLigne($france,$domicile) != 0){
									echo '<li style="padding-top:10px;"><img src="'.HTTP_IMAGE.'fleche_gauche.png" alt="'.ATTRIBUT_ALT.'" /> <a href="'.HTTP_SERVEUR.'departements-france-'.$domicile.'.php">'.TEXTE_39.'</a></li>';
								}
								?>
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