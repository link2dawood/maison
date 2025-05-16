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
includeLanguage(RACINE, LANGUAGE, FILENAME_PASSE_PERDU);
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
						 	if(empty($_POST['valider'])){
							//CREATION DU FORMULAIRE DE SOUMISSION
							echo '<p style="text-align:center;padding-top:15px;">'.TEXTE_PRESENTATION.'</p>';
							
							echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_PASSE_PERDU.'" method="post">' .
									'<div style="text-align:center;padding-top:50px;padding-bottom:10px;">' .
									''.LIBELLE_INPUT.'&nbsp;' .
									'<input type="text" name="email_form"/>&nbsp;' .
									'<input type="submit" name="valider" value="'.BT_PASSE_PERDU.'"/>' .
									'</div>' .
									'</form>';
							}
							else{
								//TRAITEMENT...
								$formulaire_email = minuscule($_POST['email_form']);
								$syntaxeEmail = conformEmail($formulaire_email);
								$ControleBaseEmail = $metier->controleExistence('email', $formulaire_email, TABLE_INSCRIPTION);
								
								//RECUPERATION IDENTIFIANT DU COMPTE
								$getPseudo = $metier->getChamps('pseudo', TABLE_INSCRIPTION, 'email', $formulaire_email);
								$getPasse = $metier->getChamps('passe', TABLE_INSCRIPTION, 'email', $formulaire_email);
								
								//CAS 1 : VERIFIER SI EMAIL EST VALIDE
								if($syntaxeEmail == 0){
									echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_SYNTAXE_EMAIL.'</p>';
									redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_PASSE_PERDU);
								}
								//CAS 2 : VERIFIER SI EMAIL EST VIDE
								elseif(empty($formulaire_email)){
									echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_EMAIL_VIDE.'</p>';
									redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_PASSE_PERDU);
								}
								//CAS 3 : VERIFIER SI EMAIL EST EXISTANT DANS LA BASE
								elseif($ControleBaseEmail == 0){
									echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ERREUR_EMAIL_DEJA_UTILISE.'</p>';
									redirection('3', HTTP_SERVEUR.'interface/'.FILENAME_PASSE_PERDU);
								}
								//CAS 4 : TOUT EST OK....
								elseif($ControleBaseEmail > 0){
									echo '<p style="font-size:20px;font-weight:bolder;text-align:center;padding-top:80px;padding-bottom:400px;">'.FORMULAIRE_ENVOYE.'</p>';
									if(LANGUAGE == "fr"){
										$contenu='<h1 style="text-align:center;">LOGIN</h1>' .
												'<br /><br />Hi,' .
												'<br /><br />Find out below your informations datas:' .
												'<br /><span style="text-decoration:underline;">login :</span> <strong>'.$getPseudo.'</strong>' .
												'<br /><span style="text-decoration:underline;">Password :</span> <strong>'.$getPasse.'</strong>' .
												'<br /><br />All the team of www.home-exchange.biz thank you for your trust.' .
												'<br />' .
												'<br /><h3 style="text-align:center;">DO NOT REPLY - AUTOMATIC MAIL</h3>';
									}
									
									envoyerUnMail($formulaire_email, HEADER_MAIL, $contenu, MAIL_CORRESPONDANCE, MAIL_CORRESPONDANCE);
									
									redirection('3', HTTP_SERVEUR);
								}
								else{
									redirection('0', HTTP_SERVEUR.'interface/'.FILENAME_PASSE_PERDU);
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
									echo '<div class="img_invitation_hors_connexion"><a href="'.HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION.'"><img src="'.HTTP_IMAGE.BT_INSCRIPTION_GRATUITE.'" alt="'.ATTRIBUT_ALT.'"/></a></div>';
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