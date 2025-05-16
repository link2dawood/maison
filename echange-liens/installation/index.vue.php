<?php
	if(file_exists('../inc/config.inc.php'))
	{
		header('Location: ../');
		exit();
	}
?>
<!-- COPYRIGHT :
Créateurs du script : Victor T. & PaidPR.com
Pour : http://www.paidpr.com/ - PaidPR : Vendre des liens, tout sur le PageRank...
Dernière mise à jour : Décembre 2008
Merci de laisser ce copyright ainsi que les liens menant vers PaidPR.com, bénéficiaire de ce script.
Pour redistribuer ce script, contactez-nous sur http://www.paidpr.com/contact.php.
/!\ LA REVENTE DE CE SCRIPT SANS NOTRE ACCORD EST INTERDITE /!\
FIN COPYRIGHT -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>Installation du script d'échange de liens - par Victor.T & PaidPR.com</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
	</head>
	<body>
		<div id="header">
			<h1>Installation du script d'échange de liens</h1>
			<!-- merci de laisser ce lien intact --><div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div><!-- fin du lien -->
		</div>
		<form action="" method="post" id="content">
			<p>
				<?php echo $erreur; ?>
				<span class="title">Installation</span><hr />
				<label for="login">Login pour l'administration :</label> <input type="text" name="login" id="login" value="<?php echo $login; ?>" /><br />
				<label for="pass1">Mot de passe pour l'administration :</label> <input type="password" name="pass1" id="pass1" /><br />
				<label for="pass2">Confirmation du mot de passe :</label> <input type="password" name="pass2" id="pass2" /><br />
				<label for="nom_du_site">Nom du site : </label><input type="text" name="nom_du_site" id="nom_du_site" value="<?php echo $nom_du_site; ?>" /><br />
				<label for="url_du_site_principal">Url du site principal : </label><input type="text" name="url_du_site_principal" id="url_du_site_principal" value="<?php if(isset($url_du_site_principal)) echo $url_du_site_principal; else echo 'http://' . $_SERVER['HTTP_HOST']; ?>" /><br />
				<input type="checkbox" name="a_lien_retour_page_interne" id="a_lien_retour_page_interne"<?php if(isset($_POST['a_lien_retour_page_interne'])) echo ' checked="checked"'; ?> /> <label for="a_lien_retour_page_interne">Autoriser le lien retour à être autre part qu'à l'accueil du site</label><br />
				<input type="radio" name="lien_en_dur_ou_redirection" id="lien_en_dur" value="DUR"<?php if($type_de_liens == 'DUR') echo ' checked="checked"'; ?> /> <label for="lien_en_dur">Liens en dur</label> <input type="radio" name="lien_en_dur_ou_redirection" id="lien_redirection" value="REDIRECTION"<?php if($type_de_liens == 'REDIRECTION') echo 'checked="checked"'; ?> /> <label for="lien_redirection">Liens avec redirection</label><br />
				<input type="checkbox" name="a_envoi_mails" id="a_envoi_mails"<?php if(isset($_POST['a_envoi_mails'])) echo ' checked="checked"'; ?> /> <label for="a_envoi_mails">Envoyer un mail si tout s'est bien déroulé</label><br />
				<input type="checkbox" name="a_ajout_pages_internes" id="a_ajout_pages_internes"<?php if(isset($_POST['a_ajout_pages_internes'])) echo ' checked="checked"'; ?> /> <label for="a_ajout_pages_internes">Autoriser l'ajout de pages internes</label><br />
				<input type="checkbox" name="a_liens_xxx" id="a_liens_xxx"<?php if(isset($_POST['a_liens_xxx'])) echo ' checked="checked"'; ?> /> <label for="a_liens_xxx">Autoriser les liens XXX</label><br />
				<label for="nbre_lien_par_page">Nombre de liens par page : </label><input type="text" size="4" name="nbre_lien_par_page" id="nbre_lien_par_page" value="<?php if(intval($_POST['nbre_lien_par_page'] != 0)) echo $_POST['nbre_lien_par_page']; ?>" /><br />
				Classer les liens : <input type="radio" name="classement" id="asc" value="CROISSANT"<?php if($classement == 'CROISSANT') echo ' checked="checked"'; ?> /> <label for="asc">Du plus ancien au plus récent</label> <input type="radio" name="classement" value="DECROISSANT" id="desc"<?php if($classement == 'DECROISSANT') echo ' checked="checked"'; ?> /> <label for="desc">Du plus récent au plus ancien</label><br />
				Entrez votre adresse e-mail : <input type="text" name="mail_admin" value="<?php echo $mail_admin; ?>" /><br />
				<input type="submit" value="Installation" />
			</p>
		</form>
	</body>
</html>