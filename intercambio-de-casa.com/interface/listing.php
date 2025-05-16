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
includeLanguage(RACINE, LANGUAGE, FILENAME_LISTING_MEMBRES);
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
			<h1><?php echo afficherH1Listing($_GET['id_opt'], $_GET['id_pays'], $metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $_GET['id_pays']), $metier->getChamps('nomdept', 'departement_'.LANGUAGE, 'numdept', $_GET['id_depart'])); ?></h1>
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
						<div class="corps_top_developpement">
							<?php
								//MAJ PAGINATION
								$id_pays = minuscule($_GET['id_pays']);
								$id_depart = minuscule($_GET['id_depart']);
								$id_opt = minuscule($_GET['id_opt']);
								$TotalMembres = $metier->compterMembresSuivantOptions($id_opt, $_SESSION['equivalence'], $id_pays, $id_depart);
								$page = defautPage($_GET['page']);
							
								//RECHERCHE DU LISTING
								$nombreMembresParPage = NOMBRE_ANNONCE_PAR_PAGE;
								
								$element = majPagination(NOMBRE_ANNONCE_PAR_PAGE, $TotalMembres, "", "");
								$nombreDePages = $element;
								
								if (isset($page)){
									if ($page<=$nombreDePages OR $_GET['page'] == 0){
									//ON NE FAIT RIEN...
									}
									else{
										echo '<meta http-equiv="refresh" content="0; URL='.HTTP_SERVEUR.'interface/'.FILENAME_LISTING_MEMBRES.'?page='.$nombreDePages.'&id_pays='.$_GET['id_pays'].'&id_depart='.$_GET['id_depart'].'&id_opt='.$_GET['id_opt'].'">';
									}
								}
							?>	
							<div id="pagination">
								<table style="width:100%;">
									<tr>
										<td class="li_1">
											<?php
											//BOUTON RETOUR
											$page_actuelle = $page;
											
											if(is_null($page_actuelle) OR $page_actuelle <= 1){
												$num_retour = 0;
												$disabled = "disabled";
											}
											else{
												$num_retour = $page_actuelle-1;
												$disabled = "";
											}
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_LISTING_MEMBRES.'" method="get">' .
												'<input type="hidden" name="id_pays" value="'.$_GET['id_pays'].'" />' .
												'<input type="hidden" name="id_depart" value="'.$_GET['id_depart'].'" />' .
												'<input type="hidden" name="id_opt" value="'.$_GET['id_opt'].'" />' .
												'<input type="hidden" name="page" value="'.$num_retour.'" />' .
												'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
												'</form>'; 
											
											?>
										</td>
										<td class="li_2"><?php echo '('.$TotalMembres.')'; ?> <?php echo afficherH1Listing($_GET['id_opt'], $_GET['id_pays'], $metier->getChamps('pays', 'pays_'.LANGUAGE, 'id', $_GET['id_pays']), $metier->getChamps('nomdept', 'departement_'.LANGUAGE, 'numdept', $_GET['id_depart'])); ?></td>
										<td class="li_3"><?php echo PAGE.$page.'/'.$nombreDePages; ?></td>
										<td class="li_4">
											<?php
												//BOUTON AVANCER
												if(is_null($page_actuelle) OR $page_actuelle == 0){
													$num_suite = 1;
												}
												else{
													$num_suite = $page_actuelle+1;
												}
												echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_LISTING_MEMBRES.'" method="get">' .
													'<input type="hidden" name="id_pays" value="'.$_GET['id_pays'].'" />' .
													'<input type="hidden" name="id_depart" value="'.$_GET['id_depart'].'" />' .
													'<input type="hidden" name="id_opt" value="'.$_GET['id_opt'].'" />' .
													'<input type="hidden" name="page" value="'.$num_suite.'" />' .
													'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'" />' .
													'</form>'; 
												
												?>
										</td>
										<td class="li_5"><?php 
											//MOTEUR DE PAGINATION
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_LISTING_MEMBRES.'" method="get">' .
													''.INTITULE_INPUT_PAGINATION.'' .
													'<input type="text" name="page" value="'.defautPage($_GET['page']).'" style="width:30px;"/>' .
													'<input type="hidden" name="id_pays" value="'.$_GET['id_pays'].'" />' .
													'<input type="hidden" name="id_depart" value="'.$_GET['id_depart'].'" />' .
													'<input type="hidden" name="id_opt" value="'.$_GET['id_opt'].'" />' .
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
						 	<div id="col_central">
							<?php
								// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
								$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
											
								$page = defautPage($_GET['page']);
										 
								// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
								$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
												
								$NombreMembresMaxi = $page + 20;
														
								$NombreMembresMini = pageMini($page);
								
								//**********************************************************************************
								//                      RECUPERATION DU LISTING ANNONCES
								//**********************************************************************************
								if($TotalMembres > 0){
									echo $metier->afficherExtraitAnnoncesSuivantOptions($premierMembresAafficher, $nombreMembresParPage, $id_opt, $_SESSION['equivalence'], $id_pays, $id_depart);
								}
								else{
									echo '<p style="padding-top:80px;padding-bottom:420px;text-align:center;font-size:16px;">'.PAS_DE_RESULTAT.'</p>';
								}
							?>
							</div>
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
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_A); ?></div>
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
