<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('./interface/applications/commun/fct-utile.php');
include('./config.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
include('./interface/applications/classes/class.EspaceMembre.php');
$membre = new EspaceMembre();
include('./interface/applications/classes/class.Metier.php');


require_once('./interface/applications/commun/configuration.php');
$metier = new Metier();
include(INCLUDE_CLASS_RECHERCHE_AVANCEE);
$rech = new RechercheAvancee();



//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_RECHERCHE_AVANCEE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?>"/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>

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
			
			<h1><?php echo H1_DE_LA_PAGE; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client'] ?? ''); ?></div>
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
</div>
						<div class="bord_droit"></div>
					</td>
				</tr>
				<tr>
					<!-- PARTIE DEVELOPPEMENT -->
					<td>
						 <div class="developpement">
						 	<?php
						if(empty($_POST['select_echange']) OR empty($_POST['select_pays'])){
							echo '<form action="'.HTTP_SERVEUR.FILENAME_RECHERCHE_AVANCEE.'" method="post">' .
									'<div id="advanced_search">' .
									'<ul>' .
									'<li style="text-align:center;"><a href="'.HTTP_SERVEUR.FILENAME_RECHERCHE_AVANCEE.'">'.TEXTE_1.'</a></li>' .
									'<li>'.TEXTE_2.'</li>' .
									'<li>'.TEXTE_3.'</li>' .
									'<li>'.TEXTE_4.'</li>' .
									'<li>'.TEXTE_5.'</li>' .
									'<li>'.TEXTE_6.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=5',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_8.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=102',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_9.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=153',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_10.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=21',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_11.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=6',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_12.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=96',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_13.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=144',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_14.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=17',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_15.'</li>' .
									'<li>'.TEXTE_16.'';
									
									$select_echange = $metier->afficherEchange('select_echange', LANGUAGE, "");
									foreach($select_echange as $echange){
										echo $echange;
									}	
									
									echo'</li>' .
									'<li>'.TEXTE_17.'';
									
									$tab_pays = $metier->getPays('select_pays', LANGUAGE, "");
									foreach($tab_pays as $cle_pays){
										echo $cle_pays;
									}
									
									echo'</li>' .
									'<li style="text-align:center;"><input type="submit" value="'.TEXTE_18.'"/></li>' .
									'</ul>' .
									'</div>' .
									'</form>';
						}
						else{
							$total = "";
							if($total <= 0 OR $total == ""){
								$disabled = 'disabled';
							}
							else{
								$disabled = '';
							}
							
							echo '<form action="'.HTTP_SERVEUR.FILENAME_RECHERCHE_AVANCEE_1.'" method="get">' .
									'<div id="advanced_search">' .
									'<ul>' .
									'<li style="text-align:center;"><a href="'.HTTP_SERVEUR.FILENAME_RECHERCHE_AVANCEE.'">'.TEXTE_1.'</a></li>' .
									'<li style="text-align:center;background-color:#00327C;color:white;padding:5px;font-size:18px;">'.$metier->getChamps("element","rubriques_".LANGUAGE,"id",minuscule($_POST['select_echange'])).' '.$metier->getChamps("pays","pays_".LANGUAGE,"id",minuscule($_POST['select_pays'])).'</li>' .
									'<li>'.TEXTE_2.'</li>' .
									'<li>'.TEXTE_3.'</li>' .
									'<li>'.TEXTE_4.'</li>' .
									'<li>'.TEXTE_5.'</li>' .
									'<li>'.TEXTE_6.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=5',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_8.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=102',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_9.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=153',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_10.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=21',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_11.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=6',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_12.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=96',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_13.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=144',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_14.' '.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_INFO_CATEGORIE.'?id_pays=17',490,160,TEXTE_7).'</li>' .
									'<li>'.TEXTE_15.'</li>' .
									'<li>'.TEXTE_28.' <select name="select_departement">';
									
									//Liste déroulante de l'ensemble des départements dispo	
									echo $rech->extraireDepartementPays($_POST['select_echange'], $_POST['select_pays']);	
									
									echo'</select>' .
									'<input type="hidden" name="select_echange" value="'.minuscule($_POST['select_echange']).'" />' .
									'<input type="hidden" name="select_pays" value="'.minuscule($_POST['select_pays']).'" /></li>' .
									'<li style="text-align:center;"><input type="submit" value="'.TEXTE_18.'" '.$disabled.'/></li>' .
									'</ul>' .
									'</div>' .
									'</form>';
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