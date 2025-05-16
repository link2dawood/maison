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
includeLanguage(RACINE, LANGUAGE, FILENAME_MEMBRE_OFFLINE);

//****** TRAITEMENT *****************
$page = defautPage($_GET['page']);
//Récupération du type d'échange
$type_echange = $membre->getChamps("element", "rubriques_".LANGUAGE, "id", minuscule($_GET['type']));
//Récupération du pays d'échange
$pays = $membre->getChamps("pays", "pays_".LANGUAGE, "id", minuscule($_GET['choix_pays']));
if($_GET['type']>0 AND $_GET['type']<=6){
	$table = TABLE_LISTING_ECHANGE_MAISON;
}
else{
	$table = TABLE_LISTING_COUCHSURFING;
}
//***********************************
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?></title>
	<meta name="description" content="<?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?>"/>
	<meta name="keywords" content="<?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?>"/>
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
			<h1><?php echo ajoutCouch(minuscule($_GET['type']), $type_echange); ?> <?php echo $pays; ?></h1>
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
							$element = majPagination(NOMBRE_ANNONCE_PAR_PAGE, $membre->compterMembresOffline($table,minuscule($_GET['type']),minuscule($_GET['choix_pays']),"liste"));
							$nombreDePages = $element;
							
							if (isset($page)){
								if ($page<=$nombreDePages OR $_GET['page'] == 0){
								//ON NE FAIT RIEN...
								}
								else{
									echo '<meta http-equiv="refresh" content="0; URL='.HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE.'?page='.$nombreDePages.'&type='.minuscule($_GET['type']).'&choix_pays='.minuscule($_GET['choix_pays']).'">';
								}
							}
							?>	
							<div id="pagination">
								<table class="navigation">
									<tr>
										<td class="li_1">
											<?php 
											//---- PAGINATION RETOUR --------------
											if(is_null(defautPage($_GET['page'])) OR defautPage($_GET['page']) <= 1){
												$num = 0;
												$disabled = "disabled";
											}
											else{
												$num = defautPage($_GET['page'])-1;
												$disabled = "";
											}
											//-------- BOUTON PAGINATION RETOUR --------------
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="hidden" name="type" value="'.$_GET['type'].'"/>' .
												'<input type="hidden" name="choix_pays" value="'.$_GET['choix_pays'].'"/>' .
												'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
												'</form>';
											?>
										</td>
										<td class="li_2"><?php echo $membre->compterMembresOffline($table,minuscule($_GET['type']),minuscule($_GET['choix_pays']),"liste").NOMBRE_RESULTAT; ?></td>
										<td class="li_3"><?php echo PAGE.defautPage($_GET['page']).'/'.$nombreDePages; ?></td>
										<td class="li_4">
										<?php 
											//-------- BOUTON PAGINATION AVANCER --------------
											if(is_null(defautPage($_GET['page'])) OR defautPage($_GET['page']) == 0){
												$num = 1;
											}
											else{
												$num = defautPage($_GET['page'])+1;
											}
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="hidden" name="type" value="'.$_GET['type'].'"/>' .
												'<input type="hidden" name="choix_pays" value="'.$_GET['choix_pays'].'"/>' .
												'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'"/>' .
												'</form>';
										 ?>
										</td>
										<td class="li_5"><?php 
											//MOTEUR DE PAGINATION
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_MEMBRE_OFFLINE.'" method="get">' .
													''.INTITULE_INPUT_PAGINATION.'' .
													'<input type="text" name="page" value="'.defautPage($_GET['page']).'" style="width:30px;"/>' .
													'<input type="hidden" name="type" value="'.$_GET['type'].'"/>' .
													'<input type="hidden" name="choix_pays" value="'.$_GET['choix_pays'].'"/>' .
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
						 	<div id="col_central"><?php include(INCLUDE_LISTING_MEMBRES_OFFLINE); ?></div>
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
							<!-- PUBLICITE -->
							<div class="bord_g"></div>
							<div class="centre_top_tchat"><?php echo ESPACE_PUBLICITAIRE; ?></div>
							<div class="bord_d"></div>
							<div class="maPub"><?php include(INCLUDE_MA_PUBLICITE_C); ?></div>
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