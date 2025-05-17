<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
// include('./interface/applications/commun/fct-utile.php');

include('./interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('./interface/applications/classes/class.Metier.php');



require_once('./interface/applications/commun/configuration.php');
$metier = new Metier();



//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_COUCHSURFING);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
   
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
	<?php 
	include('./interface/compatibilite-navigateurs.php');
	
	?>
</head>
<body>
<!-- DEBUT EXTERIEUR -->
<div id="exterieur">
	<div id="grey_back">
		<!-- PARTIE ENTETE -->
		<div id="entete">
			<div id="logo">
				<ul>
					<li><a href="<?php echo HTTP_SERVEUR; ?>"></a></li>
					<li></li>
				</ul>
			</div>
			
			<h1></h1>
		</div>
		<!-- MENU -->
		<div id="menu"></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"></div>
		<!-- RECHERCHE PAR CONNEXION -->
		<div id="module_recherche"><?php include('./interface/module-recherche-connexion.php'); ?></div>
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
							$table = TABLE_LISTING_COUCHSURFING;
							$total = $metier->compterMembresSuivantOptions($table,"","","couchsurfing");
							$page = 1;
							$type = 7;
							
							$nombreDePages = 1;
							
							if (isset($page)){
								if ($page<=$nombreDePages OR $_GET['page'] == 0){
								//ON NE FAIT RIEN...
								}
								else{
									echo '<meta http-equiv="refresh" content="0; URL='.HTTP_SERVEUR.FILENAME_COUCHSURFING.'?page='.$nombreDePages.'">';
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
											echo '<form action="'.HTTP_SERVEUR.FILENAME_COUCHSURFING.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="submit" value="'.BOUTON_RETOUR_PAGINATION.'" '.$disabled.'/>' .
												'</form>';
											?>
										</td>
										<td class="li_2"><?php echo $total; ?></td>
										<td class="li_3"></td>
										<td class="li_4">
										<?php 
											//-------- BOUTON PAGINATION AVANCER --------------
											if(is_null($page) OR $page == 0){
												$num = 1;
											}
											else{
												$num = $page+1;
											}
											echo '<form action="'.HTTP_SERVEUR.FILENAME_COUCHSURFING.'" method="get">' .
												'<input type="hidden" name="page" value="'.$num.'"/>' .
												'<input type="submit" value="'.BOUTON_SUITE_PAGINATION.'"/>' .
												'</form>';
										 ?>
										</td>
										<td class="li_5"><?php 
											//MOTEUR DE PAGINATION
											echo '<form action="'.HTTP_SERVEUR.FILENAME_COUCHSURFING.'" method="get">' .
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
						
						?></div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
						 	<div id="col_central"><?php include('./interface/listing-thematique.php'); ?></div>
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
							<div class="maPub"><?php include('./interface/ma-publicite_D.php'); ?></div>
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
		<div id="derniers_inscrits"><?php include('./interface/derniers-inscrits.php'); ?></div>
		<?php
		function connexionON(){
	?>
	<script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'maj',
		    '<?php echo HTTP_SERVEUR.'interface/maj.php'; ?>',
		    {
		        frequency: ,
		        decay:1
		    }
		);
    </script>
	<?php
}
		 echo connexionON(); 
		 ?>
	</div>
</div>
<div id="footer"><?php
include('./interface/footer.php');

?></div>
<!-- FIN EXTERIEUR -->
</body>
</html>