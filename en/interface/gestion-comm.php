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
includeLanguage(RACINE, LANGUAGE, FILENAME_COMMENTAIRES_GESTION);

if($_GET['act'] == 1){
	$compl = TEXTE_1;
}
elseif($_GET['act'] == 2){
	$compl = TEXTE_2;
}
elseif($_GET['act'] == 3){
	$compl = TEXTE_3;
}
else{
	$compl = TEXTE_4;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE.' - '.$compl; ?></title>
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
			<h1><?php echo H1_DE_LA_PAGE.' - '.$compl; ?></h1>
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
						<div class="corps_top_developpement"><?php echo H2_DE_LA_PAGE.' - '.$compl; ?></div>
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
									$mon_commentaire = $membre->getTable(TABLE_LIVRE_DOR,"pseudo_livre_dor",$_SESSION['pseudo_client']);
									
									if($_GET['act'] == 1){
										//AJOUTER UN COMMENTAIRE
										if(empty($_POST['requiredCommentaire'])){
											echo '<form action="'.HTTP_SERVEUR.'interface/'.FILENAME_COMMENTAIRES_GESTION.'?act=1" method="post" onSubmit="return checkrequired(this)" name="formulaire_1">' .
													'<div id="livre_dor">' .
													'<ul>' .
													'<li class="texte">'.TEXTE_6.'</li>' .
													'<li style="text-align:center;"><label><textarea name="requiredCommentaire" onKeyDown="CheckLen_1(this)" onKeyUp="CheckLen_1(this)" rows="10" cols="78"></textarea><br />'.TEXTE_7.'<input type="text" name="abd_1" size="3" value="200" style="width:22px;border:none;color:red;"/> '.TEXTE_8.'</label></li>' .
													'<li style="text-align:center;"><input type="submit" value="'.TEXTE_5.'"/></li>' .
													'</ul>' .
													'</div>' .
													'</form>';
										}
										else{
											if($mon_commentaire->commentaire_livre_dor){
												messageErreur(TEXTE_9);
												redirection(4,HTTP_ESPACE_MEMBRE);
											}
											else{
												$commentaire = textareaFormater($_POST['requiredCommentaire']);
												if($mon_commentaire->accepter_message){
											 		messageErreur(TEXTE_9);
													redirection(4,HTTP_ESPACE_MEMBRE);
											 	}
											 	else{
											 		//INSERTION EN BASE
											 		$membre->insertionNouveauLivreDor($_SESSION['pseudo_client'], time(), retrecirMessageTropLong($commentaire));
											 		messageErreur(TEXTE_10);
													redirection(4,HTTP_ESPACE_MEMBRE);
											 	}
											}
										}
									}
									elseif($_GET['act'] == 2 OR $_GET['act'] == 3){
										//VOIR LE COMMENTAIRE
										echo '<table style="width:100%;margin-top:7px;border-top:1px solid grey;border-bottom:1px solid grey;"">' .
												'<tr>' .
												'<td style="color:red;font-size:10px;">'.TEXTE_13.'</td>' .
												'<td style="text-align:right;"><a href="'.HTTP_SERVEUR.'interface/'.FILENAME_COMMENTAIRES_GESTION.'?act=4">'.TEXTE_12.'</a></td>' .
												'</tr>' .
												'</table>';
										$mon_commentaire = $membre->getTable(TABLE_LIVRE_DOR,"pseudo_livre_dor",$_SESSION['pseudo_client']);
										
										if($mon_commentaire->accepter_message == "ok"){
											$statut = TEXTE_2;
										}
										else{
											$statut = TEXTE_3;
										}
										
										echo '<div class="ad_livre_dor">' .
												'<table>' .
												'<tr>' .
												'<td colspan="3" class="top">'.TEXTE_14.'</td>' .
												'</tr>' .
												'<tr>' .
												'<td class="pseudo">'.$mon_commentaire->pseudo_livre_dor.'</td>' .
												'<td><span style="text-decoration:underline;color:grey;">'.TEXTE_15.'</span> '.date("d/m/y H:i:s",$mon_commentaire->date_livre_dor).'</td>' .
												'<td class="etat"><span style="text-decoration:underline;color:grey;">'.TEXTE_16.'</span> '.$statut.'</td>' .
												'</tr>' .
												'<tr>' .
												'<td colspan="3" class="com">'.$mon_commentaire->commentaire_livre_dor.'</td>' .
												'</tr>' .
												'</table>' .
												'</div>';
									}
									else{
										//SUPPRIMER LE COMMENTAIRE
										$membre->supprimerUnElement(TABLE_LIVRE_DOR,"pseudo_livre_dor",$_SESSION['pseudo_client']);
										messageErreur(TEXTE_11);
										redirection(4,HTTP_ESPACE_MEMBRE);
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