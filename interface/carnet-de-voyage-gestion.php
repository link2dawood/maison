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
includeLanguage(RACINE, LANGUAGE, FILENAME_CARNET_DE_VOYAGE_GESTION);
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
    <link href="<?php echo CONFIGURATION_GALERIE_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php echo CONFIGURATION_GALERIE_JS; ?>
    <?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
   	<script language="javascript" type="text/javascript" src="./../admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "textareas",
		plugins : "advimage, style, emotions",
		theme_advanced_buttons3_add : "advimage, style, emotions",
		relative_urls : false
	});
</script>
    
<!-- Do not edit IE conditional style below -->
<!--[if gte IE 5.5]>
<style type="text/css">
#motioncontainer {
width:expression(Math.min(this.offsetWidth, maxwidth)+'px');
}
</style>
<![endif]-->
<!-- End Conditional Style -->
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
		
		<!-- BLOC REFERENCE -->
		<div id="int_corps">
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
				?>
				<!-- ESPACE GALERIE PHOTOS -->
					<div id="carnet_galerie">
						<p style="text-align:right;padding-top:5px;"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?prw=2'; ?>" style="color:red;"><?php echo TEXTE_33; ?></a></p>
						<h2><?php echo TEXTE_32; ?></h2>
						<ul>
							<!-- GALERIE PHOTOS -->
							<li>
								<div id="motioncontainer" style="position:relative;overflow:hidden;">
									<div id="motiongallery" style="position:absolute;left:0px;top:7px;white-space: nowrap;">
										<br />
										<nobr id="trueContainer">
										<?php
										$compter = $membre->compterUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
										
										if($compter == "" OR $compter == 0){
											echo TEXTE_1;
										}
										else{
											$membre->listerImagesGalerie($_SESSION['id_client'],$_SESSION['pseudo_client']);
										}
										?> 
										</nobr>
									</div>
								</div>
							</li>
							<!-- GESTION -->
							<li>
							<?php
								if($_GET['st'] == 1){
									$selecteur = minuscule($_POST['selecteur']);
									if($selecteur){
										if($_GET['cf'] == 1){
											if($selecteur == "aj"){
												//AJOUTER UNE PHOTO
												$photo_size = $_FILES['photo']['size'];
												$photo_name = $_FILES['photo']['name'];
												$photo_tmp_name = $_FILES['photo']['tmp_name'];
														
												if(empty($photo_name)){
													redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
												}
												else{
													$toutes_extensions = $membre->getChamps("img",TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
													if(empty($toutes_extensions)){
														$num = 1;
													}
													else{
														$pos = strpos($toutes_extensions, "|");
														$extensions_images = explode("|",$toutes_extensions);
														if ($pos === false){
															$num = 2;
														}
														else{
															$num = count($extensions_images)+1;
														}
													}
																
													//CREATION STOCKAGE REPERTOIRE PAR ID
													creationRepertoireStockage(nommageRepertoire($_SESSION['id_client']));
															
													$tab_photo = $metier->chargementPhoto($photo_tmp_name, $photo_size, $photo_name, REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']), REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']), libelleGalerie($_SESSION['pseudo_client'],$num), nommageRepertoire($_SESSION['id_client']));
													if(is_numeric($tab_photo)){
														messageErreur(TEXTE_10);
														redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
													}
													else{
														if(empty($toutes_extensions)){
															$membre->insertImagesGalerie($_SESSION['id_client'] ,$tab_photo);
														}
														else{
															$nouvelle_img = $toutes_extensions.'|'.$tab_photo;
															$membre->updateElement(TABLE_GALERIE_PHOTOS,"img",$nouvelle_img,"identifiant",$_SESSION['id_client']);
															$membre->updateElement(TABLE_GALERIE_PHOTOS,"controle",0,"identifiant",$_SESSION['id_client']);
														}
														//Désactiver la mise en ligne du carnet pour controle ADMIN
														$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"controle","","identifiant",$_SESSION['id_client']);
														
														messageErreur(TEXTE_11);
														redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
													}
												}
											}
											elseif($selecteur == "sp"){
												//SUPPRIMER UNE PHOTO
												$select_images = minuscule($_POST['select_images']);
												$position = explode("_",$select_images);
												$position_img = $position[1]-1;
												$numero_img = $position[1];
												$extension = $position[0];
												$compteur = 1;
												$mon_array = array();
												
												//Suppression image
												supprimerImage($_SESSION['id_client'],libelleGalerie($_SESSION['pseudo_client'],$numero_img),$extension);
												//Suppression dans la table
												$toutes_extensions = $membre->getChamps("img",TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
												$extensions_images = explode("|",$toutes_extensions);
												
												//Vérifier si il y a d'autres images dispo...
												$pos = strpos($toutes_extensions, "|");
												if ($pos === false){
													//Unique image dispo...
													$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
													messageErreur(TEXTE_21);
													redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
												}
												else{
													//------------------------------------------------
													//     Reconstruire le tableau des extensions
													//------------------------------------------------
													foreach($extensions_images as $cle){
														if($compteur >= $numero_img){
															if($compteur == $numero_img){
																//Correspond au fichier supprimé !
															}
															else{
																//Tous les autres fichiers ayant une incrémentation supérieur au libellé supprimé...
																//------------------------------------------------
																//    Renommer les images sur le serveur
																//------------------------------------------------
																$reel_original = REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],$compteur).'.'.$cle;
																$reel_redi = REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],$compteur).'.'.$cle;
																$reel_mini = REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],$compteur).'.'.$cle;
																//-------------------------
																$renommer_original = REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],($compteur-1)).'.'.$cle;
																$renommer_redi = REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],($compteur-1)).'.'.$cle;
																$renommer_mini = REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($_SESSION['id_client']).libelleGalerie($_SESSION['pseudo_client'],($compteur-1)).'.'.$cle;
																//-------------------------
																rename($reel_original,$renommer_original);
																rename($reel_redi,$renommer_redi);
																rename($reel_mini,$renommer_mini);
																
																//------------------
																array_push($mon_array,$cle);
															}
														}
														else{
															array_push($mon_array,$cle);
														}
														
														$compteur++;
													}
													$tableau = implode("|",$mon_array);
													//------------------------------------------------
													$membre->updateElement(TABLE_GALERIE_PHOTOS,"img",$tableau,"identifiant",$_SESSION['id_client']);
													messageErreur(TEXTE_21);
													redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
												}
											}
											else{
												redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
											}
										}
										else{
											if($selecteur == "aj"){
												$titre = TEXTE_7;
												$mon_select = '<input type="file" name="photo" />';
											}
											elseif($selecteur == "sp"){
												$titre = TEXTE_8;
												$mon_select = $membre->getListingImagesGalerie($_SESSION['id_client'],"select_images");
											}
											else{
												redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
											}
										?>
										<p style="text-align:right;padding-right:10px;"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION; ?>"><?php echo TEXTE_20; ?></a></p>
										<div id="gestion_galerie">
											<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?st=1&cf=1'; ?>" method="post" enctype="multipart/form-data">
												<table>
													<tr>
														<td colspan="3" class="titre"><?php echo $titre; ?></td>
													</tr>
													<tr>
														<td><?php echo TEXTE_9; ?> <input type="hidden" name="selecteur" value="<?php echo minuscule($_POST['selecteur']); ?>" /></td>
														<td><?php echo $mon_select; ?></td>
														<td><input type="submit" value="<?php echo TEXTE_6; ?>" /></td>
													</tr>
												</table>
											</form>
										</div>
										<?php
										}
									}
									else{
										redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
									}
								}
								else{
								?>
								<div id="gestion_galerie">
									<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?st=1'; ?>" method="post">
										<table>
											<tr>
												<td colspan="6" class="titre"><?php echo TEXTE_2; ?></td>
											</tr>
											<tr>
												<td><?php echo TEXTE_3; ?></td>
												<td><input type="radio" name="selecteur" value="aj" /></td>
												<td><?php echo TEXTE_4; ?></td>
												<?php
												if($compter == "" OR $compter == 0){
													//Pas d'option suppression...pas de photos dispo !
												}
												else{
													?>
													<td><input type="radio" name="selecteur" value="sp" /></td>
													<td><?php echo TEXTE_5; ?></td>
													<?php
												}
												?>
												<td><input type="submit" value="<?php echo TEXTE_6; ?>" /></td>
											</tr>
										</table>
									</form>
								</div>
								<?php
								}
								?>
							</li>
						</ul>
					</div>
					<!-- COMMENTAIRE -->
					<div id="carnet_commentaire">
						<?php
						$carnet = $membre->getTable(TABLE_CARNET_DE_VOYAGE,"identifiant",$_SESSION['id_client']);
						$video = $membre->getTable(TABLE_FICHIER_VIDEO,"pseudo", $_SESSION['pseudo_client']);
							
						if($carnet->controle == "ok"){
							//EN LIGNE
							$h2 = TEXTE_18;
						}
						else{
							if($carnet->controle == "" AND is_numeric($carnet->identifiant)){
								$h2 = TEXTE_17;
							}
							else{
								//SANS ANNONCE
								$h2 = TEXTE_19;
							}
						}
									
						echo '<h2>'.$h2.'</h2>';
								
						if($_GET['prw'] == 1){
							$mon_commentaire = $_POST['description'];
							$intitule = protegerTexte($_POST['intitule']);
							
							if(empty($_POST['description']) OR empty($_POST['intitule'])){
								afficherAlerte(TEXTE_31);
								redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
							}
							else{
								if(empty($carnet->identifiant)){
									//AJOUTER
									$membre->insertNouveauCarnetVoyage($_SESSION['id_client'],$intitule,$mon_commentaire);
														
									afficherAlerte(TEXTE_14);
									redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
								}
								else{
									//MODIFIER
									$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"commentaire",$mon_commentaire,"identifiant",$_SESSION['id_client']);
									$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"intitule",$intitule,"identifiant",$_SESSION['id_client']);
									$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"controle","","identifiant",$_SESSION['id_client']);
									afficherAlerte(TEXTE_15);
									redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
								}
							}
						}
						elseif($_GET['prw'] == 2){
							//-------- SUPPRESSION IMAGES EN MASSE ---------------
							if($compter > 0){
								//Vérifier si il y a d'autres images dispo...
								$galerie = $membre->getTable(TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
								$video = $membre->getTable(TABLE_FICHIER_VIDEO,"pseudo", $_SESSION['pseudo_client']);
								
								$temoin = strpos($galerie->img, "|");
								if ($temoin === false){
									//Unique image dispo...
									supprimerImage($_SESSION['id_client'],libelleGalerie($_SESSION['pseudo_client'],1),$galerie->img);
									$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
								}
								else{
									$ext = explode("|",$galerie->img);
									for($i=1;$i<=count($ext);$i++){
										$num_ext = $i - 1;
										supprimerImage($_SESSION['id_client'],libelleGalerie($_SESSION['pseudo_client'],$i),$ext[$num_ext]);
									}
									$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_SESSION['id_client']);
								}
							}
							//---------------------------------------------------
							//------- SUPRESSION VIDEO ---------------
							if($video->fichier != ""){
								unlink(REPERTOIRE_VIDEO.nommageRepertoire($_SESSION['id_client']).$video->fichier);
								$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
							}
							//----------------------------------------
							$membre->supprimerUnElement(TABLE_CARNET_DE_VOYAGE,"identifiant",$_SESSION['id_client']);
							afficherAlerte(TEXTE_16);
							redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
						}
						else{
							if($carnet->intitule){
								$com = stripslashes($carnet->commentaire);
							}
							else{
								$com = TEXTE_34;
							}
						?>
						<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?prw=1'; ?>" method="post">
							<ul>
								<li style="text-align:justify;"><?php echo TEXTE_13; ?></li>
								<li><?php echo TEXTE_30; ?> <input type="text" name="intitule" value="<?php echo stripslashes($carnet->intitule); ?>" size="79"/></li>
								<li style="text-align:center;"><textarea name="description" rows="25" cols="81"><?php echo $com; ?></textarea></li>
								<li style="text-align:center;padding-top:15px;"><input type="submit" value="<?php echo TEXTE_12; ?>" /></li>
							</ul>
						</form>
						<?php
						}
						?>
					</div>
					<!-- ESPACE VIDEO -->
					<div id="carnet_video">
						<div class="ma_video"><?php echo afficherVideo($video->fichier, $metier->extraireDroite($video->fichier, 3),nommageRepertoire($_SESSION['id_client'])); ?></div>
						<div class="ma_gestion_video">
							<?php
							if($video->fichier != "" AND $video->controle == 0){
								echo '<h2>'.TEXTE_22.'</h2>';
							}
							elseif($video->fichier != "" AND $video->controle == 1){
								echo '<h2>'.TEXTE_23.'</h2>';
							}
							else{
								echo '<h2>'.TEXTE_24.'</h2>';
							}
							//-------------------------------------
							if($_GET['gt_v'] == 1){
								//Traitement...
								if($_POST['vo'] == "aj"){
									//Traitement...
									if($_GET['gst_v_cf'] == 1){
										//--------CHARGEMENT VIDEO------------------
										$video_size = $_FILES['video']['size'];
										$video_name = $_FILES['video']['name'];
										$video_tmp_name = $_FILES['video']['tmp_name'];
										
										if(!empty($video_name)){
											//DEMANDE DE CHARGEMENT VIDEO....
											creerUnRepertoire(REPERTOIRE_VIDEO.nommageRepertoire($_SESSION['id_client']));
											//------CHARGEMENT VIDEO--------
											$tab_video = $metier->chargementVideo($video_tmp_name, $video_size, $video_name, REPERTOIRE_VIDEO.nommageRepertoire($_SESSION['id_client']),$_SESSION['pseudo_client']);
											//CONTROLE SI UN FICHIER VIDEO EST DEJA PRESENT
											$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
											//UPDATE EN BASE
											if(!is_numeric($tab_video[0]) AND $video_existant == ""){
												//RETURN LE CHEMIN DONC PRESENT EN ATTENTE INTEGRATION - PAS DE FICHIER DEJA CONNU
												$membre->insertNouveauMedia(TABLE_FICHIER_VIDEO, $_SESSION['pseudo_client'], $tab_video[0]);
												//Désactiver la mise en ligne du carnet pour controle ADMIN
												$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"controle","","identifiant",$_SESSION['id_client']);
											}
											elseif(!is_numeric($tab_video[0]) AND $video_existant != "" AND $tab_video[0] != ""){
												//UPDATE NOUVEAU
												$membre->updateElement(TABLE_FICHIER_VIDEO, "fichier", $tab_video[0], "pseudo", $_SESSION['pseudo_client']);
												//Désactiver la mise en ligne du carnet pour controle ADMIN
												$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"controle","","identifiant",$_SESSION['id_client']);
											}
											else{
												redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
											}
														
											afficherAlerte(TEXTE_29);
											redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
										}
										else{
											redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
										}
									}
									else{
										?>
										<p style="text-align:right;padding-right:10px;"><a href="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION; ?>" style="color:white;font-style:italic;"><?php echo TEXTE_20; ?></a></p>
										<div id="gestion_galerie">
											<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?gt_v=1&gst_v_cf=1'; ?>" method="post" enctype="multipart/form-data">
												<table>
													<tr>
														<td colspan="2" class="titre"><?php echo TEXTE_27; ?> <input type="hidden" name="vo" value="<?php echo minuscule($_POST['vo']); ?>" /></td>
													</tr>
													<tr>
														<td><input type="file" name="video" /></td>
														<td><input type="submit" value="<?php echo TEXTE_6; ?>" /></td>
													</tr>
													<tr>
														<td colspan="2" class="msg"><?php echo TEXTE_28; ?></td>
													</tr>
												</table>
											</form>
										</div>
										<?php
									}
								}
								elseif($_POST['vo'] == "sp"){
									//Traitement...
									if($video->fichier != ""){
										unlink(REPERTOIRE_VIDEO.nommageRepertoire($_SESSION['id_client']).$video->fichier);
										$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
									}
									afficherAlerte(TEXTE_26);
									redirection(4,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
								}
								else{
									redirection(0,HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION);
								}
							}
							else{
								?>
								<div class="ma_gestion_video_1">
									<form action="<?php echo HTTP_SERVEUR.'interface/'.FILENAME_CARNET_DE_VOYAGE_GESTION.'?gt_v=1'; ?>" method="post">
										<table>
											<tr>
												<td colspan="6" class="titre"><?php echo TEXTE_25; ?></td>
											</tr>
											<tr>
												<td><?php echo TEXTE_3; ?></td>
												<?php
												if($video->fichier != ""){
													//pas de formulaire ajout
												}
												else{
													?>
													<td><input type="radio" name="vo" value="aj" /></td>
													<td><?php echo TEXTE_4; ?></td>
													<?php
												}
												
												if($video->fichier != ""){
													?>
													<td><input type="radio" name="vo" value="sp" /></td>
													<td><?php echo TEXTE_5; ?></td>
													<?php
												}
												else{
													//Pas de video dispo
												}
												?>
												<td><input type="submit" value="<?php echo TEXTE_6; ?>" /></td>
											</tr>
										</table>
									</form>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<p id="init"></p>
					<?php
					}
				}
				?>
			</div>
		<?php echo connexionON(); ?>
	</div>
</div>
<div id="footer"><?php include(INCLUDE_FOOTER); ?></div>
<!-- FIN EXTERIEUR -->
</body>
</html>