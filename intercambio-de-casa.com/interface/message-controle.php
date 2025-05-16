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
//------------------------------------------------------------------
$messenger = $membre->getMessagerie($_GET['id']);
//DESTINATAIRE
$destinataire = $membre->getInscription($messenger[4]);

//VERIFIER SI MEMBRE ONLINE
$ident_dest = $membre->getChamps("identifiant", TABLE_ONLINE, "pseudo", $destinataire->pseudo);
$dest_connecter = etatConnecter($ident_dest);
//RENSEIGNER LE FICHIER XML/FLASH
if($messenger[12] == "message-video" AND !empty($messenger[9])){
	//Lecture du message VIDEO
	//chargerFlashXml($messenger[9], RACINE."/interface/controleur-lire-video.txt");
	$fichier = 'monFichier='.$messenger[9].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[9];
	$sonRep = nommageRepertoire($messenger[2]);
}
elseif($messenger[12] == "message-audio" AND !empty($messenger[8])){
	//Lecture du message VIDEO
	//chargerFlashXml($messenger[8], RACINE."/interface/controleur-lire-video.txt");
	$fichier = 'monFichier='.$messenger[8].'&repertoire='.nommageRepertoire($messenger[2]);
	$libelle = $messenger[8];
	$sonRep = nommageRepertoire($messenger[2]);
}
else{
	//ON FAIT RIEN MESSAGE TEXTE OU DUO...PAS DE CHARGEMENT XML
}
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
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <?php echo CONFIGURATION_LIGHTBOX_JS; ?>
    <?php echo CONFIGURATION_JS; ?>
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
	if($messenger[12] == "message-video"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-video/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-video/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-video/history/history.js" language="javascript"></script>'."\n";
	}
	elseif($messenger[12] == "message-audio"){
		echo '<link rel="stylesheet" type="text/css" href="'.HTTP_FLASH.'lire-audio/imageshistory/history.css" />' ."\n".
			 '<script src="'.HTTP_FLASH.'lire-audio/AC_OETags.js" language="javascript"></script>'."\n" .
			 '<script src="'.HTTP_FLASH.'lire-audio/history/history.js" language="javascript"></script>'."\n";
	}
	else{
		//ON FAIT RIEN...
	}
	?>
</head>
<body>
<?php
if(is_numeric($_GET['id'])){
	//CAS 1 : MESSAGE TEXTE
	if($messenger[12] == "message-texte"){
		//MESSAGE TEXTE
		echo '<div id="form_messenger">' ."\n".
			'<table>' ."\n".
			'<tr>' ."\n".
			'<td class="img_form">'.grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)).'</td>' ."\n".
			'<td class="text_top_form"><strong>'.$destinataire->pseudo.'</strong></td>' ."\n".
			'<td class="icone_form"><img src="'.HTTP_IMAGE.'message_texte.png" alt="icone"/></td>' ."\n".
			'</tr>' ."\n".
			'<tr>' ."\n".
			'<td class="com_txt" colspan="3">'.retrecirMessageTropLong($messenger[7]).'</td>' ."\n".
			'</tr>' ."\n".
			'</table>' ."\n".
			'</div>' ."\n";
		}
		//CAS 2 : MESSAGE AUDIO
		elseif($messenger[12] == "message-audio"){
			//MESSAGE AUDIO
			?>
			<div id="form_messenger">
				<table>
					<tr>
						<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)); ?></td>
						<td class="text_top_form"><strong><?php echo $destinataire->pseudo; ?></strong></td>
						<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_audio.png" alt="icone"/></td>
					</tr>
					<tr>
						<td class="com_txt_lire_audio" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
					</tr>
					<tr>
						<td class="space_lire_audio" colspan="3">
							<?php echo scriptJsLireAudio($fichier); ?>
							<br />
							<?php echo scriptFlashLireAudio($fichier); ?>
						</td>
					</tr>
				</table>
			</div>
			<?php
			}
			//CAS 3 : MESSAGE VIDEO
			elseif($messenger[12] == "message-video"){
				//MESSAGE VIDEO
				?>
				<div id="form_messenger">
					<table>
						<tr>
							<td class="img_form"><?php echo grandIconeConnexion($membre->getChamps("identifiant",TABLE_ONLINE,"pseudo",$destinataire->pseudo)); ?></td>
							<td class="text_top_form"><strong><?php echo $destinataire->pseudo; ?></strong></td>
							<td class="icone_form"><img src="<?php echo HTTP_IMAGE; ?>message_webcam.png" alt="icone"/></td>
						</tr>
						<tr>
							<td class="com_txt_lire_video" colspan="3"><?php echo retrecirMessageTropLong($messenger[7]); ?></td>
						</tr>
						<tr>
							<td class="space_lire_video" colspan="3">
								<?php echo scriptJsLireVideo($fichier); ?>
								<br />
								<?php echo scriptFlashLireVideo($fichier); ?>
							</td>
						</tr>
					</table>
				</div>
				<?php
			}
			//CAS 4 : ERREUR...
			else{
				echo '<h1 style="text-align:center;margin-top:130px;">Puede usted cerrar la ventana...' .
			'<br/>ERROR</h1>';
			}
}
else{
	//RAS...
	echo '<h1 style="text-align:center;margin-top:130px;">Puede usted cerrar la ventana...' .
			'<br/>ERROR</h1>';
}
?>
</body>
</html>