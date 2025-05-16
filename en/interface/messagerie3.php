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

//RECUPERER LES ELEMENTS DU MEMBRE SELECTIONNE
$info_membre = $membre->getInscription($_GET['id']);
$membre_online = $metier->getChamps("pseudo", TABLE_ONLINE, "identifiant", $_GET['id']);
$naissance = dateNaissance($info_membre[10]);
$annee = $naissance[2];

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_MESSAGERIE);
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
<!-- DEBUT EXTERIEUR -->
<div id="exterieur">
	<!-- PARTIE ENTETE -->
	<div id="entete">
			<div id="logo">
				<ul>
					<li><a href="<?php echo HTTP_SERVEUR; ?>"><?php echo LOGO; ?></a></li>
					<li><?php echo PHRASE_LOGO; ?></li>
				</ul>
			</div>
		<?php echo afficherLogin($_SESSION['pseudo_client'], HTTP_SERVEUR); ?>
	</div>
	
	<!-- CORPS DE PAGE -->
	<div id="corps">
		<div id="alignement">&nbsp;</div>
		<table id="developpement">
			<tr>
				<!-- COLONNE TOP -->
				<td id="col_top" colspan="3">
					<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
					<h1 style="text-align:center;">
						<?php 
						//VERIFIER CONNEXION
						if($membre_online != ""){
							//MEMBRE ONLINE
							echo H1_ONLINE;
						}
						else{
							//MEMBRE OFFLINE
							echo H1_OFFLINE;
						}
						?>
					</h1>
					<?php include(INCLUDE_ANNONCE_PUBLICITE); ?>
					<table class="info_salon_webcam">
						<tr>
							<!-- ESPACE INFORMATIONS EN DIRECT -->
							<td class="td_info">
								<table class="info">
									<tr>
										<td class="titre_info"><?php echo TITRE_INFORMATIONS; ?></td>
									</tr>
									<tr>
										<td><?php 
										//AFFICHER LES INFOS EN DIRECT...
										echo afficherInformationsEnDirect($membre->afficherDerniereInfo($_SESSION['id_client'], $_SESSION['pseudo_client']));
										?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<?php include(INCLUDE_MENU_ESPACE_MEMBRE_2); ?>
					</td>
			</tr>
			<tr>
				<!-- COLONNE GAUCHE -->
				<td id="col_gauche"></td>
				<!-- COLONNE CENTRALE -->
				<td id="col_central">
					<?php
					//LA DEMANDE EST PAS VALIDE
					if($_GET['genre'] == "" OR $_GET['action'] == "" OR $_GET['method'] == "" OR $_GET['id'] == "" OR $_GET['m'] == ""){
						echo redirection('0', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
					}
					//EXPEDITEUR DU MESSAGE = MEMBRE => ANNULE DEMANDE MESSAGE
					elseif($info_membre[1] == $_SESSION['pseudo_client']){
						echo '<p class="message_erreur">'.MESSAGE_EXPEDITEUR_ANNULE.'</p>';
						redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
					}
					else{
						//TRAITEMENT 
						if($_GET['genre'] == "messenger"){
							//CAS 1 : MESSENGER
							if($_GET['action'] == "demande-duo"){
								if($_GET['method'] == "confirmer"){
									//SUPPRESSION DES AUTRES DEMANDES DE DUO
									$membre->deleteMessenger($_SESSION['id_client'], "demande-duo", "id_expediteur", "genre");
									
									echo formulaireMessengerDuo(HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE_2, 
																'post', 
																afficherMiniature($info_membre[0], $info_membre[1], $info_membre[11], $info_membre[12]), 
																$info_membre[1], 
																date("Y", time()) - $annee.' '.AGE, 
																$metier->getChamps('nomdept', 'departement_'.LANGUAGE, 'numdept', $info_membre[9]), 
																$metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $info_membre[8]), 
																iconeConnexion('1'), 
																'messenger', 
																$_GET['action'], 
																TITRE_MESSAGE_DUO, 
																PHRASE_MESSAGE_DEMANDE_DUO, 
																SUBMIT_MESSAGE_DEMANDE_DUO, 
																SUBMIT_MESSAGE_DEMANDE_DUO_ANNULER,
																$info_membre[0]);
								}
								elseif($_GET['method'] == "supprimer"){
									echo '<p class="message_erreur">'.$membre->getErreur('6').'</p>';
									
									//INSERER DANS LA TABLE DES INFOS
									$membre->ajouterMessageInformationsDirect(addslashes($membre->getErreur('6')), $_SESSION['id_client'], $_SESSION['pseudo_client'], time());
								
									echo redirection(RAFRAICHISSEMENT_MESSAGES_MESSENGER, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
								}
								else{
									echo redirection('0', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
								}
							}
						}
						else{
							//CAS 3 : ERREUR...
							echo redirection('0', HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
						}
					}
					?>
				</td>
				<!-- COLONNE DROITE -->
				<td id="col_droite">
					<!-- MESSENGER -->
					<?php include(INCLUDE_MESSENGER); ?>
				</td>
			</tr>
			<tr>
				<!-- COLONNE BOTTOM -->
				<td id="col_bottom" colspan="3">
					<!-- DERNIERS INSCRITS -->
					<?php include(INCLUDE_DERNIERS_INSCRITS); ?>
				</td>
			</tr>
		</table>
		<div id="spacer"></div>
	</div>
	
	<!-- BAS CORPS DE PAGE -->
	<div id="bas_corps">&nbsp;</div>
	
	<!-- FOOTER -->
	<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
	<?php echo connexionON(); ?>
</div>
<!-- FIN EXTERIEUR -->		
		<?php
	}
?>
<!-- FIN EXTERIEUR -->
</body>
</html>
