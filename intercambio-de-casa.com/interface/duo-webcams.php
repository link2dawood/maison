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

//$metier->controleConnexionMetier(time(), $_SESSION['id_client'], $_SESSION['pseudo_client']);

//--------------------------------CONTROLE PAGE DE PAIEMENT ------------------------------------
$mon_compte = $metier->getInscriptionMembre($_SESSION['id_client']);
$controle_acces = controleAcces($mon_compte[4], $mon_compte[5]);
$periode_accepte = PERIODE_PAIEMENT_GRATUIT + $mon_compte[3];
//--------------------------------CONTROLE ACCES PAR TABLE UTILISATEUR----------------------------
$acces_paiements = $metier->getComptePaiement($_SESSION['pseudo_client']);
$date_cloture = strtotime($acces_paiements[2]);
		
	if($periode_accepte > time() 
	OR $controle_acces == 1 
	OR $acces_paiements[4] == 1 
	OR $acces_paiements[3] == 1 
	OR $date_cloture > time()){
		//AUTORISATION....
		//---- ACTIVER LE DUO ------------
		$messenger = $membre->getMessenger(minuscule($_GET['id_msg']));
		//METTRE LE MEMBRE EN CONNEXION...
		$controle_presence = $membre->getChamps("id", TABLE_LISTE_MEMBRES_CONNECTER_DUO, "id_membre", $_SESSION['id_client']);
		if($controle_presence == NULL){
			$membre->connecterMembreDuo($_SESSION['id_client']);
		}
		
		if($_GET['action'] == "activer-duo"
		AND is_numeric($_GET['id_msg']) 
		AND is_numeric($_GET['id_exp']) 
		AND $_GET['p_exp'] != NULL){
			
			$membre->envoyerConfirmationDuo($messenger[4],//id expéditeur
											$messenger[5],//pseudo_expediteur
											$messenger[2],//id destinataire
											$messenger[3],//pseudo destinataire
											"activer-duo",//champ DUO
											"non",//message lu ou non
											minuscule($_GET['id_msg']));
		}
		elseif($_GET['action'] == "confirmation"
		AND is_numeric($_GET['id_msg']) 
		AND is_numeric($_GET['id_exp']) 
		AND $_GET['p_exp'] != NULL){
			$membre->envoyerConfirmationDuo($messenger[2],//id expéditeur
											$messenger[3],//pseudo_expediteur
											$messenger[4],//id destinataire
											$messenger[5],//pseudo destinataire
											"activer-duo",//champ DUO
											"oui",//message lu ou non
											minuscule($_GET['id_msg']));
		}
		else{
			redirection(0, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
		}
	}
	else{
		echo activerPaiement($mon_compte[4], $mon_compte[5], $mon_compte[6], $mon_compte[8], $mon_compte[1], $mon_compte[3]);
	}
//----------------------------------------------------------------------------------------------

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_DUO_WEBCAMS);
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
	<script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'fenetre',
		    '<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MAJ_MESSAGES_DUO.'?id_exp='.$_GET['id_exp'].'&p_exp='.$_GET['p_exp'].'&id_msg='.$_GET['id_msg']; ?>',
		    {
		        frequency: <?php echo RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS; ?>
		    }
		);
    </script>
</head>
<body onBeforeUnload="fermerNavigateur(<?php echo $_GET['id_msg']; ?>, <?php echo $_GET['id_exp']; ?>)">

<!-- DEBUT EXTERIEUR -->
<?php
//<body onBeforeUnload="fermerNavigateur('.$_GET['id_msg'].', '.$_GET['id_exp'];)">

	if(empty($_SESSION['pseudo_client'])){
		//RENVOI ACCUEIL
		echo redirection('0', HTTP_SERVEUR);
	}
	else{
		//DEVELOPPEMENT DUO....
		?>
<div id="exterieur_duo">
	<!-- CORPS DE PAGE -->
	<div id="corps">
		<div id="alignement">&nbsp;</div>
		<table id="developpement">
			<tr>
				<td style="text-align:center;">
					<img src="<?php echo HTTP_IMAGE; ?>ban_duo.png" alt="icone"/>
				</td>
			</tr>
			<tr>
				<td class="cam_1">
					<table id="fenetre_conversation">
						<tr>
							<td>
								<div id="bloc_message_webcam">
								<p style="font-weight:bolder;font-size:16px;"><?php echo TITRE_ESPACE_CONVERSATION; ?></p>
									<div id="fenetre">
										<iframe src ="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MAJ_MESSAGES_DUO.'?id_exp='.$_GET['id_exp'].'&p_exp='.$_GET['p_exp'].'" width="'.FENETRE_WIDTH_MESSAGES_DUO_WEBCAMS.'" height="'.FENETRE_HEIGHT_MESSAGES_DUO_WEBCAMS; ?>">
											<p>Your browser does not support iframes.</p>
										</iframe>
									</div>
									<br />
									<div class="formulaire_envoi">
										<form>
											<ul>
												<li style="font-weight:bolder;"><?php echo TITRE_COMMENTAIRE; ?></li>
												<li style="text-align:right;">
													<img src="<?php echo HTTP_IMAGE; ?>fleche_ecrire.png" alt="icone"/> <textarea name="commentaire" id="message" cols="65" rows="4"></textarea>
													<input type="hidden" id="id_client" name="id_client" value="<?php echo $_SESSION['id_client']; ?>"/>
													<input type="hidden" id="pseudo_client" name="pseudo_client" value="<?php echo $_SESSION['pseudo_client']; ?>"/>
													<input type="hidden" id="id_exp" name="id_exp" value="<?php echo $_GET['id_exp']; ?>"/>
													<input type="hidden" id="p_exp" name="p_exp" value="<?php echo $_GET['p_exp']; ?>"/>
												</li>
												<li style="text-align:right;"><input type="button" name="bt_submit" onClick="SendForm()" value="<?php echo SUBMIT_COMMENTAIRE; ?>"/></li>
											</ul>
										</form>
									</div>
								</div>
							</td>
							<td class="partie_droite">
								<table id="tab_droite">
									<tr>
										<td class="titre_fermeture_duo"><?php echo INFO_FERMETURE_DUO; ?></td>
									</tr>
									<tr>
										<td class="text_fermeture_duo"><?php echo TEXT_EXPLICATIF_FERMETURE_DUO; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;"><a href="<?php echo HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE.'?type=retour-duo&id_msg='.$_GET['id_msg']; ?>"><img src="<?php echo HTTP_IMAGE; ?>bt_sortir_duo_fr.png" alt="icone"/></a></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<p class="text_cam"><em><?php echo MESSAGE_ALERTE; ?></em></p>
				</td>
			</tr>
		</table>
		<div id="spacer"></div>
	</div>
	
	<!-- BAS CORPS DE PAGE -->
	<div id="bas_corps">&nbsp;</div>
	<?php echo connexionON(); ?>
</div>	
		<?php
	}
?>
<!-- FIN EXTERIEUR -->
</body>
</html>