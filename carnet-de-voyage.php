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

//Récupérer le carnet de voyage du dit-membre
$carnet = $membre->getTable(TABLE_CARNET_DE_VOYAGE,"identifiant",$_GET['id_carnet']);
$inscription = $membre->getTable(TABLE_INSCRIPTION,"id",$_GET['id_carnet']);
$video = $membre->getTable(TABLE_FICHIER_VIDEO,"pseudo", $inscription->pseudo);
$identifiant = $membre->getChamps("identifiant",TABLE_ONLINE,"pseudo", $inscription->pseudo);

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_CARNET_DE_VOYAGE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo HEADER_TITLE; ?> <?php echo $inscription->pseudo; ?></title>
	<meta name="description" content="<?php echo HEADER_DESCRIPTION; ?> <?php echo $inscription->pseudo; ?>. <?php echo HEADER_DESCRIPTION_1; ?> <?php echo stripslashes($carnet->intitule); ?>."/>
	<meta name="keywords" content="<?php echo HEADER_KEYWORDS; ?>"/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_GALERIE_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php echo CONFIGURATION_GALERIE_JS; ?>
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
			<h1><?php echo H1_DE_LA_PAGE; ?> <?php echo $inscription->pseudo; ?></h1>
		</div>
		<!-- MENU -->
		<div id="menu"><?php getMenu($_SESSION['pseudo_client']); ?></div>
		<!-- PARTIE ADSENSE -->
		<div id="adsense"><?php include(INCLUDE_ADSENSE); ?></div>
		
		<!-- BLOC REFERENCE -->
		<div id="int_corps">
			<!-- ESPACE GALERIE PHOTOS -->
					<div id="carnet_galerie">
						<h2><?php echo TEXTE_1; ?></h2>
						<ul>
							<!-- GALERIE PHOTOS -->
							<li>
								<div id="motioncontainer" style="position:relative;overflow:hidden;">
									<div id="motiongallery" style="position:absolute;left:0px;top:0px;white-space: nowrap;">
										<br />
										<nobr id="trueContainer">
										<?php
										$compter = $membre->compterUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_GET['id_carnet']);
										if($compter == "" OR $compter == 0){
											echo TEXTE_1;
										}
										else{
											$membre->listerImagesGalerie($_GET['id_carnet'],$inscription->pseudo);
										}
										?> 
										</nobr>
									</div>
								</div>
							</li>
						</ul>
						<p style="padding:7px;"><?php echo TEXTE_12; ?></p>
					</div>
					<!-- COMMENTAIRE -->
					<div id="carnet_contenu">
						<h2><?php echo stripslashes($carnet->intitule); ?></h2>
						<ul>
							<li><?php echo $carnet->commentaire; ?></li>
						</ul>
					</div>
					<!-- ESPACE VIDEO -->
					<div id="carnet_video">
						<h2><?php echo TEXTE_4; ?></h2>
						<div class="ma_video"><?php echo afficherVideo($video->fichier, $metier->extraireDroite($video->fichier, 3),nommageRepertoire($inscription->id)); ?></div>
						<h2><?php echo TEXTE_5; ?></h2>
						<div class="me_contacter">
							<ul>
								<li class="contact_1">
									<!-- Contacter par COURRIER -->
									<table>
										<tr>
											<td class="top_1"><?php echo TEXTE_7; ?></td>
										<?php
										if($_SESSION['pseudo_client']){
											?>
											<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-video&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
									 		<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-audio&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
									 		<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=off&action=message-texte&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<?php
										}
										else{
											?>
											<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_COURRIER_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<?php
										}
										?>
										</tr>
									</table>
								</li>
								<li class="contact_2">
									<!-- Contacter en direct tchat -->
									<table>
										<tr>
											<td class="top_1"><?php echo TEXTE_8; ?></td>
										<?php
								 		if(empty($_SESSION['pseudo_client'])){
								 			?>
								 			<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.FILENAME_FICHE_INSCRIPTION; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
											<?php
								 		}
								 		else{
								 			if($identifiant){
										 		?>
										 		<td class="ico_1"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-texte&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
												<td class="ico_2"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-video&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
												<td class="ico_3"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MESSAGERIE.'?acces=on&action=message-audio&id='.$inscription->id.'&m='.$inscription->pseudo; ?>"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></a></td>
												<?php
									 		}
									 		else{
										 		?>
												<td class="ico_1"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_TEXTE_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
												<td class="ico_2"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_VIDEO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
												<td class="ico_3"><img src="<?php echo HTTP_IMAGE.ICONE_MINI_ANNONCE_TCHAT_AUDIO_OFF; ?>" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
												<?php
									 		}
								 		}
								 		?>
								 		</tr>
									</table>
								</li>
								<li class="contact_3">
									<!-- Ajouter aux favoris -->
									<table style="margin-top:3px;width:100%;">
										<tr>
											<td class="top_1"><?php echo TEXTE_11; ?></td>
											<td>
												<?php
												if($_SESSION['pseudo_client']){
													$paiement = activerPaiement($_SESSION['pseudo_client']);
													if($paiement == 0){
											 			//AUTORISATION REFUSEE
											 			echo '<a href="'.HTTP_PAIEMENT.'">'.TEXTE_9.'</a>';
											 		}
											 		else{
											 			if($_SESSION['id_client'] == $inscription->id){
											 				echo TEXTE_9;
											 			}
											 			else{
											 				$deja_favori = $membre->getMisEnFavori($_SESSION['id_client'],$inscription->id);
												 			if($deja_favori > 0){
												 				echo TEXTE_10;
												 			}
												 			else{
												 				if($_GET['act'] == 1){
												 					$membre->ajouterFavori($_SESSION['id_client'],$inscription->id);
												 					echo TEXTE_10;
												 				}
												 				else{
												 					if($inscription->type_annonce != "" AND $inscription->compte_actif == 0 AND $inscription->en_ligne == "ok"){
														 				echo '<a href="'.HTTP_SERVEUR.'carnet-de-voyage-'.$inscription->id.'-1.php">'.TEXTE_9.'</a>';
														 			}
														 			else{
														 				echo TEXTE_9;
														 			}
												 				}
												 			}
											 			}
											 		}
												}
												else{
													?>
													<a href="<?php echo HTTP_SERVEUR.FILENAME_INSCRIPTION; ?>"><?php echo TEXTE_9; ?></a>
													<?php 
												}
												?>
											</td>
										</tr>
									</table>
								</li>
							</ul>
						</div>
					</div>
					<p style="clear:left;"></p>
			</div>
		<div id="derniers_inscrits"><?php include(INCLUDE_DERNIERS_INSCRITS_HORS_CONNEXION); ?></div>
		<?php echo connexionON(); ?>
	</div>
</div>
<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
<!-- FIN EXTERIEUR -->
</body>
</html>