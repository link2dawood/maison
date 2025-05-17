<?php
if (isset($_GET['PHPSESSID']) || isset($_COOKIE[session_name()])){
	session_start() ;
}
include('../interface/applications/commun/fct-utile.php');
include('../interface/applications/classes/class.EspaceMembre.php');
include('../interface/applications/classes/class.Metier.php');
// include('identifiants.php');
require_once('../interface/applications/commun/configuration.php');
// include(INCLUDE_FCTS_UTILE);
// include(INCLUDE_CLASS_ESPACE_MEMBRE);
// $membre = new EspaceMembre();
// include(INCLUDE_CLASS_METIER);
// $metier = new Metier();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ADMINISTRATION</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
    <link href="<?php echo CONFIGURATION_CSS; ?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="http://localhost/maison/css/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
    <?php echo afficherMetaLangue(LANGUAGE); ?>
    <?php echo CONFIGURATION_ROBOTS_NOFOLLOW; ?>
    <script src="http://localhost/maison/interface/applications/lightbox/lightbox.js"></script>
    <script src="http://localhost/maison/interface/applications/lightbox/global.js"></script>
	<!-- <?php include(INCLUDE_COMPATIBILITE_NAVIGATEURS); ?>	 -->
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
	?>
	<?php include('menu.php'); ?>
	<?php include('info.php'); ?>
	<h1>Administration</h1>
	<p style="margin-top:20px;margin-bottom:50px;"><img src="<?php echo HTTP_IMAGE; ?>warning.gif" alt="progressbar" /> ATTENTION... par mesure de sécurité, il n'est pas possible de modifier le compte d'un membre connecté!<br />
	La raison en est très simple...<br />
	Le fait de modifier ses données alors que celui-ci est connecté, viendrait altérer le processus de connexion. C'est pourquoi, lorsque vous validez des membres dans la rubrique NOUVEAUX INSCRITS,
	Les membres sont tous hors connexion!</p>
	<?php
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>
