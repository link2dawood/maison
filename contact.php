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

//***LUTTE ANTI-SPAM***
mt_srand((float) microtime()*1000000);
$nb = mt_rand(0, 100000);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_CONTACT);
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
						 	<?php
							 //-------------------------------------------------------------------------
							 //               CONDITIONS GENERALES UTILISATIONS
							 //-------------------------------------------------------------------------
							if(empty($_POST['requiredRaisonMessage']) OR empty($_POST['requiredCommentaire']) OR empty($_POST['requiredEmail']) OR empty($_POST['image'])){
								//Formulaire de contact...
								echo formulaireDeContact($nb);
							}
							else{
							$verifSpam = "K".$_POST['num']."s";
							$aVerifier = $_POST['image'];
							
								if($aVerifier != $verifSpam){
									echo afficherAlerte('<img src="'.HTTP_IMAGE.'progressbar.gif" alt="progressbar" /><br />Nous sommes désolé mais le code <span style="font-weight:bolder;color:red;font-size:16px;">'.$aVerifier.'</span> n\'est pas conforme!');
									redirection(3, HTTP_SERVEUR.FILENAME_CONTACT);
								}
								else{
									//***************************************************************************************************
									//                                       CONTROLE DU MAIL
									//***************************************************************************************************
									
									//---------------RECUPERATION DES DONNEES----------------------------------------------------------------------------------------------------------------------------------------------------------------------
									$time = time();
									$DateEnregistrement = date("d/m/Y", $time);
									
									$RaisonMessage = textFormater($_POST['requiredRaisonMessage']);
									
									$Commentaire = textareaFormater($_POST['requiredCommentaire']);
									
									$Email = minuscule($_POST['requiredEmail']);
							
									if (isset($Email)){
										$verifEmail = conformEmail($Email);
										
										if ($verifEmail == 1){
											//---------------------------------------------------------------------------------------------------------------------------------------------------
											//                                  ENVOI DES INFORMATIONS SUR LA BOITE EMAIL
											//---------------------------------------------------------------------------------------------------------------------------------------------------
											$destinataire = MAIL_CORRESPONDANCE;
											$expediteur   = $Email;
											$reponse      = $expediteur;
			
											$codehtml=
											"<html><body>" .
											"<h1 style=\"text-align:center;\">FORMULAIRE DE CONTACT</h1><br/>".
											"<br /><br />Date du message: <span style=\"font-weight:bolder;color:red;\">".$DateEnregistrement."</span>".
											"<br /><br />Raison du message: <span style=\"font-weight:bolder;color:red;\">".$RaisonMessage."</span>".
											"<br /><br />Commentaire: <span style=\"font-weight:bolder;color:red;\">".$Commentaire."</span>".
											"<br /><br />Son email: <span style=\"font-weight:bolder;color:red;\">".$Email."</span>".
											"</body></html>";
											mail($destinataire,
												     "CONTACT",
											     $codehtml,
											     "From: ".$expediteur."\r\nReply-To: ".$reponse."\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\n");
											
											echo afficherAlerte('<img src="'.HTTP_IMAGE.'progressbar.gif" alt="progressbar" /><br />Félicitations <br />Votre message a été soumis avec succés!!<br/>Votre demande va être traitée dans les plus brefs délais et nous répondrons via votre adresse email <span style="text-decoration:underline;color:red;font-weight:bolder;">'.$Email.'</span><br /><br />Merci de votre confiance!!');
											redirection(3, HTTP_SERVEUR);
										}
										else{
											echo afficherAlerte('<img src="'.HTTP_IMAGE.'progressbar.gif" alt="progressbar" /><br />Nous sommes désolés mais cet email <span style="font-weight:bolder;color:red;font-size:16px;">'.$Email.'</span> n\'est pas conforme!');
											redirection(3, HTTP_SERVEUR.FILENAME_CONTACT);
										}
									}
									else
									{
										echo afficherAlerte('<img src="'.HTTP_IMAGE.'progressbar.gif" alt="progressbar" /><br />Nous sommes désolés mais une erreur est survenue !');
										redirection(3, HTTP_SERVEUR.FILENAME_CONTACT);
									}
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