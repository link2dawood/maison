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
	?>
	<?php include('menu.php'); ?>
	<?php include('info.php'); ?>
	<h1>Administration</h1>
	<h4>[Ecrire une newsletter]</h4>
	<?php
		//Controler le nb adresse email
		$array_email = $metier->getEmail();
		$nb_email = count($array_email);
		echo '<p style="text-align:left;">Nombres de membres contactés : <span style="color:#EF7227;font-weight:bolder;font-size:22px;">'.$nb_email.'</span></p>';
		$entete = '<table style="width:700px;margin:0px auto;border:1px solid #00327C;">' .
				  '<tr>' .
				  '<td><img src="'.HTTP_IMAGE.'top_mail.png" alt="images"/></td>' .
				  '</tr>' .
				  '<tr>' .
				  '<td>' .
				  '<h1 style="text-align:center;font-size:20px;padding-top:7px;">NEWSLETTER</h1>' .
				  '<div style="padding:3px;">';
						  
		$fin_news = '</div>' .
				'<p style="text-align:left;padding-top:10px;">Echange de maison et hébergement vacances gratuites</p>' .
				'<p style="text-align:left;"><a href="'.HTTP_SERVEUR.'">www.vacanceshome.com</a></p>' .
				'<h3 style="text-align:center;padding-top:10px;">MAIL AUTOMATIQUE - NE PAS REPONDRE</h3>' .
				'</td>' .
				'</tr>' .
				'</table>';
		
		if($nb_email == 0){
			echo afficherAlerte("Nous sommes désolés mais vous ne pouvez pas envoyer de newsletter!<br />Pas de compte email disponible...");
		}
		else{
			//ECRIRE NEWSLETTER
			if((empty($_POST['description']) AND empty($_GET['action'])) OR $_GET['type'] == "retour"){
				$contenu = stripslashes($metier->getChamps("contenu", TABLE_ECRIRE_NEWSLETTER, "id", $_POST['retour']));
				?>
				<form action="./newsletter.php?action=preview" method="post">
					<div style="margin:0 auto;margin-top:30px;width:810px;">
						<ul>
							<li><input type="hidden" name="traitement" value="<?php echo $_POST['retour']; ?>" /> <textarea name="description" rows="25" cols="90"><?php echo preview($contenu); ?></textarea></li>
							<li style="text-align:center;padding-top:15px;"><input type="submit" value="Prévisualiser votre NEWSLETTER" /></li>
						</ul>
					</div>
				</form>
				<?php
			}
			elseif($_POST['description'] != "" AND $_GET['action'] == "preview"){
				echo "<p style=\"text-align:center;font-size:16px;\">PREVIEW</p>";
				
				if(empty($_POST['traitement'])){
					$ma_news = str_replace('href="/"','href="'.HTTP_SERVEUR.'"',mysql_real_escape_string(text($_POST['description'])));
					$metier->enregisterNewsletter($ma_news);
					$enreg = mysql_insert_id();
					?>
					<p><a href='javascript:popUp("./mail-controle.php?id_msg=<?php echo $enreg; ?>",600,500,"menubar=no,scrollbars=no,statusbar=no")'><img src="<?php echo HTTP_IMAGE; ?>mail_controle.png" alt="rencontre webcam"/></a></p>
					<?php
					
					echo "<div style=\"text-align:right;\">"
						."<form action=\"./newsletter.php?action=preview&type=retour\" method=\"POST\" enctype=\"multi-part\">"
						."<input type=\"hidden\" name=\"retour\" value=\"".$enreg."\" />"
						."<input type=\"submit\" value=\"Revenir en ARRIERE\" />"
						."</form>"
						."</div>";
					
					echo "<div style=\"padding:3px;margin:auto;margin-top:10px;\">".$entete.stripslashes($ma_news).$fin_news."</div>";
				
					echo "<div style=\"text-align:center;margin-top:10px;margin-left:10px;\">"
						."<form action=\"./newsletter.php?action=send\" method=\"POST\" enctype=\"multi-part\">"
						."<input type=\"hidden\" name=\"numero\" value=\"".$enreg."\" />"
						."<input type=\"submit\" value=\"Envoyer cette NEWSLETTER\" />"
						."</form>"
						."</div>";
				}
				else{
					$ma_news = str_replace('href="/"','href="'.HTTP_SERVEUR.'"',mysql_real_escape_string(text($_POST['description'])));
					$metier->updateNewsletter($ma_news, $_POST['traitement']);
					?>
					<p><a href='javascript:popUp("./mail-controle.php?id_msg=<?php echo $_POST['traitement']; ?>",600,500,"menubar=no,scrollbars=no,statusbar=no")'><img src="<?php echo HTTP_IMAGE; ?>mail_controle.png" alt="rencontre webcam"/></a></p>
					<?php
					
					echo "<div style=\"text-align:right;padding-right:7px;\">"
						."<form action=\"./newsletter.php?action=preview&type=retour\" method=\"POST\" enctype=\"multi-part\">"
						."<input type=\"hidden\" name=\"retour\" value=\"".$_POST['traitement']."\" />"
						."<input type=\"submit\" value=\"Revenir en ARRIERE\" />"
						."</form>"
						."</div>";
					
					echo "<div style=\"padding:3px;margin:auto;margin-top:10px;\">".$entete.stripslashes($ma_news).$fin_news."</div>";
				
					echo "<div style=\"text-align:center;margin-left:10px;margin-top:10px;\">"
						."<form action=\"./newsletter.php?action=send\" method=\"POST\" enctype=\"multi-part\">"
						."<input type=\"hidden\" name=\"numero\" value=\"".$_POST['traitement']."\" />"
						."<input type=\"submit\" value=\"Envoyer cette NEWSLETTER\" />"
						."</form>"
						."</div>";
				}
				
			}
			elseif($_GET['action'] == "send"){
				$newsletter = stripslashes($metier->getChamps("contenu", TABLE_ECRIRE_NEWSLETTER, "id", $_POST['numero']));
				
				for($i=0;$i<count($array_email);$i++){
					if($array_email[$i] == MAIL_CORRESPONDANCE){
						//On continue la boucle...
					}
					else{
						envoiNewsletter($array_email[$i], $entete.$newsletter.$fin_news);
					}
				}
				
				messageErreur("Félicitation newsletter envoyé !");
				redirection(4, HTTP_ADMIN);
			}
			else{
				redirection(0, HTTP_ADMIN);
			}	
		}
	}
?>
	<div id="footer_ad"><?php include('footer.php'); ?></div>
</div>
<!-- FIN EXTERIEUR -->
</body>
</html>
