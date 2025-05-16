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
		echo '<h4>[Configuration]</h4>';
		
		if(empty($_POST['controle'])){
			include(INCLUDE_ADMIN_CONFIGURATION);
		}
		else{
			//TRAITEMENT...
			if(is_numeric($_POST['requiredNombreAnnonce']) 
				AND is_numeric($_POST['requiredNombreColonne']) 
				AND is_numeric($_POST['requiredExtraitContenuDebut']) 
				AND is_numeric($_POST['requiredExtraitContenuFin']) 
				AND is_numeric($_POST['requiredDureeConnexion']) 
				AND is_numeric($_POST['requiredLimiteConnexion']) 
				AND is_numeric($_POST['requiredPeriodeRaffrPage']) 
				AND is_numeric($_POST['requiredLimiteMajorite']) 
				AND is_numeric($_POST['requiredPeriodeRaffrMessenger']) 
				AND is_numeric($_POST['requiredTempsAffichageInfo']) 
				AND is_numeric($_POST['requiredTempsAffichageMessenger']) 
				AND is_numeric($_POST['requiredMessagesParPage']) 
				AND is_numeric($_POST['requiredNombreCaracteresExtrait']) 
				AND is_numeric($_POST['requiredNombreBacklisterParPage']) 
				AND is_numeric($_POST['requiredNombreMessagesConversationDuo']) 
				AND is_numeric($_POST['requiredRaffrTempsDuo']) 
				AND is_numeric($_POST['requiredLargeurDuo']) 
				AND is_numeric($_POST['requiredHauteurDuo']) 
				AND is_numeric($_POST['requiredGratuitNouveauClient'])){
				//OK BON POUR INSERTION DANS LA TABLE CONFIGURATION...
				$requiredRacineFichier = validerSynthaxe($_POST['requiredRacineFichier'], "sans-slash");
				$requiredRacineSite = validerSynthaxe($_POST['requiredRacineSite'], "sans-slash");
				$requiredRacineSiteFR = validerSynthaxe($_POST['requiredRacineSiteFR'], "avec-slash");
				$requiredRacineSiteEN = validerSynthaxe($_POST['requiredRacineSiteEN'], "avec-slash");
				$requiredRacineSiteDE = validerSynthaxe($_POST['requiredRacineSiteDE'], "avec-slash");
				$requiredAccesFlash = validerSynthaxe($_POST['requiredAccesFlash'], "avec-slash");
				$email = minuscule($_POST['requiredMailCorrespondance']);
				$emailPaypal = minuscule($_POST['requiredMailPaypal']);
				if($requiredRacineFichier == "ok" 
					AND $requiredRacineSite == "ok" 
					AND $requiredRacineSiteFR == "ok" 
					AND $requiredRacineSiteEN == "ok" 
					AND $requiredRacineSiteDE == "ok" 
					AND $requiredAccesFlash == "ok"
					AND $email != "" 
					AND $emailPaypal != ""){
					//TOUT EST CONTROLE... ON ENREGISTRE....
					$array_config = array('', 
											$_POST['requiredRacineFichier'],
											$_POST['requiredRacineSite'],
											$_POST['requiredAccesBDD'],
											$_POST['requiredLoginBDD'],
											$_POST['requiredPasseBDD'],
											$_POST['requiredNomBDD'],
											$_POST['requiredNomBDDPaiement'],
											$_POST['requiredRacineSiteFR'],
											$_POST['requiredRacineSiteEN'],
											$_POST['requiredRacineSiteDE'],
											$_POST['requiredCharset'],
											$_POST['requiredTypeContent'],
											$_POST['requiredAccesFlash'],
											$_POST['requiredNombreAnnonce'],
											$_POST['requiredNombreColonne'],
											$_POST['requiredExtraitContenuDebut'],
											$_POST['requiredExtraitContenuFin'],
											$_POST['requiredDureeConnexion'],
											$_POST['requiredLimiteConnexion'],
											$_POST['requiredPeriodeRaffrPage'],
											$_POST['requiredLimiteMajorite'],
											$_POST['requiredPeriodeRaffrMessenger'],
											$_POST['requiredTempsAffichageInfo'],
											$_POST['requiredTempsAffichageMessenger'],
											$_POST['requiredMessagesParPage'],
											$_POST['requiredNombreCaracteresExtrait'],
											$_POST['requiredNombreBacklisterParPage'],
											$_POST['requiredNombreMessagesConversationDuo'],
											$_POST['requiredRaffrTempsDuo'],
											$_POST['requiredLargeurDuo'],
											$_POST['requiredHauteurDuo'],
											$_POST['requiredGratuitNouveauClient'],
											$email,
											$emailPaypal);
					for($i=1;$i<count($array_config); $i++){
						$membre->updateConfiguration($array_config[$i], $i);
					}
					
					messageErreur("Félicitation... la configuration du site a été correctement mis à jour !");
					redirection(3, HTTP_ADMIN.FILENAME_ADMIN_CONFIGURATION);
				}
				else{
					messageErreur("ERREUR...ATTENTION à respecter la synthaxe pour chaque champs !");
					redirection(3, HTTP_ADMIN.FILENAME_ADMIN_CONFIGURATION);
				}
			}
			else{
				messageErreur("ERREUR...ATTENTION à respecter la synthaxe pour chaque champs !");
				redirection(3, HTTP_ADMIN.FILENAME_ADMIN_CONFIGURATION);
			}
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>
