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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_CONSEILLER_SITE_AMI);
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
						 <?php
					 //-------------------------------------------------------------------------
					 //               FORMULAIRE DE SOUMISSION CONSEILLER CE SITE A UN AMI
					 //-------------------------------------------------------------------------
					
					if(empty($_POST['email_form']) OR $_POST['email_form'] == "........@........"){
						//CREATION DU FORMULAIRE DE SOUMISSION
						echo '<p style="text-align:center;padding-top:15px;">'.TEXTE_PRESENTATION.'</p>';
						
						echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_CONSEILLER_SITE_AMI.'" method="post">' .
								'<div style="width:350px;margin:0 auto;margin-top:80px;text-align:center;">' .
								'<table>' .
								'<tr>' .
								'<td style="padding-top:14px;">'.LIBELLE_INPUT.'</td>' .
								'<td style="padding-top:11px;"><input type="text" name="email_form" value="........@........"/></td>' .
								'<td><input type="image" src="'.HTTP_IMAGE.'bt_rechercher_fr.gif"/></td>' .
								'</tr>' .
								'</table>' .
								'</div>' .
								'</form>';
					}
					else{
						//TRAITEMENT...
						$formulaire_email = minuscule($_POST['email_form']);
						$syntaxeEmail = conformEmail($formulaire_email);
						
						//CAS 1 : VERIFIER SI EMAIL EST VALIDE
						if($syntaxeEmail == 0){
							messageErreur(FORMULAIRE_ERREUR_SYNTAXE_EMAIL);
							redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_CONSEILLER_SITE_AMI);
						}
						//CAS 2 : VERIFIER SI EMAIL EST VIDE
						elseif(empty($formulaire_email)){
							messageErreur(FORMULAIRE_ERREUR_EMAIL_VIDE);
							redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_CONSEILLER_SITE_AMI);
						}
						//CAS 3 : TOUT EST OK....
						else{
							messageErreur(FORMULAIRE_ENVOYE);
							if(LANGUAGE == "es"){
								$contenu='<h1 style="text-align:center;">INVITACIÓN</h1>' .
										'<br /><br />Hola,' .
										'<br />Usted recibe este mensaje porque uno de vuestros amigos ha enviado esta invitación a explorar nuestro sitio.' .
										'<br /><br />Estamos feliz de presentarvos este sitio de intercambio de casa y alojamiento vacaciones gratis !' .
										'<br />Puede usted enseyar el intercambio de vuestra casa para las vacaciones o habitación... y más cosas para descubrir' .
										'<br /><br />El equipo de www.intercambio-de-casa.com dicevos gracias por vuestra confianza.' .
										'<br />Intercambio de casa y alojamiento vacaciones gratis: www.intercambio-de-casa.com' .
										'<br />' .
										'<br /><h3 style="text-align:center;">NO CONTESTA - AUTOMATIC MAIL</h3>';
							}
							
							$codehtml=  '<html>' .
										'<head>' .
										'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
										'</head>' .
										'<body>' .
										''.$contenu.'' .
										'</body>' .
										'</html>';
											
							mail($formulaire_email, HEADER_MAIL, $codehtml,"From: ".MAIL_CORRESPONDANCE."\r\nReply-To: ".MAIL_CORRESPONDANCE."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
							
							redirection('3', HTTP_SERVEUR);
						}
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