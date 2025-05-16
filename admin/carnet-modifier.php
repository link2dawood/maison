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

//Récupérer le carnet de voyage du dit-membre
$carnet = $membre->getTable(TABLE_CARNET_DE_VOYAGE,"identifiant",$_GET['id_carnet']);
$inscription = $membre->getTable(TABLE_INSCRIPTION,"id",$_GET['id_carnet']);
$video = $membre->getTable(TABLE_FICHIER_VIDEO,"pseudo", $inscription->pseudo);
$identifiant = $membre->getChamps("identifiant",TABLE_ONLINE,"pseudo", $inscription->pseudo);
$galerie = $membre->getTable(TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ADMINISTRATION</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_CSS_ADMIN; ?>" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
    <?php echo CONFIGURATION_GALERIE_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
	<script language="javascript" type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
		tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
			plugins : "advimage, style, emotions",
			theme_advanced_buttons3_add : "styleprops, emotions",
			relative_urls : false
		});
</script>
</head>
<body>
<div id="ext_ad">
<!-- DEBUT EXTERIEUR -->
<?php
	if(empty($_SESSION['admin'])){
		//RENVOI ACCUEIL
		echo afficherLoginAdmin();
	}
	else{
		//DEVELOPPEMENT ESPACE MEMBRE
		include('menu.php');
		include('info.php');
		echo '<h1>Administration</h1>';
		echo '<h4>[CARNET DE VOYAGE - MODIFIER/SUPPRIMER ('.$inscription->pseudo.')]</h4>';
		//---------------------------------
		?>
		<!-- ESPACE GALERIE PHOTOS -->
		<div id="carnet_galerie">
			<p style="text-align:right;border-top:1px solid grey;border-bottom:1px solid grey;font-style:italic;"><a href="./carnet-modifier.php?prw=3&id_carnet=<?php echo $_GET['id_carnet']; ?>" style="font-weight:bolder;color:green;">[accepter]</a> | <a href="./carnet-modifier.php?prw=2&id_carnet=<?php echo $_GET['id_carnet']; ?>" style="color:red;font-weight:bolder;">[supprimer]</a></p>
			<h2>Ma galerie photos [<?php echo $inscription->pseudo; ?>]</h2>
			<ul>
			<!-- GALERIE PHOTOS -->
				<li>
					<div id="motioncontainer" style="position:relative;overflow:hidden;">
						<div id="motiongallery" style="position:absolute;left:0;top:7;white-space: nowrap;">
							<br />
							<nobr id="trueContainer">
							<?php
								$compter = $membre->compterUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);
								if($compter == "" OR $compter == 0){
									echo "Pas de photos disponibles...";
								}
								else{
									$membre->listerImagesGalerie($inscription->id,$inscription->pseudo);
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
								if($selecteur == "sp"){
								//SUPPRIMER UNE PHOTO
								$select_images = minuscule($_POST['select_images']);
								$position = explode("_",$select_images);
								$position_img = $position[1]-1;
								$numero_img = $position[1];
								$extension = $position[0];
								$compteur = 1;
								$mon_array = array();
											
								//Suppression image
								supprimerImage($inscription->id,libelleGalerie($inscription->pseudo,$numero_img),$extension);
								//Suppression dans la table
								$toutes_extensions = $membre->getChamps("img",TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);
								$extensions_images = explode("|",$toutes_extensions);
											
								//Vérifier si il y a d'autres images dispo...
								$pos = strpos($toutes_extensions, "|");
								if ($pos === false){
									//Unique image dispo...
									$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);
									messageErreur("Photo supprimée !");
									redirection(4,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
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
												$reel_original = REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,$compteur).'.'.$cle;
												$reel_redi = REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,$compteur).'.'.$cle;
												$reel_mini = REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,$compteur).'.'.$cle;
												//-------------------------
												$renommer_original = REPERTOIRE_IMAGE_ORIGINAL.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,($compteur-1)).'.'.$cle;
												$renommer_redi = REPERTOIRE_IMAGE_REDIMENSIONNEE.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,($compteur-1)).'.'.$cle;
												$renommer_mini = REPERTOIRE_IMAGE_MINIATURE.nommageRepertoire($inscription->id).libelleGalerie($inscription->pseudo,($compteur-1)).'.'.$cle;
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
									$membre->updateElement(TABLE_GALERIE_PHOTOS,"img",$tableau,"identifiant",$inscription->id);
									messageErreur("Photo supprimée !");
									redirection(4,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
								}
							}
							else{
								redirection(0,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
							}
						}
						else{
							if($selecteur == "sp"){
								$titre = "Supprimer une photo";
								$mon_select = $membre->getListingImagesGalerie($inscription->id,"select_images");
							}
							else{
								redirection(0,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
							}
							?>
							<p style="text-align:right;padding-right:10px;"><a href="./carnet-modifier.php?id_carnet=<?php echo $_GET['id_carnet']; ?>">[annuler]</a></p>
								<div id="gestion_galerie">
									<form action="./carnet-modifier.php?st=1&cf=1&id_carnet=<?php echo $_GET['id_carnet']; ?>" method="post" enctype="multipart/form-data">
										<table>
											<tr>
												<td colspan="3" class="titre"><?php echo $titre; ?></td>
											</tr>
											<tr>
												<td>Sélectionner : <input type="hidden" name="selecteur" value="<?php echo minuscule($_POST['selecteur']); ?>" /></td>
												<td><?php echo $mon_select; ?></td>
												<td><input type="submit" value="Envoyer" /></td>
											</tr>
										</table>
									</form>
								</div>
							<?php
						}
					}
					else{
						redirection(0,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
					}
				}
			else{
				if($compter == "" OR $compter == 0){
					//Pas de formulaire de suppression !
				}
				else{
					?>
					<div id="gestion_galerie">
						<form action="./carnet-modifier.php?st=1&id_carnet=<?php echo $_GET['id_carnet']; ?>" method="post">
							<table>
								<tr>
									<td colspan="3" class="titre">Gestion de ma galerie</td>
								</tr>
								<tr>
									<td>Supprimer une image : </td>
									<td><input type="radio" name="selecteur" value="sp" /></td>
									<td><input type="submit" value="Envoyer" /></td>
								</tr>
							</table>
						</form>
					</div>
					<?php
				}
			}
			?>
			</li>
		</ul>
	</div>
	<!-- COMMENTAIRE -->
	<div id="carnet_commentaire">
	<?php
		if($carnet->controle == "ok"){
			//EN LIGNE
			$h2 = 'Carnet [en ligne]';
		}
		else{
			if($carnet->controle == "" AND is_numeric($carnet->identifiant)){
				$h2 = 'Carnet [en attente]';
			}
			else{
			//SANS ANNONCE
				$h2 = 'Carnet [sans]';
			}
		}
							
		echo '<h2>'.$h2.'</h2>';
								
		if($_GET['prw'] == 1){
			$mon_commentaire = $_POST['description'];
			$intitule = protegerTexte($_POST['intitule']);
					
			if(empty($_POST['description']) OR empty($_POST['intitule'])){
				afficherAlerte("ATTENTION tous les champs sont obligatoires !");
				redirection(4,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
			}
			else{
				//MODIFIER
				$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"commentaire",$mon_commentaire,"identifiant",$inscription->id);
				$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"intitule",$intitule,"identifiant",$inscription->id);
				
				afficherAlerte("Carnet de voyage modifié !");
				redirection(4,'./carnet.php');
			}
		}
		elseif($_GET['prw'] == 2){
			//-------- SUPPRESSION IMAGES EN MASSE ---------------
			if($compter > 0){
				//Vérifier si il y a d'autres images dispo...
				$temoin = strpos($galerie->img, "|");
				if ($temoin === false){
					//Unique image dispo...
					supprimerImage($inscription->id,libelleGalerie($inscription->pseudo,1),$galerie->img);
					$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);
				}
				else{
					$ext = explode("|",$galerie->img);
					for($i=1;$i<=count($ext);$i++){
						$num_ext = $i - 1;
						supprimerImage($inscription->id,libelleGalerie($inscription->pseudo,$i),$ext[$num_ext]);
					}
					$membre->supprimerUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$inscription->id);
				}
			}
			//---------------------------------------------------
			//------- SUPRESSION VIDEO ---------------
			if($video->fichier != ""){
				unlink(REPERTOIRE_VIDEO.nommageRepertoire($inscription->id).$video->fichier);
				$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $inscription->pseudo);
			}
			//----------------------------------------
			//SUPPRESSION
			$membre->supprimerUnElement(TABLE_CARNET_DE_VOYAGE,"identifiant",$inscription->id);
			afficherAlerte("Carnet supprimé avec galerie photos + vidéo!");
			redirection(4,'./carnet.php');
		}
		elseif($_GET['prw'] == 3){
			//------------- ACCEPTER LE CARNET DE VOYAGE + FICHIERS JOINTS --------------------------
			//Accepter la galerie
			$membre->updateElement(TABLE_GALERIE_PHOTOS,"controle","1","identifiant",$inscription->id);
			//Accepter la vidéo
			$membre->updateElement(TABLE_FICHIER_VIDEO,"controle","1","pseudo", $inscription->pseudo);
			//Accepter le carnet de voyage
			$membre->updateElement(TABLE_CARNET_DE_VOYAGE,"controle","ok","identifiant",$inscription->id);
			
			afficherAlerte("Carnet accepté [mise en ligne]!");
			redirection(4,'./carnet.php');
			//---------------------------------------------------------------------------------------
		}
		else{
		?>
		<form action="./carnet-modifier.php?prw=1&id_carnet=<?php echo $_GET['id_carnet']; ?>" method="post">
			<ul>
				<li>Titre : <input type="text" name="intitule" value="<?php echo stripslashes($carnet->intitule); ?>" size="79"/></li>
				<li style="text-align:center;"><textarea name="description" rows="25" cols="81"><?php echo stripslashes($carnet->commentaire); ?></textarea></li>
				<li style="text-align:center;padding-top:15px;"><input type="submit" value="Modifier mon carnet" /></li>
			</ul>
		</form>
		<?php
		}
		?>
	</div>
	<!-- ESPACE VIDEO -->
	<div id="carnet_video">
		<div class="ma_video"><?php echo afficherVideo($video->fichier, $metier->extraireDroite($video->fichier, 3),nommageRepertoire($inscription->id)); ?></div>
			<div class="ma_gestion_video">
			<?php
			if($video->fichier != "" AND $video->controle == 0){
				echo '<h2>Video [en attente]</h2>';
			}
			elseif($video->fichier != "" AND $video->controle == 1){
				echo '<h2>Vdéo [en ligne]</h2>';
			}
			else{
				echo '<h2>[Pas de vidéo]</h2>';
			}
			//-------------------------------------
			if($_GET['gt_v'] == 1){
				//Traitement...
				if($_POST['vo'] == "sp"){
					//Traitement...
					if($video->fichier != ""){
						unlink(REPERTOIRE_VIDEO.nommageRepertoire($inscription->id).$video->fichier);
						$membre->supprimerUnElement(TABLE_FICHIER_VIDEO, "pseudo", $inscription->pseudo);
					}
					afficherAlerte("Vidéo supprimée !");
					redirection(4,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
				}
				else{
					redirection(0,'./carnet-modifier.php?id_carnet='.$_GET['id_carnet']);
				}
			}
			else{
				if($video->fichier != ""){
					?>
					<div class="ma_gestion_video_1">
						<form action="./carnet-modifier.php?gt_v=1&id_carnet=<?php echo $_GET['id_carnet']; ?>" method="post">
							<table>
								<tr>
									<td colspan="3" class="titre">Gestion de ma vidéo</td>
								</tr>
								<tr>
									<td>Sélectionner : </td>
									<td><input type="radio" name="vo" value="sp" /></td>
									<td><input type="submit" value="Envoyer" /></td>
								</tr>
							</table>
						</form>
					</div>
					<?php
				}
				else{
					//Pas de formulaire de suppression
				}
			}
			?>
		</div>
	</div>
	<p style="clear:left;"></p>
	<?php	
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>