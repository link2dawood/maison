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

//TRAITEMENT DU SUPPORT DE LANGUE
includeLanguage(RACINE, LANGUAGE, FILENAME_MESSAGERIE_2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="<?php echo CONFIGURATION_CONTENT; ?>; charset=<?php echo CONFIGURATION_CHARSET; ?>" />
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo CONFIGURATION_LIGHTBOX_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
	<?php echo CONFIGURATION_LIGHTBOX_JS; ?>
	<?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>
	<script language="javascript">
		new Ajax.PeriodicalUpdater(
		    'messenger',
		    '<?php echo HTTP_SERVEUR.'interface/'.FILENAME_MAJ_MESSAGES_TCHAT; ?>',
		    {
		        frequency: <?php echo RAFRAICHISSEMENT_MESSAGES_DUO_WEBCAMS; ?>,
		        decay:1
		    }
		);
    </script>
</head>
<body>
<!-- DEBUT EXTERIEUR -->
<p style="padding:4px;border-bottom:1px dashed grey;"><?php echo MESSAGE_ACCES_TCHAT; ?></p>
<div id="messenger"></div>
<!-- FIN EXTERIEUR -->
</body>
</html>