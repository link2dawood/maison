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
		echo '<h4>[CARNET DE VOYAGE - CONSULTER ('.$inscription->pseudo.')]</h4>';
		//---------------------------------
		?>
		<p style="text-align:right;font-style:italic;padding:7px;"><a href="./carnet-modifier.php?prw=3&id_carnet=<?php echo $_GET['id_carnet']; ?>" style="font-weight:bolder;color:green;">[accepter]</a> | <a href="./carnet-modifier.php?id_carnet=<?php echo $_GET['id_carnet']; ?>">[modifier]</a> | <a href="./carnet-modifier.php?prw=2&id_carnet=<?php echo $_GET['id_carnet']; ?>" style="color:red;font-weight:bolder;">[supprimer]</a></p>
		<div id="carnet_galerie">
			<h2>Ma galerie photos [<?php echo $inscription->pseudo; ?>]</h2>
			<ul>
				<!-- GALERIE PHOTOS -->
				<li>
					<div id="motioncontainer" style="position:relative;overflow:hidden;">
						<div id="motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;">
							<br />
							<nobr id="trueContainer">
							<?php
							$compter = $membre->compterUnElement(TABLE_GALERIE_PHOTOS,"identifiant",$_GET['id_carnet']);
							if($compter == "" OR $compter == 0){
								echo "pas de photos disponibles...";
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
			<h2>Ma vidéo</h2>
			<div class="ma_video"><?php echo afficherVideo($video->fichier, $metier->extraireDroite($video->fichier, 3),nommageRepertoire($inscription->id)); ?></div>
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