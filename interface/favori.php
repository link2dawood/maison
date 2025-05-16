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
includeLanguage(RACINE, LANGUAGE, FILENAME_FAVORIS);
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
						 	if(empty($_SESSION['pseudo_client'])){
						 		include(INCLUDE_LOGIN);
						 	}
						 	else{
						 		$paiement = activerPaiement($_SESSION['pseudo_client']);
						 		if($paiement == 0){
						 			//AUTORISATION REFUSEE
						 			echo afficherErreur(ACCES_PAGE_REFUSEE);
						 		}
						 		else{
									if($_POST['supp'] == "suppression" AND count($_POST['favori']) > 0){
										$tab = $_POST['favori'];
										foreach($tab as $cle){
											$membre->supprimerFavori($_SESSION['id_client'],$cle);
										}
										echo messageErreur(MSG_SUPPRESSION_FAVORI);
										redirection(3,HTTP_ESPACE_MEMBRE);
									}
									else{
										$nombreMembresParPage = NOMBRE_MEMBRES_BLACKLIST;
									 	//   NUMERO 1 --> COMPTER NOMBRE DE PAGES
										$TotalMembres = $membre->compterUnElement(TABLE_COMPTEUR_PROFIL,"id_profil",$_SESSION['id_client']);
										
										// NUMERO 2 --> COMPTER LE NOMBRE DE PAGES PAR DEFAUT
										$nombreDePages  = ceil($TotalMembres / $nombreMembresParPage);
													
										$page = defautPage($_GET['page']);
										$nombreDePages = defautPage($nombreDePages1);
												 
										// NUMERO 3 --> DEFINIR LE PREMIER MESSAGE
										$premierMembresAafficher = ($page - 1) * $nombreMembresParPage;
														
										$NombreMembresMaxi = $page + 20;
																
										$NombreMembresMini = pageMini($page);
										
										echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS.'" method="post">' .
												'<div id="divBlacklist">' .
												'<table>' .
												'<tr>' .
												'<th>'.CASE_A_COCHER.'</th>' .
												'<th>'.SON_PSEUDO.'</th>' .
												'<th>'.SON_PROFIL.'</th>' .
												'</tr>';
									 	
									 	//**********************************************************************************
										//                      RECUPERATION DU LISTING ANNONCES
										//**********************************************************************************
										if($TotalMembres > 0){
											echo $membre->afficherListingCompletFavoris($_SESSION['id_client'],$premierMembresAafficher, $nombreMembresParPage);
											echo '<tr>' .
												'<td colspan="3" style="text-align:center;padding-top:7px;"><input type="hidden" name="supp" value="suppression" /> <input type="submit" value="'.LIBELLE_SUBMIT.'" /></td>' .
												'</tr>' .
												'</table>' .
												'</div>' .
												'</form>';
										}
										else{
											echo '<tr><td colspan="3" style="padding-top:50px;padding-bottom:185px;text-align:center;font-size:16px;background-color:white;">'.PAS_DE_RESULTAT.'</td></tr>';
											echo '<tr>' .
												'<td colspan="3" style="text-align:center;padding-top:7px;"><input type="hidden" name="supp" value="suppression" /> <input type="submit" value="'.LIBELLE_SUBMIT.'" disabled /></td>' .
												'</tr>' .
												'</table>' .
												'</div>' .
												'</form>';
										}
												
										//-----DEFINIR LE NOMBRE DE PAGES--------------------
										if (isset($page)){
											if ($page<=$nombreDePages){
												$MaxiPagesAffichees = $page + 9;
											}
											else{
												echo "<meta http-equiv=\"refresh\" content=\"0; URL=".HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS."?page=".$nombreDePages."\">";
											}
										}
										?>
										<!-- PAGINATION -->
										<div id="barre_pagination">
											<table style="width:100%;">
												<tr>
													<td class="el_1"><?php echo NOMBRE_RESULTAT.$TotalMembres; ?></td>
													<td class="el_2"><?php echo PAGE.defautPage($_GET['page']).'/'.$nombreDePages; ?></td>
													<td class="el_3"><?php 
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
													echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS.'" method="get">' .
														'<input type="hidden" name="page" value="'.$num.'"/>' .
														'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
														'</form>';
													?></td>
													<td class="el_4"><?php 
													//-------- BOUTON PAGINATION AVANCER --------------
													if(is_null(defautPage($_GET['page'])) OR defautPage($_GET['page']) == 0){
														$num = 1;
													}
													else{
														$num = defautPage($_GET['page'])+1;
													}
													echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_FAVORIS.'" method="get">' .
														'<input type="hidden" name="page" value="'.$num.'"/>' .
														'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'"/>' .
														'</form>';
													 ?></td>
												</tr>
											</table>
										</div>
										<?php
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