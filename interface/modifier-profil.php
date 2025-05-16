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
includeLanguage(RACINE, LANGUAGE, FILENAME_PROFIL_MODIFIER);
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
			<h1><?php echo H1; ?></h1>
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
						<div class="corps_top_developpement"><?php echo TITRE_PROFIL; ?></div>
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
							 $profil = $metier->getOnlineMembre($_SESSION['id_client']);
							 $naissance = dateNaissance($profil[9]);
							 $date_inscription = $metier->getChamps("date_inscription", TABLE_INSCRIPTION, "id", $_SESSION['id_client']);
							 ?>
							 <div id="modifier_profil">
								<form action="<?php echo HTTP_SERVEUR; ?>interface/<?php echo FILENAME_PROFIL_MODIFIER_2.'?action=profil'; ?>" method="post" enctype="multipart/form-data">
									<table style="width:100%;">
										<tr>
											<td colspan="2" class="titre"><?php echo DONNEES_PERSO; ?></td>
										</tr>
										<tr>
											<td class="libelle"><?php echo MON_PSEUDO; ?></td>
											<td class="donnee"><strong><?php echo $_SESSION['pseudo_client']; ?></strong></td>
										</tr>
										<tr>
											<td class="libelle"><?php echo DATE_INSCRIPTION; ?></td>
											<td class="donnee"><?php echo date("d/m/y", $date_inscription); ?></td>
										</tr>
										<tr>
											<td class="libelle"><?php echo MON_EMAIL; ?></td>
											<td class="donnee"><input type="text" name="email" value="<?php echo $profil[6]; ?>" class="input_email"/></td>
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
											<td class="libelle"><?php echo MON_PAYS; ?></td>
											<td class="donnee">
											<?php
													//AFFICHER LES OPTIONS DE PAYS
													$tab_pays = $metier->getPays('recherche_pays', LANGUAGE, $profil[7]);
													foreach($tab_pays as $cle_pays){
														echo $cle_pays;
													}
												?>
											</td>
										</tr>
										<tr>
											<td class="libelle"><?php echo MON_DEPARTEMENT; ?></td>
											<td class="donnee">
											<?php
												//CHARGEMENT DES DEPARTEMENTS...
												if(empty($profil[8])){
													//PAS DE PAYS FRANCE SELECTIONNE
													include(INCLUDE_DEPARTEMENT_ACCUEIL);
												}
												else{
													$tab_departement = $metier->getDepartement('departement', "departement_".LANGUAGE, $profil[8]);
														foreach($tab_departement as $cle_departement){
															echo $cle_departement;
														}
												}
											  ?>
											</td>
										</tr>
										<tr>
											<td class="libelle"><?php echo MA_DATE_DE_NAISSANCE; ?></td>
											<td class="donnee"><?php echo formaterChiffre($naissance[0]); ?>/<?php echo formaterChiffre($naissance[1]); ?>/<?php echo $naissance[2]; ?></td>
										</tr>
										<tr>
											<td class="libelle"><?php echo MA_DESCRIPTION; ?></td>
											<td class="donnee"><textarea name="requiredCommentaire" rows="10" cols="50"><?php echo str_replace('<br />', '', $profil[13]); ?></textarea></td>
										</tr>
										<tr>
											<td colspan="2" class="msg"><?php echo CHAMPS_OBLIGATOIRE_TEXTE; ?></td>
										</tr>
										<tr>
											<td colspan="2" class="sub"><input type="image" src="<?php echo HTTP_IMAGE.SUBMIT_FORMULAIRE; ?>" alt="rencontre"/></td>
										</tr>
									</table>
								</form>
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
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.'"><img src="'.HTTP_IMAGE.'bt_inscription.jpg" alt="rencontre"/></a></div>';
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