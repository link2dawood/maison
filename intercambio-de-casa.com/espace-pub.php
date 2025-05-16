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
includeLanguage(RACINE, LANGUAGE, FILENAME_PUBLICITE);
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
						 	//                         ESPACE PUBLICITAIRE
						 	//-------------------------------------------------------------------------
						 	echo '<p id="guide">'.TEXTE.'</p>';
						 	
						 	echo '<p style="text-align:right;"><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_CLIENT_PUBLICITE.'">'.ANCHOR_LIEN.'</a></p>';
							
							echo '<p style="color:red;font-weight:bolder;margin-top:5px;">'.MESSAGE_ATTENTION.'</p>';
							
							//GRILLE TARIFAIRE
							echo '<table id="grille_tarifaire">' .
									'<tr>' .
									'<th>'.TOP_GRILLE_TARIFAIRE_CHOIX_PAGE.'</th>' .
									'<th colspan="8">' .
									'<table class="sous_grille_tarifaire">' .
									'<tr>' .
									'<td colspan="8" style="background-color:#00327C;color:white;">'.TOP_GRILLE_TARIFAIRE_JOURS.'</td>' .
									'</tr>' .
									'<tr>' .
									'<td style="width:62px;">1</td>' .
									'<td style="width:63px;">3</td>' .
									'<td style="width:63px;">5</td>' .
									'<td style="width:63px;">7</td>' .
									'<td style="width:65px;">10</td>' .
									'<td style="width:76px;">15</td>' .
									'<td style="width:76px;">20</td>' .
									'<td style="width:76px;">30</td>' .
									'</tr>' .
									'</table>' .
									'</th>' .
									'</tr>';
								//--PARTIE A ------
								echo '<tr>' .
									'<td>A</td>';
									//RECUPERE LES TARIFS
									$array = $membre->getTableauTarif("A");
									foreach($array as $cle){
										echo $cle;
									}
								echo '</tr>';
								//--PARTIE B ------
								echo '<tr>' .
									'<td>B</td>';
									//RECUPERE LES TARIFS
									$array_b = $membre->getTableauTarif("B");
									foreach($array_b as $cle){
										echo $cle;
									}
								echo '</tr>';
								//--PARTIE C ------
								echo '<tr>' .
									'<td>C</td>';
									//RECUPERE LES TARIFS
									$array_c = $membre->getTableauTarif("C");
									foreach($array_c as $cle){
										echo $cle;
									}
								echo '</tr>';
								//--PARTIE D ------
								echo '<tr>' .
									'<td>D</td>';
									//RECUPERE LES TARIFS
									$array_d = $membre->getTableauTarif("D");
									foreach($array_d as $cle){
										echo $cle;
									}
								echo '</tr>';
								
								echo '</table>';
							if(is_numeric($_GET['action']) AND $_GET['action'] != ""){
								$mesValeurs = $membre->getTable(TABLE_GRILLE_TARIFAIRE, "id", $_GET['action']);
								echo '<table id="h3_tarif">' .
										'<tr>' .
										'<td>'.GRILLE_TARIFAIRE_PAGE.' '.$mesValeurs->partie.'</td>' .
										'<td>'.GRILLE_TARIFAIRE_JOUR.' '.$mesValeurs->jour.'</td>' .
										'<td>'.GRILLE_TARIFAIRE_MONTANT.' '.$mesValeurs->montant.' &euro;</td>' .
										'</tr>' .
										'</table>';
								if($_GET['step'] == "1"){
									echo '<div id="f_charger_img">' .
											'<form action="'.HTTP_SERVEUR.FILENAME_PUBLICITE.'?action='.$_GET['action'].'&step=2" method="post" onSubmit="return checkrequired(this)" name="formulaire">' .
											'<table>' .
											'<tr>' .
											'<td colspan="2"><strong>'.GRILLE_TARIFAIRE_ETAPE2_TEXTE.'</strong></td>' .
											'</tr>' .
											'<tr>' .
											'<td>'.LIBELLE_1.'</td>' .
											'<td><input type="text" name="requiredLien"/> '.LIBELLE_3.'</td>' .
											'</tr>' .
											'<tr>' .
											'<td>'.LIBELLE_2.'</td>' .
											'<td><input type="text" name="requiredHttp"/></td>' .
											'</tr>' .
											'<tr>' .
											'<td><strong>'.LIBELLE_0.'</strong></td>' .
											'<td><input type="text" name="requiredEmail"/></td>' .
											'</tr>' .
											'<tr>' .
											'<td colspan="2" style="text-align:center;"><input type="submit" value="'.SUBMIT.'"/></td>' .
											'</tr>' .
											'</table>' .
											'</form>' .
											'</div>';
								}
								elseif($_GET['step'] == "2"){
									//TRAITEMENT DU PAIEMENT
									if(empty($_POST['requiredLien']) OR empty($_POST['requiredHttp']) OR empty($_POST['requiredEmail'])){
										redirection(0, HTTP_SERVEUR.FILENAME_PUBLICITE.'?action='.$_GET['action'].'&step=1');
									}
									else{
										$syntaxeEmail = conformEmail(minuscule($_POST['requiredEmail']));
										$rest = substr(minuscule($_POST['requiredLien']), -3);
										$debut = substr(minuscule($_POST['requiredHttp']), 0, 7);
										$ht = 'http://';
										$formAutorise = "#^jpg|png|gif$#i";
										if(preg_match($formAutorise,$rest)){
											$ext = 1;//C'est bon !
										}
										else{
											$ext = 0;
										}
										
										if($syntaxeEmail == 0){
											echo "<p style=\"text-align:center;font-size:18px;font-weight:bolder;\"><img src=\"".HTTP_IMAGE."progressbar.gif\" alt=\"progressbar\" /><br />".GRILLE_TARIFAIRE_ERREUR_SYNTAXE_EMAIL."</p>";
											redirection('3', HTTP_SERVEUR.FILENAME_PUBLICITE.'?action='.$_GET['action'].'&step=1');
										}
										elseif($ext == 0){
											echo "<p style=\"text-align:center;font-size:18px;font-weight:bolder;\"><img src=\"".HTTP_IMAGE."progressbar.gif\" alt=\"progressbar\" /><br />".GRILLE_TARIFAIRE_ERREUR_FORMAT_ACCEPTE."</p>";
											redirection('3', HTTP_SERVEUR.FILENAME_PUBLICITE.'?action='.$_GET['action'].'&step=1');
										}
										else{
											if($debut == $ht){
												$http = minuscule($_POST['requiredHttp']);
											}
											else{
												$http = $ht.minuscule($_POST['requiredHttp']);
											}
											
											//ETAPE PAIEMENT...
											mt_srand((float) microtime()*1000000);
											$nb_aleatoire = mt_rand(0, 100000);
											$confirm = $membre->getChamps("id", TABLE_PAIEMENT_ATTENTE_CONFIRMATION, "email", minuscule($_POST['requiredEmail']));
											if(!empty($confirm)){
												//ON NE FAIT RIEN...ON SECURISE LES DONNEES POUR QUELLES SOIENT UNIQUE DANS LA TABLE !
											}
											else{
												$metier->ajouterDonneesEnAttente(minuscule($_POST['requiredLien']),
																			$http,
																			minuscule($_POST['requiredEmail']), 
																			"",
																			md5($nb_aleatoire),
																			minuscule($_GET['action']));
											}
											//Bouton PAYPAL
											$email = EMAIL_PAYPAL;
											$nom_article = GRILLE_TARIFAIRE_PAGE.' '.$mesValeurs->partie.' / '.GRILLE_TARIFAIRE_JOUR.' '.$mesValeurs->jour.' / '.GRILLE_TARIFAIRE_MONTANT.' '.$mesValeurs->montant;
											$prix = $mesValeurs->montant;
											$url_paypal = "https://www.paypal.com/cgi-bin/webscr";
											//$url_paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr";
											$url_ok = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ACCEPTE.'?im='.minuscule($_POST['requiredEmail']).'&ind='.md5($nb_aleatoire);
											$url_erreur = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_REFUSE.'?im='.minuscule($_POST['requiredEmail']).'&ind='.md5($nb_aleatoire);
											$devis = "EUR";
												
											echo '<div style="text-align:center;margin-top:10px;">';
											echo boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devis);
											echo '</div>';
										}
									}	
								}
								else{
									redirection(0, HTTP_SERVEUR.FILENAME_PUBLICITE);
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