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
includeLanguage(RACINE, LANGUAGE, FILENAME_PAGE_PAIEMENT);
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
		<div id="module_recherche"><?php include(INCLUDE_MODULE_RECHERCHE); ?></div>
		<!-- BLOC REFERENCE -->
		<div id="contenu">
			<table id="tiers">
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td class="titre_developpement">
						<div class="bord_gauche"></div>
						<div class="corps_top_developpement"><?php echo H1; ?></div>
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
						 		echo '<p style="text-align:justify;color:red;font-weight:bolder;font-size:16px;">'.PRESENTATION.'</p>';
				
								if(is_numeric($_SESSION['id_client']) AND !empty($_SESSION['pseudo_client'])){
									?>
									<table id="tab_paiement_ligne">
										<tr>
											<td>
												<!-- PAYPAL -->
												<?php
												$email = EMAIL_PAYPAL;
												$url_paypal = "https://www.paypal.com/cgi-bin/webscr";
												$nb_aleatoire = md5(time());
												$metier->ajouterDonneesEnAttente("","",$_SESSION['pseudo_client'],"",$nb_aleatoire,"");
												
												//---------ABONNEMENT 1 MOIS-------------
												$abo_1 = $membre->getAbonnement(1, TABLE_ABO_HOMME, LANGUAGE);
												echo '<p style="text-align:center;padding-top:50px;">'.ABONNEMENT.' <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_1[2].'</span>&euro; / <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_1[1].'</span> '.MOIS.'</p>';
												
												$nom_article = ABONNEMENT.' '.$abo_1[2].'&euro;/'.$abo_1[1].' '.MOIS;
												$prix = $abo_1[2];
												$url_ok = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_ACCEPTE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire.'&abo='.$abo_1[1];
												$url_erreur = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_REFUSE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire;
												$devis = "EUR";
															
												echo '<div style="text-align:center;margin-top:5px;margin-bottom:5px;">';
												echo boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devis);
												echo '</div>';
												//---------ABONNEMENT 3 MOIS-------------
												$abo_2 = $membre->getAbonnement(3, TABLE_ABO_HOMME, LANGUAGE);
												echo '<p style="text-align:center;padding-top:50px;">'.ABONNEMENT.' <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_2[2].'</span>&euro; / <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_2[1].'</span> '.MOIS.'</p>';
												
												$nom_article = ABONNEMENT.' '.$abo_2[2].'&euro;/'.$abo_2[1].' '.MOIS;
												$prix = $abo_2[2];
												$url_ok = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_ACCEPTE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire.'&abo='.$abo_2[1];
												$url_erreur = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_REFUSE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire;
												$devis = "EUR";
															
												echo '<div style="text-align:center;margin-top:5px;margin-bottom:5px;">';
												echo boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devis);
												echo '</div>';
												//---------ABONNEMENT 6 MOIS-------------
												$abo_3 = $membre->getAbonnement(6, TABLE_ABO_HOMME, LANGUAGE);
												echo '<p style="text-align:center;padding-top:65px;">'.ABONNEMENT.' <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_3[2].'</span>&euro; / <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_3[1].'</span> '.MOIS.'</p>';
												
												$nom_article = ABONNEMENT.' '.$abo_3[2].'&euro;/'.$abo_3[1].' '.MOIS;
												$prix = $abo_3[2];
												$url_ok = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_ACCEPTE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire.'&abo='.$abo_3[1];
												$url_erreur = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_REFUSE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire;
												$devis = "EUR";
															
												echo '<div style="text-align:center;margin-top:5px;margin-bottom:5px;">';
												echo boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devis);
												echo '</div>';
												//---------ABONNEMENT 12 MOIS-------------
												$abo_4 = $membre->getAbonnement(12, TABLE_ABO_HOMME, LANGUAGE);
												echo '<p style="text-align:center;padding-top:65px;">'.ABONNEMENT.' <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_4[2].'</span>&euro; / <span style="font-weight:bolder;font-size:16px;color:#00327C;">'.$abo_4[1].'</span> '.MOIS.'</p>';
												
												$nom_article = ABONNEMENT.' '.$abo_4[2].'&euro;/'.$abo_4[1].' '.MOIS;
												$prix = $abo_4[2];
												$url_ok = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_ACCEPTE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire.'&abo='.$abo_4[1];
												$url_erreur = HTTP_SERVEUR.'interface/'.FILENAME_PAIEMENT_ABO_REFUSE.'?mb='.$_SESSION['pseudo_client'].'&ind='.$nb_aleatoire;
												$devis = "EUR";
															
												echo '<div style="text-align:center;margin-top:5px;margin-bottom:5px;">';
												echo boutonPaiementPAYPAL($url_paypal, $email, $nom_article, $prix, $url_ok, $url_erreur, $devis);
												echo '</div>';
												?>
											</td>
											<td>
												<!-- ALLOPASS -->
												<?php echo scriptAlloPass1Mois(LIBELLE_ALLOPASS_1); ?>
												<?php echo scriptAlloPass3Mois(LIBELLE_ALLOPASS_2); ?>
												<?php echo scriptAlloPass6Mois(LIBELLE_ALLOPASS_3); ?>
												<?php echo scriptAlloPass12Mois(LIBELLE_ALLOPASS_4); ?>
											</td>
										</tr>
									</table>
									<?php
								}
								else{
									//ERREUR RETOUR ESPACE MEMBRE
									redirection('0', HTTP_ESPACE_MEMBRE);
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