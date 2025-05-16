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
		echo '<h4>[modifier ses identifiants de connexion]</h4>';
	
		$login = minuscule($_POST['login']);
		$passe = md5(textLibre($_POST['passe1']));
		$caractersSpeciauxPseudo = caractSpeciaux($login);
		
		if(textLibre($_POST['passe1']) != textLibre($_POST['passe2'])){
			//ERREUR
			redirection(3, HTTP_ADMIN.FILENAME_IDENTIFIANTS);
			messageErreur("Attention... la confirmation du mot de passe n'est pas valide !");
		}
		elseif($caractersSpeciauxPseudo == 1){
			redirection(3, HTTP_ADMIN.FILENAME_IDENTIFIANTS);
			messageErreur("Attention... les caractères spéciaux ne sont pas admis dans le login !");
		}
		else{
			//OK MAJ DES IDENTIFIANTS....
			$metier->updateIdentifiantsAdmin($login, $passe, textLibre($_POST['passe1']));
			redirection(3, HTTP_ADMIN);
			detruireSession();
			messageErreur("Félicitation... mise à jour effectuée !<br />Vous devez vous reconnecter !");
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>