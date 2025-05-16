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
includeLanguage(RACINE, LANGUAGE, FILENAME_DEPOT_ANNONCE);
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
    <link href="<?php echo CONFIGURATION_CSS_CALENDRIER; ?>" media="screen" rel="stylesheet" type="text/css" />
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
			<h1>
			<?php
				if($_GET['tpe'] == "echange"){
					echo H1_DE_LA_PAGE_2;
				}
				elseif($_GET['tpe'] == "couchsurfing"){
					echo H1_DE_LA_PAGE_3;
				}
				else{
					echo H1_DE_LA_PAGE_1;
				}
			?>
			</h1>
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
						<div class="corps_top_developpement">
						<?php
							if($_GET['tpe'] == "echange"){
								echo H1_DE_LA_PAGE_2;
							}
							elseif($_GET['tpe'] == "couchsurfing"){
								echo H1_DE_LA_PAGE_3;
							}
							else{
								echo H1_DE_LA_PAGE_1;
							}
						?>
						</div>
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
						 	if(empty($_SESSION['pseudo_client'])){
						 		include(INCLUDE_LOGIN);
						 	}
						 	else{
						 		$annonce_en_ligne = $membre->getChamps("en_ligne", TABLE_ONLINE, "identifiant", $_SESSION['id_client']);
						 		$annonce_en_attente = $membre->getChamps("type_annonce", TABLE_ONLINE, "identifiant", $_SESSION['id_client']);
						 		
						 		if($annonce_en_ligne == "ok"){
									//ACCES REFUSE UNE ANNONCE EST EN LIGNE
									messageErreur(TEXTE_65);
									redirection(4, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
								}
								elseif($annonce_en_ligne == "" AND $annonce_en_attente != ""){
									//ACCES REFUSE UNE ANNONCE EST EN ATTENTE DE VALIDATION
									messageErreur(TEXTE_66);
									redirection(4, HTTP_SERVEUR.FILENAME_ESPACE_MEMBRE);
								}
								elseif($_GET['tpe'] == "echange" OR $_GET['tpe'] == "couchsurfing"){
									//Formulaire dépot annonce
									include(INCLUDE_FORMULAIRE_DEPOT_ANNONCE);
								}
								else{
									//page GENERALE
									echo '<p style="text-align:justify;">'.TEXTE_1.'</p>';
									echo '<p style="text-align:center;">'.TEXTE_2.'</p>';
									echo '<p style="text-align:center;color:red;margin-top:7px;font-weight:bolder;">'.TEXTE_3.'</p>';
									echo '<p style="text-align:justify;margin-top:7px;">'.TEXTE_4.'</p>';
									echo '<div style="margin:0 auto;width:400px;">'.TEXTE_5.'</div>';
									echo '<div style="text-align:justify;color:red;margin-top:7px;font-weight:bolder;">'.TEXTE_6.'</div>';
									echo '<p style="margin-top:7px;font-size:18px;text-decoration:underline;">'.TEXTE_7.'</p>';
									echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_DEPOT_ANNONCE.'" method="get">' .
											'<table id="form_insc">' .
											'<tr>' .
												'<td><img src="'.HTTP_IMAGE.'img10.jpg" alt="'.ATTRIBUT_ALT.'"/> <input type="hidden" name="action" value="aj"/></td>' .
												'<td class="radio"><input type="radio" name="tpe" value="echange" checked/> <span style="color:#FF6600;font-weight:bolder;">'.TEXTE_8.'</span></td>' .
												'</tr>' .
												'<tr>' .
												'<td><img src="'.HTTP_IMAGE.'img6.jpg" alt="'.ATTRIBUT_ALT.'"/></td>' .
												'<td class="radio"><input type="radio" name="tpe" value="couchsurfing" /> <span style="color:#FFCC00;font-weight:bolder;">'.TEXTE_9.'</span></td>' .
												'</tr>' .
												'<tr>' .
												'<td colspan="2" style="text-align:center;"><input type="submit" value="'.TEXTE_10.'" /></td>' .
												'</tr>' .
												'</table>';
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