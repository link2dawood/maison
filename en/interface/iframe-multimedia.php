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

 if($_GET['tpe'] == "echange"){
	$titre_album = 'titre_album_ech';
	$titre_album_video = 'titre_album_ech_video';
	$titre_album_audio = 'titre_album_ech_audio';
}
elseif($_GET['tpe'] == "couchsurfing"){
	$titre_album = 'titre_album_couch';
	$titre_album_video = 'titre_album_couch_video';
	$titre_album_audio = 'titre_album_couch_audio';
}
else{
	
}
$img1 = $membre->getChamps("img1", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
$img2 = $membre->getChamps("img2", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
$img3 = $membre->getChamps("img3", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
$img4 = $membre->getChamps("img4", TABLE_ALBUM_PHOTO, "identifiant", $_SESSION['id_client']);
//Récupération de mon fichier audio et vidéo
$video_existant = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $_SESSION['pseudo_client']);
$audio_existant = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $_SESSION['pseudo_client']);
//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_DEPOT_ANNONCE);
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
<div id="popup">
	<?php
	if(empty($_SESSION['pseudo_client'])){
		//ESPACE RESTREINT....
	}
	else{
		?>
		<div class="album">
			<ul>
				<li id="<?php echo $titre_album; ?>"><p><?php echo TEXTE_49; ?></p></li>
				<li class="photo">
					<table>
						<tr>
							<td style="text-align:center;">
								<?php echo afficherMiniatureAlbumPhoto($_SESSION['id_client'], libelleImage($_SESSION['pseudo_client'],1), $img1, "ok","sans_1.jpg");	?>
								<p>
									<?php
									if($img1){
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=5&action=sm',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>'); 
									}
									else{
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=5&action='.$_GET['action'].'',400,200,'<span style="font-size:10px;">'.TEXTE_50.'</span>'); 
									}
									 ?>
								</p>
							</td>
							<td style="text-align:center;">
								<?php echo afficherMiniatureAlbumPhoto($_SESSION['id_client'], libelleImage($_SESSION['pseudo_client'],2), $img2, "ok","sans_2.jpg");	?>
								<p>
									<?php
									if($img2){
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=6&action=sm',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>'); 
									}
									else{
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=6&action='.$_GET['action'].'',400,200,'<span style="font-size:10px;">'.TEXTE_50.'</span>'); 
									}
									 ?>
								</p>
							</td>
							</tr>
							<tr>
								<td style="text-align:center;">
									<?php echo afficherMiniatureAlbumPhoto($_SESSION['id_client'], libelleImage($_SESSION['pseudo_client'],3), $img3, "ok","sans_3.jpg");	?>
									<p>
									<?php
									if($img3){
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=7&action=sm',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>'); 
									}
									else{
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=7&action='.$_GET['action'].'',400,200,'<span style="font-size:10px;">'.TEXTE_50.'</span>'); 
									}
									 ?>
								</p>
								</td>
								<td style="text-align:center;">
									<?php echo afficherMiniatureAlbumPhoto($_SESSION['id_client'], libelleImage($_SESSION['pseudo_client'],4), $img4, "ok","sans_4.jpg");	?>
									<p>
									<?php
									if($img4){
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=8&action=sm',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>'); 
									}
									else{
										echo fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=8&action='.$_GET['action'].'',400,200,'<span style="font-size:10px;">'.TEXTE_50.'</span>'); 
									}
									 ?>
								</p>
								</td>
							</tr>
						</table>
					</li>
					<li id="<?php echo $titre_album_video; ?>"><p><?php echo TEXTE_51; ?></p></li>
					<li class="video">
						<table>
							<tr>
								<td style="text-align:center;">
									<?php
									if($video_existant){
										//Regarder la vidéo
										echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=rg&tpe='.$_GET['tpe'].'',700,270,'<span style="font-size:10px;">'.TEXTE_72.'</span>').'</p>';
										//Supprimer la vidéo
										echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=sm&tpe='.$_GET['tpe'].'',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>').'</p>';
									}
									else{
										//Ajouter une vidéo
										echo '<p style="padding-top:20px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=9&action=aj&tpe='.$_GET['tpe'].'',700,320,'<span style="font-size:10px;">'.TEXTE_50.'</span>').'</p>';
									}
									?>
								</td>
								<td><img src="<?php echo HTTP_IMAGE; ?>media-player.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
							</tr>
						</table>
					</li>
					<li id="<?php echo $titre_album_video; ?>"><p><?php echo TEXTE_52; ?></p></li>
					<li class="audio">
						<table>
							<tr>
								<td style="text-align:center;">
									<?php
									if($audio_existant){
										//Regarder la vidéo
										echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=ec&tpe='.$_GET['tpe'].'',700,270,'<span style="font-size:10px;">'.TEXTE_73.'</span>').'</p>';
										//Supprimer la vidéo
										echo '<p style="padding-top:10px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=sm&tpe='.$_GET['tpe'].'',400,200,'<span style="font-size:10px;">'.TEXTE_71.'</span>').'</p>';
									}
									else{
										//Ajouter une vidéo
										echo '<p style="padding-top:20px;">'.fenetrePopUp(HTTP_SERVEUR.'interface/'.FILENAME_POPUP_IDENTITE.'?atn=10&action=aj&tpe='.$_GET['tpe'].'',700,320,'<span style="font-size:10px;">'.TEXTE_50.'</span>').'</p>';
									}
									?>
								</td>
								<td><img src="<?php echo HTTP_IMAGE; ?>loudspeaker.png" alt="<?php echo ATTRIBUT_ALT; ?>"/></td>
							</tr>
						</table>
					</li>
				</ul>
			</div>	
		<?php
	}
	?>
</div>
</body>
</html>