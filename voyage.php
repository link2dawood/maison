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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_VOYAGE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_GALERIE_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
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
						<div class="corps_top_developpement">
							<?php
							//MAJ PAGINATION
							$page = defautPage($_GET['page']);
							$total = $membre->compterUnElement(TABLE_CARNET_DE_VOYAGE,"controle","ok");
							$nombreDePages = majPagination(NOMBRE_ANNONCE_PAR_PAGE, $total);
							
							if (isset($page)){
								if ($page<=$nombreDePages OR $_GET['page'] == 0){
								//ON NE FAIT RIEN...
								}
								else{
									echo '<meta http-equiv="refresh" content="0; URL='.HTTP_SERVEUR.FILENAME_VOYAGE.'?page='.$nombreDePages.'">';
								}
							}
							?>	
							<div id="pagination">
								<table class="navigation">
									<tr>
										<td class="li_1">
											<?php 
											//---- PAGINATION RETOUR --------------
											if(is_null($page) OR $page <= 1){
												$num = 0;
												$disabled = "disabled";
											}
											else{
												$num = $page-1;
												$disabled = "";
											}
											//-------- BOUTON PAGINATION RETOUR --------------
											echo '<form action="'.HTTP_SERVEUR.FILENAME_VOYAGE.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
												'</form>';
											?>
										</td>
										<td class="li_2"><?php echo $total.NOMBRE_RESULTAT; ?></td>
										<td class="li_3"><?php echo PAGE.$page.'/'.$nombreDePages; ?></td>
										<td class="li_4">
										<?php 
											//-------- BOUTON PAGINATION AVANCER --------------
											if(is_null($page) OR $page == 0){
												$num = 1;
											}
											else{
												$num = $page+1;
											}
											echo '<form action="'.HTTP_SERVEUR.FILENAME_VOYAGE.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'"/>' .
												'</form>';
										 ?>
										</td>
										<td class="li_5"><?php 
											//MOTEUR DE PAGINATION
											echo '<form action="'.HTTP_SERVEUR.FILENAME_VOYAGE.'" method="get">' .
													''.INTITULE_INPUT_PAGINATION.'' .
													'<input type="text" name="page" value="'.$page.'" style="width:30px;"/>' .
													'<input type="submit" value="Go"/>' .
													'</form>';
											
											?>
										</td>
									</tr>
								</table>
							</div>
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
						 	//**********************************************************************************
							//                      RECUPERATION DU LISTING ANNONCES
							//**********************************************************************************
							if($total > 0){
								$nombreAnnoncesParPage = NOMBRE_ANNONCE_PAR_PAGE;
								$premierAnnoncesAafficher = ($page - 1) * $nombreAnnoncesParPage;
								
								echo $metier->afficherExtraitCarnetDeVoyage($premierAnnoncesAafficher, $nombreAnnoncesParPage);
							}
							else{
								echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
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