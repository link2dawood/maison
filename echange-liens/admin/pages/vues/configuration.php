<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>ADMINISTRATION - Configuration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript">
		<!--
			var nombre_de_titres = <?php echo count($config['noms_du_site']); ?>;
			
			function ajouterTitre()
			{
				nombre_de_titres++;
				document.getElementById('titres').innerHTML += '<label for="nom_du_site' + nombre_de_titres + '">Nom du site n°' + nombre_de_titres + ' : </label><input type="text" name="nom_du_site' + nombre_de_titres + '" id="nom_du_site' + nombre_de_titres + '" /><br />';
				document.getElementById('nom_du_site' + nombre_de_titres).focus();
			}
		//-->
		</script>
	</head>
	<body>
		<div id="header">
			<h1>Administration</h1>
			<div id="subtitle">powered by <a href="http://www.paidpr.com">paid<span class="green">pr</span>.com</a></div>
		</div>
		<?php echo $menu; ?>
		<form action="" method="post" id="content">
		<?php echo $erreur; ?>
			<span class="title">Configuration</span><hr />
			<p>
				<label for="login">Pseudo du dossier d'administration :</label> <input type="text" name="login" id="login" value="<?php echo $config['login']; ?>" /><br />
				<label for="pass1">Mot de passe du dossier d'administration :</label> <input type="password" name="pass1" id="pass1" value="<?php echo $config['pass']; ?>" /><br />
				<label for="pass2">Confirmation du mot de passe :</label> <input type="password" name="pass2" id="pass2" value="<?php echo $config['pass']; ?>" /><br />
			</p>
			<?php echo $titres; ?>
			<p>
				<input type="button" value="Ajouter un autre titre" onclick="javascript:ajouterTitre();" /><br />
				<label for="url_du_site_principal">Url du site principal : </label><input type="text" name="url_du_site_principal" id="url_du_site_principal" value="<?php echo $config['url_du_site_principal']; ?>" /><br />
				<input type="checkbox" name="a_lien_retour_page_interne" id="a_lien_retour_page_interne"<?php if($config['lien_retour'] == PARTOUT) echo ' checked="checked"'; ?> /> <label for="a_lien_retour_page_interne">Autoriser le lien retour à être autre part qu'à l'accueil du site</label><br />
				<input type="radio" name="lien_en_dur_ou_redirection" id="lien_en_dur" value="DUR"<?php if($config['type_de_liens'] == DUR) echo ' checked="checked"'; ?> /> <label for="lien_en_dur">Liens en dur</label> <input type="radio" name="lien_en_dur_ou_redirection" id="lien_redirection" value="REDIRECTION"<?php if($config['type_de_liens'] == REDIRECTION) echo 'checked="checked"'; ?> /> <label for="lien_redirection">Liens avec redirection</label><br />
				<input type="checkbox" name="a_envoi_mails" id="a_envoi_mails"<?php if($config['envoi_de_mails'] == OUI) echo ' checked="checked"'; ?> /> <label for="a_envoi_mails">Autoriser l'envoi d'un mail si tout s'est bien déroulé</label><br />
				<input type="checkbox" name="a_ajout_pages_internes" id="a_ajout_pages_internes"<?php if($config['ajout_pages_internes'] == OUI) echo ' checked="checked"'; ?> /> <label for="a_ajout_pages_internes">Autoriser l'ajout de pages internes de sites</label><br />
				<input type="checkbox" name="a_liens_xxx" id="a_liens_xxx"<?php if($config['liens_xxx'] == OUI) echo ' checked="checked"'; ?> /> <label for="a_liens_xxx">Autoriser les liens XXX</label><br />
				<label for="nbre_lien_par_page">Nombre de liens par page : </label><input type="text" size="4" name="nbre_lien_par_page" id="nbre_lien_par_page" value="<?php echo $config['nbre_lien_par_page']; ?>" /><br />
				Classer les liens : <input type="radio" name="classement" id="asc" value="CROISSANT"<?php if($config['classement'] == CROISSANT) echo ' checked="checked"'; ?> /> <label for="asc">Du plus ancien au plus récent</label> <input type="radio" name="classement" value="DECROISSANT" id="desc"<?php if($config['classement'] == DECROISSANT) echo ' checked="checked"'; ?> /> <label for="desc">Du plus récent au plus ancien</label><br />
				Entrez votre adresse e-mail : <input type="text" name="mail_admin" value="<?php echo $config['mail_admin']; ?>" /><br />
				<input type="submit" value="Enregistrer" />
			</p>
		</form>
		<?php echo $footer; ?>
	</body>
</html>