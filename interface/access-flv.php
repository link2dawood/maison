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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_PROFIL_MEMBRE);
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
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
	<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 28;
// -----------------------------------------------------------------------------
// -->
</script>
<?php
	if($_GET['f'] == 1){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-video-profil/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-video-profil/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-video-profil/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($_GET['f'] == 2){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-audio-profil/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-audio-profil/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-audio-profil/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ERREUR
	}
	?>
</head>
<body>
<?php
	if($_GET['pid'] != "" AND is_numeric($_GET['pid'])){
		$pseudo = $membre->getChamps("pseudo", TABLE_INSCRIPTION, "id", $_GET['pid']);
			
		if($_GET['f'] == 1){
			//ACTION FLASH VIDEO
			$fichier_video = $membre->getChamps("fichier", TABLE_FICHIER_VIDEO, "pseudo", $pseudo);
			$chaine = 'monFichier='.$fichier_video.'&repertoire='.nommageRepertoire($_GET['pid']);
			?>
			<div id="pop_flash">
				<?php echo scriptJsProfilVideo($chaine); ?>
				<br />
				<?php echo scriptFlashProfilVideo($chaine); ?>
			</div>
			<?php
		}
		elseif($_GET['f'] == 2){
			//ACTION FLASH AUDIO
			$fichier_audio = $membre->getChamps("fichier", TABLE_FICHIER_AUDIO, "pseudo", $pseudo);
			$chaine = 'monFichier='.$fichier_audio.'&repertoire='.nommageRepertoire($_GET['pid']);
			?>
			<div id="pop_flash">
				<?php echo scriptJsProfilAudio($chaine); ?>
				<br />
				<?php echo scriptFlashProfilAudio($chaine); ?>
			</div>
			<?php
		}
		else{
			//ERREUR
		}
	}
	else{
		//ERREUR
	}
	?>
</body>
<html>