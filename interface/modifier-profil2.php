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
includeLanguage(RACINE, LANGUAGE, FILENAME_PROFIL_MODIFIER_2);
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
								if($_GET['action'] == "profil"){
									//TRAITEMENT DE LA PAGE DU FORMULAIRE
									if(empty($_POST['recherche_pays']) 
									OR empty($_POST['requiredCommentaire'])
									OR empty($_POST['email'])){
										redirection('0', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
									}
									else{
										//PASSONS LES DIFFERENTS CAS DE TRAITEMENTS
										$formulaire_domiciliation = minuscule($_POST['recherche_pays']);
										$formulaire_departement = minuscule($_POST['departement']);
										$formulaire_email = minuscule($_POST['email']);
										$requiredCommentaire = textareaLibre($_POST['requiredCommentaire']);
										$commentaire = retrecirMessageTropLong($requiredCommentaire);
										
										$syntaxeEmail = conformEmail($formulaire_email);
										
										if($syntaxeEmail == 0){
											echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_SYNTAXE_EMAIL.'</p>';
											redirection('3', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										}
										//CAS 6 : VERIFIER SI PAYS EST CORRECT
										elseif($formulaire_domiciliation == 0){
											echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_PAYS_NON_SELECTIONNE.'</p>';
											redirection('3', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										}
										//CAS 7 : VERIFIER SI PAYS FRANCE MAIS DEPARTEMENT PAS RENSEIGNE
										elseif($formulaire_domiciliation == 5 AND $formulaire_departement == "x"){
											echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_DEPARTEMENT_NON_SELECTIONNE.'</p>';
											redirection('3', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										}
										else{
											//*********************************************************************************
											//                            ENREGISTREMENT GENERAL
											//*********************************************************************************
											//RENSEIGNER LA TABLE DES NOUVEAUX INSCRITS POUR CONTROLE SUR MODIFICATION
											$modif_existante = $membre->getChamps("date_creation", TABLE_NOUVEAUX_INSCRITS, "identifiant", $_SESSION['id_client']);
											if(empty($modif_existante) AND !empty($_SESSION['id_client'])){
												$metier->insertNouvelleInscription($_SESSION['id_client'], time());
											}
											
											//UPDATE DES TABLES...
											$metier->updateProfil(TABLE_INSCRIPTION, 
																$_SESSION['pseudo_client'], 
																$formulaire_email, 
																$formulaire_domiciliation, 
																$formulaire_departement, 
																$commentaire);
											$metier->updateProfil(TABLE_ONLINE, 
																$_SESSION['pseudo_client'], 
																$formulaire_email, 
																$formulaire_domiciliation, 
																$formulaire_departement, 
																$commentaire);
											
											echo afficherAlerte(FORMULAIRE_MODIFICATION_PARTENAIRE);
											redirection('3', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
										}
									}
								}
								else{
									redirection('0', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
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